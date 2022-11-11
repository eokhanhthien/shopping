<?php
class accessory extends controller {
    public $Functions;
    function __construct(){
        $this->ProductModels = $this->models('ProductModels');
        $this->ProductDetailModels = $this->models('ProductDetailModels');
        $this->CategoryModels = $this->models('CategoryModels');

        $this->Functions = $this->heler('Functions');

    }
    public function index(){     
        // Lấy sản phẩm là điện thoại để đổ ra bảng tableProduct
            $cateSame= $this->sameProduct(91);

        //Lấy dữ liệu hãng cho filter
            $brand = $this->CategoryModels->select_array('*',['publish' => 1 , 'parentID' => 90]);
            // echo "<pre>";
            // print_r($brand);die;

                            
            $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
            
            $limit = 6;
            $page = 1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            $product = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,$start,$limit,'cateID',$cateSame,'id', NULL);

            $data = [
                'page'      => 'accessory/accessory',
                'product'   => $product,
                'brand'     => $brand,
                'button_pagination' => $button_pagination,
                'total'     =>$total_rows

            ];
            $this->viewFrontEnd('frontend/masterlayout',$data);
        
       
        // ============ > Không nhận được $_POST['orderby'] bị UNDEFINE 
        // print_r($_POST['orderby']);die;
        // có mà ta
        // echo "<pre></pre>";
        // print_r($_POST['orderby']);
       
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

    //  Hàm này dùng để get array id sản phẩm theo key cần lọc đuọc truyền vào
     function push_array_filter($arrayFilter){
        $array = [];
        foreach($arrayFilter as $value){
            $array[] = $value['id_product'];
        }
        return $array;
     }
     public function loadProduct(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // bỏ vào đây hả anh ?
            // E định lấy $_POST['orderby'] gán vô để xếp giá lại 
            
            $order = $_POST['orderby'] != NULL ? 'price '.$_POST['orderby'] : ' id DESC';
            $cateID = $_POST['cateID'] != NULL &&  $_POST['cateID'] != '' ? $_POST['cateID'] : "ALL" ;
            $betweenPrice = $_POST['betweenPrice'] != NULL &&  $_POST['betweenPrice'] != "" ? $_POST['betweenPrice'] : NULL ;
            $ram =isset( $_POST['ram'] ) &&  $_POST['ram'] != "ALL"? $_POST['ram'] : "ALL" ;
            $memory =isset( $_POST['memory'] ) &&  $_POST['memory'] != "ALL"? $_POST['memory'] : "ALL" ;
            $demand =isset( $_POST['demand'] ) &&  $_POST['demand'] != "ALL"? $_POST['demand'] : "ALL" ;
            // print_r($memory);die;

            
            // Lấy sp có category giống sp có id 91 => điện thoại
            $cateSame= $this->sameProduct(91);
            
            //Lấy danh sách array id có ram => $ram            
            $filter_ram = $this->ProductDetailModels->select_array('*', ['ram' => $ram],NULL,NULL,NULL,'cateID',$cateSame,NULL, NULL ,NULL);
            $array_id_filterRam = $this->push_array_filter($filter_ram);
            // echo "<pre>";
            // print_r($array_id_filterRam);die;

            //Lấy danh sách array id có memory => $memory            
            $filter_memory = $this->ProductDetailModels->select_array('*', ['memory' => $memory],NULL,NULL,NULL,'cateID',$cateSame,NULL, NULL ,NULL);
            $array_id_filterMemory = $this->push_array_filter($filter_memory);

            $filter_demand = $this->ProductDetailModels->select_array('*', NULL,NULL,NULL,NULL,'cateID',$cateSame,NULL, NULL ,NULL,'demand',$demand);
            $array_id_filterDemand = $this->push_array_filter($filter_demand);
            // echo "<pre>";
            // print_r($array_id_filterDemand);die;

            if($ram != 'ALL'){
                $intersectProduct = $array_id_filterRam;
            }
            if($memory != 'ALL'){
                $intersectProduct = $array_id_filterMemory;
            }
            if($demand != 'ALL'){
                $intersectProduct = $array_id_filterDemand;
            }
            if($ram != 'ALL' && $memory != 'ALL'){
                $intersectProduct = array_intersect($array_id_filterRam,$array_id_filterMemory);
            }
            if($ram != 'ALL' && $demand != 'ALL'){
                $intersectProduct = array_intersect($array_id_filterRam,$array_id_filterDemand);
            }
            if($memory != 'ALL' && $demand != 'ALL'){
                $intersectProduct = array_intersect($array_id_filterMemory,$array_id_filterDemand);
            }            
            if($ram != 'ALL' &&$memory != 'ALL' && $demand != 'ALL'){
                $intersectProduct = array_intersect($array_id_filterRam,$array_id_filterMemory,$array_id_filterDemand);
            }


            
            $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
            
            $limit = 6;
            $page = isset($_POST['page'])?$_POST['page']:1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            if($cateID == 'ALL'){
                    $product = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,$limit,'cateID',$cateSame,NULL, NULL,$betweenPrice);

                    //Phân trang lại
                    $rows = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,NULL,'cateID',$cateSame,NULL, NULL,$betweenPrice);
                    $total_rows = count($rows);
                    $total_pages = ceil($total_rows / $limit);
                    $button_pagination = $this->Functions->pagination($total_pages,$page);

