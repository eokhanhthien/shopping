<!-- css swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

<div class="Content">
    <div class="Content-banner">
      <img  src="https://cellphones.com.vn/sforum/wp-content/uploads/2021/05/c14dbc50-c1e9-11eb-bffd-3ca5a1fd1f33.jpeg" alt="">
      <a href="#product-hot" class="btn-down"><i class="fa-solid fa-angles-down icon-btn-down"></i></a>

      <div class="intrduce">
        <div class="introduce-title">SIÊU SALE CHÚC MỪNG SINH NHẬT</div>
        <div class="introduce-product">Apple Watch Series 5</div>
        <div class="introduce-title">Giảm ngay 1 triệu động từ 15/9-31/9</div>
      </div>

    </div>

    <div class="Container-app mt-60">
      <div class="row g-0" id="product-hot">
        <div class="col col-xxl-4 nav-main-product col-12">
              <a  href="smartphone">
              <div class="img-main-product">
                  <img src="mvc/views/frontend/images/phone.jpg" alt="">
              </div>
              <div class="text-main-product">
                <p>ĐIỆN THOẠI</p>
                <p>Giảm  50%</p>
              </div>
            </a>
        </div>

        <div class="col col-xxl-4 nav-main-product col-12">
              <a  href="laptop">
              <div class="img-main-product">
                  <img src="mvc/views/frontend/images/phone2.jpg" alt="">
              </div>
              <div class="text-main-product">
                <p>LAPTOP</p>
                <p>Giảm  10%</p>
              </div>
            </a>
        </div>

        <div class="col col-xxl-4 nav-main-product col-12">
              <a  href="accessory">
              <div class="img-main-product">
                  <img src="mvc/views/frontend/images/phone3.jpg" alt="">
              </div>
              <div class="text-main-product">
                <p>TAI NGHE</p>
                <p>Giảm  20%</p>
              </div>
            </a>
        </div>


      </div>


      <div class="product-selling-title mt-40 mb-40">
        <hr>
        <span >SẢN PHẨM MỚI NHẤT</span>
        <hr>
     </div>
  

     <div class="row g-0">
      <?php if(isset($data['product']) && $data['product'] != NULL) { ?>
        <?php foreach($data['product'] as $key => $val) {?>
              <div class="col col-xl-3 product-item col-6">
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

     <div class="product-selling-title mt-40 mb-40">
        <hr>
        <span>ĐIỆN THOẠI</span>
        <hr>
     </div>

     
        <div class="swiper">
        <div class="swiper-wrapper">
        <?php if(isset($data['Smartphone']) && $data['Smartphone'] != NULL) { ?>
        <?php foreach($data['Smartphone'] as $key => $val) {?>
            <div class="swiper-slide">
                  <div class="thumbnail-avt-product">
                     <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
                      <div class="tab-detail-product">CHI TIẾT</div>
                  </div>
                  <div class="thumbnail-name-product"><?= $val['name'] ?></div>
                  <div class="thumbnail-price-product"><?= number_format($val['price']) ?>đ</div>
                  <!-- <button onclick="addtoCart('<?= $val['slug'] ?>' , 1)" class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button>             -->
              </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>


      <div class="product-selling-title mt-40 mb-40">
        <hr>
        <span>MÁY TÍNH BẢNG</span>
        <hr>
     </div>
        <div class="swiper">
        <div class="swiper-wrapper">
        <?php if(isset($data['tablet']) && $data['tablet'] != NULL) { ?>
        <?php foreach($data['tablet'] as $key => $val) {?>
            <div class="swiper-slide">
                  <div class="thumbnail-avt-product">
                     <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
                      <div class="tab-detail-product">CHI TIẾT</div>
                  </div>
                  <div class="thumbnail-name-product"><?= $val['name'] ?></div>
                  <div class="thumbnail-price-product"><?= number_format($val['price']) ?>đ</div>
                  <!-- <a href="javascript:void(0)" onclick="addtoCart('<?= $val['slug'] ?>' , 1)"><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>               -->
              </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>


      <div class="product-selling-title mt-40 mb-40">
        <hr>
        <span>LAPTOP</span>
        <hr>
     </div>
        <div class="swiper">
        <div class="swiper-wrapper">
        <?php if(isset($data['laptop']) && $data['laptop'] != NULL) { ?>
        <?php foreach($data['laptop'] as $key => $val) {?>
            <div class="swiper-slide">
                  <div class="thumbnail-avt-product">
                     <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
                      <div class="tab-detail-product">CHI TIẾT</div>
                  </div>
                  <div class="thumbnail-name-product"><?= $val['name'] ?></div>
                  <div class="thumbnail-price-product"><?= number_format($val['price']) ?>đ</div>
                  <!-- <a href="javascript:void(0)" onclick="addtoCart('<?= $val['slug'] ?>' , 1)"><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>               -->
              </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
     

      <div class="product-selling-title mt-40 mb-40">
        <hr>
        <span>PHỤ KIỆN</span>
        <hr>
     </div>
        <div class="swiper">
        <div class="swiper-wrapper">
        <?php if(isset($data['accessory']) && $data['accessory'] != NULL) { ?>
        <?php foreach($data['accessory'] as $key => $val) {?>
            <div class="swiper-slide">
                  <div class="thumbnail-avt-product">
                     <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
                      <div class="tab-detail-product">CHI TIẾT</div>
                  </div>
                  <div class="thumbnail-name-product"><?= $val['name'] ?></div>
                  <div class="thumbnail-price-product"><?= number_format($val['price']) ?>đ</div>
                  <!-- <a href="javascript:void(0)" onclick="addtoCart('<?= $val['slug'] ?>' , 1)"><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>               -->
              </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
   

     <div class="row mt-60 mb-60">
      <div class="col col-xxl-4 deliver-container">
        <i class="fa-solid fa-truck-moving deliver-icon"></i>
        <div class="deliver-title">Giao Hàng Toàn Quốc</div>
        <div class="deliver-content">Ship COD toàn quốc. Nhận hàng trong vòng 2-3 ngày</div>
      </div>

      <div class="col col-xxl-4 deliver-container bd-lf-custom">
        <i class="fa-solid fa-rotate-left deliver-icon"></i>
        <div class="deliver-title">Hoàn Trả Miễn Phí</div>
        <div class="deliver-content">Xem hàng trước khi nhận. Hoàn trả miễn phí nếu không hài lòng</div>
      </div>

      <div class="col col-xxl-4 deliver-container">
        <i class="fa-solid fa-house-chimney deliver-icon"></i>
        <div class="deliver-title">Bảo hành 1 năm</div>
        <div class="deliver-content">Bảo hành 1 năm. Lỗi 1 đổi 1 tất cả các sản phẩm của Apple</div>
      </div>

     </div>

    </div>

  </div>

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
          //Load lại số lượng sp trên icon cart
          $("#cart-quantity").load(" #cart-quantity");

          //Load lại số lượng sp trong cart hover
          $("#drop-down-cart").load(" #drop-down-cart > *"); 
          // $(".cart-container").load(" .cart-container");
          // $("#cart-quantity").load(location.href + " #cart-quantity");
          // quantity cart trên icon khi không có phải reder ra 0 đê không bị lỗi

		}
    })
    }
  </script>


<!-- Swiper ----start------------------------------------------------------------ -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper('.swiper', {
    slidesPerView: 4,
    // direction: getDirection(),
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 2,
      
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 2,
      
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      
    }
  }

    // on: {
    //   resize: function () {
    //     swiper.changeDirection(getDirection());
    //   },
    // },
  });

  // function getDirection() {
  //   var windowWidth = window.innerWidth;
  //   var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

  //   return direction;
  // }
</script>
<!-- Swiper ----end------------------------------------------------------------ -->
