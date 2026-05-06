<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithDrawings
{
    private $rowNumber = 1;
    private $drawings = [];

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Anggota::where('is_deleted', false)
            ->with('pekerjaan')
            ->orderBy('nama_lengkap')
            ->get();
    }

    /**
     * Define the headings
     */
    public function headings(): array
    {
        return [
            'No',
            'Foto',
            'NIK',
            'No. KK',
            'Status KK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Golongan Darah',
            'Status Perkawinan',
            'Pekerjaan',
            'No. Telepon',
            'Desa',
            'RT',
            'RW',
            'Kelurahan',
            'Kecamatan',
            'Kabupaten',
            'Provinsi',
            'Tanggal Masuk'
        ];
    }

    /**
     * Map the data
     */
    public function map($anggota): array
    {
        $this->rowNumber++;

        // Handle image
        if ($anggota->foto && file_exists(public_path('storage/' . $anggota->foto))) {
            $drawing = new Drawing();
            $drawing->setName('Foto ' . $anggota->nama_lengkap);
            $drawing->setDescription('Foto Anggota');
            $drawing->setPath(public_path('storage/' . $anggota->foto));
            $drawing->setHeight(50);
            $drawing->setWidth(50);
            $drawing->setCoordinates('B' . $this->rowNumber);
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $this->drawings[] = $drawing;
        }

        return [
            $this->rowNumber - 1,
            '', // Foto column - will be filled by drawing
            $anggota->nik,
            $anggota->no_kk,
            $anggota->status_kk,
            $anggota->nama_lengkap,
            $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $anggota->tempat_lahir,
            $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d/m/Y') : '',
            $anggota->golongan_darah ?? '-',
            $anggota->status_perkawinan ?? '-',
            $anggota->pekerjaan->nama_pekerjaan ?? '-',
            $anggota->no_telp ?? '-',
            $anggota->desa ?? '-',
            $anggota->rt ?? '-',
            $anggota->rw ?? '-',
            $anggota->kelurahan ?? '-',
            $anggota->kecamatan ?? '-',
            $anggota->kabupaten ?? '-',
            $anggota->provinsi ?? '-',
            $anggota->tanggal_masuk ? $anggota->tanggal_masuk->format('d/m/Y') : '-'
        ];
    }

    /**
     * Define column widths
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 12,  // Foto
            'C' => 20,  // NIK
            'D' => 18,  // No. KK
            'E' => 15,  // Status KK
            'F' => 25,  // Nama Lengkap
            'G' => 12,  // Jenis Kelamin
            'H' => 15,  // Tempat Lahir
            'I' => 12,  // Tanggal Lahir
            'J' => 8,   // Golongan Darah
            'K' => 15,  // Status Perkawinan
            'L' => 20,  // Pekerjaan
            'M' => 15,  // No. Telepon
            'N' => 15,  // Desa
            'O' => 5,   // RT
            'P' => 5,   // RW
            'Q' => 15,  // Kelurahan
            'R' => 15,  // Kecamatan
            'S' => 15,  // Kabupaten
            'T' => 15,  // Provinsi
            'U' => 12,  // Tanggal Masuk
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Style for header row
        $sheet->getStyle('A1:U1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB'], // Blue header
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Style for data rows
        $lastRow = $this->collection()->count() + 1;
        $sheet->getStyle('A2:U' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP,
            ],
        ]);

        // Center align specific columns
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G2:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I2:I' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J2:J' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('O2:P' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('U2:U' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set row height for header
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Set row height for data rows (to accommodate images)
        for ($i = 2; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(60);
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Return drawings (images)
     */
    public function drawings()
    {
        return $this->drawings;
    }
}
