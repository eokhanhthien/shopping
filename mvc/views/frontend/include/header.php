<div class="Header ">
    <div class="Container-app">
          <div class=" Header-top">
            <div class="row">
                <div class="col col-xl-4 col-xxl-2">
                  <div class="img-logo">
                    <img src="mvc/views/frontend/images/logo1.png" alt="">
                  </div>
                </div>
                <div class="col col-xl-4 col-xxl-5 search-header">
                  <input class="input-search-header" type="text" placeholder="Nhập sản phẩm cần tìm kiếm" >
                  <i class="fa-solid fa-magnifying-glass icon-search-header"></i>
                </div>
                <div class="col col-xl-4 col-xxl-5">
                  <div class="row g-0">
                    <div class="col header-custom-text"><a href="home/cart" >GIỎ HÀNG <i class="fa-solid fa-cart-shopping"></i></a> </div>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] != NULL) {?>
                          <div class="col col-xl-4 header-info-customer"> 
                            
                          <span class="info-customer">THÔNG TIN <i class="fas fa-user-circle"></i> <i class="fas fa-caret-down"></i></span> 
                            <div class="drop-down-info">
                              <div class="drop-down-info-item">Thông tin tài khoản</div>
                              <div class="drop-down-info-item">Thông tin đơn hàng</div>
                              <div class="drop-down-info-item"> <a href="authen/logout">Đăng xuất</a> </div>
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
                <div class="col header-menu-text"> <a href="">ĐIỆN THOẠI</a> </div>
                <div class="col header-menu-text"> <a href="">MÁY TÍNH BẢNG</a> </div>
                <div class="col header-menu-text"> <a href="">LAPTOP</a> </div>
                <div class="col header-menu-text"> <a href="">PHỤ KIỆN</a> </div>
                <div class="col header-menu-text"> <a href="">LIÊN HỆ</a> </div>
              </div>
            </div>
        </div>
    </div>
  </div>