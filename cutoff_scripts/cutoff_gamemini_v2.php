<?php
//echo "dcm";
//die();
include("config/dbconnect_log.php");
$timezone = +7;

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");

//echo $dcm;
//die();

// Start date
//$from = '2017-12-01';
//// End date
//$end_date = '2018-01-09';
//
//while (strtotime($from) < strtotime($end_date)) {
//    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
//    echo $from;
//    echo "<br/>";
//}
//die();

    $dcm = "
     SELECT 
          end_at,
          roomid,
          gameid,
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
              THEN taxmoney ELSE 0
            END
          ) tienthang,
          SUM(
            CASE
              WHEN taxmoney < 0 
              THEN taxmoney ELSE 0
            END
          ) tienthua 
        FROM
          bancavip_logs.`match_logs` 
        WHERE DATE(`end_at`) = '" . $from . "' 
          AND taxmoney != 0 
        GROUP BY DATE(end_at),
          roomid, gameid 
        ORDER BY end_at DESC 
";
    $querry = mysql_query("" . $dcm . "", $conn1) or die ("error dcm: " . mysql_error());

    while ($row = mysql_fetch_array($querry)) {
//    echo $row['tienthua'];
//    echo "<br/>";

        $insert1 = mysql_query("
        INSERT INTO `bancavip_logs`.`cutoff_gamemini_v2` (
          `end_at`,
          `roomid`,
          `gameid`,
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
            '" . $row['gameid'] . "',
            '" . $row['tongvan'] . "',
            '" . $row['vanthang'] . "',
            '" . $row['vanthua'] . "',
            '" . $row['tongtien'] . "',
            '" . $row['tienthang'] . "',
            '" . $row['tienthua'] . "'
          ) ;
    ", $conn1) or die("error insert: " . mysql_error());
//    }
}
?>
