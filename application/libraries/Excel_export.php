<?php
// File: application/libraries/Excel_export.php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

/**
 * Excel Export Library menggunakan PhpSpreadsheet
 * 
 * @author ArChiee
 */
class Excel_export {

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    /**
     * Export data audiometri ke Excel
     */
    public function export_audiometri_data($data) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Audiometri System by ArChiee')
            ->setLastModifiedBy('ArChiee')
            ->setTitle('Data Tes Audiometri')
            ->setSubject('Laporan Audiometri')
            ->setDescription('Export data hasil tes audiometri')
            ->setKeywords('audiometri excel export')
            ->setCategory('Medical Report');

        // Set column headers
        $headers = [
            'A1' => 'No',
            'B1' => 'Tanggal Tes',
            'C1' => 'No RM',
            'D1' => 'Nama',
            'E1' => 'Umur',
            'F1' => 'Jenis Kelamin',
            'G1' => 'Perusahaan',
            'H1' => 'Jabatan',
            'I1' => 'R-AC-250',
            'J1' => 'R-AC-500',
            'K1' => 'R-AC-1000',
            'L1' => 'R-AC-2000',
            'M1' => 'R-AC-3000',
            'N1' => 'R-AC-4000',
            'O1' => 'R-AC-6000',
            'P1' => 'R-BC-250',
            'Q1' => 'R-BC-500',
            'R1' => 'R-BC-1000',
            'S1' => 'R-BC-2000',
            'T1' => 'R-BC-3000',
            'U1' => 'R-BC-4000',
            'V1' => 'R-BC-6000',
            'W1' => 'L-AC-250',
            'X1' => 'L-AC-500',
            'Y1' => 'L-AC-1000',
            'Z1' => 'L-AC-2000',
            'AA1' => 'L-AC-3000',
            'AB1' => 'L-AC-4000',
            'AC1' => 'L-AC-6000',
            'AD1' => 'L-BC-250',
            'AE1' => 'L-BC-500',
            'AF1' => 'L-BC-1000',
            'AG1' => 'L-BC-2000',
            'AH1' => 'L-BC-3000',
            'AI1' => 'L-BC-4000',
            'AJ1' => 'L-BC-6000',
            'AK1' => 'Impression'
        ];

        // Set headers
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style headers
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2C3E50']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];

        $sheet->getStyle('A1:AK1')->applyFromArray($headerStyle);

        // Set row height for header
        $sheet->getRowDimension('1')->setRowHeight(25);

        // Fill data
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($item['tanggal_tes'])));
            $sheet->setCellValue('C' . $row, $item['no_rm']);
            $sheet->setCellValue('D' . $row, $item['nama']);
            $sheet->setCellValue('E' . $row, $item['umur']);
            $sheet->setCellValue('F' . $row, $item['jenis_kelamin']);
            $sheet->setCellValue('G' . $row, $item['perusahaan']);
            $sheet->setCellValue('H' . $row, $item['jabatan']);
            
            // Right ear AC values
            $sheet->setCellValue('I' . $row, $item['right_ac_250']);
            $sheet->setCellValue('J' . $row, $item['right_ac_500']);
            $sheet->setCellValue('K' . $row, $item['right_ac_1000']);
            $sheet->setCellValue('L' . $row, $item['right_ac_2000']);
            $sheet->setCellValue('M' . $row, $item['right_ac_3000']);
            $sheet->setCellValue('N' . $row, $item['right_ac_4000']);
            $sheet->setCellValue('O' . $row, $item['right_ac_6000']);
            
            // Right ear BC values
            $sheet->setCellValue('P' . $row, $item['right_bc_250']);
            $sheet->setCellValue('Q' . $row, $item['right_bc_500']);
            $sheet->setCellValue('R' . $row, $item['right_bc_1000']);
            $sheet->setCellValue('S' . $row, $item['right_bc_2000']);
            $sheet->setCellValue('T' . $row, $item['right_bc_3000']);
            $sheet->setCellValue('U' . $row, $item['right_bc_4000']);
            $sheet->setCellValue('V' . $row, $item['right_bc_6000']);
            
            // Left ear AC values
            $sheet->setCellValue('W' . $row, $item['left_ac_250']);
            $sheet->setCellValue('X' . $row, $item['left_ac_500']);
            $sheet->setCellValue('Y' . $row, $item['left_ac_1000']);
            $sheet->setCellValue('Z' . $row, $item['left_ac_2000']);
            $sheet->setCellValue('AA' . $row, $item['left_ac_3000']);
            $sheet->setCellValue('AB' . $row, $item['left_ac_4000']);
            $sheet->setCellValue('AC' . $row, $item['left_ac_6000']);
            
            // Left ear BC values
            $sheet->setCellValue('AD' . $row, $item['left_bc_250']);
            $sheet->setCellValue('AE' . $row, $item['left_bc_500']);
            $sheet->setCellValue('AF' . $row, $item['left_bc_1000']);
            $sheet->setCellValue('AG' . $row, $item['left_bc_2000']);
            $sheet->setCellValue('AH' . $row, $item['left_bc_3000']);
            $sheet->setCellValue('AI' . $row, $item['left_bc_4000']);
            $sheet->setCellValue('AJ' . $row, $item['left_bc_6000']);
            
            $sheet->setCellValue('AK' . $row, $item['impression']);
            
            $row++;
        }

        // Auto size columns
        foreach (range('A', 'AK') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Apply borders to data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];

        $sheet->getStyle('A1:AK' . ($row - 1))->applyFromArray($dataStyle);

        // Add alternating row colors
        for ($i = 2; $i < $row; $i += 2) {
            $sheet->getStyle('A' . $i . ':AK' . $i)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8F9FA']
                ]
            ]);
        }

        // Set filename
        $filename = 'Data_Audiometri_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create writer and output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        
        // Clean up
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        exit;
    }
}

?>
