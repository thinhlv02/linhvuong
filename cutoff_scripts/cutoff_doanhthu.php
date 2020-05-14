<?php
include("config/dbconnect.php");
include("config/dbconnect_acc.php");
include("config/dbconnect_log.php");
$timezone = +7;

$db = 'bancavip';
$db_logs = 'bancavip_logs';
$db_account = 'bancavip_account';
//echo 'ahihi';
//die();

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");
//$from = '2018-03-18';

//mysql_query("DELETE
//FROM `".$db."`.`khaosat_game`
//WHERE `id` = '101';");
//die();


//echo $from;
//die();
// Start date
//$from = '2018-02-24';
//// End date
//$end_date = '2018-02-26';
//
//while (strtotime($from) < strtotime($end_date)) {
//    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
//    echo $from;
//    echo "<br/>";
//}
//die();
//NRU
$str = "
  SELECT DATE(a.`end_at`) `day`, b.`provider_id`,COUNT(a.`id`) total_gd,
  SUM(ifnull(CASE WHEN a.`line_free` = 0 THEN a.`betmoney` * a.`num_line_cuoc` * 0.97 END,0)) total_thu,
  SUM(ifnull(a.money_win,0)) total_chi 
  FROM `" . $db_logs . "`.`match_logs` a JOIN " . $db_account . ".`users` b 
    ON a.`players` = b.`username` WHERE a.`gameid` IN (1,2) AND DATE(a.`end_at`) = '" . $from . "' GROUP BY b.`provider_id`
";
$querry = mysql_query("$str", $conn1) or die ("error str " . mysql_error());
//End NRU
while ($row = mysql_fetch_array($querry)) {
    $money_log = "SELECT  count(distinct a.`user_id`) sl  FROM `" . $db_logs . "`.`money_log` a 
              JOIN " . $db_account . ".`users` b  ON a.`user_id` = b.`id` 
            WHERE DATE(a.`logintime`) = '" . $from . "' AND b.provider_id = " . $row['provider_id'] . " 
    ";
    $querry2 = mysql_query("" . $money_log . "", $conn1) or die ("error querry 2: " . mysql_error() . "");
    $row2 = mysql_fetch_array($querry2);
    $loinhuan = $row['total_thu'] - $row['total_chi'];
//    xxxxxxxxx
    $fuck = "SELECT `id` FROM `" . $db_account . "`.`users` a WHERE DATE(a.`created_at`) = '$from' ";
//                        echo $fuck;
    $acc_new = mysql_query("$fuck ", $conn) or die('error acc_new' . mysql_error());
//
    $rs = array();
    while ($row_acc = mysql_fetch_array($acc_new)) {
        $rs[] = $row_acc['id'];
    }
    $ids = implode(",", $rs);
    if ($ids == 0) {
        $ids = 0;
    }
//                        $total_acc_new = count($rs);
//                        echo 'sl' .count($ids);
//                        echo 'ids' . $ids;
    //
    $doanhthu_new = mysql_query("
           SELECT DATE(a.`end_at`) `day`,
              COUNT(DISTINCT a.`players`) total_acc,
              COUNT(a.`id`) total_gd,
                IFNULL(SUM(CASE WHEN a.`line_free` = 0 THEN a.`betmoney` * a.`num_line_cuoc` END),0) total_thu,
              IFNULL(SUM(a.money_win),0) total_chi
            FROM
              `" . $db_logs . "`.`match_logs` a
              JOIN " . $db_account . ".`users` b
                ON a.`players` = b.`username`
            WHERE DATE(a.`end_at`) = '$from' AND b.id in ($ids) AND b.provider_id = " . $row['provider_id'] . "
        ") or die('error acc new: ' . mysql_error());
    $r_acc = mysql_fetch_array($doanhthu_new);
    $loinhuan3 = $r_acc['total_thu'] - $r_acc['total_chi'];
//    xxxxxxxxx

    $insert1 = mysql_query("
    INSERT INTO `" . $db_logs . "`.`cutoff_doanhthu` (
      `date`,
      `provider_id`,
      `sl`,
      `total_gd`,
      `total_thu`,
      `total_chi`,
      `loinhuan`,
      `sl_moi`,
      `total_gd_moi`,
      `total_thu_moi`,
      `total_chi_moi`,
      `loinhuan_moi`
    ) 
    VALUES
      (
        '" . $from . "',
        '" . $row['provider_id'] . "',
        '" . $row2['sl'] . "',
        '" . $row['total_gd'] . "',
        '" . $row['total_thu'] . "',
        '" . $row['total_chi'] . "',
        '" . $loinhuan . "',
        '" . $r_acc['total_acc'] . "',
        '" . $r_acc['total_gd'] . "',
        '" . $r_acc['total_thu'] . "',
        '" . $r_acc['total_chi'] . "',
        '" . $loinhuan3 . "'
      ) ;
    ", $conn1) or die("erro I: " . mysql_error());
//    }
}
