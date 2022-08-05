<?php
class smartphone extends controller {
    public $Functions;
    function __construct(){
        $this->ProductModels = $this->models('ProductModels');
        $this->CategoryModels = $this->models('CategoryModels');

        $this->Functions = $this->heler('Functions');

    }
    public function index(){     
        // Lấy sản phẩm là điện thoại để đổ ra bảng tableProduct
            $cateSame= $this->sameProduct(62);

        //Lấy dữ liệu hãng cho filter
            $brand = $this->CategoryModels->select_array('*',['publish' => 1 , 'parentID' => 61]);
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
                'page'      => 'smartphone/smartphone',
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

     public function loadProduct(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // bỏ vào đây hả anh ?
            // E định lấy $_POST['orderby'] gán vô để xếp giá lại 
            
            $order = $_POST['orderby'] != NULL ? 'price '.$_POST['orderby'] : ' id DESC';
            $cateID = $_POST['cateID'] != NULL &&  $_POST['cateID'] != '' ? $_POST['cateID'] : NULL ;
            $betweenPrice = $_POST['betweenPrice'] != NULL &&  $_POST['betweenPrice'] != "" ? $_POST['betweenPrice'] : NULL ;

            $cateSame= $this->sameProduct(62);
            

            $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
            
            $limit = 6;
            $page = isset($_POST['page'])?$_POST['page']:1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            if($cateID == 'ALL'){
                $product = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,$limit,'cateID',$cateSame,'id', NULL,$betweenPrice);

                //Phân trang lại
                $rows = $this->ProductModels->select_array('*',['publish' => 1 ],$order ,$start,NULL,'cateID',$cateSame,'id', NULL,$betweenPrice);
                $total_rows = count($rows);
                $total_pages = ceil($total_rows / $limit);
                $button_pagination = $this->Functions->pagination($total_pages,$page);
            }
            else{
                $product = $this->ProductModels->select_array('*',['publish' => 1 , 'cateID' => $cateID],$order ,$start,$limit,'cateID',$cateSame,'id', NULL,$betweenPrice);
                
                //Phân trang lại
                $rows = $this->ProductModels->select_array('*',['publish' => 1 ,'cateID' => $cateID],$order ,$start,NULL,'cateID',$cateSame,'id', NULL,$betweenPrice);
                $total_rows = count($rows);
                $total_pages = ceil($total_rows / $limit);
                $button_pagination = $this->Functions->pagination($total_pages,$page);
            }
            
            $data = [
                'page'      => 'smartphone/smartphone',
                'product'   => $product,
                'button_pagination' => $button_pagination,
                'total'     =>$total_rows

            ];
            $this->viewFrontEnd('frontend/smartphone/loadProduct',$data);
        }
        else{
            $cateSame= $this->sameProduct(62);
            
            $rows = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,NULL,NULL,'cateID',$cateSame,'id', NULL ,NULL);
            
            $limit = 6;
            $page = $_POST['page']?$_POST['page']:1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            $product = $this->ProductModels->select_array('*',['publish' => 1],'id DESC' ,$start,$limit,'cateID',$cateSame,'id', NULL ,NULL);

            $data = [
                'page'      => 'smartphone/smartphone',
                'product'   => $product,
                'button_pagination' => $button_pagination,
                'total'     => $total_rows

            ];
            $this->viewFrontEnd('frontend/smartphone/loadProduct',$data);
        }
     }

}