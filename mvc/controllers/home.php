<?php
// Bình thường auto chạy vào home/index
    class home extends controller {
        // public $SlugModels;
        // public $ProductModels;
        // public $PhotoModels;
        // hàm __construct() luôn chạy khi vừa vào;
        public $Functions;
        function __construct(){
            $this->SlugModels = $this->models('SlugModels');
            $this->ProductModels = $this->models('ProductModels');
            $this->PhotoModels = $this->models('PhotoModels');
            $this->CategoryModels = $this->models('CategoryModels');

            $this->Functions = $this->heler('Functions');

        }

        public function index()  {
            $product = $this->ProductModels->select_array('*',['publish' => 1] ,'id desc',0,8);
            //Lấy id điện thoại -> 62
            $cateSmartphone= $this->sameProduct(62);
            $Smartphone = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,0,8,'cateID',$cateSmartphone,'id', NULL ,NULL);
            // Lấy id máy tính bảng 85->Tìm ra id cha là danh mục
            $cateTable= $this->sameProduct(85);
            $tablet = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,0,8,'cateID',$cateTable,'id', NULL ,NULL);

            $cateLaptop= $this->sameProduct(92);
            $laptop = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,0,8,'cateID',$cateLaptop,'id', NULL ,NULL);

            $cateAccessory= $this->sameProduct(91);
            $accessory = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,0,8,'cateID',$cateAccessory,'id', NULL ,NULL);
            // echo "<pre>";
            // print_r( $tablet);die;
            // print_r($_SESSION['cart']);die;
            $data = [
                'page'      => 'home/index',
                'product'   => $product,
                'Smartphone'=>$Smartphone,
                'tablet'   => $tablet,
                'laptop'   => $laptop,
                'accessory'   => $accessory,
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
            // echo $_POST['quantity'];die;
            $data = $this->ProductModels->select_row('*',['slug' => $_POST['slug']]);
            if($data != NULL){
                $cart = $this->addtoCart($data , $_POST['quantity']);
            }
            
         }

         function addcartDetail(){
            // echo $_POST['quantity'];die;
            if($_POST['option'] === "NULL"){
                $data = $this->ProductModels->select_row('*',['slug' => $_POST['slug']]);
                // echo "<pre>";
                // print_r($data);
                if($data != NULL){
                    $cart = $this->addtoCart($data , $_POST['quantity']);
                }
            }else{
            $option = $_POST['option'];
            $data = $this->ProductModels->select_row('*',['slug' => $_POST['slug']]);
            $arr_optionproduct =[];
            if($data['optionproduct'] != '' && $data['optionproduct'] != NULL){
                $arr_optionproduct= json_decode($data['optionproduct'], true);
            }
            if(isset($_SESSION['cart']) && array_key_exists($data['id'], $_SESSION['cart'])){ 
                if($_SESSION['cart'][$data['id']]['name'] != $arr_optionproduct[$option]['name'] ){
                    $datas = [
                        'id'                => $data['id'].$arr_optionproduct[$option]['slug'],
                        'name'              => $arr_optionproduct[$option]['name'],
                        'price'             => $arr_optionproduct[$option]['price'],
                        'image'             => $data['image'],
                        'thumb'             => $data['thumb'],
                        'slug'              => $data['slug'],
                    ];
                    $cart = $this->addtoCart($datas , $_POST['quantity']);
                    
                }
                else{
                      if($data != NULL){
                           $cart = $this->addtoCart($data , $_POST['quantity']);
                       }
                }
            }
            else{
                $datas = [
                    'id'                => $data['id'].$arr_optionproduct[$option]['slug'],
                    'name'              => $arr_optionproduct[$option]['name'],
                    'price'             => $arr_optionproduct[$option]['price'],
                    'image'             => $data['image'],
                    'thumb'             => $data['thumb'],
                    'slug'              => $data['slug'],
                ];
                $cart = $this->addtoCart($datas , $_POST['quantity']);
            }
           
            // echo "<pre>";
            // print_r($datas);


            }

            
         }

         function addtoCart($array , $quantity){
            if(isset($_SESSION['cart'])){
                if(array_key_exists($array['id'], $_SESSION['cart'])){ 
                    $_SESSION['cart'][$array['id']]['qty'] += $quantity;  
                }
                else{
                    $_SESSION['cart'][$array['id']] = $array;
                    $_SESSION['cart'][$array['id']]['qty'] = $quantity;
                }
    
            }
            else{
                $_SESSION['cart'][$array['id']] = $array;
                $_SESSION['cart'][$array['id']]['qty'] = $quantity;
            }        
            // echo "<pre>";
            // print_r($_SESSION['cart']);
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
                        // print_r($_POST["quantity".$value["id"]]);     
                        $_SESSION['cart'][$value['id']]["qty"] = $_POST["quantity".$value["id"]];

                    }
                    // die;
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


        //  public function smartphone(){     
        //     // Lấy sản phẩm là điện thoại để đổ ra bảng tableProduct
        //         $cateSame= $this->sameProduct(62);

        //     //Lấy dữ liệu hãng cho filter
        //         $brand = $this->CategoryModels->select_array('*',['publish' => 1 , 'parentID' => 61]);
        //         // echo "<pre>";
        //         // print_r($brand);die;

                                
        //         $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
                
        //         $limit = 6;
        //         $page = 1;
        //         $total_rows = count($rows);
        //         $total_pages = ceil($total_rows / $limit);
        //         $start = ($page -1) * $limit;
        //         $button_pagination = $this->Functions->pagination($total_pages,$page);
 
        //         $product = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,$start,$limit,'cateID',$cateSame,'id', NULL);

        //         $data = [
        //             'page'      => 'smartphone/smartphone',
        //             'product'   => $product,
        //             'brand'     => $brand,
        //             'button_pagination' => $button_pagination,
        //             'total'     =>$total_rows

        //         ];
        //         $this->viewFrontEnd('frontend/masterlayout',$data);
            
           
        //     // ============ > Không nhận được $_POST['orderby'] bị UNDEFINE 
        //     // print_r($_POST['orderby']);die;
        //     // có mà ta
        //     // echo "<pre></pre>";
        //     // print_r($_POST['orderby']);
           
        //  }

        //  public function loadProduct(){
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         // bỏ vào đây hả anh ?
        //         // E định lấy $_POST['orderby'] gán vô để xếp giá lại 
                
        //         $order = $_POST['orderby'] != NULL ? 'price '.$_POST['orderby'] : ' id DESC';
        //         $cateID = $_POST['cateID'] != NULL &&  $_POST['cateID'] != '' ? $_POST['cateID'] : NULL ;
        //         $betweenPrice = $_POST['betweenPrice'] != NULL &&  $_POST['betweenPrice'] != "" ? $_POST['betweenPrice'] : NULL ;

        //         $cateSame= $this->sameProduct(62);
                

        //         $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
                
        //         $limit = 6;
        //         $page = isset($_POST['page'])?$_POST['page']:1;
        //         $total_rows = count($rows);
        //         $total_pages = ceil($total_rows / $limit);
        //         $start = ($page -1) * $limit;
        //         $button_pagination = $this->Functions->pagination($total_pages,$page);

        //         if($cateID == 'ALL'){
        //             $product = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,$limit,'cateID',$cateSame,'id', NULL,$betweenPrice);

        //             //Phân trang lại
        //             $rows = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,NULL,'cateID',$cateSame,'id', NULL,$betweenPrice);
        //             $total_rows = count($rows);
        //             $total_pages = ceil($total_rows / $limit);
        //             $button_pagination = $this->Functions->pagination($total_pages,$page);
        //         }
        //         else{
        //             $product = $this->ProductModels->select_array('*',['publish' => 1 , 'cateID' => $cateID],$order ,$start,$limit,'cateID',$cateSame,'id', NULL,$betweenPrice);
                    
        //             //Phân trang lại
        //             $rows = $this->ProductModels->select_array('*',['publish' => 1 ,'cateID' => $cateID],$order ,$start,NULL,'cateID',$cateSame,'id', NULL,$betweenPrice);
        //             $total_rows = count($rows);
        //             $total_pages = ceil($total_rows / $limit);
        //             $button_pagination = $this->Functions->pagination($total_pages,$page);
        //         }
                
        //         $data = [
        //             'page'      => 'smartphone/smartphone',
        //             'product'   => $product,
        //             'button_pagination' => $button_pagination,
        //             'total'     =>$total_rows

        //         ];
        //         $this->viewFrontEnd('frontend/smartphone/loadProduct',$data);
        //     }
        //     else{
        //         $cateSame= $this->sameProduct(62);
                
        //         $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
                
        //         $limit = 6;
        //         $page = $_POST['page']?$_POST['page']:1;
        //         $total_rows = count($rows);
        //         $total_pages = ceil($total_rows / $limit);
        //         $start = ($page -1) * $limit;
        //         $button_pagination = $this->Functions->pagination($total_pages,$page);

        //         $product = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,$start,$limit,'cateID',$cateSame,'id', NULL ,NULL);

        //         $data = [
        //             'page'      => 'smartphone/smartphone',
        //             'product'   => $product,
        //             'button_pagination' => $button_pagination,
        //             'total'     => $total_rows

        //         ];
        //         $this->viewFrontEnd('frontend/smartphone/loadProduct',$data);
        //     }
        //  }

         function search(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $seach_name = $_POST['seach_name'] != "" ?$_POST['seach_name']:"";
                $sql="";
                $sql .= "SELECT * FROM `tbl_product` WHERE name like" ." ".'"%'.$seach_name.'%"';
                $product = $this->ProductModels->query($sql);
                $output = "";
                if($seach_name != "" && count($product) > 0 ){
                    foreach($product as $val){
                    $output .= '<div class="row g-0 cart-header-item">
                    <div class="col col-xl-3">
                    <div class="img-size-search">
                    <a href="home/detail/'.$val['slug'].'"><img src="'. $val['image'].'" alt=""></a>
                    </div>
                    </div>
                    <div class="col col-xl-7"> <div class="text-name-search">'. $val['name'].'</div> <div class="text-price-search">'. number_format($val['price']).'đ</div> </div>
                    <div class="col col-xl-2"><i class="fas fa-cart-plus"></i> </div>
                    </div>';
                    
                 }}
                 else{
                    $output .= '<img src="mvc/views/frontend/images/no-products-found.png"  alt="">';
                 }
                

                
                echo $output;
                
            }
         }

    }