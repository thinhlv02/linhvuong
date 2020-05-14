<?php

$conn_logs = mysqli_connect('210.211.99.246', 'thinhlv', 'Thinh@2019_LV', 'linhvuongmobile_logs' ,'33060') or die(mysqli_error());
mysqli_select_db($conn_logs,'linhvuongmobile_logs') or die(mysqli_error());
//mysql_query("SET charactor_set_results=utf8", $conn_logs);
//mysql_query("SET NAMES 'utf8'");
?>
