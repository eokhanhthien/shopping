<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";

// Bình thường auto chạy vào home/index
    class product extends controller {
    // public $MyModels; => Không cần do thừa kế
    // Load Models
        public $CategoryModels;
        public $ProductModels;
        public $SlugModels;
        public $PhotoModels;

        public $MyController;

    // Load heler
        public $JWTOKEN;
        public $uploads;
        public $Functions;

        public $AdminModels;

        var $template = 'product';
        var $title = ' sản phẩm';
        public $session = 'session';

        //file chứa ảnh
        var $path_dir = 'public/uploads/images/product/';
        var $path_dir_detail = 'public/uploads/images/product/detail/';

        const type = 2;
        const limit = 6;
        function __construct(){
    // $this->MyModels = $this->models('MyModels'); => Không cần do thừa kế
             $this->AdminModels = $this->models('AdminModels');
            
            //Chứa biến $this->table -> tên bảng 
            $this->CategoryModels   = $this->models('CategoryModels');
            $this->ProductModels    = $this->models('ProductModels');
            $this->SlugModels       = $this->models('SlugModels');
            $this->PhotoModels       = $this->models('PhotoModels');
            $this->MyController     = new MyController();

            $this->JWTOKEN = $this->heler('JWTOKEN');
            $this->uploads = $this->heler('uploads');
            $this->Functions = $this->heler('Functions');

        }

        public function index()  {  
            // Kết nối thử CSDL khi thừa kế lớp MyModels 
            // $kq = $this->CategoryModels->select_array();
            // echo "<pre>";
            // print_r($kq);die;

            // print_r($_SESSION['admin']) ;die;
            
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                // $id_user=$_SESSION['admin']['id'];
                // $data_info_admin = $this->AdminModels->select_row('*',['id' => $id_user]);
                $redirect = new redirect('auth/index');

            }
           

            $data_admin = $this->MyController->getIndexAdmin();
            // $datas = $this->ProductModels->query('SELECT tbl_product.* , tbl_category.name as name_cate FROM `tbl_product` INNER JOIN tbl_category ON tbl_product.cateID = tbl_category.id ');
            $rows = $this->ProductModels->select_array_join_table('tbl_product.*,tbl_category.name as name_cate',NULL,'tbl_product.id desc',NULL,NULL,'tbl_category','tbl_category.id = tbl_product.cateID','INNER');

            // echo "<pre>";
            // print_r($datas);
            // die;


            // 30 sản phẩm total_rows = 30
            // mỗi trang sẽ chứa 1 sp limit =1
            // 30/1 = 30 trang total_rows/limit

            $limit = self::limit;
            $page = 1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;
            $datas = [];
            if($total_rows > 0){
                $datas = $this->ProductModels->select_array_join_table('tbl_product.*,tbl_category.name as name_cate',NULL,'tbl_product.id desc',$start,$limit,'tbl_category','tbl_category.id = tbl_product.cateID','INNER');

            }
            $button_pagination = $this->Functions->pagination($total_pages,$page);
            // echo $button_pagination;die; 
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/index',
                'title'     =>'Danh sách'.$this->title,
                'template'  => $this->template,
                'datas'     => $datas,
                'button_pagination' => $button_pagination
                // 'data_info_admin' => $data_info_admin
            ];
         
            $this->view('masterlayout',$data);
         }

         public function add(){
            $data_admin = $this->MyController->getIndexAdmin();
            if(isset($_POST['submit'])){
                if($_FILES['image']['name']){
                    $path_dir = $this->path_dir;
                    $data_upload = $this->uploads->upload($_FILES['image'], $path_dir, $_FILES['image']['name'],400,400);
                    if($data_upload['result'] == 'false'){
                        $redirect = new redirect($this->template.'/'.'index');
                        $redirect->setFlash('flash', $data_upload['message']);
                    }
                    else{
                        $image = $data_upload['img'];
                        $thumb = $data_upload['thumb'];
                    }
                }
                else{
                    $image = '';
                    $thumb = ''; 
                }

                $type =self::type;


                $data_post = $_POST['data_post'];
                $data_properties = $_POST['data_properties'];
                $properties = '';
                if(isset($data_properties) && $data_properties != NULL){
                    $properties = json_encode($data_properties);
                }

                $slug = $this->Functions->createSlug($data_post['slug'],$type);
                $price = str_replace(',','',$data_post['price']);
                $data_post['price'] = $price;   
                $data_post['slug'] = $slug;   
                $data_post['image'] = $image;   
                $data_post['thumb'] = $thumb;   
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                $data_post['properties'] = $properties;
              
                $data_post['created_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> ProductModels->add($data_post);
                $return = json_decode($result,true);

                // 
                $data_photoID = $_POST['photoID'];
                if( isset($data_photoID) && $data_photoID != NULL ){
                    foreach($data_photoID as $key => $val){
                        $this->PhotoModels->update(['productID' => $return['id']],['uuid' => $val]);
                    }
                }


                if($return['type'] == "SuccessFully"){
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Thêm thành công sản phẩm');
                }
            }

            // parentID
            $parent = $this->CategoryModels->select_array('*',['parentID'=>0]);
            foreach($parent as $key => $val){
                $parent[$key]['children'] = $this->CategoryModels->select_array('*',['parentID'=>$val['id']]);
            }
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/add',
                'title'     =>'Thêm mới'.$this->title,
                'template'  => $this->template,
                'parent'    => $parent
            ];
         
            $this->view('masterlayout',$data);
         }



         public function edit($id){
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->ProductModels->select_row('*',['id' => $id]);
            // danh sách ảnh chi tiết
            $list_photo = $this->PhotoModels->select_array('*',['productID' => $id]);

            $arr_properties =[];
            if($datas['properties'] != '' && $datas['properties'] != NULL){
                $arr_properties= json_decode($datas['properties'], true);
            }

            $image_folder = $datas['image'];
            $thumb_folder = $datas['thumb'];

            $type =self::type;

            if(isset($_POST['submit'])){ 
                if($_FILES['image']['name']){
                    if(file_exists( $image_folder)){
                        unlink( $image_folder);
                    }
                    if(file_exists( $thumb_folder)){
                        unlink( $thumb_folder);
                    }
                    $path_dir = $this->path_dir;
                    $data_upload = $this->uploads->upload($_FILES['image'], $path_dir, $_FILES['image']['name'],400,400);
                    if($data_upload['result'] == 'false'){
                        $redirect = new redirect($this->template.'/'.'index');
                        $redirect->setFlash('flash', $data_upload['message']);
                    }
                    else{
                        $image = $data_upload['img'];
                        $thumb = $data_upload['thumb'];
                    }
                }
                else{
                    $image = $datas['image'];
                    $thumb = $datas['thumb']; 
                }

                $data_properties = $_POST['data_properties'];
                $properties = '';
                if(isset($data_properties) && $data_properties != NULL){
                    $properties = json_encode($data_properties);
                }
              


                $data_post = $_POST['data_post'];
                $slug = $this->Functions->createSlug($data_post['slug'],$type, $datas['slug']);
                $data_post['slug'] = $slug;  
                $price = str_replace(',','',$data_post['price']);
                $data_post['price'] = $price;   
                $data_post['image'] = $image;   
                $data_post['thumb'] = $thumb;   
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                $data_post['properties'] = $properties;
                $data_post['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> ProductModels->update($data_post, ['id' => $id]);
                $return = json_decode($result,true);

                // echo "<pre>";print_r( $data_photoID);die;
                if( isset($_POST['photoID']) && $_POST['photoID'] != NULL ){
                    $data_photoID = $_POST['photoID'];
                    foreach($data_photoID as $key => $val){
                        $this->PhotoModels->update(['productID' => $id],['uuid' => $val]);
                    }
                }

                if($return['type'] == "SuccessFully"){
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Cập nhật thành công sản phẩm');
                } 

                
            }

            $parent = $this->CategoryModels->select_array('*',['parentID'=>0]);
            foreach($parent as $key => $val){
                $parent[$key]['children'] = $this->CategoryModels->select_array('*',['parentID'=>$val['id']]);
            }
            $data = [
                'data_admin'        => $data_admin,
                'page'              => $this->template.'/edit',
                'title'             =>'Cập nhật '.$this->title,
                'template'          => $this->template,
                'parent'            => $parent,
                'datas'             => $datas,
                'arr_properties'    => $arr_properties,
                'list_photo'        => $list_photo
            ];
         
            $this->view('masterlayout',$data);
        }


        public function delete($id){  
            $datas = $this->ProductModels->select_row('*',['id' => $id]);
            $image_folder = $datas['image'];
            $thumb_folder = $datas['thumb'];
            if(file_exists( $image_folder)){
                unlink( $image_folder);
            }
            if(file_exists( $thumb_folder)){
                unlink( $thumb_folder);
            }
            $result  = $this-> ProductModels->delete(['id' => $id ]);
            $this->SlugModels->delete(['name' => $datas['slug']]);
            $return = json_decode($result,true);
            if($return['type'] == "SuccessFully"){
                // header("location:".$this->template."/index");
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Xóa thành công sản phẩm');
            } 
         }

        function pagination_page(){
            $rows = $this->ProductModels->select_array_join_table('tbl_product.*,tbl_category.name as name_cate',NULL,'tbl_product.id desc',NULL,NULL,'tbl_category','tbl_category.id = tbl_product.cateID','LEFT');

            // echo "<pre>";
            // print_r($rows);
            // die;


            // 30 sản phẩm total_rows = 30
            // mỗi trang sẽ chứa 1 sp limit =1
            // 30/1 = 30 trang total_rows/limit

            $limit = self::limit;
            $page = $_POST['page']?$_POST['page']:1;
            $total_rows = count($rows);
            $total_pages = ceil($total_rows / $limit);
            $start = ($page -1) * $limit;

            if($total_rows > 0){
                $datas = $this->ProductModels->select_array_join_table('tbl_product.*,tbl_category.name as name_cate',NULL,'tbl_product.id desc',$start,$limit,'tbl_category','tbl_category.id = tbl_product.cateID','LEFT');

            }
            $button_pagination = $this->Functions->pagination($total_pages,$page);

            $data = [
                'template'  => $this->template,
                'datas'     => $datas,
                'button_pagination' => $button_pagination,
            ];
            $this->view('product/loadTable',$data);
        }


        function uploads(){
            if($_FILES['file']['name']){
                $path_dir = $this->path_dir_detail;
                $data_upload = $this->uploads->upload($_FILES['file'], $path_dir,$_POST['uuid'],400,400);
                if($data_upload['result'] == 'false'){
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', $data_upload['message']);
                }
                else{
                    $image = $data_upload['img'];
                    $thumb = $data_upload['thumb'];
                }

                $array = [
                    'uuid'          =>  $_POST['uuid'],
                    'image'         =>  $image,
                    'thumb'         =>  $thumb,
                    'productID'     =>  0,
                    'created_at'    => gmdate('Y-m-d H:i:s', time() + 7*3600)
                ];
                $this->PhotoModels->add($array);
            }
        }


        function deletePhotoID(){
            // echo $_POST['id'];
            // Xóa trong thư mục
            $data = $this->PhotoModels->select_row('*', ['id' => $_POST['id']] );
            if($data['image'] != '' && $data['image'] != NULL){
                if(file_exists($data['image'])){
                    unlink($data['image']);
                }
            }

            if($data['thumb'] != '' && $data['thumb'] != NULL){
                if(file_exists($data['thumb'])){
                    unlink($data['thumb']);
                }
            }

            //Xóa trên CSDL
            $result = $this->PhotoModels->delete(['id' => $_POST['id']]);
            echo  $result;
        }

        function deletezone(){
            $uuid = $_POST['id'];
            $data = $this->PhotoModels->select_row('*', ['uuid' => $uuid ] );
            if($data['image'] != '' && $data['image'] != NULL){
                if(file_exists($data['image'])){
                    unlink($data['image']);
                }
            }

            if($data['thumb'] != '' && $data['thumb'] != NULL){
                if(file_exists($data['thumb'])){
                    unlink($data['thumb']);
                }
            }

            //Xóa trên CSDL
            $result = $this->PhotoModels->delete(['uuid' => $uuid ]);
        }
        
    }