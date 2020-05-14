<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config[] = array();

// excel library path
define('PHPEXCEL_LIB_PATH', 'application/libraries/Classes/');
//to use
///ex:
/*require_once(PHPEXCEL_LIB_PATH.'PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();*/

// mpdf lib path
define('MPDF_LIB_PATH', 'app/app_v3.1.4/libraries/mpdf/');
// khi day len server se config = rong
//$config['cf_upload_local'] = 'images/upload';
$config['cf_upload_local'] = '';

$config['LST_SERVER'] = array(
    '1' => array(
        'main' => 'main',
        'logs' => 'logs',
        'name' => 'Server 1',
    ),
    '2' => array(
        'main' => 'main_2',
        'logs' => 'logs_2',
        'name' => 'Server 2',
    )

);
