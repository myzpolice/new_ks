<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

require_once '../../../models/Include.php';
require_once '../../../../phpexcel/Classes/PHPExcel.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');
*/
// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("KERANJANG SAYUR")
                             ->setLastModifiedBy("KERANJANG SAYUR")
                             ->setTitle("DETAIL PACKING")
                             ->setSubject("DETAIL PACKING")
                             ->setDescription("DETAIL PACKING OF KERANJANG SAYUR")
                             ->setKeywords("DETAIL PACKING")
                             ->setCategory("DETAIL PACKING");

$font = array(
    'font' => array(
        'name' => 'Calibri')
);

$styleArray = array(
    'font' => array(
        'bold' => true,
        'italic' => true,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$border = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '000000')
            )
        )
    );

$borderTop = array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$borderOutline = array(
        'borders' => array(
            'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            ),
            'vertical' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$bold = array(
    'font' => array(
        'bold' => true)
);

$color = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$forDesc = array(
    'font' => array(
        'italic' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$fillOrder = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFDD00')
                )
);
$fillShip = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFAA00')
                )
);

//$stmt = $transaction->detailPackingSplit();
$num = count($data);
$invDate = $data[0]['invoice_date'];
$invDateFormat = date('l, d F Y', strtotime($data[0]['invoice_date']));
$shipDateFormat = date('l, d F Y', strtotime($data[0]['shipping_date']));


$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setHeader(0.8);
$objPHPExcel->getActiveSheet()->getPageMargins()->setFooter(0.8);

$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$objPHPExcel->getActiveSheet()->getStyle('A1:E100')->applyFromArray($font);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
// Header

$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($fillOrder);
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($fillShip);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($border);

// Add some data

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ORDER')
            ->setCellValue('B1', $invDateFormat)
            ->setCellValue('A2', 'SHIPPING  ')
            ->setCellValue('B2', $shipDateFormat);


// table
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A4:A5')
            ->setCellValue('A4', 'TOTAL QTY')
            ->setCellValue('B4', 'ORDER')
            ->setCellValue('B5', 'NYA')
            ->mergeCells('C4:C5')
            ->setCellValue('C4', 'INVOICE')
            ->mergeCells('D4:D5')
            ->setCellValue('D4', 'NAMA')
            ->mergeCells('E4:F5')
            ->setCellValue('E4', 'BANYAKNYA')
            ->mergeCells('G4:G5')
            ->setCellValue('G4', 'KETERANGAN');

$row = 6;
$prevGroup = "";
for($x=0;$x<count($data);$x++){
            //$transaction->invoiceDate = $transaction->transactionDate;
            //$transaction->itemId = $rowTrans->item_id;
            //$stmtCount = count($data);
            //$rowCount = $stmtCount->fetch(PDO::FETCH_OBJ);
            $test = array_count_values(array_column($data, "item_id"));
            $z = $data[$x]['item_id'];
            $rows = $test[$z];
            $nums = $row + $rows - 1;
            $group = $data[$x]['item_name'];


            $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->applyFromArray($border);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $fill = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => preg_replace('/^#/', '', $data[$x]['highlight_color']))
                    )
                );

            if($data[$x]['highlight_color'] != NULL){
                $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($fill);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($fill);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($fill);
            }

            if($group !==$prevGroup){
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A'.$row.':A'.$nums)
                        ->setCellValue('A'.$row, $sum[$z]['item_qty'] . " " . $sum[$z]['unit_name']);
                        $prevGroup = $group;
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('B'.$row.':B'.$nums)
                        ->setCellValue('B'.$row, strtoupper($data[$x]['item_name']));
                        $prevGroup = $group;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C'.$row, $data[$x]['invoice_code'])
                        ->setCellValue('D'.$row, $data[$x]['customer_name'])
                        ->setCellValue('E'.$row, $data[$x]['item_qty'])
                        ->setCellValue('F'.$row, $data[$x]['unit_name'])
                        ->setCellValue('G'.$row, $data[$x]['description']);
    $row++;
}

// Rename wo'2016-11-22't
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Sheet1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=detail_packing-$invDate.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
