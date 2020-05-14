<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(PHPEXCEL_LIB_PATH.'PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("AdX")
    ->setLastModifiedBy("AdX")
    ->setTitle("Office 2007 XLSX Document")
    ->setSubject("Office 2007 XLSX Document")
    ->setDescription($lang['transaction'] . " " . $fromdate->format('d-m-Y') . ' ' . $lang['to'] . ' ' . $todate->format('d-m-Y'))
    ->setCategory("");

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', $lang['date'])
    ->setCellValue('B1', $lang['transaction_code'])
    ->setCellValue('C1', $lang['content'])
    ->setCellValue('D1', $lang['offer'])
    ->setCellValue('E1', $lang['recharge_money'])
    ->setCellValue('F1', $lang['deductione_money'])
    ->setCellValue('G1', $lang['promotion_money'])
    ->setCellValue('H1', $lang['account_balance'])
    ->setCellValue('I1', $lang['account_promotion'])
    ->setCellValue('J1', $lang['status']);
$add_money = 0;
$sub_money = 0;
$promotion_money = 0;
$index = 2;
if ($user_paid) {
    foreach ($user_paid as $paid) {
        $add_money = $add_money + $paid['money'];
        if ((int)$paid['promotion'] > 0) {
            $promotion_money = $promotion_money + $paid['promotion'];
        }
        if ($paid['type'] == 0 && (int)$paid['status'] == 1) {

        } else if ($paid['type'] == 1) {
            $sub_money = $sub_money + $paid['money'];
        }
        if ($paid['type_pay'] != '') {
            $type_pay = $paid['type_pay'];
        } else if ($paid['pay_port'] == '1') {
            $type_pay = 'SohaPay';
        } else if ($paid['pay_port'] == '2') {
            $type_pay = 'Wepay';
        }
        $date = new DateTime($paid['payment_time']);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $index, $date->format('d-m-Y'))
            ->setCellValue('B' . $index, '#' . strip_tags($paid['payment_key']) . PHP_EOL . $date->format('d-m-Y'))
            ->setCellValue('C' . $index, strip_tags($paid['message']))
            ->setCellValue('D' . $index, strip_tags($type_pay))
            ->setCellValue('E' . $index, ($paid['type'] == 0 ? '+' . number_format($paid['money']) : ''))
            ->setCellValue('F' . $index, ($paid['type'] == 1 ? '-' . number_format($paid['money']) : ''))
            ->setCellValue('G' . $index, ((int)$paid['promotion'] > 0 ? '+' . number_format($paid['promotion']) : ''))
            ->setCellValue('H' . $index, number_format($paid['on_balance']))
            ->setCellValue('I' . $index, number_format($paid['on_promotion']))
            ->setCellValue('J' . $index, ((int)$paid['status'] == 1 ? $lang['arr_status'][1] : $lang['arr_status'][0]));
        $index++;
    }
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('B' . $index, 'Tổng')
    ->setCellValue('E' . $index, ($add_money > 0 ? '+' . number_format($add_money) : '+0'))
    ->setCellValue('F' . $index, ($sub_money > 0 ? '-' . number_format($sub_money) : '+0'))
    ->setCellValue('G' . $index, ($promotion_money > 0 ? '+' . $promotion_money : '+0'));

$objPHPExcel->getActiveSheet()->getStyle('B1:B' . $objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C1:C' . $objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setVisible(false);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Remarketing_transaction_report.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;