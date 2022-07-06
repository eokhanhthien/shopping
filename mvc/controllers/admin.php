<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";

// Bình thường auto chạy vào home/index
    class admin extends controller {
    // public $MyModels; => Không cần do thừa kế
        public $AdminModels;
        public $MyController;

        var $template = 'admin';
        var $title = ' tài khoản quản trị';
        public $session = 'session';


        function __construct(){
    // $this->MyModels = $this->models('MyModels'); => Không cần do thừa kế
            
            //Chứa biến $this->table -> tên bảng 
            $this->AdminModels = $this->models('AdminModels');
            $this->MyController = new MyController();
        }

        public function index()  {  
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                // $id_user=$_SESSION['admin']['id'];
                // $data_info_admin = $this->AdminModels->select_row('*',['id' => $id_user]);
                $redirect = new redirect('auth/index');

            }
            
            // Kết nối thử CSDL khi thừa kế lớp MyModels 
            // $kq = $this->AdminModels->select_array();
            // echo "<pre>";
            // print_r($kq);die;
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->AdminModels->select_array('*');
        
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
            if(isset($_POST['submit'])){
                $data_post = $_POST['data_post'];
                $password = password_hash($data_post['password'],PASSWORD_BCRYPT );
                $data_post['password'] = $password;
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish;
                // print_r($data_post);die;
                $result  = $this-> AdminModels->add($data_post);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Thêm thành công ');
                }
            }

         
            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/add',
                'title'     =>'Thêm mới'.$this->title,
                'template'  => $this->template,
               
            ];
         
            $this->view('masterlayout',$data);
         }


        // URL http://localhost/shopping/admin/edit/7/duongkhanhthien thì hàm sẽ nhận vào biến theo thứ tự sau edit/$biến1/$biến2
        public function edit($id,$fullname){
            // echo $fullname;die;
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->AdminModels->select_row('*',['id' => $id]);  
            if(isset($_POST['submit'])){ 
                $data_post = $_POST['data_post'];
                $data_post['publish'] ? $publish =1 : $publish=0;
                $data_post['publish'] = $publish; 
                // print_r($data_post);die;
                $result  = $this-> AdminModels->update($data_post, ['id' => $id]);
                $return = json_decode($result,true);
                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect($this->template.'/'.'index');
                    $redirect->setFlash('flash', 'Cập nhật thành công danh mục sản phẩm');
                } 
                

               
                
            }

            $data = [
                'data_admin' => $data_admin,
                'page'      => $this->template.'/edit',
                'title'     =>'Cập nhật '.$this->title,
                'template'  => $this->template,
                'datas'     => $datas
            ];
         
            $this->view('masterlayout',$data);
        }


        public function delete($id){  
            $result  = $this-> AdminModels->delete(['id' => $id ]);
            $return = json_decode($result,true);
            if($return['type'] == "SuccessFully"){       
                // header("location:".$this->template."/index");
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Xóa thành công danh mục sản phẩm');
            } 
         }

    }