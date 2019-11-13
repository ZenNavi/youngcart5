<?php
include_once('./_common.php');

$po_run = false;

if($it['it_id']) {
    $opt_subject = explode(',', $it['it_option_subject']);
    $opt1_subject = $opt_subject[0];
    $opt2_subject = $opt_subject[1];
    $opt3_subject = $opt_subject[2];

    $sql = " select * from {$g5['g5_shop_item_option_table']} where io_type = '0' and it_id = '{$it['it_id']}' order by io_no asc ";
    $result = sql_query($sql);
    if(sql_num_rows($result))
        $po_run = true;
} else if(!empty($_POST)) {


    $i = 1;
    $opt_key = 'opt' . $i;
    $sub_key = $opt_key . '_subject';

    $options = array();
    while(isset($_POST[$opt_key]) && !empty($_POST[$opt_key])){
        $opt_key_nm = preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST[$opt_key])));
        $sub_key_nm = preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST[$sub_key])));
        $options[$sub_key_nm] = explode(',', $opt_key_nm);
        $i++;
        $opt_key = 'opt' . $i;
        $sub_key = $opt_key . '_subject';
    }

    // 마지막 부터 만들면....
    $reverse_values_options = array_reverse(array_values($options));
    $tmp2 = array();
    $key2 = array();
    foreach($reverse_values_options as $option){
        $tmp2 = array();
        foreach($option as $opt){
            if( count($key2) > 0 )
                foreach($key2 as $key){
                    $tmp2[$opt.chr(30).$key] = $opt.chr(30).$key;
                }
            else
                $tmp2[$opt] = $opt;
        }

        $key2 = $tmp2;

    }

    $opt1_subject = preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt1_subject'])));
    $opt1_val = preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt1'])));

    if(!$opt1_subject || !$opt1_val) {
        echo '옵션1과 옵션1 항목을 입력해 주십시오.';
        exit;
    }

    $po_run = true;

}

if($po_run) {
?>

<div class="sit_option_frm_wrapper">
    <table>
    <caption>옵션 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="opt_chk_all" class="sound_only">전체 옵션</label>
            <input type="checkbox" name="opt_chk_all" value="1" id="opt_chk_all">
        </th>
        <th scope="col">옵션</th>
        <th scope="col">공급금액</th>
        <th scope="col">추가금액</th>
        <th scope="col">재고수량</th>
        <th scope="col">통보수량</th>
        <th scope="col">사용여부</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($it['it_id']) {
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $opt_id = $row['io_id'];
            $opt_val = explode(chr(30), $opt_id);
            $opt_label = str_replace(chr(30), ' <small>&gt;</small> ', $opt_id);

            $opt_supp_price = $row['io_supp_price'];
            $opt_price = $row['io_price'];
            $opt_stock_qty = $row['io_stock_qty'];
            $opt_noti_qty = $row['io_noti_qty'];
            $opt_use = $row['io_use'];
    ?>
    <tr>
        <td class="td_chk">
            <input type="hidden" name="opt_id[]" value="<?php echo $opt_id; ?>">
            <label for="opt_chk_<?php echo $i; ?>" class="sound_only"></label>
            <input type="checkbox" name="opt_chk[]" id="opt_chk_<?php echo $i; ?>" value="1">
        </td>
        <td class="opt-cell"><?php echo $opt_label; ?></td>
        <td class="td_numsmall">
            <label for="opt_supp_price_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_supp_price[]" value="<?php echo $opt_supp_price; ?>" id="opt_supp_price_<?php echo $i; ?>" class="frm_input" size="9">
        </td>
        <td class="td_numsmall">
            <label for="opt_price_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_price[]" value="<?php echo $opt_price; ?>" id="opt_price_<?php echo $i; ?>" class="frm_input" size="9">
        </td>
        <td class="td_num">
            <label for="opt_stock_qty_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_stock_qty[]" value="<?php echo $opt_stock_qty; ?>" id="op_stock_qty_<?php echo $i; ?>" class="frm_input" size="5">
        </td>
        <td class="td_num">
            <label for="opt_noti_qty_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_noti_qty[]" value="<?php echo $opt_noti_qty; ?>" id="opt_noti_qty_<?php echo $i; ?>" class="frm_input" size="5">
        </td>
        <td class="td_mng">
            <label for="opt_use_<?php echo $i; ?>" class="sound_only"></label>
            <select name="opt_use[]" id="opt_use_<?php echo $i; ?>">
                <option value="1" <?php echo get_selected('1', $opt_use); ?>>사용함</option>
                <option value="0" <?php echo get_selected('0', $opt_use); ?>>사용안함</option>
            </select>
        </td>
    </tr>
    <?php
        } // for
    } else {

        foreach($key2 as $opt_id){
            $opt_price = 0;
            $opt_supp_price = 0;
            $opt_stock_qty = 0;
            $opt_noti_qty = 0;
            $opt_use = 1;
            // 기존에 설정된 값이 있는지 체크
            if($_POST['w'] == 'u') {
                $sql = " select io_no,io_supp_price, io_price, io_stock_qty, io_noti_qty, io_use
                                    from {$g5['g5_shop_item_option_table']}
                                    where it_id = '{$_POST['it_id']}'
                                      and io_id = '$opt_id'
                                      and io_type = '0'  ";
                $row = sql_fetch($sql);
                if($row) {
                    $opt_supp_price = (int)$row['io_supp_price'];
                    $opt_price = (int)$row['io_price'];
                    $opt_stock_qty = (int)$row['io_stock_qty'];
                    $opt_noti_qty = (int)$row['io_noti_qty'];
                    $opt_use = (int)$row['io_use'];
                }
            }

            $opt_label = str_replace(chr(30), ' <small>&gt;</small> ', $opt_id);
    ?>
    <tr>
        <td class="td_chk">
            <input type="hidden" name="opt_id[]" value="<?php echo $opt_id; ?>">
            <label for="opt_chk_<?php echo $i; ?>" class="sound_only"></label>
            <input type="checkbox" name="opt_chk[]" id="opt_chk_<?php echo $i; ?>" value="1">
        </td>
        <td class="opt1-cell"><?php echo $opt_label; ?></td>
        <td class="td_numsmall">
            <label for="opt_supp_price_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_supp_price[]" value="<?php echo $opt_supp_price; ?>" id="opt_supp_price_<?php echo $i; ?>" class="frm_input" size="9">
        </td>
        <td class="td_numsmall">
            <label for="opt_price_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_price[]" value="<?php echo $opt_price; ?>" id="opt_price_<?php echo $i; ?>" class="frm_input" size="9">
        </td>
        <td class="td_num">
            <label for="opt_stock_qty_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_stock_qty[]" value="<?php echo $opt_stock_qty; ?>" id="opt_stock_qty_<?php echo $i; ?>" class="frm_input" size="5">
        </td>
        <td class="td_num">
            <label for="opt_noti_qty_<?php echo $i; ?>" class="sound_only"></label>
            <input type="text" name="opt_noti_qty[]" value="<?php echo $opt_noti_qty; ?>" id="opt_noti_qty_<?php echo $i; ?>" class="frm_input" size="5">
        </td>
        <td class="td_mng">
            <label for="opt_use_<?php echo $i; ?>" class="sound_only"></label>
            <select name="opt_use[]" id="opt_use_<?php echo $i; ?>">
                <option value="1" <?php echo get_selected('1', $opt_use); ?>>사용함</option>
                <option value="0" <?php echo get_selected('0', $opt_use); ?>>사용안함</option>
            </select>
        </td>
    </tr>
    <?php
        } // for
    }
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="button" value="선택삭제" id="sel_option_delete" class="btn btn_02">
</div>

