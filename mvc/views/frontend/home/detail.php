<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>
    <title>Document</title>
</head>
<body>
    <div class="Content "> 
        <div class="Container-app">
            <div class="row mt-40">
                <div class="col col-xxl-6">
                    <div class="img-size-detail">
                        <!-- <img src="mvc/views/frontend/images/dienthoai1.jpg" alt=""> -->
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    <?php if(isset($data['list_images']) && $data['list_images'] != NULL) {?>
                                        <?php foreach($data['list_images'] as $key => $val) {?>
                                        <div class="swiper-slide">
                                            <img src="<?= $val['image'] ?>" />
                                        </div>
                                        <?php } ?>    
                                    <?php } ?>    
                                    <!-- <div class="swiper-slide">
                                    <img src="mvc/views/frontend/images/dienthoai1.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                                    </div> -->
                                </div>

                                <div style ="color: #333 " class="swiper-button-next"></div>
                                <div style ="color: #333 " class="swiper-button-prev"></div>
                            </div>

                                    <div thumbsSlider="" class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                    <?php if(isset($data['list_images']) && $data['list_images'] != NULL) {?>
                                        <?php foreach($data['list_images'] as $key => $val) {?>
                                        <div class="swiper-slide">
                                            <img src="<?= $val['thumb'] ?>" />
                                        </div>
                                        <?php } ?>    
                                    <?php } ?>  
                                
                                    </div>
                                    </div>
                    </div>
                </div>
                <div class="col col-xxl-6">
                    <div class="detail-title">ĐIỆN THOẠI</div>
                    <div class="detail-name"><?= $data['product']['name'] ?></div>
                    <div class="detail-price"><?= number_format($data['product']['price']) ?>đ</div>
                    <div class="row g-0 mt-4">
                        <div class="col col-2"><div class="properties-choose">64GB</div> </div>
                        <div class="col col-2"><div class="properties-choose">128GB</div> </div>
                        <div class="col col-2"><div class="properties-choose">256GB</div> </div>   
                    </div>
                    <div class="row g-0 mt-3">
                        <div class="col col-3"><div class="properties-choose">MÀU ĐỎ</div> </div>
                        <div class="col col-3"><div class="properties-choose">MÀU GOLD</div> </div>
                        <div class="col col-3"><div class="properties-choose">MÀU TRẮNG</div> </div>   
                        <div class="col col-3"><div class="properties-choose">MÀU XANH</div> </div>   
                    </div>

                    <ul class="info-ul mt-4">
                                    <?php if(isset($data['product']['contents']) && $data['product']['contents'] != '') {?>
                                       <?= $data['product']['contents'] ?>
                                    <?php } ?> 
                        <!-- <li>iPhone 12 Pro Max 128 GB một siêu phẩm smartphone đến từ Apple.</li>
                        <li>Thay đổi thiết kế mới sau 6 năm.</li>
                        <li>Theo chu kỳ cứ mỗi 3 năm thì iPhone lại thay đổi thiết kế và 2020 là năm đánh dấu cột mốc quan trong này.</li>
                        <li>iPhone 12 Pro Max sở hữu diện mạo mới mới với khung viền được vát thẳng và mạnh mẽ như trên iPad Pro 2020.</li> -->
                    </ul>

                    <div class="status-product">Còn hàng</div>

                    <div class="row g-0 mt-3">
                        <div class="col col-3">
                        <div class="row g-0">
                            <div onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="col btn-quantity">-</div>
                            <input class="col input_value_quantity" min="1" type="number" value= "1" >
                            <div onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="col btn-quantity">+</div>
                        </div>
                        
                        </div>
                        <div class="col col-5"><div class="detail-add-to-cart" onclick="addCartDetail('<?= $data['product']['slug'] ?>')">THÊM VÀO GIỎ HÀNG</div> </div>
                    </div>

                </div>
            </div>

            <div class="mt-60"></div>
        
            <div  data-tab="properties" class="b-nav-tab active">CẤU HÌNH</div>
            <div  data-tab="comment" class="b-nav-tab">ĐÁNH GIÁ(0)</div>

            <div id="properties" class="b-tab active">
                <ul class="properties-content">
                    <?php if(isset($data['product']['properties']) && $data['product']['properties'] != '') 
                    $properties =json_decode($data['product']['properties'], true);
                    ?>
                    
                    <?php if(isset($properties) && $properties != NULL) {?>
                        <?php foreach($properties as $key => $val) {?>
                            <div class="row g-0 properties-item <?= $key%2==0?'properties-color':''?>">
                                <div class="col"><?= $val['name'] ?></div>
                                <div class="col"><?= $val['value'] ?></div>
                            </div>
                        <?php }?>    
                    <?php }?>    

                    <!-- <div class="row g-0 properties-item properties-color">
                                <div class="col">Màn hình:</div>
                                <div class="col">Dynamic AMOLED 2X6.8"Quad HD+ (2K+)</div>
                    </div>
                    <li>
                        <div class="row g-0 properties-item properties-color">
                            <div class="col">Màn hình:</div>
                            <div class="col">Dynamic AMOLED 2X6.8"Quad HD+ (2K+)</div>
                        </div>
                    </li>
                     <li>                        
                        <div class="row g-0 properties-item">
                            <div class="col">Hệ điều hành:</div>
                            <div class="col">Android 11</div>
                        </div>
                    </li>    
                     <li>                        
                        <div class="row g-0 properties-item properties-color">
                            <div class="col">Màn hình:</div>
                            <div class="col">Dynamic AMOLED 2X6.8"Quad HD+ (2K+)</div>
                        </div>
                    </li>     -->

                    
                </ul>
            </div>
            <div id="comment" class="b-tab">
                <div>Chưa có đánh giá nào</div>
                <div class="notify-comment">Chỉ những khách hàng đã đăng nhập và mua sản phẩm này mới có thể đưa ra đánh giá.</div>
            </div>

            <div class="border-custom-cart " ></div>
            
            <div class="same_product">SẢN PHẨM TƯƠNG TỰ</div>
            
            <div class="row">
                <?php if(isset($data['product_same']) && $data['product_same'] != NULL) { ?>
                    <?php foreach($data['product_same'] as $key => $val) {?>
                        <div class="col col-xxl-3 product-item">
                            <div class="thumbnail-avt-product">
                                <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
                                <div class="tab-detail-product">CHI TIẾT</div>
                            </div>
                            <div class="thumbnail-name-product"><?= $val['name'] ?></div>
                            <div class="thumbnail-price-product"><?= number_format($val['price']) ?>đ</div>
                            <a href="javascript:void(0)" onclick="addtoCart('<?= $val['slug'] ?>' , 1)"><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a> 
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

     
        </div>
    </div>
</body>
</html>

<!-- Swiper- start -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
      var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
</script>
<!-- Swiper- end -->

<!-- Tab start -->
<script>
    function Tabs() {
    var bindAll = function() {
        var menuElements = document.querySelectorAll('[data-tab]');
        for(var i = 0; i < menuElements.length ; i++) {
        menuElements[i].addEventListener('click', change, false);
        }
    }

    var clear = function() {
        var menuElements = document.querySelectorAll('[data-tab]');
        for(var i = 0; i < menuElements.length ; i++) {
        menuElements[i].classList.remove('active');
        var id = menuElements[i].getAttribute('data-tab');
        document.getElementById(id).classList.remove('active');
        }
    }

    var change = function(e) {
        clear();
        e.target.classList.add('active');
        var id = e.currentTarget.getAttribute('data-tab');
        document.getElementById(id).classList.add('active');
    }

    bindAll();
    }

    var connectTabs = new Tabs();
</script>
<!-- Tab end -->
<script>
    function addtoCart(slug,quantity){
      $.ajax({
        url:"home/addcart",
        method:"post",
        data: {
          slug:slug,
          quantity:quantity
        }, 
        success : function(response) { 
          $(".cart-container").load(" .cart-container");
          $("#cart-quantity").load(" #cart-quantity");
         
		}
    })
    }


    function addCartDetail(slug) {
        quantity = document.querySelector(".input_value_quantity").value;
        addtoCart(slug,quantity);
    }
  </script>