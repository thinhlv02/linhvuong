<?php
$timezone = +7;
include("config/dbconnect_acc.php");
include("config/dbconnect_log.php");
include("config/dbconnect.php");

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");

//mysql_query("DELETE
//FROM `slot_logs`.`cutoff_dau2`
//WHERE `id` > 1129");
//die();

// Start date
//$from = '2017-12-01';
//// End date
//$end_date = '2018-01-24';
//
//while (strtotime($from) < strtotime($end_date)) {
//    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
//    echo $from;
//    echo "<br/>";
//}
//
//
//die();

//user_login
$query_login = mysql_query("
SELECT a.hour_1 `hour`, a.user_login, b.hour_2, b.user_reg, SUM(a.user_login + b.user_reg) dau FROM
    
(SELECT  DATE_FORMAT(a.`created_at`, '%H') hour_1, COUNT(a.`id`) user_login FROM `bancavip_account`.`users` a WHERE 
DATE(a.`created_at`) < '" . $from . "' AND a.`id` IN (SELECT b.`user_id` FROM `bancavip_logs`.`money_log` b WHERE 
DATE(b.`logintime`) = '" . $from . "')  GROUP BY DATE_FORMAT(a.`created_at`, '%H')) a INNER JOIN 
 (SELECT DATE_FORMAT(a.`created_at`, '%H') hour_2, COUNT(a.`id`) user_reg FROM `bancavip_account`.`users` a WHERE 
 DATE(a.`created_at`) = '" . $from . "' GROUP BY DATE_FORMAT(a.`created_at`, '%H')) b ON a.hour_1 = b.hour_2 GROUP BY a.hour_1
") or die("error login: " . mysql_error());

while ($r = mysql_fetch_array($query_login)) {
    $str = "
        INSERT INTO `bancavip_logs`.`cutoff_dau2` (
          `date`,
          `hour`,
          `user_login`,
          `user_reg`,
          `dau`
        ) 
        VALUES
          (
            '" . $from . "',
            '" . $r['hour'] . "',
            '" . $r['user_login'] . "',
            '" . $r['user_reg'] . "',
            '" . $r['dau'] . "'
          ) ;
    ";
    $insert = mysql_query(" $str ", $conn1) or die("error Insert: " . mysql_error());
//    }
//    die luôn
}
?>