                    if($ram != 'ALL' || $memory != 'ALL' ||  $demand != 'ALL'){
                        if(count($intersectProduct)>0){
                            $product = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,$limit,'id',$intersectProduct,NULL, NULL,$betweenPrice);
                        }
                        else{
                            $product = [];
                        }

                        //Phân trang lại
                        if(count($product) > 0){
                            $rows = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,NULL,'id',$intersectProduct,NULL, NULL,$betweenPrice);
                        }
                        else{
                            $rows = [];
                        }
                        $total_rows = count($rows);
                        $total_pages = ceil($total_rows / $limit);
                        $button_pagination = $this->Functions->pagination($total_pages,$page);
                    }
      
            }
            else{
                    $product = $this->ProductModels->select_array('*',['publish' => 1 , 'cateID' => $cateID],$order ,$start,$limit,'cateID',$cateSame,NULL, NULL,$betweenPrice);

                    //Phân trang lại
                    $rows = $this->ProductModels->select_array('*',['publish' => 1 ,'cateID' => $cateID],$order ,$start,NULL,'cateID',$cateSame,NULL, NULL,$betweenPrice);
                    $total_rows = count($rows);
                    $total_pages = ceil($total_rows / $limit);
                    $button_pagination = $this->Functions->pagination($total_pages,$page);
        

                    if($ram != 'ALL' || $memory != 'ALL' ||  $demand != 'ALL'){
                        if(count($intersectProduct)>0){
                            $product = $this->ProductModels->select_array('*',['publish' => 1 , 'cateID' => $cateID],$order ,$start,$limit,'id',$intersectProduct,NULL, NULL,$betweenPrice);

                        }
                        else{
                            $product = [];
                        }
                        //Phân trang lại
                        if(count($product) > 0){
                            $rows = $this->ProductModels->select_array('*',['publish' => 1 , 'cateID' => $cateID],$order ,$start,NULL,'id',$intersectProduct,NULL, NULL,$betweenPrice);
                        }
                        else{
                            $rows = [];
                        }
                        $total_rows = count($rows);
                        $total_pages = ceil($total_rows / $limit);
                        $button_pagination = $this->Functions->pagination($total_pages,$page);
                    }
            }
            
            $data = [
                'page'      => 'accessory/accessory',
                'product'   => $product,
                'button_pagination' => $button_pagination,
                'total'     =>$total_rows

            ];
            $this->viewFrontEnd('frontend/accessory/loadProduct',$data);
        }
        else{
            $cateSame= $this->sameProduct(91);
            
            $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
            
            $limit = 6;
            $page = $_POST['page']?$_POST['page']:1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            $product = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,$start,$limit,'cateID',$cateSame,'id', NULL ,NULL);

            $data = [
                'page'      => 'accessory/accessory',
                'product'   => $product,
                'button_pagination' => $button_pagination,
                'total'     => $total_rows

            ];
            $this->viewFrontEnd('frontend/accessory/loadProduct',$data);
        }
     }

}