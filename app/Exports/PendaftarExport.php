<?php
// File: app/Exports/PendaftarExport.php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $search;
    protected $jurusan;

    public function __construct($search = null, $jurusan = null)
    {
        $this->search = $search;
        $this->jurusan = $jurusan;
    }

    public function collection()
    {
        $query = DB::table('pendaftaran')->orderBy('created_at', 'desc');

        // Apply jurusan filter
        if ($this->jurusan) {
            $query->where('jurusan', $this->jurusan);
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Lengkap',
            'Jurusan',
            'Program Studi',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Usia',
            'No HP',
            'Alamat',
            'Organisasi Yang Pernah Diikuti',
            'Alasan Bergabung',
            'Tanggal Pendaftaran'
        ];
    }

    public function map($pendaftar): array
    {
        static $counter = 0;
        $counter++;
        
        return [
            $counter,
            $pendaftar->nim,
            $pendaftar->nama_lengkap,
            $pendaftar->jurusan,
            $pendaftar->program_studi,
            $pendaftar->jenis_kelamin,
            $pendaftar->tempat_lahir,
            \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d-m-Y'),
            \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->age . ' tahun',
            $pendaftar->no_hp,
            $pendaftar->alamat,
            $pendaftar->organisasi_yang_pernah_diikuti ?: 'Tidak Ada',
            $pendaftar->alasan_bergabung,
            \Carbon\Carbon::parse($pendaftar->created_at)->format('d-m-Y H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2E7D32']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            // Style all cells
            'A:N' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true
                ]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 12,  // NIM
            'C' => 25,  // Nama Lengkap
            'D' => 18,  // Jurusan
            'E' => 25,  // Program Studi
            'F' => 15,  // Jenis Kelamin
            'G' => 15,  // Tempat Lahir
            'H' => 12,  // Tanggal Lahir
            'I' => 10,  // Usia
            'J' => 15,  // No HP
            'K' => 30,  // Alamat
            'L' => 30,  // Organisasi
            'M' => 40,  // Alasan Bergabung
            'N' => 18   // Tanggal Pendaftaran
        ];
    }

    public function title(): string
    {
        return 'Data Pendaftar UKM Cakra Manggala';
    }
}