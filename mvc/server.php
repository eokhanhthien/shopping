<?php
    // Lệnh require, require_once, include và include_once dùng để import một file PHP A vào một file PHP B
    // với mục đích giúp file PHP B có thể sử dụng được các thư viện trong file PHP A.

    require_once "mvc/core/App.php";
    require_once "mvc/core/controller.php";
    require_once "mvc/core/db.php";
    require_once "./mvc/core/constant.php";
    require_once "./mvc/helper/JWTOKEN.php";
