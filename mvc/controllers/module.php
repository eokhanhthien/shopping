<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
// Bình thường auto chạy vào home/index
    class module extends controller {
    // public $MyModels; => Không cần do thừa kế
    
        public $ModuleModels;
        public $MyController;
        var $template = 'module';
        var $title = ' module';
        public $session = 'session';
        public $JWTOKEN;


        function __construct(){
    // $this->MyModels = $this->models('MyModels'); => Không cần do thừa kế
            
            //Chứa biến $this->table -> tên bảng -> Ket noi CSDL
            $this->ModuleModels = $this->models('ModuleModels');
            $this->MyController = new MyController();

            $this->JWTOKEN = $this->heler('JWTOKEN');

        }

        public function index()  {  
            // Kết nối thử CSDL khi thừa kế lớp MyModels 
            // $kq = $this->ModuleModels->select_array();
            // echo "<pre>";
            // print_r($kq);die;


            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){  
                $redirect = new redirect('auth/index');

            }

            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->ModuleModels->select_array('*', ['parentID' => 0]);
            foreach($datas as $key => $val){
                $children = $this->ModuleModels->select_array('*',['parentID' => $val['id']]);
                $datas[$key]['children'] = $children;
            }
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/index',
                'title'     =>'Danh sách'.$this->title,
                'template'  => $this->template,
                'datas'     => $datas
            ];
         
            $this->view('masterlayout',$data);
         }

         public function add(){
            $data_admin = $this->MyController->getIndexAdmin();
            $sort_max = $this->ModuleModels->select_max_fields('sort',NULL);
            if(isset($_POST['submit'])){
                $data_post = $_POST['data_post'];
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                $data_post['sort'] = $sort_max['sort']+1;
                $data_post['created_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> ModuleModels->add($data_post);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Thêm thành công danh mục sản phẩm');
                }
            }

            // parentID
            $parent = $this->ModuleModels->select_array('*',['parentID'=>0]);
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
            $datas = $this->ModuleModels->select_row('*',['id' => $id]);
            if(isset($_POST['submit'])){ 
                $data_post = $_POST['data_post'];
                if($id == $data_post['parentID']){
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('errors', 'Danh mục không thể là danh mục con của chính nó');
                }
                else{
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                
                $data_post['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                // print_r($data_post);die;
                $result  = $this-> ModuleModels->update($data_post, ['id' => $id]);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Cập nhật thành công danh mục sản phẩm');
                } 
                }

               
                
            }

            $parent = $this->ModuleModels->select_array('*',['parentID'=>0]);
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
            $result  = $this-> ModuleModels->delete(['id' => $id ]);
            $return = json_decode($result,true);
            if($return['type'] == "SuccessFully"){
                
                // Cập nhật danh mục con thành cha khi xóa đi danh mục cha
                $result  = $this-> ModuleModels->update(['parentID' => 0] ,['parentID' => $id] );
                // header("location:".$this->template."/index");
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Xóa thành công danh mục sản phẩm');
            } 
         }

    }