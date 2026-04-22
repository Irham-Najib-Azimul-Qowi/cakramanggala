<?php

// File: app/Http/Controllers/PendaftarController.php

namespace App\Http\Controllers;

use App\Exports\PendaftarExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jurusan = $request->get('jurusan');
        $perPage = $request->get('per_page', 12); // Per Page 12 matches the grid layout better (4 columns)

        $query = \App\Models\Pendaftaran::orderBy('created_at', 'desc');

        if ($search) {
            $query->search($search);
        }

        if ($jurusan) {
            $query->byJurusan($jurusan);
        }

        $pendaftar = $query->paginate($perPage);

        // Statistics using Model
        $stats = [
            'total' => \App\Models\Pendaftaran::count(),
            'teknik' => \App\Models\Pendaftaran::where('jurusan', 'Teknik')->count(),
            'akuntansi' => \App\Models\Pendaftaran::where('jurusan', 'Akuntansi')->count(),
            'administrasi' => \App\Models\Pendaftaran::where('jurusan', 'Administrasi Bisnis')->count(),
            'bulan_ini' => \App\Models\Pendaftaran::thisMonth()->count(),
        ];

        return view('dashboard.pendaftar.index', compact('pendaftar', 'stats', 'search', 'jurusan', 'perPage'));
    }

    public function show($id)
    {
        $pendaftar = \App\Models\Pendaftaran::findOrFail($id);
        return view('dashboard.pendaftar.show', compact('pendaftar'));
    }

    public function approve($id)
    {
        $pendaftar = \App\Models\Pendaftaran::findOrFail($id);
        $pendaftar->update([
            'status' => 'approved',
            'is_approved' => true
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ' . $pendaftar->nama_lengkap . ' telah disetujui!');
    }

    public function reject($id)
    {
        $pendaftar = \App\Models\Pendaftaran::findOrFail($id);
        $pendaftar->update([
            'status' => 'rejected',
            'is_approved' => false
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ' . $pendaftar->nama_lengkap . ' telah ditolak.');
    }

    // METHOD BARU: Handle form pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|max:255',
            'nim' => 'required|max:20|unique:pendaftaran,nim',
            'jurusan' => 'required|max:100',
            'program_studi' => 'required|max:150',
            'semester' => 'required|integer|min:1|max:14',
            'no_hp' => 'required|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required|max:500',
            'motivasi' => 'required|max:1000',
            'pengalaman_organisasi' => 'nullable|max:500',
            'hobi' => 'nullable|max:200',
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = $request->except(['_token']);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        // Upload foto - SOLUSI BARU
        if ($request->hasFile('foto_diri')) {
            // Pastikan folder ada
            $uploadPath = public_path('uploads/pendaftaran');
            if (! File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate nama file unik
            $filename = time().'_'.Str::slug($request->nama_lengkap).'.'.$request->file('foto_diri')->getClientOriginalExtension();

            // Upload langsung ke public/uploads/pendaftaran/
            $request->file('foto_diri')->move($uploadPath, $filename);

            // Simpan path relatif ke database
            $data['foto_diri'] = 'uploads/pendaftaran/'.$filename;
        }

        // Insert ke database
        DB::table('pendaftaran')->insert($data);

        return redirect()->route('pendaftaran.success')
            ->with('success', 'Pendaftaran berhasil dikirim! Terima kasih telah mendaftar di UKM Cakra Manggala.');
    }

    // METHOD BARU: Handle update foto pendaftar (jika diperlukan)
    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pendaftar = DB::table('pendaftaran')->where('id', $id)->first();

        if (! $pendaftar) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Data pendaftar tidak ditemukan.');
        }

        // Hapus foto lama jika ada
        if ($pendaftar->foto_diri && File::exists(public_path($pendaftar->foto_diri))) {
            File::delete(public_path($pendaftar->foto_diri));
        }

        // Upload foto baru - SOLUSI BARU
        if ($request->hasFile('foto_diri')) {
            // Pastikan folder ada
            $uploadPath = public_path('uploads/pendaftaran');
            if (! File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate nama file unik
            $filename = time().'_'.$id.'.'.$request->file('foto_diri')->getClientOriginalExtension();

            // Upload langsung ke public/uploads/pendaftaran/
            $request->file('foto_diri')->move($uploadPath, $filename);

            // Update database dengan path relatif
            DB::table('pendaftaran')
                ->where('id', $id)
                ->update([
                    'foto_diri' => 'uploads/pendaftaran/'.$filename,
                    'updated_at' => now(),
                ]);
        }

        return redirect()->route('dashboard.pendaftar.show', $id)
            ->with('success', 'Foto pendaftar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendaftar = DB::table('pendaftaran')->where('id', $id)->first();

        if (! $pendaftar) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Data pendaftar tidak ditemukan.');
        }

        // Delete photo if exists - SOLUSI BARU
        if ($pendaftar->foto_diri && File::exists(public_path($pendaftar->foto_diri))) {
            File::delete(public_path($pendaftar->foto_diri));
        }

        // Delete record
        DB::table('pendaftaran')->where('id', $id)->delete();

        return redirect()->route('dashboard.pendaftar')
            ->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function export(Request $request)
    {
        try {
            $search = $request->get('search');
            $jurusan = $request->get('jurusan');

            // Debug: cek apakah ada data
            $query = DB::table('pendaftaran');
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                        ->orWhere('nim', 'LIKE', "%{$search}%")
                        ->orWhere('program_studi', 'LIKE', "%{$search}%");
                });
            }
            if ($jurusan) {
                $query->where('jurusan', $jurusan);
            }

            $dataCount = $query->count();

            if ($dataCount == 0) {
                return redirect()->route('dashboard.pendaftar')
                    ->with('error', 'Tidak ada data untuk diexport dengan filter yang dipilih.');
            }

            $filename = 'data-pendaftar-'.date('Y-m-d-H-i-s').'.xlsx';

            return Excel::download(new PendaftarExport($search, $jurusan), $filename);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Terjadi kesalahan saat export data: '.$e->getMessage());
        }
    }

    // METHOD BARU: Show success page
    public function success()
    {
        return view('pendaftaran.success');
    }

    public function exportSimple(Request $request)
    {
        try {
            $pendaftar = DB::table('pendaftaran')
                ->select('nim', 'nama_lengkap', 'jurusan', 'program_studi', 'no_hp', 'email')
                ->get();

            if ($pendaftar->isEmpty()) {
                return redirect()->route('dashboard.pendaftar')
                    ->with('error', 'Tidak ada data untuk diexport.');
            }

            $callback = function() use ($pendaftar) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['NIM', 'Nama Lengkap', 'Jurusan', 'Program Studi', 'No HP', 'Email']);

                foreach ($pendaftar as $item) {
                    fputcsv($file, [$item->nim, $item->nama_lengkap, $item->jurusan, $item->program_studi, $item->no_hp, $item->email]);
                }
                fclose($file);
            };

            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=pendaftar-simple-".date('Y-m-d').".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.pendaftar')
                ->with('error', 'Terjadi kesalahan saat export data: '.$e->getMessage());
        }
    }
}
