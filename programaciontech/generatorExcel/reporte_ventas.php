<?php

require_once __DIR__ . "/class/venta.class.php";
require_once __DIR__ . "/../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$venta = new Venta();
$lst = json_decode($venta->Reporte(), true);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Reporte Ventas");
$sheet->setShowGridlines(false);

$sheet->setCellValue("A1", "PRODUCTO");
$sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("A1")->getFont()->setBold(true)->setSize(14)->getColor()->setARGB("ff002060");

$sheet->setCellValue("B1", "CANTIDAD");
$sheet->getStyle("B1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("B1")->getFont()->setBold(true)->setSize(14)->getColor()->setARGB("ff002060");

$sheet->setCellValue("C1", "PRECIO");
$sheet->getStyle("C1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("C1")->getFont()->setBold(true)->setSize(14)->getColor()->setARGB("ff002060");

$sheet->setCellValue("D1", "IGV");
$sheet->getStyle("D1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("D1")->getFont()->setBold(true)->setSize(14)->getColor()->setARGB("ff002060");

$sheet->setCellValue("E1", "TOTAL");
$sheet->getStyle("E1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("E1")->getFont()->setBold(true)->setSize(14)->getColor()->setARGB("ff002060");

$fila = 2;

if($lst["code"] == 200){
    foreach($lst["data"] as $rpt){
        $sheet->setCellValue("A" . $fila, $rpt["Producto"]);
        $sheet->getColumnDimension("A")->setAutoSize(true);

        $sheet->setCellValue("B" . $fila, $rpt["Cantidad"]);
        $sheet->getColumnDimension("B")->setAutoSize(true);
        $sheet->getStyle("B" . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("C" . $fila, $rpt["Precio"]);
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getStyle("C" . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("C" . $fila)->getNumberFormat()->setFormatCode('"S/." #,##0.00');

        $sheet->setCellValue("D" . $fila, $rpt["IGV"]);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getStyle("D" . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $sheet->getStyle("D" . $fila)->getNumberFormat()->setFormatCode('"S/." #,##0.00');
        
        $sheet->setCellValue("E" . $fila, $rpt["Total"]);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        $sheet->getStyle("E" . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $sheet->getStyle("E" . $fila)->getNumberFormat()->setFormatCode('"S/." #,##0.00');

        $fila += 1;
    }

    $sheet->getStyle("A2:E" . $fila-1)->applyFromArray([
        "borders" => [
            "allBorders" => [
                "borderStyle" => Border::BORDER_THIN,
                "color" => ["argb" => "FF000000"]
            ]
        ]
    ]);
}

$write = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=reporte.xlsx");
header("Cache-Control: max-age=0");
$write->save("php://output");

?>