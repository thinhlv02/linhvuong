<?php
include("config/dbconnect_log.php");
$timezone = +7;

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");

$querry = mysql_query("
        SELECT 
          roomid,
          betmoney,
          COUNT(*) AS sovan,
          SUM(CASE `exception` WHEN 0  THEN 1  ELSE 0 END) 0DO,
          SUM(CASE `exception` WHEN 1  THEN 1  ELSE 0 END) 1DO,
          SUM(CASE `exception` WHEN 2  THEN 1  ELSE 0 END) 2DO,
          SUM(CASE `exception` WHEN 3  THEN 1  ELSE 0 END) 3DO,
          SUM(CASE `exception` WHEN 4  THEN 1  ELSE 0 END) 4DO,
          SUM(CASE WHEN `owner` = '' THEN taxmoney  ELSE 0 END) taxmoney_admin,
          SUM(CASE WHEN `owner` !='' THEN taxmoney  ELSE 0 END) taxmoney_user,
          DATE(end_at) AS `time`
        FROM
          match_logs_xd 
        WHERE DATE(end_at) = '" . $from . "' 
        GROUP BY roomid,
          betmoney,
          DATE(end_at) ORDER BY `time` ASC 
", $conn1) or die (mysql_error());

while ($row = mysql_fetch_array($querry)) {
    $insert1 = mysql_query("
        INSERT INTO `bancavip_logs`.`cutoff_xocdia` (
          `roomid`,
          `betmoney`,
          `sovan`,
          `0do`,
          `1do`,
          `2do`,
          `3do`,
          `4do`,
          `taxmoney_admin`,
          `taxmoney_user`,
          `time`
        ) 
        VALUES
          (
            '" . $row['roomid'] . "',
            '" . $row['betmoney'] . "',
            '" . $row['sovan'] . "',
            '" . $row['0DO'] . "',
            '" . $row['1DO'] . "',
            '" . $row['2DO'] . "',
            '" . $row['3DO'] . "',
            '" . $row['4DO'] . "',
            '" . $row['taxmoney_admin'] . "',
            '" . $row['taxmoney_user'] . "',
            '" . $row['time'] . "'
          ) ;
    ", $conn1);
}
?>
