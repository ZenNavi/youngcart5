<?php
$sub_menu = '400100';
include_once('./_common.php');

check_demo();

check_admin_token();

$param = $_REQUEST;

unset($param['token']);

$shopSupplier = \App\ShopSupplier::find($param['sp_id']);

if( $result = $shopSupplier->update($param) ){
   goto_url("./configform.php");
} else {
   alert("저장에 실패 하였습다.");
}

