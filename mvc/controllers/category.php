<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";

// Bình thường auto chạy vào home/index
    class category extends controller {
    // public $MyModels; => Không cần do thừa kế
        public $CategoryModels;
        public $MyController;
        public $Functions;
        public $SlugModels;
        public $JWTOKEN;

        public $AdminModels;

        var $template = 'category';
        var $title = ' danh mục sản phẩm';
        public $session = 'session';
        var $type  = 1;

        function __construct(){
    // $this->MyModels = $this->models('MyModels'); => Không cần do thừa kế
             $this->AdminModels = $this->models('AdminModels');
             $this->SlugModels = $this->models('SlugModels');
            
            //Chứa biến $this->table -> tên bảng 
            $this->CategoryModels = $this->models('CategoryModels');
            $this->MyController = new MyController();

            $this->JWTOKEN = $this->heler('JWTOKEN');
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
            $datas = $this->CategoryModels->select_array('*', ['parentID' => 0]);
            foreach($datas as $key => $val){
                $children = $this->CategoryModels->select_array('*',['parentID' => $val['id']]);
                $datas[$key]['children'] = $children;
            }
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/index',
                'title'     =>'Danh sách'.$this->title,
                'template'  => $this->template,
                'datas'     => $datas,
                // 'data_info_admin' => $data_info_admin
            ];
         
            $this->view('masterlayout',$data);
         }

         public function add(){
            $data_admin = $this->MyController->getIndexAdmin();
            if(isset($_POST['submit'])){
                $data_post = $_POST['data_post'];
                $slug = $this->Functions ->createSlug($data_post['slug'], $this -> type);
                $data_post['slug'] = $slug;
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                $data_post['type'] =  $this -> type;
                $data_post['created_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> CategoryModels->add($data_post);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Thêm thành công danh mục sản phẩm');
                }
            }

            // parentID
            $parent = $this->CategoryModels->select_array('*',['parentID'=>0]);
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
            $datas = $this->CategoryModels->select_row('*',['id' => $id]);
            if(isset($_POST['submit'])){ 
                $data_post = $_POST['data_post'];
                if($id == $data_post['parentID']){
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('errors', 'Danh mục không thể là danh mục con của chính nó');
                }
                else{
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;

                $slug = $this->Functions ->createSlug($data_post['slug'], $this -> type , $datas['slug']);
                $data_post['slug'] = $slug;

                $data_post['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> CategoryModels->update($data_post, ['id' => $id]);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Cập nhật thành công danh mục sản phẩm');
                } 
                }

               
                
            }

            $parent = $this->CategoryModels->select_array('*',['parentID'=>0]);
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/edit',
                'title'     =>'Cập nhật '.$this->title,
                'template'  => $this->template,
                'parent'    => $parent,
                'datas'     => $datas
            ];
         
            $this->view('masterlayout',$data);
        }


        public function delete($id){  
            // xóa trong bảng slug----  ( phải xóa trước sản phẩm ) -----------------
            $datas = $this->CategoryModels->select_row('*',['id' => $id]);
            $this->SlugModels->delete(['name' => $datas['slug']]);
            // ----------------------------------------
            $result  = $this-> CategoryModels->delete(['id' => $id ]);
            $return = json_decode($result,true);
            if($return['type'] == "SuccessFully"){
                
                // Cập nhật danh mục con thành cha khi xóa đi danh mục cha
                $result  = $this-> CategoryModels->update(['parentID' => 0] ,['parentID' => $id] );
                // header("location:".$this->template."/index");
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Xóa thành công danh mục sản phẩm');
            } 
         }

    }