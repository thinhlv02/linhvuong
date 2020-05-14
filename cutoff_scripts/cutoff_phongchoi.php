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
//$from = '2018-03-22';
//mysql_query("DELETE
//FROM `".$db."`.`khaosat_game`
//WHERE `id` = '101';");
//die();


//echo $from;
//die();
// Start date
//$from = '2018-02-15';
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
 SELECT 
      DATE(a.`end_at`) `day`,
      a.`roomid`,
      b.`provider_id`,
      COUNT(DISTINCT a.`players`) count_stk,
      COUNT(a.`players`) count_soluotquay,
      SUM(ifnull(CASE WHEN a.`line_free` = 0 THEN a.`betmoney` * a.`num_line_cuoc` END,0)) total_money,
      SUM(ifnull(a.money_win,0)) money_win 
    FROM
      `".$db_logs."`.`match_logs` a  JOIN ".$db_account.".`users` b 
    ON a.`players` = b.`username` 
    WHERE a.`gameid` IN (1,2) AND DATE(a.`end_at`) = '".$from."' GROUP BY  a.`roomid`, b.`provider_id`
";
$querry = mysql_query("$str", $conn1) or die ("error str " . mysql_error());
//End NRU
while ($row = mysql_fetch_array($querry)) {
    $loinhuan = $row['total_money'] - $row['money_win'];
//    xxxxxxxxx

//                        $total_acc_new = count($rs);
//                        echo 'sl' .count($ids);
//                        echo 'ids' . $ids;
    //
//    xxxxxxxxx

    $insert1 = mysql_query("
        INSERT INTO `".$db_logs."`.`cutoff_phongchoi` (
          `date`,
          `room`,
          `provider_id`,
          `count_stk`,
          `count_soluotquay`,
          `total_money`,
          `money_win`,
          `loinhuan`
        ) 
        VALUES
          (
            '" . $from . "',
             '" . $row['roomid'] . "',
             '" . $row['provider_id'] . "',
             '" . $row['count_stk'] . "',
             '" . $row['count_soluotquay'] . "',
             '" . $row['total_money'] . "',
             '" . $row['money_win'] . "',
             '" . $loinhuan . "'
          ) ;
    ", $conn1) or die("erro I: " . mysql_error());
//    }
}
