<?php

$sub_menu = '400000';
include_once('./_common.php');
$g5['title'] = '주문현황';
//include_once (G5_SP_ADMIN_PATH.'/admin.head.php');

// View::share('title', $g4['title']);
$shopOrderCtrl  = new App\Controller\ShopOrderController();

echo $shopOrderCtrl->index();

//include_once (G5_SP_ADMIN_PATH.'/admin.tail.php');
