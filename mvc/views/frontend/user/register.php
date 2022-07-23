<?php 
require_once "./mvc/core/redirect.php";
$redirect = new redirect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/shopping/" >
    <link rel="stylesheet" href="mvc/views/frontend/user/style.css">
    <title>Đăng ký</title>
</head>
<body>
<div class="authen_container">
      
    <form class="" action="" method="post" novalidate> 
            <h1 class="text-center">Đăng ký tài khoản</h1>
            <div class="authen_title">Họ và tên:</div>
            <input class="input_authen" name="data_post[fullname]"  type="text" placeholder ="Nhập họ và tên của bạn">
            <div class="authen_title mt-20">Tên tài khoản:</div>
            <input class="input_authen" name="data_post[username]" type="text" placeholder ="Nhập tài khoản của bạn">
            <div class="authen_title mt-20">Mật khẩu:</div>
            <input class="input_authen mb-20" name="data_post[password]" type="password" placeholder ="Nhập mật khẩu của bạn">
            <!-- <div class="authen_title mt-20">Nhập lại mật khẩu:</div>
            <input class="input_authen" name="data_post[repassword]" type="password" placeholder ="Nhập mật khẩu của bạn"> -->
            
            <div ><a class="create_account" href="authen">Bạn đã có tài khoản</a></div>
            <button name="submit" type="submit"  class="btn-login-user" >Đăng ký</button>
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
</body>
</html>