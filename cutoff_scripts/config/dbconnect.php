<?php

$conn = mysqli_connect('210.211.99.246', 'thinhlv', 'Thinh@2019_LV', 'linhvuongmobile', '33060') or die(mysqli_error());

mysqli_select_db($conn,'linhvuongmobile') or die(mysqli_error());
mysqli_query($conn,"SET charactor_set_results=utf8");
//mysqli_query("SET NAMES 'utf8'");
?>
