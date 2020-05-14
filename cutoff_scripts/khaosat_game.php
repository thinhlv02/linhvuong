<?php
include("config/dbconnect.php");
include("config/dbconnect_acc.php");
include("config/dbconnect_log.php");
$timezone = +7;

$db = 'bancavip';
$db_logs = 'bancavip_logs';
$db_account = 'bancavip_account';

$date = new DateTime(date("Y-m-d"));
date_sub($date, date_interval_create_from_date_string("1 days"));
$from = date_format($date, "Y-m-d");
//$from = '2018-03-19';

//mysql_query("DELETE
//FROM `".$db."`.`khaosat_game`
//WHERE `id` = '101';");
//die();

$provider = mysql_query("SELECT 
  `provider_id`,
  `platform`,
  `name_device` 
FROM
  `" . $db_account . "`.`providers` ") or die("error provider_id: " . mysql_error());
$arr_android = $arr_ios = $arr_wp = array();
while ($r = mysql_fetch_array($provider)) {
    if ($r['platform'] == 1) {
        $arr_android[] = $r['provider_id'];
    }
    if ($r['platform'] == 2) {
        $arr_ios[] = $r['provider_id'];
    }
    if ($r['platform'] == 3) {
        $arr_wp[] = $r['provider_id'];
    }
}
//$rs_android = $rs_ios = $rs_wp = 0;
if (!empty($arr_android)) {
    $rs_android = implode(',', $arr_android);
} else {
    $rs_android = 999;
}
if (!empty($arr_ios)) {
    $rs_ios = implode(',', $arr_ios);
} else {
    $rs_ios = 999;
}
if (!empty($arr_wp)) {
    $rs_wp = implode(',', $arr_wp);
} else {
    $rs_wp = 999;
}
//var_dump($rs_wp);
//echo $rs_android . '<br>';
//echo $rs_ios . '<br>';
//echo $rs_wp . '<br>';
//die();
//echo $from;
//die();
// Start date
//$from = '2017-12-01';
//// End date
//$end_date = '2018-01-07';
//
//while (strtotime($from) < strtotime($end_date)) {
//    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
//    echo $from;
//    echo "<br/>";
//}
//die();
//NRU
$str = "
  SELECT p.tg,  p.NRU_android, p.NRU_ios, p.NRU_wp FROM (
    SELECT 
      DATE(a.`created_at`) tg,
      a.`provider_id`,
      COUNT(CASE WHEN a.`provider_id` IN (" . $rs_android . ") THEN 1 END) NRU_android,
      COUNT(CASE WHEN a.`provider_id` IN (" . $rs_ios . ") THEN 1 END) NRU_ios,
      COUNT(CASE WHEN a.`provider_id` IN (" . $rs_wp . ") THEN 1 END) NRU_wp
    FROM
      `" . $db_account . "`.`users` a 
      JOIN " . $db_account . ".`providers` b 
        ON a.`provider_id` = b.`provider_id` WHERE DATE(a.`created_at`)  = '" . $from . "' 
    GROUP BY  DATE(a.`created_at`) 
    ORDER BY DATE(a.`created_at`) ) p
";

$querry = mysql_query("$str", $conn1) or die ("error NRU " . mysql_error());
//End NRU

//        CCU
$query_ccu = mysql_query("SELECT  MIN(a.`total`) minCCU,MAX(a.`total`) maxCCU  FROM `" . $db_logs . "`.`ccu_log` a WHERE 
              DATE(`date`) = '" . $from . "'") or die("error ccu: " . mysql_error());
$r_ccu = mysql_fetch_array($query_ccu);
//        End CCU

// tiền phế
$query_phe = mysql_query("SELECT IFNULL(SUM(match_logs.`taxmoney`),0) totalPhe FROM match_logs 
             WHERE DATE(match_logs.`end_at`) = '" . $from . "' ") or die("error phe: " . mysql_error());
$r_phe = mysql_fetch_array($query_phe);
// End tiền phế
//0: admin cong
//1: cong free hang ngay
//2: cong tien dang ky + active
//3: cong tien lan 2
//4: sub
//5: gift code
//xu vào
$query_in = mysql_query("
 SELECT SUM(IFNULL(p.add_money_logs,0) + IFNULL(p.sms,0) + IFNULL(p.card,0) + IFNULL(p.iap,0)) xuIn,
 SUM(IFNULL(p.totalPhe,0) + IFNULL(p.doithuong,0) + IFNULL(p.admin_sub, 0)) xuOut,
 SUM(IFNULL(p.add_money_logs,0) + IFNULL(p.sms,0) + IFNULL(p.card,0) + IFNULL(p.iap,0)) - 
 SUM(IFNULL(p.totalPhe,0) + IFNULL(p.doithuong,0) + IFNULL(p.admin_sub, 0)) xuEnd
   FROM (   
 SELECT
(SELECT SUM(CASE WHEN type_add IN(0,3,2,5) THEN money END) add_money_logs
 FROM `" . $db_logs . "`.`add_money_logs` WHERE DATE(`date`) = '" . $from . "') add_money_logs,
(SELECT SUM(`price`) sms FROM `" . $db_logs . "`.`sms_logs` WHERE DATE(`date`) = '" . $from . "') sms,
(SELECT SUM(`conversion_price`) card FROM `" . $db_logs . "`.`pay_cards` WHERE DATE(`requested_at`) = '" . $from . "') card,
 (SELECT SUM(`xu`) iap FROM `" . $db_logs . "`.`inapp_logs` WHERE DATE(`time`) = '" . $from . "') iap,
 (SELECT SUM(`taxmoney`) totalPhe FROM match_logs WHERE DATE(match_logs.`end_at`) = '" . $from . "') totalPhe,
 (SELECT SUM(price) FROM (SELECT gift_info.`cost`,gift_info.`price`,getgift_logs.`process_time`,getgift_logs.`status` 
 FROM `" . $db_logs . "`.getgift_logs JOIN `" . $db_logs . "`.gift_info ON getgift_logs.`gift_id` = gift_info.`id` 
      WHERE DATE(`process_time`) = '" . $from . "'AND getgift_logs.`status` = 5) p ) doithuong,
 (SELECT SUM(money) admin_sub FROM `" . $db_logs . "`.`add_money_logs` WHERE DATE(`date`) = '" . $from . "' AND type_add = 4) admin_sub ) p
    ", $conn1) or die("lỗi add_money_logs " . mysql_error() . " ");
$row_in = mysql_fetch_array($query_in);
//xu vào

//DAU
$str_dau = "
SELECT p.newUserLogin, p.oldUserLogin, IFNULL(SUM(p.oldUserLogin + p.newUserLogin),0) totalUserLogin, p.newUserRelogin FROM (
(SELECT 
(SELECT COUNT(a.`id`) oldUserLogin FROM `" . $db_account . "`.`users` a WHERE DATE(a.`created_at`) < '" . $from . "' 
 AND a.`id` IN (SELECT b.`user_id`FROM `" . $db_logs . "`.`money_log` b WHERE DATE(b.`logintime`) = '" . $from . "')) oldUserLogin,
 (SELECT COUNT(a.`id`) newUserLogin FROM " . $db_account . ".`users` a WHERE DATE(a.`created_at`) = '" . $from . "' 
 GROUP BY DATE(a.`created_at`)) newUserLogin,
(SELECT COUNT(a.`id`) oldUserLogin FROM `" . $db_account . "`.`users` a WHERE DATE(a.`created_at`) = DATE_SUB('" . $from . "',INTERVAL 1 DAY) 
 AND a.`id` IN (SELECT b.`user_id`FROM `" . $db_logs . "`.`money_log` b WHERE DATE(b.`logintime`) = '" . $from . "')) newUserRelogin)) p
";
$query_dau = mysql_query("$str_dau") or die("error dcm: " . mysql_error() . "");
$r_dau = mysql_fetch_array($query_dau);
//End DAU

//CARD
$query_card = mysql_query("
    SELECT COUNT(DISTINCT a.`user_id`) puCard,COUNT(a.`id`) countCard,IFNULL(SUM(a.`conversion_price`),0) moneyCard
FROM `" . $db_logs . "`.`pay_cards` a WHERE DATE(a.`requested_at`) = '" . $from . "' AND a.`price` > 0
") or die("error card: " . mysql_error());
$r_card = mysql_fetch_array($query_card);
//END CARD

//SMS
//$query_sms = mysql_query("
//  SELECT COUNT(DISTINCT user_id) AS puSMS,COUNT(`id`) countSMS,
//        IFNULL(SUM(CASE
//        WHEN `action` > 1000 THEN `action`
//        WHEN `action` IN('Download', 'REG') THEN 1000
//        WHEN `action` LIKE '%NAP%' THEN SUBSTR(`action`, 4, 10) * 1000 END),0) AS moneySMS
//        FROM " . $db_logs . ".sms_logs where DATE(date) = '" . $from . "'
//") or die("error card: " . mysql_error());
$query_sms = mysql_query("
  SELECT COUNT(DISTINCT user_id) AS puSMS,COUNT(`id`) countSMS, IFNULL(SUM(price),0) AS moneySMS
        FROM " . $db_logs . ".sms_logs where DATE(date) = '" . $from . "' 
") or die("error card: " . mysql_error());
$r_sms = mysql_fetch_array($query_sms);
//END SMS

//moneyTOPUP
$moneyTOPUP = mysql_query("
 SELECT IFNULL(SUM(money),0) moneyTOPUP FROM `" . $db_logs . "`.`add_money_logs` WHERE DATE(`date`) = '" . $from . "' AND 
 type_add IN (0,5) ") or die("error moneyTOPUP: " . mysql_error());
$r_moneyTOPUP = mysql_fetch_array($moneyTOPUP);

//moneyTOPUP

//newPU
$query_newPU = mysql_query("
    SELECT COUNT(DISTINCT user_id) newPU FROM (SELECT 
      a.`user_id`,COUNT(a.`user_id`) sl 
    FROM `" . $db_logs . "`.`pay_cards` a 
    WHERE DATE(a.`requested_at`) = '" . $from . "' 
      AND a.`user_id` IN (SELECT `id` FROM `" . $db_account . "`.`users` a 
      WHERE DATE(a.`created_at`) = '" . $from . "') AND price > 0 
    GROUP BY a.`user_id` HAVING (sl >= 1) 
      UNION ALL 
      SELECT a.`user_id`,COUNT(a.`user_id`) sl 
      FROM `" . $db_logs . "`.`sms_logs` a 
      WHERE DATE(a.`date`) = '" . $from . "' 
        AND a.`user_id` IN 
        (SELECT `id` FROM `" . $db_account . "`.`users` a WHERE DATE(a.`created_at`) = '" . $from . "') 
      GROUP BY a.`user_id` HAVING (sl >= 1)) h
") or die("error new PU: " . mysql_error());
$r_newPU = mysql_fetch_array($query_newPU);

$conga = "SELECT COUNT(DISTINCT `user_id`) a0 FROM `".$db_logs."`.`money_log` 
            WHERE DATE(`logintime`)  = '" . $from . "' AND description like '%Dat cuoc%'
    ";
//    echo $conga;
//    die();
//   COUNT(tm.num)
$query_a0 = mysql_query("$conga", $conn1) or die("lỗi ao " . mysql_error() . "");
$a0 = mysql_fetch_array($query_a0);
//End newPU

//ARPPU
// tính pay_user
$xxx = "SELECT ifnull(COUNT(DISTINCT " . $db_logs . ".`money_log`.`user_id`),0) pu FROM " . $db_logs . ".`money_log` WHERE 
        (DATE(" . $db_logs . ".`money_log`.`logintime`) = '" . $from . "') AND 
        user_id IN 
            (
                SELECT DISTINCT user_id FROM 
                (
                SELECT user_id FROM pay_cards WHERE price > 0 AND DATE(requested_at) = '" . $from . "'
                UNION ALL
                SELECT user_id FROM sms_logs WHERE (output like '%Kich hoat thanh cong%' or 
                output like '%Nap tien thanh cong%') AND DATE(`date`) = '" . $from . "'
                ) t
            )
    ";
//    echo "Vui lòng thử lại sau";
//    echo $xxx;
//    die();
$query_pay_user = mysql_query("$xxx", $conn1) or die ("lỗi pay_userr chung " . mysql_error() . "");

$r_pay_user = mysql_fetch_array($query_pay_user);
//ENd ARPPU

//Doi thuong
$query_dt = mysql_query("
     SELECT
     ifnull((SELECT SUM(b.`cost`) cost
    FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b ON a.`gift_name` = b.`name` 
    WHERE DATE(a.`request_time`) = '" . $from . "'  AND a.`status` =99 ),0) moneyHuyDT,
    ifnull((SELECT SUM(b.`cost`) cost
    FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b ON a.`gift_name` = b.`name` 
    WHERE DATE(a.`process_time`) = '" . $from . "'  AND a.`status` = 5 ),0) moneyTraDT,
     ifnull((SELECT COUNT(b.`cost`) cost
    FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b ON a.`gift_name` = b.`name` 
    WHERE DATE(a.`process_time`) = '" . $from . "' AND a.`status` = 5 ),0) moneyTraDTCount,
    ifnull((SELECT SUM(b.`cost`) cost
    FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b ON a.`gift_name` = b.`name` 
    WHERE DATE(a.`request_time`) = '" . $from . "'),0) moneyDTRequest,
    ifnull((SELECT SUM(b.`cost`) cost FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b 
        ON a.`gift_name` = b.`name`  WHERE  DATE(a.`request_time`) < '" . $from . "' AND 
        DATE(a.`process_time`) = '" . $from . "' AND a.`status` = 5 ),0) yeucauchuaduyet,
    IFNULL((SELECT COUNT(b.`cost`) cost FROM `" . $db_logs . "`.`getgift_logs` a JOIN " . $db_logs . ".`gift_info_detail` b 
        ON a.`gift_name` = b.`name` WHERE DATE(a.`request_time`) < '" . $from . "' AND 
        DATE(a.`process_time`) = '" . $from . "' AND a.`status` = 5 ),0) yeucauchuaduyetCount                
") or die("erro dt: " . mysql_error());
$r_dt = mysql_fetch_array($query_dt);
//END Doithuong

while ($row = mysql_fetch_array($querry)) {
    $NRU_total = $row['NRU_ios'] + $row['NRU_android'] + $row['NRU_wp'];
    $payRate = number_format($r_newPU['newPU'] / $NRU_total * 100);
    if ($r_pay_user['pu'] == 0) {
        $ARPPU = 0;
    } else {
        $ARPPU = ($r_card['moneyCard'] + $r_sms['moneySMS']) / $r_pay_user['pu'];
    }

    $insert1 = mysql_query("
        INSERT INTO `" . $db . "`.`khaosat_game` (
      `time`,
      `NRU_ios`,
      `NRU_android`,
      `NRU_wp`,
      `NRU_total`,
      `newUserLogin`,
      `oldUserLogin`,
      `totalUserLogin`,
      `newUserRelogin`,
      `minCCU`,
      `maxCCU`,
      `totalPhe`,
      `xuIn`,
      `xuOut`,
      `xuEnd`,
      `puCard`,
      `countCard`,
      `moneyCard`,
      `puSMS`,
      `countSMS`,
      `moneySMS`,
      `moneyTOPUP`,
      `payRate`,
      `newPU`,
      `ARPPU`,
      `moneyHuyDT`,
      `moneyTraDT`,
      `moneyTraDTCount`,
      `moneyDTRequest`,
      `yeucauchuaduyet`,
      `yeucauchuaduyetCount`,
      `PU`
    ) 
    VALUES
      (
        '" . $row['tg'] . "',
        '" . $row['NRU_ios'] . "',
        '" . $row['NRU_android'] . "',
        '" . $row['NRU_wp'] . "',
        '" . $NRU_total . "',
        '" . $r_dau['newUserLogin'] . "',
        '" . $r_dau['oldUserLogin'] . "',
        '" . $r_dau['totalUserLogin'] . "',
        '" . $r_dau['newUserRelogin'] . "',
        '" . $r_ccu['minCCU'] . "',
        '" . $r_ccu['maxCCU'] . "',
        '" . $r_phe['totalPhe'] . "',
        '" . $row_in['xuIn'] . "',
        '" . $row_in['xuOut'] . "',
        '" . $row_in['xuEnd'] . "',
        '" . $r_card['puCard'] . "',
        '" . $r_card['countCard'] . "',
        '" . $r_card['moneyCard'] . "',
        '" . $r_sms['puSMS'] . "',
        '" . $r_sms['countSMS'] . "',
        '" . $r_sms['moneySMS'] . "',
        '" . $r_moneyTOPUP['moneyTOPUP'] . "',
        '" . $payRate . "',
        '" . $r_newPU['newPU'] . "',
        '" . $ARPPU . "',
        '" . $r_dt['moneyHuyDT'] . "',
        '" . $r_dt['moneyTraDT'] . "',
        '" . $r_dt['moneyTraDTCount'] . "',
        '" . $r_dt['moneyDTRequest'] . "',
        '" . $r_dt['yeucauchuaduyet'] . "',
        '" . $r_dt['yeucauchuaduyetCount'] . "',
        '" . $a0['a0'] . "'
      ) ;
    ", $conn1) or die("erro I: " . mysql_error());
//    }
}
?>
