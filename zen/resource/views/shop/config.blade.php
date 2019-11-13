@extends('layout.admin')

@section('content')

<?php
$pg_anchor = '<ul class="anchor">
<li><a href="#anc_scf_info">사업자정보</a></li>
<li><a href="#anc_scf_account">정산계좌 정보</a></li>
<li><a href="#anc_scf_payment">담당자 정보</a></li>
<li><a href="#anc_scf_delivery">배송설정</a></li>
<li><a href="#anc_scf_sms">SMS설정</a></li>
</ul>';
$pg_anchor = '';
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fconfig" action="./configformupdate.php" onsubmit="return fconfig_check(this)" method="post" enctype="MULTIPART/FORM-DATA">
    <input type="hidden" name="token" value="{{ get_token() }}">
    <input type="hidden" name="sp_id" id="sp_id" value="{{ $supplier->sp_id }}">
    <section id="anc_scf_info">
        <h2 class="h2_frm">사업자정보</h2>
        <?php echo $pg_anchor; ?>
        <style>
            .tbl_frm01 th { width: auto; }
        </style>
        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>사업자정보 입력</caption>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">제공상품</th>
                    <td><input type="text" class="frm_input" name="sp_item_name" value="{{ $supplier->sp_item_name }}"></td>
                </tr>
                <tr>
                    <th scope="row">업체(법인)명</th>
                    <td><input type="text" class="frm_input" name="sp_com_name" value="{{ $supplier->sp_com_name }}"></td>
                </tr>
                <tr>
                    <th scope="row">대표자명</th>
                    <td><input type="text" class="frm_input" name="sp_com_biz_ceoname" value="{{ $supplier->sp_com_biz_ceoname }}"></td>
                </tr>
                <tr>
                    <th scope="row">업태</th>
                    <td><input type="text" class="frm_input" name="sp_com_biz_type" value="{{ $supplier->sp_com_biz_type }}"></td>
                </tr>
                <tr>
                    <th scope="row">품목</th>
                    <td><input type="text" class="frm_input" name="sp_com_biz_item" value="{{ $supplier->sp_com_biz_item }}"></td>
                </tr>
                <tr>
                    <th scope="row">사업장주소</th>
                    <td class="td_addr_line">
                        <label for="sp_com_biz_postcode" class="sound_only">우편번호</label>
                        <input type="text" name="sp_com_biz_postcode" value="{{ $supplier->sp_com_biz_postcode }}" id="sp_com_biz_postcode" class="frm_input readonly" size="5" maxlength="6">
                        <button type="button" class="btn_frmline" onclick="win_zip('fconfig', 'sp_com_biz_postcode', 'sp_com_biz_addr', 'sp_com_biz_addr2', 'sp_com_biz_addr3', 'sp_com_biz_jibeon');">주소 검색</button><br>
                        <input type="text" name="sp_com_biz_addr" value="{{ $supplier->sp_com_biz_addr }}" id="sp_com_biz_addr" class="frm_input readonly" size="60">
                        <label for="sp_com_biz_addr">기본주소</label><br>
                        <input type="text" name="sp_com_biz_addr2" value="{{ $supplier->sp_com_biz_addr2 }}" id="sp_com_biz_addr2" class="frm_input" size="60">
                        <label for="sp_com_biz_addr2">상세주소</label>
                        <br>
                        <input type="text" name="sp_com_biz_addr3" value="{{ $supplier->sp_com_biz_addr3 }}" id="sp_com_biz_addr3" class="frm_input" size="60">
                        <label for="sp_com_biz_addr3">참고항목</label>
                        <input type="hidden" name="sp_com_biz_jibeon" value="{{ $supplier->sp_com_biz_jibeon }}"><br>

                    </td>
                </tr>
                <tr>
                    <th scope="row">대표전화</th>
                    <td><input type="text" class="frm_input" name="sp_com_biz_telno" value="{{ $supplier->sp_com_biz_telno }}"></td>
                </tr>
                <tr>
                    <th scope="row">팩스번호</th>
                    <td><input type="text" class="frm_input" name="sp_com_biz_faxno" value="{{ $supplier->sp_com_biz_faxno }}"></td>
                </tr>
                <tr>
                    <th scope="row">홈페이지</th>
                    <td><input type="text" class="frm_input" name="sp_com_homepage" value="{{ $supplier->sp_com_homepage }}"></td>
                </tr>

                </tbody>
            </table>
        </div>
    </section>

    <section id="anc_scf_account">
        <h2 class="h2_frm">정산계좌 정보</h2>
        <?php echo $pg_anchor; ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>사업자정보 입력</caption>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="sp_bank_name">은행명</label></th>
                    <td>
                        <input type="text" name="sp_bank_name" value="{{  $supplier->sp_bank_name }}" id="sp_bank_name" class="frm_input" size="30">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_bank_account">계좌번호</label></th>
                    <td>
                        <input type="text" name="sp_bank_account" value="{{  $supplier->sp_bank_account }}" id="sp_bank_account" class="frm_input" size="30">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_bank_holder">예금주명</label></th>
                    <td>
                        <input type="text" name="sp_bank_holder" value="{{  $supplier->sp_bank_holder }}" id="sp_bank_holder" class="frm_input" size="30">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="anc_scf_payment">
        <h2 class="h2_frm">담당자 정보</h2>
        <?php echo $pg_anchor; ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>사업자정보 입력</caption>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="sp_staff_name">담당자 명</label></th>
                    <td>
                        <input type="text" name="sp_staff_name" value="{{ $supplier->sp_staff_name }}" id="sp_staff_name" class="frm_input" size="30">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_staff_cellphone">담당자 핸드폰</label></th>
                    <td>
                        <input type="text" name="sp_staff_cellphone" value="{{ $supplier->sp_staff_cellphone }}" id="sp_staff_cellphone" class="frm_input" size="30">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_staff_email">담당자 이메일</label></th>
                    <td>
                        <input type="text" name="sp_staff_email" value="{{ $supplier->sp_staff_email }}" id="sp_staff_email" class="frm_input" size="30">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="anc_scf_delivery">
        <h2 >배송설정</h2>
        <?php echo $pg_anchor; ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>배송설정 입력</caption>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="sp_delivery_company">배송업체</label></th>
                    <td>
                        <?php echo help("이용 중이거나 이용하실 배송업체를 선택하세요."); ?>
                        <select name="sp_delivery_company" id="sp_delivery_company">
                            <?php echo get_delivery_company($supplier->sp_delivery_company); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_send_cost_case">배송비유형</label></th>
                    <td>
                        <?php echo help("<strong>금액별차등</strong>으로 설정한 경우, 주문총액이 배송비상한가 미만일 경우 배송비를 받습니다.\n<strong>무료배송</strong>으로 설정한 경우, 배송비상한가 및 배송비를 무시하며 착불의 경우도 무료배송으로 설정합니다.\n<strong>상품별로 배송비 설정을 한 경우 상품별 배송비 설정이 우선</strong> 적용됩니다.\n예를 들어 무료배송으로 설정했을 때 특정 상품에 배송비가 설정되어 있으면 주문시 배송비가 부과됩니다."); ?>
                        <select name="sp_send_cost_case" id="sp_send_cost_case">
                            <option value="차등" <?php echo get_selected($supplier->sp_send_cost_case, "차등"); ?>>금액별차등</option>
                            <option value="무료" <?php echo get_selected($supplier->sp_send_cost_case, "무료"); ?>>무료배송</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_send_cost_limit">배송비상한가</label></th>
                    <td>
                        <?php echo help("배송비유형이 '금액별차등'일 경우에만 해당되며 배송비상한가를 여러개 두고자 하는 경우는 <b>;</b> 로 구분합니다.\n\n예를 들어 20000원 미만일 경우 4000원, 30000원 미만일 경우 3000원 으로 사용할 경우에는 배송비상한가를 20000;30000 으로 입력하고 배송비를 4000;3000 으로 입력합니다."); ?>
                        <input type="text" name="sp_send_cost_limit" value="{{ $supplier->sp_send_cost_limit }}" size="40" class="frm_input" id="sp_send_cost_limit"> 원
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_send_cost_list">배송비</label></th>
                    <td>
                        <input type="text" name="sp_send_cost_list" value="{{ $supplier->sp_send_cost_list }}" size="40" class="frm_input" id="sp_send_cost_list"> 원
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_hope_date_use">희망배송일사용</label></th>
                    <td>
                        <?php echo help("'예'로 설정한 경우 주문서에서 희망배송일을 입력 받습니다."); ?>
                        <select name="sp_hope_date_use" id="sp_hope_date_use">
                            <option value="0" <?php echo get_selected($supplier->sp_hope_date_use, 0); ?>>사용안함</option>
                            <option value="1" <?php echo get_selected($supplier->sp_hope_date_use, 1); ?>>사용</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sp_hope_date_after">희망배송일지정</label></th>
                    <td>
                        <?php echo help("오늘을 포함하여 설정한 날 이후부터 일주일 동안을 달력 형식으로 노출하여 선택할수 있도록 합니다."); ?>
                        <input type="text" name="sp_hope_date_after" value="{{ $supplier->sp_hope_date_after }}" id="sp_hope_date_after" class="frm_input" size="5"> 일
                    </td>
                </tr>
                <tr>
                    <th scope="row">배송정보</th>
                    <td><?php echo editor_html('sp_baesong_content', get_text($supplier->sp_baesong_content, 0)); ?></td>
                </tr>
                <tr>
                    <th scope="row">교환/반품</th>
                    <td><?php echo editor_html('sp_change_content', get_text($supplier->sp_change_content, 0)); ?></td>
                </tr>

                <tr>
                    <th scope="row">모바일 배송정보</th>
                    <td><?php echo editor_html('sp_mobile_baesong_content', get_text($supplier->sp_mobile_baesong_content, 0)); ?></td>
                </tr>
                <tr>
                    <th scope="row">모바일 교환/반품</th>
                    <td><?php echo editor_html('sp_mobile_change_content', get_text($supplier->sp_mobile_change_content, 0)); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="btn_fixed_top">
        <a href=" <?php echo G5_SHOP_URL; ?>" class="btn btn_02">쇼핑몰</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>

</form>

<script>
    function fconfig_check(f)
    {
        <?php echo get_editor_js('sp_baesong_content'); ?>
        <?php echo get_editor_js('sp_change_content'); ?>
        <?php echo get_editor_js('sp_mobile_baesong_content'); ?>
        <?php echo get_editor_js('sp_mobile_change_content'); ?>
        <?php echo get_editor_js('sp_guest_privacy'); ?>

        return false;
    }

</script>

@endsection
