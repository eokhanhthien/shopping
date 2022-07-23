<?php
// Bình thường auto chạy vào home/index
    class home extends controller {
        // public $SlugModels;
        // public $ProductModels;
        // public $PhotoModels;
        // hàm __construct() luôn chạy khi vừa vào;
        function __construct(){
            $this->SlugModels = $this->models('SlugModels');
            $this->ProductModels = $this->models('ProductModels');
            $this->PhotoModels = $this->models('PhotoModels');
            $this->CategoryModels = $this->models('CategoryModels');
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
            $datas = $this->SlugModels->select_row('*', ['name' => $slug]);
            if($datas['type'] == 2){
                $data = $this->getProductDetail($slug);
                // echo "<pre>";
                // print_r($data);die;
                $this->viewFrontEnd('frontend/masterlayout',$data);
            }
         }

         function getProductDetail($slug){
            $data = [];
            $data['page'] = 'home/detail';
            $data['product'] = $this->ProductModels->select_row('*', ['slug' => $slug]);
            $data['list_images'] = $this->PhotoModels->select_array('*' , ['productID' => $data['product']['id'] ]);
            $cateSame= $this->sameProduct($data['product']['cateID']);
            $data['product_same'] = $this->ProductModels->select_array('*',['publish' => 1],'id desc',0,4,'cateID',$cateSame,'id', array($data['product']['id']));
            // echo "<pre>";
            // print_r($data['product_same']);die;
            return $data;
         }

         function sameProduct($cateID){
            $array = [];
            $data = $this->CategoryModels->select_row('*',['id' => $cateID]);
            if($data['parentID'] != 0){
                $cate = $this->CategoryModels->select_array('*',['parentID' =>$data['parentID']]);
                foreach($cate as $value){
                    $array[] = $value['id'];
                }
            }
            else{
                $array[] = $data['id'];
            }
            return $array;
         }

         function addcart(){
            // echo $_POST['slug'];die;
            $data = $this->ProductModels->select_row('*',['slug' => $_POST['slug']]);
            if($data != NULL){
                $cart = $this->addtoCart($data);
            }
         }

         function deletecart(){
            //ajax nhận lại 1 cái $_POST['id'] chứ không phải deletecart(id)
            // echo $_POST['id'];die;
            unset($_SESSION['cart'][$_GET['id']]);
            header("location: cart");
            // print_r($_GET['id']);
            // die;
        }

        function updatecart(){
            if(isset($_POST['update'])){
                if(isset($_SESSION["cart"])){
                    foreach($_SESSION["cart"] as $value){
                        if($_POST["quantity".$value["id"]] <= 0){
                            unset($_SESSION['cart'][$value['id']]);
                        }
                        else{
                            $_SESSION['cart'][$value['id']]["qty"] = $_POST["quantity".$value["id"]];
                        }
                    }
                }
            }
            header("location: cart");
        }

         function cart(){
            $cart = [];
            if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            }
            // echo "<pre>";
            // print_r(count($_SESSION['cart']));die;

            $data = [
                'page'      => 'home/cart',
                'cart'      => $cart,
            ];
             $this->viewFrontEnd('frontend/masterlayout',$data);
         }

    }