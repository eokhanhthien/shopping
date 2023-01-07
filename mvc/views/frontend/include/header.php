
<script src="mvc/views/frontend/bootstrap/jquery/dist/jquery.min.js"></script>
<div class="Header ">
    <div class="Container-app">
          <div class=" Header-top">
            <div class="row">
                <div class="col col-xl-4 col-xxl-2">
                  <div class="img-logo">
                    <img src="mvc/views/frontend/images/logo2.png" alt="">
                  </div>
                  
                </div>
                <div class="col col-xl-4 col-xxl-5 ">
                  <div class="search-header">
                    <input class="input-search-header" id="input-search-header" type="text" placeholder="Nhập sản phẩm cần tìm kiếm" >
                    <i class="fa-solid fa-magnifying-glass icon-search-header"></i>
                    <div class="search-header-dropdow">
                      <div class = "search-title ">SẢN PHẨM TƯƠNG TỰ</div>
                      <div class="drop-down-cart-height" id="loadSearch">
                        <img src="mvc/views/frontend/images/no-products-found.png"  alt="">
                      </div>


                    </div>
                    <div class="search-modal"></div>
                  </div>

                </div>
                <div class="col col-xl-4 col-xxl-5">
                  <div class="row g-0">
                    <div class="col "><div class="header-custom-text pb-40">
                      <a class=" cart-container" href="home/cart" >GIỎ HÀNG 
                        <!-- <i class="fa-solid fa-cart-shopping"></i>  -->
                        <span class="logo-cart"></span>
                      <?php 
                        if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
                          $quantity_total = 0;
                          foreach($_SESSION['cart'] as $key => $val){
                            $quantity_total += $val['qty'];
                          }
                        }
                      ?>
                    <?php if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL) {?>
                      <div class="cart-quantity" > <span id="cart-quantity"><?= $quantity_total ?> </span> </div>                
                    <?php }else{?>
                      <div class="cart-quantity" > <span id="cart-quantity">0 </span> </div>                
                    <?php }?>
                    </a> 

                    <div class="drop-down-cart" id="drop-down-cart">
                      <div class="drop-down-cart-height">
                      <?php 
                      if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
                        $monney_total = 0;
                        foreach($_SESSION['cart'] as $key => $val){
                          $monney_total += $val['price'] * $val['qty'];
                        }
                      }
                    ?>

                        <?php   if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){?>
                        <?php foreach($_SESSION['cart'] as $key => $val){?>
                        <div class="row g-0 cart-header-item">
                          <div class="col col-xl-3">
                            <div class="img-size-cart">
                            <a href="home/detail/<?= $val['slug'] ?>"><img src="<?=$val['image']?>" alt=""></a>
                            </div>
                          </div>
                          <div class="col col-xl-8">
                              <div class ='name-size-cart'><?=$val['name']?></div>
                              <div class ='price-size-cart'><?=$val['qty']?> x <span> <?=number_format($val['price']) ?></span> </div>
                          </div>
                          <div class="col col-xl-1">
                            <div class="remove-from-cart"><p>x</p></div>
                          </div>
                        </div>
                        <?php }?>
                      <?php }?>
                      </div>
                   
                      <?php if(isset($monney_total) && $monney_total != NULL){ ?>
                        <div class="">Tổng tiền: <?=number_format($monney_total)?>đ</div> 
                      <?php }else{?>
                        <div class="">Giỏ hàng trống</div> 
                      <?php }?>
                      
                         
                      <div class="header-cart-btn"><a href="home/cart">XEM GIỎ HÀNG</a> </div>
                    </div>
                  </div> 

                    </div>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] != NULL) {?>
                          <div class="col col-xl-8 "> 
                            
                          <div class="header-info-customer">
                            <span class="info-customer pb-40"><?= $_SESSION['user-info']['info']['fullname'] ?> <i class="fas fa-user-circle"></i> <i class="fas fa-caret-down"></i></span> 
                            <div class="drop-down-info">
                              <div class="drop-down-info-item"><a href="userinfo"><i class="fas fa-user-cog"></i> Thông tin tài khoản</a></div>
                              <div class="drop-down-info-item"><a href="userinfo"><i class="far fa-edit"></i> Thông tin đơn hàng</a> </div>
                              <div class="drop-down-info-item"> <a href="authen/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a> </div>
                            </div>
                          </div>



                          </div>
                    <?php }else{?>
                          <div class="col col-xl-4 header-custom-text"><a href="authen/register">ĐĂNG KÝ</a> </div>
                          <div class="col col-xl-4 header-custom-text"><a href="authen">ĐĂNG NHẬP</a> </div>
                      <?php }?>

                  </div>
                </div>
            </div>
          </div> 

        <div class="Header-menu">
            <div class="container-menu">
              <div class="row g-0">
                <div class="col header-menu-text <?php if(!isset($_SERVER['PATH_INFO'])) { echo "header-menu-active";}  {echo " ";} ?>"> <a href="">TRANG CHỦ</a> </div>
                <div class= "col header-menu-text <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/smartphone') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="smartphone">ĐIỆN THOẠI</a> </div>
                <div class= "col header-menu-text <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/tablet') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="tablet">MÁY TÍNH BẢNG</a> </div>
                <div class= "col header-menu-text <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/laptop') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="laptop">LAPTOP</a> </div>
                <div class= "col header-menu-text <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/accessory') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="accessory">PHỤ KIỆN</a> </div>
                <!-- <div class="col header-menu-text"> <a href="">MÁY TÍNH BẢNG</a> </div> -->
                <!-- <div class="col header-menu-text"> <a href="">LAPTOP</a> </div> -->
                <!-- <div class="col header-menu-text"> <a href="">PHỤ KIỆN</a> </div> -->
                <div class="col header-menu-text"> <a href="">LIÊN HỆ</a> </div>
              </div>
            </div>
        </div>
    </div>
  </div>


  <div class="Header-mobile">
    <div class="row">
      <div class="col"></div>
      <div class="col Header-mobile-right"><img class="list-moblie" src="mvc/views/frontend/images/list.png"  alt=""></div>
    </div>
  </div>
  <div class="nav-bar-left">
                <div class="header-menu-text-mobile <?php if(!isset($_SERVER['PATH_INFO'])) { echo "header-menu-active";}  {echo " ";} ?>"> <a href="">TRANG CHỦ</a> </div>
                <div class= "header-menu-text-mobile <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/smartphone') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="smartphone">ĐIỆN THOẠI</a> </div>
                <div class= "header-menu-text-mobile <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/tablet') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="tablet">MÁY TÍNH BẢNG</a> </div>
                <div class= "header-menu-text-mobile <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/laptop') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="laptop">LAPTOP</a> </div>
                <div class= "header-menu-text-mobile <?php if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/accessory') { echo "header-menu-active";}  {echo " ";} ?>" > <a href="accessory">PHỤ KIỆN</a> </div>
                <!-- <div class="header-menu-text-mobile"> <a href="">MÁY TÍNH BẢNG</a> </div> -->
                <!-- <div class="header-menu-text-mobile"> <a href="">LAPTOP</a> </div> -->
                <!-- <div class="header-menu-text-mobile"> <a href="">PHỤ KIỆN</a> </div> -->
                <div class= "header-menu-text-mobile "><a href="authen/register">ĐĂNG KÝ</a></div>
                <div class= "header-menu-text-mobile "><a href="authen">ĐĂNG NHẬP</a></div>
                <div class="header-menu-text-mobile"> <a href="">LIÊN HỆ</a> </div>
  </div>
  <div class="overlay"></div>                   

  <script>
  $(document).ready(function(){
  // focus cho dropdown seach và modal ---- Start -------
    $('#input-search-header').focus(()=>{
      $('.search-header-dropdow').addClass( "search-dropdow-active" );
      $('.search-modal').toggle();
    })

    $('.search-modal').click(()=>{
      $('.search-header-dropdow').removeClass( "search-dropdow-active" );
      $('.search-modal').toggle();
    })
  
  // focus cho dropdown seach và modal ---- End ---------
})
  </script>

  
<script>
  $(document).ready(function(){
// Bắt sự kiện keyup cho search------Start -------
  $('#input-search-header').keyup(()=>{
    var seach_name = $('#input-search-header').val();
    $.ajax({
    url: "home/search",
    method: "post",
    data: {
          seach_name : seach_name,
        },
	  success : function(response) {
        $('#loadSearch').html(response)
	}
	})

  })
})
// Bắt sự kiện keyup cho search------End ---------
</script>

<script>
  var list_moblie = document.querySelector(".list-moblie");
  var overlay = document.querySelector(".overlay");
  var nav_bar_left = document.querySelector(".nav-bar-left");
  
  list_moblie.onclick = () => {
    nav_bar_left.classList.add("navbar-active");
    overlay.classList.add("overlay-active");
  }
  overlay.onclick = () => {
    nav_bar_left.classList.remove("navbar-active");
    overlay.classList.remove("overlay-active");
  }
</script>