<?php

$conn_acc = mysqli_connect('210.211.99.246', 'thinhlv', 'Thinh@2019_LV','linhvuongmobile_account', '33060') or die('eeeeee'.mysqli_connect_error($conn_acc));
mysqli_select_db($conn_acc,'linhvuongmobile_account') or die('abc');
mysqli_query($conn_acc,"SET charactor_set_results=utf8");
mysqli_query("SET NAMES 'utf8'");
 ?>
