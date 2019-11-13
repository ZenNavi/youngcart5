<?php
/**
 * Created by PhpStorm.
 * User: bjkim
 * Date: 2018-12-29
 * Time: 03:32
 */

if( !defined('__ZEN__') ) return;

if( ! $_STORE = App\ShopStore::whereStHost($_SERVER['HTTP_HOST'])->first() ) {
    if( ! $_STORE = App\ShopStore::whereStId('admin')->first() ) {
        die(' Not Exist Store ');
    }
}

$is_franchisee = false;
$is_supplier   = false;
$is_store_manager = false;

if( $supplier = App\ShopSupplier::whereSpId($member['mb_id'])->first() ) {
    $is_supplier = true;
}

if( $franchisee = App\ShopFranchisee::whereFrId($member['mb_id'])->first() ) {
    $is_franchisee = true;
}

if( $store_manager = App\ShopStore::whereStId($member['mb_id'])->first() ) {
    $is_store_manager = true;
}

//dd( compact('_STORE','is_supplier', 'is_franchisee', 'is_store_manager', 'supplier','franchisee','store_manager', 'member'));


