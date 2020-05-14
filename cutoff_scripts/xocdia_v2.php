<?php
include("config/dbconnect_log.php");
$timezone = +7;

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");

$querry = mysql_query("
        SELECT 
          end_at,
          roomid,
          COUNT(taxmoney) tongvan,
          COUNT(
            CASE
              WHEN taxmoney > 0 
              THEN 1 
            END) vanthang,
          COUNT(
            CASE
              WHEN taxmoney < 0 
              THEN 1 
            END) vanthua,
          SUM(taxmoney) tongtien,
          SUM(
            CASE
              WHEN taxmoney > 0 
              THEN taxmoney 
            END
          ) tienthang,
          SUM(
            CASE
              WHEN taxmoney < 0 
              THEN taxmoney 
            END
          ) tienthua 
        FROM
          bancavip_logs.`match_logs_xd` 
        WHERE DATE(`end_at`) = '" . $from . "' 
          AND OWNER = '' 
          AND taxmoney != 0 
        GROUP BY DATE(end_at),
          roomid 
", $conn1) or die (mysql_error());

while ($row = mysql_fetch_array($querry)) {

    $insert1 = mysql_query("
        INSERT INTO `bancavip_logs`.`cutoff_xocdia_v2` (
          `end_at`,
          `roomid`,
          `tongvan`,
          `vanthang`,
          `vanthua`,
          `tongtien`,
          `tienthang`,
          `tienthua`
        ) 
        VALUES
          (
            '" . $row['end_at'] . "',
            '" . $row['roomid'] . "',
            '" . $row['tongvan'] . "',
            '" . $row['vanthang'] . "',
            '" . $row['vanthua'] . "',
            '" . $row['tongtien'] . "',
            '" . $row['tienthang'] . "',
            '" . $row['tienthua'] . "'
          ) ;
    ", $conn1);
}
?>
