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
    <title>Đăng nhập</title>
</head>
<body>
    <div class="authen_container">
    <form action='authen/login' method="post">
        <h1 class="text-center">Đăng nhập tài khoản</h1>
        <div class="authen_title">Tài khoản:</div>
        <input name='username' class="input_authen"  type="text" placeholder ="Nhập tài khoản của bạn">
        <div class="authen_title mt-20">Mật khẩu:</div>
        <input name='password' class="input_authen mb-20"  type="password" placeholder ="Nhập mật khẩu của bạn">

        
        <div ><a class="create_account" href="authen/register">Đăng ký tài khoản mới</a></div>
        <button name="submit" type="submit" class="btn-login-user" >Đăng nhập</button>
    </form>

        <?php 
            if(isset($_SESSION['errors'])) {
          ?>
            <p class="text-error"> <?= $redirect->setFlash('errors'); ?> </p>
        <?php }?>

    </div>
    

</body>
</html>