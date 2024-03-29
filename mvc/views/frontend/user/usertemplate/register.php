<?php 
require_once "./mvc/core/redirect.php";
$redirect = new redirect();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <base href="http://localhost/shopping/" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel = "icon" type = "image/png" href = "mvc/views/frontend/images/logo2.png">

    <link rel="stylesheet" href="mvc/views/frontend/user/usertemplate/fonts/icomoon/style.css">

    <link rel="stylesheet" href="mvc/views/frontend/user/usertemplate/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="mvc/views/frontend/user/usertemplate/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="mvc/views/frontend/user/usertemplate/css/style.css">

    <title>Đăng ký</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
    <a href="" > <button class="back-home"> <i class="fas fa-angle-double-left"></i> Trở về </button></a> 
      <div class="row">
        <div class="col-md-6">
        <img src="mvc/views/frontend/images/login.png" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h1>Đăng ký</h1>
            </div>
            <form class="" action="" method="post" novalidate> 
              <div class="form-group first">
                <!-- <label for="username">Họ và tên</label> -->
                <input name="data_post[fullname]"  class="form-control" id="fullname"  type="text" placeholder="Họ và tên">
              </div>

              <div class="form-group first">
                <!-- <label for="username">Tài khoản</label> -->
                <input name="data_post[username]"  class="form-control" id="username"  type="text" placeholder="Tài khoản">
              </div>
              <div class="form-group last mb-4">
                <!-- <label for="password">Mật khẩu</label> -->
                <input name="data_post[password]" onchange="checkPass()" class="form-control" id="password"  type="password" placeholder="Mật khẩu">
              </div>
              <p class="text-error">
              <div class="form-group last mb-4">
                <!-- <label for="password">Mật khẩu</label> -->
                <input onchange="checkPass()" class="form-control" id="repassword"  type="password" placeholder="Nhập lại mật khẩu">
              </div>


              <input id="register" name="submit" type="submit" value="Đăng ký" disabled="disabled" class="btn btn-block btn-primary btn-custom-login">
              <span class="d-block text-left my-4 text-muted">  <a class="create_account" href="authen">Bạn đã có tài khoản ?</a></span>
              
            </form>
              <?php 
                if(isset($_SESSION['successful'])) {
                ?>
                <p class="text-success"> <?= $redirect->setFlash('successful'); ?> </p>
                <?php }?>

                <?php 
                if(isset($_SESSION['error'])) {
                ?>
                <p class="text-error"> <?= $redirect->setFlash('error'); ?> </p>
              <?php }?>

            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script src="mvc/views/frontend/bootstrap/jquery/dist/jquery.min.js"></script>

    <script>
      function checkPass(){
            var pass = document.querySelector("#password").value;
            var repass = document.querySelector("#repassword").value;
            var register = document.querySelector("#register");
            var text_error = document.querySelector(".text-error");
            if(pass === repass){
              register.disabled = false;
              text_error.innerHTML = "";
            }
            else{
              register.disabled = true;
              text_error.innerHTML = "Mật khẩu chưa khớp";
            }
            
          }
   
    </script>
  </body>
</html>