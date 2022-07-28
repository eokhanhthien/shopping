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

    <title>Đăng nhập</title>
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
              <h1>Đăng nhập</h1>
            </div>
            <form action='authen/login' method="post">
              <div class="form-group first">
                <!-- <label for="username">Tài khoản</label> -->
                <input name='username'  class="form-control" id="username"  type="text" placeholder="Tài khoản">
              </div>
              <div class="form-group last mb-4">
                <!-- <label for="password">Mật khẩu</label> -->
                <input name='password' class="form-control" id="password"  type="password" placeholder="Mật khẩu">
              </div>
              


              <input name="submit" type="submit" value="Đăng nhập" class="btn btn-block btn-primary btn-custom-login">
              <span class="d-block text-left my-4 text-muted">  <a class="create_account" href="authen/register">Đăng ký tài khoản mới</a></span>
              
            </form>

              <?php 
                  if(isset($_SESSION['errors'])) {
                ?>
                  <p class="text-error"> <?= $redirect->setFlash('errors'); ?> </p>
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
  </body>
</html>