<fieldset>
    <legend>옵션 일괄 적용</legend>
    <?php echo help('전체 옵션의 추가금액, 재고/통보수량 및 사용여부를 일괄 적용할 수 있습니다. 단, 체크된 수정항목만 일괄 적용됩니다.'); ?>

    <label for="opt_com_supp_price">추가공급금액</label>
    <label for="opt_com_supp_price_chk" class="sound_only">추가공급금액일괄수정</label><input type="checkbox" name="opt_com_supp_price_chk" value="1" id="opt_com_supp_price_chk" class="opt_com_chk">
    <input type="text" name="opt_com_supp_price" value="0" id="opt_com_supp_price" class="frm_input" size="5">

    <label for="opt_com_price">추가금액</label>
    <label for="opt_com_price_chk" class="sound_only">추가금액일괄수정</label><input type="checkbox" name="opt_com_price_chk" value="1" id="opt_com_price_chk" class="opt_com_chk">
    <input type="text" name="opt_com_price" value="0" id="opt_com_price" class="frm_input" size="5">

    <label for="opt_com_stock">재고수량</label>
    <label for="opt_com_stock_chk" class="sound_only">재고수량일괄수정</label><input type="checkbox" name="opt_com_stock_chk" value="1" id="opt_com_stock_chk" class="opt_com_chk">
    <input type="text" name="opt_com_stock" value="0" id="opt_com_stock" class="frm_input" size="5">

    <label for="opt_com_noti">통보수량</label>
    <label for="opt_com_noti_chk" class="sound_only">통보수량일괄수정</label><input type="checkbox" name="opt_com_noti_chk" value="1" id="opt_com_noti_chk" class="opt_com_chk">
    <input type="text" name="opt_com_noti" value="0" id="opt_com_noti" class="frm_input" size="5">

    <label for="opt_com_use">사용여부</label>
    <label for="opt_com_use_chk" class="sound_only">사용여부일괄수정</label><input type="checkbox" name="opt_com_use_chk" value="1" id="opt_com_use_chk" class="opt_com_chk">
    <select name="opt_com_use" id="opt_com_use">
        <option value="1">사용함</option>
        <option value="0">사용안함</option>
    </select>

    <button type="button" id="opt_value_apply" class="btn_frmline">일괄적용</button>
</fieldset>
<?php
}
?>