<?php

namespace App\Exports;

use App\Models\Node;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RtdReportExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function __construct(
        protected Node $node,
        protected \Illuminate\Support\Collection $rows
    ) {}

    public function title(): string
    {
        return 'RTD_' . preg_replace('/\s+/', '_', $this->node->node_id);
    }

    public function headings(): array
    {
        return ['Item No.', 'Pole Number', 'Location_Area', 'Cable Position', 'Detachment Date', 'REMARKS'];
    }

    public function collection()
    {
        return $this->rows->map(fn ($r, $i) => [
            $i + 1,
            $r->pole_number,
            $r->location,
            $r->cable_position,
            $r->detach_date,
            $r->remarks,
        ]);
    }

    public function columnWidths(): array
    {
        return ['A' => 10, 'B' => 16, 'C' => 48, 'D' => 18, 'E' => 24, 'F' => 24];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = max(1, $this->rows->count() + 1);

        // Header
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 11, 'name' => 'Calibri'],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A5F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(22);

        // Data rows
        if ($lastRow > 1) {
            $sheet->getStyle("A2:F{$lastRow}")->applyFromArray([
                'font'      => ['name' => 'Calibri', 'size' => 11],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A2:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("B2:B{$lastRow}")->getFont()->setBold(true);
            $sheet->getStyle("B2:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("E2:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Alternate row shading
            for ($row = 2; $row <= $lastRow; $row++) {
                $sheet->getRowDimension($row)->setRowHeight(18);
                if ($row % 2 === 0) {
                    $sheet->getStyle("A{$row}:F{$row}")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFF9FAFB');
                }
            }
        }

        // Borders
        $sheet->getStyle("A1:F{$lastRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFD0D7DE']]],
        ]);

        return [];
    }
}
