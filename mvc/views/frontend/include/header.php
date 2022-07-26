<div class="Header ">
    <div class="Container-app">
          <div class=" Header-top">
            <div class="row">
                <div class="col col-xl-4 col-xxl-2">
                  <div class="img-logo">
                    <img src="mvc/views/frontend/images/logo2.png" alt="">
                  </div>
                  
                </div>
                <div class="col col-xl-4 col-xxl-5 search-header">
                  <input class="input-search-header" type="text" placeholder="Nhập sản phẩm cần tìm kiếm" >
                  <i class="fa-solid fa-magnifying-glass icon-search-header"></i>
                </div>
                <div class="col col-xl-4 col-xxl-5">
                  <div class="row g-0">
                    <div class="col header-custom-text"><a class=" cart-container" href="home/cart" >GIỎ HÀNG <i class="fa-solid fa-cart-shopping"></i>
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
                    <?php }?>
                    </a> 

                    </div>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] != NULL) {?>
                          <div class="col col-xl-8 "> 
                            
                          <div class="header-info-customer">
                            <span class="info-customer"><?= $_SESSION['user-info']['info']['fullname'] ?> <i class="fas fa-user-circle"></i> <i class="fas fa-caret-down"></i></span> 
                            <div class="drop-down-info">
                              <div class="drop-down-info-item"><i class="fas fa-user-cog"></i> Thông tin tài khoản</div>
                              <div class="drop-down-info-item"><i class="far fa-edit"></i> Thông tin đơn hàng</div>
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
                <div class="col header-menu-text header-menu-active"> <a href="">TRANG CHỦ</a> </div>
                <div class="col header-menu-text"> <a href="home/smartphone">ĐIỆN THOẠI</a> </div>
                <div class="col header-menu-text"> <a href="">MÁY TÍNH BẢNG</a> </div>
                <div class="col header-menu-text"> <a href="">LAPTOP</a> </div>
                <div class="col header-menu-text"> <a href="">PHỤ KIỆN</a> </div>
                <div class="col header-menu-text"> <a href="">LIÊN HỆ</a> </div>
              </div>
            </div>
        </div>
    </div>
  </div>