<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";

// Bình thường auto chạy vào home/index
    class userinfo extends controller {

        public $AdminModels;
        var $template = 'category';

        function __construct(){
             $this->AdminModels = $this->models('AdminModels');

        }

        public function index()  {  
            $data = [
                'page'      => 'userinfo/index',
            ];
             $this->viewFrontEnd('frontend/masterlayout',$data);

        }
    }