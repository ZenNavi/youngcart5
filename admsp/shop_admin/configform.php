<?php
$sub_menu = '400100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "r");

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw']) {
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}

$g5['title'] = '기본정보';
//include_once (G5_SP_ADMIN_PATH.'/admin.head.php');

$shopOrderCtrl  = new App\Controller\ShopOrderController();

echo $shopOrderCtrl->confirmform();

//include_once (G5_SP_ADMIN_PATH.'/admin.tail.php');
?>
