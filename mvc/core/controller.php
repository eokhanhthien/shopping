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
}