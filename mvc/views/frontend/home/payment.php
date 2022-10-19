<?php 
require_once "./mvc/core/redirect.php";
$redirect = new redirect();

// echo"<pre>";
// print_r($_SESSION['cart']);die;
?>
<div class="Content "> 

<div class="Container-app">
    <form action="payment/confirm_order" method="post">
       <div class="row g-0">
        <div class="col col-xl-6">
            <div class="infor-pay-title mt-40">THÔNG TIN THANH TOÁN</div>
            <div class="row g-0 ">
                <div class="col col-xl-4 infor-pay-name">Tên người nhận:</div>
                <div class="col col-xl-8 ">
                <p class="address-tag"><?= $_SESSION['user-info']['info']['fullname'] ?></p>     
                <input type="hidden" class='infor-pay-phone' name="data_payment[shipping_name]" value="<?= $_SESSION['user-info']['info']['fullname'] ?>" >
                </div>
            </div>
            <div class="row g-0">
                <div class="col col-xl-4 infor-pay-name">Số điện thoại:</div>
                <div class="col col-xl-8 ">
                    <input name="data_payment[shipping_phone]" placeholder ="Nhập điện thoại" class='infor-pay-phone' type="text">
                </div>
            </div>
            <div class="row g-0">
                <div class="col col-xl-4 infor-pay-name">Email:</div>
                <div class="col col-xl-8 ">
                    <input name="data_payment[shipping_email]" placeholder ="Nhập email" class='infor-pay-phone' type="text">
                </div>
            </div>
            <div class="row g-0">
                <div class="col col-xl-12 infor-pay-name">Địa chỉ nhận hàng:</div>
                <div class="row g-0 mb-10">
                    <div class="col col-xl-4">
                        <p class="address-tag">Tỉnh/thành phố:</p> 
                    </div>
                    <div class="col col-xl-8 ">
                        <select name="data_payment[shipping_address_city]" id="city" class="address-main choose city" >
                        <option value="">Chọn tỉnh / Thành phố</option>
                        <?php if(isset($data['city']) && $data['city'] != NULL){ ?>
                            <?php foreach($data['city'] as $key => $val){?>
                                <option value="<?= $val['name_city'] ?>" data-city="<?= $val['matp'] ?>"><?= $val['name_city'] ?></option>
                            <?php } ?>
                        <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row g-0 mb-10">
                    <div class="col col-xl-4">
                        <p class="address-tag">Quận/huyện:</p> 
                    </div>
                    <div class="col col-xl-8">
                        <select name="data_payment[shipping_address_province]" id="province" class="address-main choose province" >
                            <option value="">Chọn quận / huyện</option>
                        </select>
                    </div>
                </div>

                <div class="row g-0 mb-10">
                    <div class="col col-xl-4">
                        <p class="address-tag">Xã phường/thị trấn:</p> 
                    </div>
                    <div class="col col-xl-8">
                        <select name="data_payment[shipping_address_wards]" id="wards" class="address-main wards" >
                            <option value="">Chọn xã phường / thị trấn</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row g-0 mb-10">
                    <div class="col col-xl-4">
                        <p class="infor-pay-name">Phương thức TT :</p> 
                    </div>
                    <div class="col col-xl-8">
                        <select name="data_payment[shipping_method]" id="wards" class="address-main wards" >
                            <option value="1">Thanh toán khi nhận hàng</option>
                            <option value="2">Thanh toán qua tín dụng</option>
                        </select>
                    </div>
                </div>

            <div class="row g-0 bt-10">
                <div class="col col-xl-12 infor-pay-name">Ghi chú:</div>
                <div class="col col-xl-9 ">
                   <input name="data_payment[shipping_notes]" type="text" class = "infor-note">             
                </div>
            </div>

        </div>
        <div class="col col-xl-6">
            <div class="infor-pay-title mt-40">ĐƠN HÀNG CỦA BẠN</div>


            <div class="row">
                <div class="col col-6 infor-pay-name">SẢN PHẨM</div>
                <div class="col col-6 text-right"><span class="price-custom-text infor-pay-name">TẠM TÍNH</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>
            <?php 
         $totalMoney = 0;
         if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL) {?>
            <?php foreach($_SESSION['cart'] as $key => $val) {
                    $tamtinh=0;
                    $tamtinh=$val['price'] * $val['qty'];
                    $totalMoney += $tamtinh;
                    ?>
            <div class="row">
                <div class="col col-9"><?= $val['name']?> x <?= $val['qty']?></div>
                <div class="col col-3 text-right"><span class="price-custom-text"><?= number_format($tamtinh) ?>đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <?php } ?>    
        


            <div class="row">
                <div class="col col-6">Phí giao hàng</div>
                <div class="col col-6 text-right">Đồng giá: <span class="price-custom-text">20.000đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6 infor-pay-total">Tổng tiền</div>
                <div class="col col-6 text-right"><span class="price-custom-text infor-pay-total"><?= number_format($totalMoney + 20000) ?>đ</span></div>
                <?php if(isset($_SESSION['coupon']) && $_SESSION['coupon'] != NULL) {?>
                    
                    <?php if($_SESSION['coupon']['coupon_condition'] == 1) {?>
                        <?php 
                            $total_coupon = ($totalMoney*$_SESSION['coupon']['coupon_number'])/100;
                        ?>
                        <div class="col col-6 infor-pay-total"><span class="price-custom-text">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?=$_SESSION['coupon']['coupon_number'] ?>% </span> </div>
                        <div class="col col-6"><span class="price-custom-text">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                    <?php }else{?>
                        <?php 
                            $total_coupon = $_SESSION['coupon']['coupon_number'];
                        ?>
                        <div class="col col-6 infor-pay-total"><span class="price-custom-text">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?=number_format($_SESSION['coupon']['coupon_number']) ?>đ</span> </div>
                        <div class="col col-6"><span class="price-custom-text">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                        <?php }?>
                   
                <?php }?>

                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>
            <button type="submit" name="submit" class="pay-btn">ĐẶT HÀNG</button>
            <?php 
                if(isset($_SESSION['flash'])) {
                ?>
                    <p class="text-success"> <?= $redirect->setFlash('flash'); ?> </p>
                <?php }?>

                <?php 
                    if(isset($_SESSION['errors'])) {
                ?>
                    <p class="text-danger"> <?= $redirect->setFlash('errors'); ?> </p>
                <?php }?>

            <?php }?>
        </div>

       </div>
       </form>
</div>
  
<script>
    $('.choose').change(function() {
        var action = $(this).attr('id');
        // var matp = $(this).val();
        var matp = $(this).find(':selected').data('city');
        var result = '';
        if(action=='city'){
            result = 'province';
        }else{
            result = 'wards';
        }
        $.ajax({
                url: "payment/getAddress",
                method:"post",
                data: {
                    action:action,
                    matp : matp,
                }, 
                success : function(response) {
                    $('#'+result).html(response);
                }
            })
    })
</script>