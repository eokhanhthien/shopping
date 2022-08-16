<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();

// print_r($data);die;
?>
<style>
.order_detail_title {
    font-size: 20px;
    margin-top: 20px;
}
.order_info{
   width: 500px; 
   font-size: 16px;
   color: #333;
}
.order_info_tag{
    font-weight: 600;
}
.final_money{
    font-size: 20px;
    color: blue;
    font-weight: 600;
}
</style>
<div class="">
<div class="page-title">
                        <div class="title_left"> 
                            <a href="order" class="btn btn-primary">Trở lại</a>
                            <h3><?= $data['title'] ?></h3>
                        </div>


                    </div>

<div class="x_content">
<div class="order_detail_title">THÔNG TIN KHÁCH HÀNG</div>
<div class="order_info">
<div class="row">
    <div class="col col-xl-6 order_info_tag">Tên khách hàng:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_name'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Số điện thoại:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_phone'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Email:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_email'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Tỉnh/thành phố:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_address_city'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Quận/huyện:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_address_province'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Xã/phường/thị trấn:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_address_wards'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Ghi chú:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_notes'] ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Hình thức thanh toán:</div>
    <div class="col col-xl-6"> <?= $data['info_customer']['shipping_method']==1?'Thanh toán khi nhận hàng' : 'Thanh toán chuyển khoản' ?></div>
</div>
<div class="row">
    <div class="col col-xl-6 order_info_tag">Ngày đặt hàng:</div>
    <div class="col col-xl-6"> <?= date('d/m/Y' , strtotime($data['info_customer']['created_at']))?></div>
</div>
</div>


<div class="table-responsive">
<div class="order_detail_title">DANH SÁCH SẢN PHẨM</div>
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">

        <th class="column-title">STT </th>
        <th class="column-title">Tên sản phẩm </th>
        <th class="column-title">Hình ảnh </th>
        <th class="column-title">Giá </th>
        <th class="column-title">Số lượng </th>

      </tr>
    </thead>

    <?php if(isset($data['data']) && $data['data'] != NULL ){ 
        $totalMoney=0
        ;?>
          <tbody>
          <?php foreach($data['data'] as $key => $val) {
                    $tamtinh=0;
                    $tamtinh=$val['product_price'] * $val['product_quantity'];
                    $totalMoney += $tamtinh;
            ?>
              <tr class="even pointer">
                  <td><?= $key+1 ?></td>
                  <td><?= $val['product_name']?></td>
                  <td><img src="<?= $val['product_image']?>" height='100' alt=""> </td>
                  <td><?= number_format($val['product_price'])?>đ</td>
                  <td><?= $val['product_quantity']?></td>
              

              </tr>
              

          <?php } ?>

          </tbody>

          <?php } ?>
  </table>
</div>
    <div class="row order_info">
                <div class="col col-6 infor-pay-total order_info_tag">Tổng tiền</div>
                <div class="col col-6 text-right"><span class="<?= isset($data['order'])? "price-custom-text infor-pay-total" : "price-custom-text infor-pay-total final_money"?>" ><?= number_format($totalMoney + 20000) ?>đ</span></div>
                <?php if(isset($data['order']) && $data['order'] != NULL) {?>
                    
                    <?php if($data['order']['order_coupon_condition'] == 1) {?>
                        <?php 
                            $total_coupon = ($totalMoney*$data['order']['order_coupon_number'])/100;
                        ?>
                        <div class="col col-6 infor-pay-total"><span class="price-custom-text order_info_tag">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?=$data['order']['order_coupon_number'] ?>% </span> </div>
                        <div class="col col-6"><span class="price-custom-text order_info_tag">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text final_money" id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                    <?php }else{?>
                        <?php 
                            $total_coupon = $data['order']['order_coupon_number'];
                        ?>
                        <div class="col col-6 infor-pay-total"><span class="price-custom-text order_info_tag">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?=number_format($data['order']['order_coupon_number']) ?>đ</span> </div>
                        <div class="col col-6"><span class="price-custom-text order_info_tag">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text final_money" id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                        <?php }?>
                   
                <?php }?>
    </div>      
    
</div>
</div>