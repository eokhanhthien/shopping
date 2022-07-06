<?php
require_once "constant.php";
// session_start() Để chuyển message thư từ trang này sang trang khác, bạn sử dụng $_SESSIONbiến superglobal.
// session_start();
class redirect{
    function __construct($index = ''){
        if($index != ''){
            header("location:".base_url.$index);
        }
      
    }

    function setFlash($type , $text = ''){
        if(isset($_SESSION[$type])){
            $message = $_SESSION[$type];
            unset($_SESSION[$type]);
            return $message;
        }
        else{
            $_SESSION[$type] = $text;
        }
        return '';
    }
}