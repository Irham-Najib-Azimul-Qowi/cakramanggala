<?php

namespace App\Http\Controllers;

use App\Exports\PendaftarExport;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    /**
     * Display a listing of pendaftar with filters and stats.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jurusan = $request->get('jurusan');
        $perPage = $request->get('per_page', 12);

        $query = Pendaftaran::query();

        // Order by Status: Belum diproses -> Diterima -> Tidak diterima
        $query->orderByRaw("FIELD(status, 'Belum diproses', 'Diterima', 'Tidak diterima') ASC")
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->search($search);
        }

        if ($jurusan) {
            $query->byJurusan($jurusan);
        }

        $pendaftar = $query->paginate($perPage)->withQueryString();

        // Optimized statistics in fewer queries
        $allStats = Pendaftaran::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN jurusan = "Teknik" THEN 1 ELSE 0 END) as teknik,
                SUM(CASE WHEN jurusan = "Akuntansi" THEN 1 ELSE 0 END) as akuntansi,
                SUM(CASE WHEN jurusan = "Administrasi Bisnis" THEN 1 ELSE 0 END) as administrasi
            ')
            ->first();

        $stats = [
            'total' => $allStats->total ?? 0,
            'teknik' => $allStats->teknik ?? 0,
            'akuntansi' => $allStats->akuntansi ?? 0,
            'administrasi' => $allStats->administrasi ?? 0,
            'bulan_ini' => Pendaftaran::thisMonth()->count(),
        ];

        return view('dashboard.pendaftar.index', compact('pendaftar', 'stats', 'search', 'jurusan', 'perPage'));
    }

    /**
     * Display the specified pendaftar.
     */
    public function show(Pendaftaran $pendaftar)
    {
        return view('dashboard.pendaftar.show', compact('pendaftar'));
    }

    /**
     * Show the form for editing the specified pendaftar.
     */
    public function edit(Pendaftaran $pendaftar)
    {
        return view('dashboard.pendaftar.edit', compact('pendaftar'));
    }

    /**
     * Update the specified pendaftar in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftar)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email,' . $pendaftar->id,
            'nim' => 'nullable|string|max:50',
            'jurusan' => 'required|in:Teknik,Administrasi Bisnis,Akuntansi',
            'program_studi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'status' => 'required|in:Belum diproses,Diterima,Tidak diterima',
        ]);

        $pendaftar->update($validated);

        return redirect()->route('dashboard.pendaftar.show', $pendaftar->id)
            ->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Approve a pendaftaran.
     */
    public function approve(Pendaftaran $pendaftar)
    {
        $pendaftar->update([
            'status' => 'Diterima',
            'is_approved' => true
        ]);

        // Automatically create Anggota record
        $angkatanDefault = \App\Models\Setting::getValue('angkatan_pendaftaran_default', '14');

        // Check if member already exists by email
        $existingMember = \App\Models\Anggota::where('email', $pendaftar->email)->first();

        if (!$existingMember) {
            \App\Models\Anggota::create([
                'nama' => $pendaftar->nama_lengkap,
                'email' => $pendaftar->email,
                'nim' => $pendaftar->nim,
                'angkatan' => $angkatanDefault,
                'status' => 'anggota baru',
                'foto' => $pendaftar->foto_diri
            ]);
        }

        return redirect()->back()->with('success', "Pendaftaran {$pendaftar->nama_lengkap} telah diterima dan terdaftar sebagai Anggota Baru!");
    }

    /**
     * Reject a pendaftaran.
     */
    public function reject(Pendaftaran $pendaftar)
    {
        $pendaftar->update([
            'status' => 'Tidak diterima',
            'is_approved' => false
        ]);

        return redirect()->back()->with('success', "Pendaftaran {$pendaftar->nama_lengkap} ditolak.");
    }

    /**
     * Remove the specified pendaftar from storage.
     */
    public function destroy(Pendaftaran $pendaftar)
    {
        // Delete photo if exists
        if ($pendaftar->foto_diri && File::exists(public_path($pendaftar->foto_diri))) {
            File::delete(public_path($pendaftar->foto_diri));
        }

        $pendaftar->delete();

        return redirect()->route('dashboard.pendaftar')
            ->with('success', 'Data pendaftar berhasil dihapus.');
    }

    /**
     * Export pendaftar data to Excel.
     */
    public function export(Request $request)
    {
        try {
            $search = $request->get('search');
            $jurusan = $request->get('jurusan');

            $query = Pendaftaran::query();
            if ($search) {
                $query->search($search);
            }
            if ($jurusan) {
                $query->byJurusan($jurusan);
            }

            if ($query->count() === 0) {
                return redirect()->route('dashboard.pendaftar')
                    ->with('error', 'Tidak ada data untuk diexport dengan filter yang dipilih.');
            }

            $filename = 'data-pendaftar-' . now()->format('Y-m-d-H-i-s') . '.xlsx';

            return Excel::download(new PendaftarExport($search, $jurusan), $filename);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Terjadi kesalahan saat export data: ' . $e->getMessage());
        }
    }

    /**
     * Export simple CSV data.
     */
    public function exportSimple()
    {
        try {
            $pendaftar = Pendaftaran::select('email', 'nama_lengkap', 'jurusan', 'program_studi', 'no_hp', 'nim')
                ->get();

            if ($pendaftar->isEmpty()) {
                return redirect()->route('dashboard.pendaftar')
                    ->with('error', 'Tidak ada data untuk diexport.');
            }

            $callback = function() use ($pendaftar) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Email', 'Nama Lengkap', 'Jurusan', 'Program Studi', 'No HP', 'NIM']);

                foreach ($pendaftar as $item) {
                    fputcsv($file, [$item->email, $item->nama_lengkap, $item->jurusan, $item->program_studi, $item->no_hp, $item->nim]);
                }
                fclose($file);
            };

            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=pendaftar-simple-" . date('Y-m-d') . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Terjadi kesalahan saat export data: ' . $e->getMessage());
        }
    }
}

