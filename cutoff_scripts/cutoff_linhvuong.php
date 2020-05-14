<?php
$timezone = +7;
include("config/dbconnect_acc.php");
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
$query_last_record = mysql_query("select a.id,a.time from linhvuongmobile_logs.`cutoff_chiso` a order by id desc limit 1", $conn_logs) or die("error last record: " . mysql_error());
$row_last_record = mysql_fetch_array($query_last_record);
//select last record

#import
//OLD: select count(id) total_dk from linhvuongmobile_account.users a where date(a.`created_at`) = '" . $from . "'
$query_import = mysql_query("
select count(id) total_dk from linhvuongmobile_account.install_game a where date(a.`time`) = '" . $from . "'
", $conn_acc) or die("error import: " . mysql_error());


$import = mysql_fetch_array($query_import);
#end import

#build
$query_userid_level_10 = mysql_query("select user_id from linhvuongmobile.tbl_quanphu a where a.level >= 10", $conn) or die('error build: ' . mysql_error());

$fbexcludearray = array();
while ($row_level10 = mysql_fetch_assoc($query_userid_level_10)) {
    $fbexcludearray[] = $row_level10['user_id'];
}

// Convert the array
$userid_lv_10 = implode(',', $fbexcludearray);

$query_build = mysql_query("
select count(id) total_build from linhvuongmobile_account.install_game a where date(a.`time`) = '" . $from . "' and
id IN ('" . $userid_lv_10 . "')
", $conn_acc) or die("error import: " . mysql_error());

$build = mysql_fetch_array($query_build);

#build

#active
//select count(distinct(user_id)) as active from linhvuongmobile_logs.session_log a where date(a.logintime) = '2019-04-12'

$query_active = mysql_query("select count(distinct(user_id)) as active from linhvuongmobile_logs.session_log a 
    where date(a.logintime) ='" . $from . "' ", $conn_logs) or die("error active: " . mysql_error());
$row_active = mysql_fetch_array($query_active);
#active

#paycards: //select sum(a.`price`) price_pay_cards, SUM(a.`conversion_price`) price_pay_cards_cvs from linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =
//$query_pay = mysql_query("select sum(a.`price`) price_pay_cards, SUM(a.`conversion_price`) price_pay_cards_cvs from
//    linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =  '" . $from . "' ", $conn_logs) or die("error paycards: ". mysql_error());
//$row_pay = mysql_fetch_array($query_pay);


#paycards: //select sum(a.`price`) price_pay_cards, SUM(a.`conversion_price`) price_pay_cards_cvs from linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =
$query_pay = mysql_query("select ifnull(sum(a.`price`),0) price_pay_cards, IFNULL((a.`conversion_price`),0) price_pay_cards_cvs,
 COUNT(a.`card_code`) total_times_cards, COUNT( distinct a.`user_id`) total_numbers_cards from 
    linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =  '" . $from . "' ", $conn_logs) or die("error paycards: " . mysql_error());
$row_pay = mysql_fetch_array($query_pay);

$inapp_arr = mysql_query("select a.price, a.money from linhvuongmobile.tbl_product_id a group by price", $conn) or die('errror inapp arr' . mysql_error());

$inapp_arr_end = array();

while (($row_in = mysql_fetch_assoc($inapp_arr))) {
    $inapp_arr_end[$row_in['price']] = $row_in['money'];
}
//echo '<pre>';
//print_r($inapp_arr_end);
//echo '</pre>';

$query_in_logs = mysql_query("select xu,price from linhvuongmobile_logs.inapp_logs a 
where date(a.time) = '" . $from . "'", $conn_logs) or die('errror inap logs');

$xu_inapp = 0;
$price_inapp = 0;
$total_times_inapps = 0;
while (($row_in_logs = mysql_fetch_assoc($query_in_logs))) {
    $xu_inapp += $row_in_logs['xu'];

    foreach ($inapp_arr_end as $key => $value) {
        if ($key == $row_in_logs['price']) {
            $price_inapp += $value;
        }
        $total_times_inapps++;
    }

}

$total_times = $row_pay['total_times_cards'] + $total_times_inapps;
$total_numbers = $row_pay['total_numbers_cards'] + $total_times_inapps;

//newpay_number
//step1: add user_id in pay_cards to array

$query_pay_userid = mysql_query("select a.user_id from 
    linhvuongmobile_logs.pay_cards a where date(a.`requested_at`) =  '" . $from . "' ", $conn_logs) or die("error paycards: " . mysql_error());
//$row_pay_userid = mysql_fetch_array($query_pay);

if (mysql_num_rows($query_pay_userid) > 0) {
    $rs_nap = array();
    while ($rs_nap_1 = mysql_fetch_array($query_pay_userid)) {
        $rs_nap[] = $rs_nap_1['user_id'];
    }
    $rs_nap = implode(',', $rs_nap);// cho các phần tử trên vào mảng ids
} else {
    $rs_nap = 0;
}

//step 2: check with users table

$query_users_regis_current = mysql_query("select count(a.`user_id`) newpay_number from linhvuongmobile_account.users a where date(a.`time_reg`) = '" . $from . "' 
and  a.`user_id` IN ('" . $rs_nap . "')
", $conn_acc) or die('error querry user register curren: ' . mysql_error());

if (mysql_num_rows($query_users_regis_current) > 0) {
    $newpay_number_p = mysql_fetch_array($query_users_regis_current);
    $newpay_number = $newpay_number_p['newpay_number'];
} else {
    $newpay_number = 0;
}
//end new pay numbers

//echo $xu_inapp;
//echo $price_inapp;
// `total_recharge` int(11) DEFAULT '0',
//  `total_recharge_gold` int(11) DEFAULT '0',

$total_recharge = $row_pay['price_pay_cards'] + $xu_inapp;
$total_recharge_gold = $row_pay['price_pay_cards_cvs'] + $price_inapp;
//echo  'total_recharget : '. $total_recharge;
//echo  '$total_recharge_gold : '. $total_recharge_gold;


//inapp làm sau

//extra_gold
$query_extra_gold = mysql_query(" select ifnull(sum(a.`items_id`),0) extra_gold from linhvuongmobile_logs.`add_items_logs` a where date(a.`date`) =   '" . $from . "' ", $conn_logs) or die("error paycards: " . mysql_error());
$row_extra_gold = mysql_fetch_array($query_extra_gold);
//extra_gold


#highest_online: ccu cao diem
$query_ccu = mysql_query("
select	p.total highest_online, sum(p.android + p.ios) / 2 ave_online from(
SELECT t1.date, t1.time, t1.total,t1.`android`,t1.`ios`
FROM linhvuongmobile_logs.`ccu_log` t1
INNER JOIN
(
    SELECT `date`, MAX(total) AS max_total
    FROM linhvuongmobile_logs.`ccu_log`
    GROUP BY DATE(date)
) t2
    ON t1.`date` = t2.`date` AND t1.total = t2.max_total 
    where date(t1.date) = '" . $from . "'
    group by date(t1.date))p

", $conn_logs) or die("error import: " . mysql_error());
$ccu = mysql_fetch_array($query_ccu);
#highest_online

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
          linhvuongmobile_logs.session_log 
        WHERE DATE(logintime) >= DATE_SUB('" . $from . "', INTERVAL 30 DAY) 
          AND DATE(logintime) <= '" . $from . "'
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1
", $conn_logs) or die("lỗi ao: " . mysql_error() . "");
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
          linhvuongmobile_logs.session_log 
        WHERE DATE(logintime) >= DATE_SUB('" . $from . "', INTERVAL 30 DAY) 
          AND DATE(logintime) < '" . $from . "'
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1
", $conn_logs) or die("lỗi a1");

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
          linhvuongmobile_logs.session_log 
        WHERE DATE(logintime) <= DATE_SUB('" . $from . "', INTERVAL 3 DAY) 
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 1 
      AND uid IN (" . $idsa1 . ")
", $conn_logs) or die("lỗi a3");

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
          linhvuongmobile_logs.session_log 
        WHERE DATE(logintime) < DATE_SUB('" . $from . "', INTERVAL 7 DAY) 
        GROUP BY user_id,
          d) AS tm 
      GROUP BY tm.uid) AS tm2 
    WHERE tm2.num >= 2 
      AND uid IN (" . $idsa3 . ")
", $conn_logs) or die("lỗi a7");

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

$str_insert = "
       INSERT INTO `linhvuongmobile_logs`.`cutoff_chiso` (
          `import`,
          `build`,
          `active`,
          `highest_online`,
          `ave_online`,
          `total_recharge`,
          `total_recharge_gold`,
          `extra_gold`,
          `total_times`,
          `total_numbers`,
          `newpay_number`,
          `a0`,
          `a1`,
          `a3`,
          `a7`,
          `time`,
          `time_action`
        ) 
        VALUES
          (
            '" . $import['total_dk'] . "',
            '" . $build['total_build'] . "',
            '" . $row_active['active'] . "',
            '" . $total_recharge . "', 
            '" . $total_recharge_gold . "',
            '" . $row_extra_gold['extra_gold'] . "',
            '" . $total_times . "',
            '" . $total_numbers . "',
            '" . $newpay_number . "',
            '" . $ccu['highest_online'] . "',
            '" . $ccu['ave_online'] . "',
            '" . $a0['a0'] . "',
             '" . mysql_num_rows($query_a1) . "',
            '" . mysql_num_rows($query_a3) . "',
            '" . mysql_num_rows($query_a7) . "',
            '" . $from . "',
            '" . date("Y-m-d H:i:s") . "'
          ); 
    ";

$str_update = "

    UPDATE `linhvuongmobile_logs`.`cutoff_chiso` SET 
        `import` = '" . $import['total_dk'] . "', 
        `build` = '" . $build['total_build'] . "', 
        `active` = '" . $row_active['active'] . "', 
        `highest_online` = '" . $ccu['highest_online'] . "',
        `ave_online` = '" . $ccu['ave_online'] . "',
        `total_recharge` =  '" . $total_recharge . "',
        `total_recharge_gold` =  '" . $total_recharge_gold . "',
        `extra_gold` =  '" . $row_extra_gold['extra_gold'] . "',
        `total_times` =  '" . $total_times . "',
        `total_numbers` =  '" . $total_numbers . "',
        `newpay_number` =  '" . $newpay_number . "',
        `a0` =  '" . $a0['a0'] . "',
        `a1` =  '" . mysql_num_rows($query_a1) . "',
        `a3` =  '" . mysql_num_rows($query_a1) . "',
        `a7` =  '" . mysql_num_rows($query_a7) . "',
        `time_action` =  '" . date("Y-m-d H:i:s") . "'
    
    WHERE id = '" . $row_last_record['id'] . "';

";

if ($from == date('Y-m-d', strtotime($row_last_record['time']))) {
    $insert = mysql_query(" $str_update ", $conn_logs) or die('error update: ' . mysql_error());

} else {
    $insert = mysql_query(" $str_insert ", $conn_logs) or die('error insert' . mysql_error());
}


//    die luôn
//}

//`total_times` int(11) DEFAULT '0',
//  `total_numbers` int(11) DEFAULT '0',
//  `newpay_number` int(11) DEFAULT '0',
//  `arpu` int(11) DEFAULT '0',
//  `arppu` int(11) DEFAULT '0',
?>
