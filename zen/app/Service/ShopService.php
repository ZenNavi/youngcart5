<?php
/**
 * Created by PhpStorm.
 * User: bjkim
 * Date: 2018-12-29
 * Time: 20:32
 */

namespace App\Service;


class ShopService
{
    public static function get_order_status_sum($status)
    {
        global $g5;

        $sql = " select count(*) as cnt,
                    sum(od_cart_price + od_send_cost + od_send_cost2 - od_cancel_price) as price
                from {$g5['g5_shop_order_table']}
                where od_status = '$status' ";
        $row = sql_fetch($sql);

        $info = array();
        $info['count'] = (int)$row['cnt'];
        $info['price'] = (int)$row['price'];
        $info['href'] = './orderlist.php?od_status='.urlencode($status);

        return $info;
    }

// 일자별 주문 합계 금액
    public static function get_order_date_sum($date)
    {
        global $g5;

        $sql = " select sum(od_cart_price + od_send_cost + od_send_cost2) as orderprice,
                    sum(od_cancel_price) as cancelprice
                from {$g5['g5_shop_order_table']}
                where SUBSTRING(od_time, 1, 10) = '$date' ";
        $row = sql_fetch($sql);

        $info = array();
        $info['order'] = (int)$row['orderprice'];
        $info['cancel'] = (int)$row['cancelprice'];

        return $info;
    }

// 일자별 결제수단 주문 합계 금액
    public static function get_order_settle_sum($date)
    {
        global $g5, $default;

        $case = array('신용카드', '계좌이체', '가상계좌', '무통장', '휴대폰');
        $info = array();

        // 결제수단별 합계
        foreach($case as $val)
        {
            $sql = " select sum(od_cart_price + od_send_cost + od_send_cost2 - od_receipt_point - od_cart_coupon - od_coupon - od_send_coupon) as price,
                        count(*) as cnt
                    from {$g5['g5_shop_order_table']}
                    where SUBSTRING(od_time, 1, 10) = '$date'
                      and od_settle_case = '$val' ";
            $row = sql_fetch($sql);

            $info[$val]['price'] = (int)$row['price'];
            $info[$val]['count'] = (int)$row['cnt'];
        }

        // 포인트 합계
        $sql = " select sum(od_receipt_point) as price,
                    count(*) as cnt
                from {$g5['g5_shop_order_table']}
                where SUBSTRING(od_time, 1, 10) = '$date'
                  and od_receipt_point > 0 ";
        $row = sql_fetch($sql);
        $info['포인트']['price'] = (int)$row['price'];
        $info['포인트']['count'] = (int)$row['cnt'];

        // 쿠폰 합계
        $sql = " select sum(od_cart_coupon + od_coupon + od_send_coupon) as price,
                    count(*) as cnt
                from {$g5['g5_shop_order_table']}
                where SUBSTRING(od_time, 1, 10) = '$date'
                  and ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 ) ";
        $row = sql_fetch($sql);
        $info['쿠폰']['price'] = (int)$row['price'];
        $info['쿠폰']['count'] = (int)$row['cnt'];

        return $info;
    }

    public static function get_max_value($arr)
    {
        foreach($arr as $key => $val)
        {
            if(is_array($val))
            {
                $arr[$key] = self::get_max_value($val);
            }
        }

        sort($arr);

        return array_pop($arr);
    }

}
