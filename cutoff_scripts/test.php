<?php
$timezone = +7;
//include("config/dbconnect_acc.php");
include("config/dbconnect_log.php");
include("config/dbconnect.php");

//$date = new DateTime(date("Y-m-d"));
//date_sub($date, date_interval_create_from_date_string("1 days"));
//$from = date_format($date, "Y-m-d");
$from = date("Y-m-d");

// Start date
//$from = '2017-10-23';
//// End date
//$end_date = '2017-11-10';
//
//while (strtotime($from) < strtotime($end_date)) {
//    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
//    echo $from;
//    echo "<br/>";
//}
//
//
//die();
//select last record

echo '1212';
#paycards: //select sum(a.`price`) price_pay_cards, SUM(a.`conversion_price`) price_pay_cards_cvs from linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =
$query_pay = mysqli_query($conn2, "select sum(a.`price`) price_pay_cards, SUM(a.`conversion_price`) price_pay_cards_cvs from 
    linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =  '" . $from . "' ") or die("error paycards: " . mysqli_error());
$row_pay = mysqli_fetch_array($query_pay);



$inapp_arr = mysqli_query($conn2, "select a.price, a.money from linhvuongmobile.tbl_product_id a group by price");

$inapp_arr_end = array();

while (($row_in = mysqli_fetch_assoc($inapp_arr))) {
    $inapp_arr_end[$row_in['price']] = $row_in['money'];
}
echo '<pre>';
print_r($inapp_arr_end);
echo '</pre>';

$query_in_logs = mysqli_query($conn1, "select xu,price from linhvuongmobile_logs.inapp_logs a where date(a.time) = '" . $from . "'") or die('errror inap logs');

$xu_inapp = 0;
$price_inapp = 0;
while (($row_in2 = mysqli_fetch_assoc($query_in_logs))) {
    $xu_inapp += $row_in2['xu'];

    foreach ($inapp_arr_end as $key => $value) {
        if ($key == $row_in2['price']) {
            $price_inapp += $value;
        }
    }
//    $price_inapp += $row_in2['xu'];

//    $inapp_arr_end[$row_in['price']]= $row_in['money'];
}

//echo $xu_inapp;
//echo $price_inapp;
// `total_recharge` int(11) DEFAULT '0',
//  `total_recharge_gold` int(11) DEFAULT '0',

$total_recharge = $row_pay['price_pay_cards'] + $xu_inapp;
$total_recharge_gold = $row_pay['price_pay_cards_cvs'] + $price_inapp;
echo  'total_recharget : '. $total_recharge;
echo  '$total_recharge_gold : '. $total_recharge_gold;

//var_dump($types);
//pre($types);

//inapp làm sau

?>
