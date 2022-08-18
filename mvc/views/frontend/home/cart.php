<?php 
require_once "./mvc/core/redirect.php";
$redirect = new redirect();

// echo "<pre>";
// print_r($_SESSION['coupon']);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Document</title>
</head>
<body>
    
<div class="Content "> 


     <div class="Container-app">
            <div class="product-selling-title mt-40 mb-40">
                <hr>
                <span>GIỎ HÀNG CỦA BẠN</span>
                <hr>
            </div>

    <div class="row">
         <?php 
         $totalMoney = 0;
         if(isset($data['cart']) && $data['cart'] != NULL) {?>
            <div class="col col-xxl-8">
            <form action="home/updatecart" method="post">
            <div class="row">
            <div class="col col-xxl-6 header-custom-text">SẢN PHẨM</div>
            <div class="col col-xxl-2 header-custom-text">GIÁ</div>
            <div class="col col-xxl-2 header-custom-text">SỐ LƯỢNG</div>
            <div class="col col-xxl-2 header-custom-text">TẠM TÍNH</div>
            <div class="col col-12"> <div class="border-custom-cart"></div> </div>
            </div>

           
                <?php foreach($data['cart'] as $key => $val) {
                    $tamtinh=0;
                    $tamtinh=$val['price'] * $val['qty'];
                    $totalMoney += $tamtinh;
                    ?>
                
            <div class="row cart-product-item">
                    <div class="col col-xxl-6">   
                        <div class="row g-0">
                                    <div class="col col-1 ">
                                        <!-- <div onclick="deletetoCart(this,<?= $val['id'] ?>)" class="remove-from-cart">
                                            <a href="javascript:void(0)" >x</a>  
                                        </div>                                               -->
                                    <a href="home/deletecart?id=<?= $val['id']?>" >
                                        <div class="remove-from-cart">
                                            <p>x</p>  
                                        </div> 
                                    </a>  

                                    </div>
                                    <div class=" col col-3 ">
                                        <div class="thumb-img-cart">
                                        <a href="home/detail/<?= $val['slug'] ?>"> <img src="<?= $val['image'] ?>" alt=""> </a>
                                    </div>
                                    </div>
                                    <div class="col col-8"><?= $val['name'] ?></div>
                        </div>
                    </div>
                <div class="col col-xxl-2 price-custom-text"><?= number_format($val['price'])  ?>đ</div>
                <div class="col col-xxl-2">
                    <div class="row g-0">
                    <div onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="col btn-quantity">-</div>
                    <input class="col input_value_quantity" min="1" type="number" value="<?= $val['qty'] ?>" name="quantity<?php echo $val['id']?>">
                    <div onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="col btn-quantity">+</div>
                    </div>

                </div>
                <div class="col col-xxl-2 price-custom-text"><?= number_format($tamtinh) ?>đ</div>
            </div>
                <?php } ?>    
             



     

        <div class="row mt-40 mb-40 btn-action-cart">
            <div class="col col-xxl-4 "><a href="/shopping" ><div class='back-view-btn'><i class="fas fa-long-arrow-alt-left"></i> TIẾP TỤC XEM SẢN PHẨM</div></a> </div> 
            <div class="col col-xxl-4 "><button type="submit" name="update" class='update-cart-btn'><i class="fas fa-edit"></i> CẬP NHẬT GIỎ HÀNG</button></div>
        </div>
        </form>
     </div> 
     
     
     <div class="col col-xxl-4">
            <div class="row">
                <div class="col col-12 price-custom-text">CỘNG GIỎ HÀNG</div>
                <div class="col col-12"> <div class="border-custom-cart"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6">Tạm tính</div>
                <div class="col col-6 text-right"><span class="price-custom-text "> <?= number_format($totalMoney) ?>đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6">Phí giao hàng</div>
                <div class="col col-6 text-right">Đồng giá: <span class="price-custom-text">20.000đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <form action='coupon/check_coupon' method="post">
            <div class="row">
                <div class="col col-6"><i class="fas fa-tag sale-icon "></i> <span class="price-custom-text">Phiếu ưu đãi</span> </div>
                <div class="col col-12"> <div class="border-custom-cart"></div> </div>
                <div class="col col-12"> <input type="text" value="<?= isset($_SESSION['coupon'])?$_SESSION['coupon']['coupon_code'] : ''  ?>" placeholder ="Nhập mã ưu đãi" name="coupon" class="input-sale"> </div>
                <?php if(isset($_SESSION['coupon']) && $_SESSION['coupon'] != NULL) {?>
                <div class="col col-12"> <a class="btn-cancel-code-sale-a" href="coupon/cancel_coupon" ><div class = "btn-cancel-code-sale">Hủy mã giảm giá</div></a> </div>       
                <?php }else{?>
                <div class="col col-12"> <button type="submit" name="check_coupon" class = "btn-apply-code-sale">Áp dụng</button> </div>     
                <?php }?>

            </div>
            </form>

                <?php if(isset($_SESSION['flash'])) {?>
                    <p class="text-success"> <?= $redirect->setFlash('flash'); ?> </p>
                <?php }?>
                <?php if(isset($_SESSION['errors'])) {?>
                    <p class="text-danger"> <?= $redirect->setFlash('errors'); ?> </p>
                <?php }?>

            <div class="row">
                    <div class="col col-6"><span class="price-custom-text">Tổng tiền:</span> </div>
                    <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?= number_format($totalMoney+20000) ;?>đ</span> </div>
                <?php if(isset($_SESSION['coupon']) && $_SESSION['coupon'] != NULL) {?>
                    
                    <?php if($_SESSION['coupon']['coupon_condition'] == 1) {?>
                        <?php 
                            $total_coupon = ($totalMoney*$_SESSION['coupon']['coupon_number'])/100;
                        ?>
                        <div class="col col-6"><span class="price-custom-text">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"><img class="img-symbon" src="mvc/views/frontend/images/sale.png" alt=""> <?=$_SESSION['coupon']['coupon_number'] ?>% </span> </div>
                        <div class="col col-6"><span class="price-custom-text">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                    <?php }else{?>
                        <?php 
                            $total_coupon = $_SESSION['coupon']['coupon_number'];
                        ?>
                        <div class="col col-6"><span class="price-custom-text">Mã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"><img class="img-symbon" src="mvc/views/frontend/images/sale.png" alt=""> <?=number_format($_SESSION['coupon']['coupon_number']) ?>đ</span> </div>
                        <div class="col col-6"><span class="price-custom-text">Tổng tiền đã giảm:</span> </div>
                        <div class="col col-6 text-right"><span class="price-custom-text " id="final-price"> <?= number_format(($totalMoney-$total_coupon)+20000) ;?>đ </span> </div>
                        <?php }?>
                   
                <?php }?>
                <div class="col col-12"> <button onclick="handelPayment()" class = "pay-product">TIẾN HÀNH THANH TOÁN</button> </div>
            </div>
     </div>
     <?php } else {?>  
        <div class="cart-empty-size">
                <img src="mvc/views/frontend/images/cart-empty.png" alt="">
                <div class="price-custom-text  mt-40">GIỎ HÀNG TRỐNG</div>
        </div>
        <div class="row mt-40 mb-40">
            <div class="col col-xxl-4 "><a href="/shopping" class='back-view-btn'><i class="fas fa-long-arrow-alt-left"></i> QUAY LẠI CỬA HÀNG</a></div>
        </div>

     <?php } ?>  
    </div>

</div>
</div>
   
</body>
</html>

<script>
    function handelPayment(){
        var isLogin = <?php echo isset($_SESSION['user'])?'true':'false'; ?>;
        if(isLogin){
            // alert("Đã đăng nhập");
            window.location.href = "http://localhost/shopping/payment";
        }
        else{
            alert("Hãy đăng nhập để tiến hành thanh toán");
            window.location.href = "http://localhost/shopping/authen";
        }
    }
</script>