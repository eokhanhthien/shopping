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
         <?php if(isset($data['cart']) && $data['cart'] != NULL) {?>
            <div class="col col-xxl-8">

            <div class="row">
            <div class="col col-xxl-6 header-custom-text">SẢN PHẨM</div>
            <div class="col col-xxl-2 header-custom-text">GIÁ</div>
            <div class="col col-xxl-2 header-custom-text">SỐ LƯỢNG</div>
            <div class="col col-xxl-2 header-custom-text">TẠM TÍNH</div>
            <div class="col col-12"> <div class="border-custom-cart"></div> </div>
            </div>

           
                <?php foreach($data['cart'] as $key => $val) {?>
            <div class="row cart-product-item">
                    <div class="col col-xxl-6">   
                        <div class="row g-0">
                                    <div class="col col-1 ">
                                        <div onclick="deletetoCart(this,<?= $val['id'] ?>)" class="remove-from-cart">
                                            <a href="javascript:void(0)" >x</a>  
                                        </div>                                              
                                    </div>
                                    <div class=" col col-3 ">
                                        <div class="thumb-img-cart">
                                            <img src="<?= $val['image'] ?>" alt="">
                                    </div>
                                    </div>
                                    <div class="col col-8"><?= $val['name'] ?></div>
                        </div>
                    </div>
                <div class="col col-xxl-2 price-custom-text"><?= number_format($val['price'])  ?>đ</div>
                <div class="col col-xxl-2">
                    <span><button class="btn-quantity">-</button></span>
                    <span class="quantity-product-cart"><?= $val['qty'] ?></span>
                    <span><button class="btn-quantity">+</button></span>
                </div>
                <div class="col col-xxl-2 price-custom-text"><?= number_format($val['price'] * $val['qty']) ?>đ</div>
            </div>
                <?php } ?>    
             



     

        <div class="row mt-40 mb-40">
            <div class="col col-xxl-4 "><a href="/shopping/home/" class='back-view-btn'><i class="fas fa-long-arrow-alt-left"></i> TIẾP TỤC XEM SẢN PHẨM</a></div>
        </div>
     </div> 
     
     <div class="col col-xxl-4">
            <div class="row">
                <div class="col col-12 price-custom-text">CỘNG GIỎ HÀNG</div>
                <div class="col col-12"> <div class="border-custom-cart"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6">Tạm tính</div>
                <div class="col col-6 text-right"><span class="price-custom-text "> <?= number_format($data['totalMoney']) ?>đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6">Phí giao hàng</div>
                <div class="col col-6 text-right">Đồng giá: <span class="price-custom-text">20.000đ</span></div>
                <div class="col col-12"> <div class="border-custom-pay"></div> </div>
            </div>

            <div class="row">
                <div class="col col-6"><i class="fas fa-tag sale-icon "></i> <span class="price-custom-text">Phiếu ưu đãi</span> </div>
                <div class="col col-12"> <div class="border-custom-cart"></div> </div>
                <div class="col col-12"> <input type="text" placeholder ="Nhập mã ưu đãi" class="input-sale"> </div>
                <div class="col col-12"> <button class = "btn-apply-code-sale">Áp dụng</button> </div>
                
            </div>
            <div class="row">
                <div class="col col-6"><span class="price-custom-text">Tổng tiền:</span> </div>
                <div class="col col-6 text-right"><span class="price-custom-text "> <?= number_format($data['totalMoney']) ?>đ</span> </div>
                <div class="col col-12"> <button class = "pay-product">TIẾN HÀNH THANH TOÁN</button> </div>
            </div>
     </div>
     <?php } else {?>  
        <div class="cart-empty-size">
                <img src="mvc/views/frontend/images/cart-empty.png" alt="">
                <div class="price-custom-text  mt-40">GIỎ HÀNG TRỐNG</div>
        </div>
        <div class="row mt-40 mb-40">
            <div class="col col-xxl-4 "><a href="/shopping/home/" class='back-view-btn'><i class="fas fa-long-arrow-alt-left"></i> QUAY LẠI CỬA HÀNG</a></div>
        </div>

     <?php } ?>  
    </div>

</div>
</div>
   
</body>
</html>

<script>
function deletetoCart(__this,id){
    $.ajax({
        url:"home/deletecart",
        method:"post",
        data: {id:id}, 
        success : function(response) {
            $(__this).closest('.cart-product-item').remove();
            location.reload();
		}
    })
}
</script>