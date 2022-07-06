<?php
session_start();
class controller{
    // Kết nối với views
    function view($view, $data = []){
        require_once "./mvc/views/cpanel/".$view.".php";
    }

    // Kết nối với CSDL
    function models($models){
        require_once "./mvc/models/".$models.".php";
        return new $models;
    }

    function heler($helper){
        require_once "./mvc/helper/".$helper.".php";
        return new $helper;
    }

    function viewFrontEnd($view, $data = []){
        require_once "./mvc/views/".$view.".php";
    }

    function addtoCart($array){
        if(isset($_SESSION['cart'])){
            if(array_key_exists($array['id'], $_SESSION['cart'])){
                $_SESSION['cart'][$array['id']]['qty'] += 1;
            }
            else{
                $_SESSION['cart'][$array['id']] = $array;
                $_SESSION['cart'][$array['id']]['qty'] = 1;
            }

        }
        else{
            $_SESSION['cart'][$array['id']] = $array;
            $_SESSION['cart'][$array['id']]['qty'] = 1;
        }        
        // echo "<pre>";
        // print_r($_SESSION['cart']);
    }
}