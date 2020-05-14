<?php
include("config/dbconnect_log.php");
$timezone = +7;

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");
//echo $from;
//die();
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


//die();

$querry = mysql_query("
  SELECT 
      match_logs.`gameid`,
      match_logs.`betmoney`,
      roomid,
      COUNT(*) AS num_match,
      SUM(match_logs.`taxmoney`) fee,
      DATE(end_at) AS `time` 
    FROM
      match_logs 
    WHERE DATE(match_logs.`end_at`) = '" . $from . "' 
    GROUP BY roomid,
      betmoney,
      gameid,
      DATE(end_at) 
    ORDER BY `time` ASC 
", $conn1) or die (mysql_error());

while ($row = mysql_fetch_array($querry)) {

    $insert1 = mysql_query("
        INSERT INTO `bancavip_logs`.`tonghopphe` (
          `gameid`,
          `roomid`,
          `betmoney`,
          `num_match`,
          `fee`,
         
          `time`
        ) 
        VALUES
          (
            '" . $row['gameid'] . "',
            '" . $row['roomid'] . "',
            '" . $row['betmoney'] . "',
            '" . $row['num_match'] . "',
            '" . $row['fee'] . "',
          
            '" . $row['time'] . "'
          ) ;
    ", $conn1);
}
//}
?>
