<?php
// Bình thường auto chạy vào home/index
    class home extends controller {
        public $MyModels;
        public $ProductModels;
        // hàm __construct() luôn chạy khi vừa vào;
        function __construct(){
            $this->MyModels = $this->models('MyModels');
            $this->ProductModels = $this->models('ProductModels');
        }

        public function index()  {
            $product = $this->ProductModels->select_array('*',['publish' => 1] ,'id desc');
            // echo "<pre>";
            // print_r($_SESSION['cart']);die;
            $data = [
                'page'      => 'home/index',
                'product'   => $product,
            ];
             $this->viewFrontEnd('frontend/masterlayout',$data);
         }

        
         function detail($slug){
            $data = $this->ProductModels->select_array('*',['slug' => $slug]);
            echo "<pre>";
            print_r($data);die;
         }

         function addcart(){
            // echo $_POST['slug'];die;
            $data = $this->ProductModels->select_row('*',['slug' => $_POST['slug']]);
            if($data != NULL){
                $cart = $this->addtoCart($data);
            }
         }

         function cart(){
             echo "<pre>";
            print_r($_SESSION['cart']);die;
            $data = [
                'page'      => 'home/cart',
            ];
             $this->viewFrontEnd('frontend/masterlayout',$data);
         }

    }