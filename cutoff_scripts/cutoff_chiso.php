<?php
$timezone = +7;
include("config/dbconnect_acc.php");
include("config/dbconnect_log.php");
include("config/dbconnect.php");

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");

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
// A0
    $query_a0 = mysql_query("
    SELECT 
      COUNT(*) a0 
    FROM
      (SELECT 
        COUNT(uid) AS num,
        uid 
      FROM
        (SELECT 
          user_id AS uid,
          DATE(logintime) AS d 
        FROM
          bancavip_logs.money_log 
        WHERE DATE(logintime) >= DATE_SUB('" . $from . "', INTERVAL 30 DAY) 
          AND DATE(logintime) <= '" . $from . "'
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1
") or die("lỗi ao: " . mysql_error() . "");
// end A0
    $a0 = mysql_fetch_array($query_a0);
//echo "a0: " . $a0['a0'] . "";
//echo "<br/>";
//die();

// A1
    $query_a1 = mysql_query("
     SELECT 
      *
    FROM
      (SELECT 
        COUNT(uid) AS num,
        uid 
      FROM
        (SELECT 
          user_id AS uid,
          DATE(logintime) AS d 
        FROM
          bancavip_logs.money_log 
        WHERE DATE(logintime) >= DATE_SUB('" . $from . "', INTERVAL 30 DAY) 
          AND DATE(logintime) < '" . $from . "'
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1
") or die("lỗi a1");

    if (mysql_num_rows($query_a1) > 0) {
        $rsa1 = array();
        while ($rowa1 = mysql_fetch_array($query_a1)) {
            $rsa1[] = $rowa1['uid'];
        }
        $idsa1 = implode(',', $rsa1);// cho các phần tử trên vào mảng ids
        // echo count($rsa1);
        // echo $rs98;
    } else {
        $idsa1 = 0;
    }
//echo count($rsa1);
//echo "a1: " . mysql_num_rows($query_a1) . "";
//echo "<br/>";
// end A1
//die();
//A3
    $query_a3 = mysql_query("
    SELECT 
      * 
    FROM
      (SELECT 
        COUNT(uid) AS num,
        uid 
      FROM
        (SELECT 
          user_id AS uid,
          DATE(logintime) AS d 
        FROM
          bancavip_logs.money_log 
        WHERE DATE(logintime) <= DATE_SUB('" . $from . "', INTERVAL 3 DAY) 
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1 
      AND uid IN (" . $idsa1 . ")
", $conn1) or die("lỗi a3");

    if (mysql_num_rows($query_a3) > 0) {
        $rsa3 = array();
        while ($rowa3 = mysql_fetch_array($query_a3)) {
            $rsa3[] = $rowa3['uid'];
        }
        $idsa3 = implode(',', $rsa3);// cho các phần tử trên vào mảng ids
        // echo count($rsa3);
        // echo $rs98;
    } else {
        $idsa3 = 0;
    }
//echo "a3: " . mysql_num_rows($query_a3) . "";
//echo "<br/>";
// end A1
//die();
// end A3

// A7
    $query_a7 = mysql_query("
     SELECT 
      * 
    FROM
      (SELECT 
        COUNT(uid) AS num,
        uid 
      FROM
        (SELECT 
          user_id AS uid,
          DATE(logintime) AS d 
        FROM
          bancavip_logs.money_log 
        WHERE DATE(logintime) < DATE_SUB('" . $from . "', INTERVAL 7 DAY) 
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 2 
      AND uid IN (" . $idsa3 . ")
", $conn1) or die("lỗi a7");

    if (mysql_num_rows($query_a7) > 0) {
        $rsa7 = array();
        while ($rowa7 = mysql_fetch_array($query_a7)) {
            $rsa7[] = $rowa7['uid'];
        }
        $idsa7 = implode(',', $rsa7);// cho các phần tử trên vào mảng ids
        // echo count($rsa7);
        // echo $rs98;
    } else {
        $idsa7 = 0;
    }
//echo "a7: " . mysql_num_rows($query_a7) . "";
//echo "<br/>";
// end A1
//die();
// end A7

// A15
    $query_a15 = mysql_query("
      SELECT 
          * 
        FROM
          (SELECT 
            COUNT(uid) AS num,
            uid 
          FROM
            (SELECT 
              user_id AS uid,
              DATE(logintime) AS d 
            FROM
              bancavip_logs.money_log 
            WHERE DATE(logintime) < DATE_SUB('" . $from . "', INTERVAL 15 DAY) 
            GROUP BY user_id,
              d) AS tm 
          GROUP BY tm.uid) AS tm2 
        WHERE tm2.num >= 3 
          AND uid IN (" . $idsa7 . ")
    ", $conn1) or die("lỗi a15");

    if (mysql_num_rows($query_a15) > 0) {
        $rsa15 = array();
        while ($rowa15 = mysql_fetch_array($query_a15)) {
            $rsa15[] = $rowa15['uid'];
        }
        $idsa15 = implode(',', $rsa15);// cho các phần tử trên vào mảng ids
        // echo count($rsa15);
        // echo $rs98;
    } else {
        $idsa15 = 0;
    }
//echo "a15: " . mysql_num_rows($query_a15) . "";
//echo "<br/>";
// end A1
//die();
// end A15

// A30
    $query_a30 = mysql_query("
    SELECT 
      * 
    FROM
      (SELECT 
        COUNT(uid) AS num,
        uid 
      FROM
        (SELECT 
          user_id AS uid,
          DATE(logintime) AS d 
        FROM
          bancavip_logs.money_log 
        WHERE DATE(logintime) < DATE_SUB('" . $from . "', INTERVAL 30 DAY) 
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 4 
      AND uid IN (" . $idsa15 . ")
    ", $conn1) or die("lỗi a30");
//echo "a30: " . mysql_num_rows($query_a30) . "";
//echo "<br/>";
// end A1
//die();
// end A30
    $str = "
       INSERT INTO `bancavip_logs`.`cutoff_chiso` (
          `a0`,
          `a1`,
          `a3`,
          `a7`,
          `a15`,
          `a30`,
          `time`
        ) 
        VALUES
          (
            '" . $a0['a0'] . "',
            '" . mysql_num_rows($query_a1) . "',
            '" . mysql_num_rows($query_a3) . "',
            '" . mysql_num_rows($query_a7) . "',
            '" . mysql_num_rows($query_a15) . "',
            '" . mysql_num_rows($query_a30) . "',
            '" . $from . "'
          ); 
    ";
    $insert = mysql_query(" $str ", $conn1);
//    die luôn
//}
?>
