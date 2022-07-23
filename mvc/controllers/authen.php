<?php
require_once "./mvc/core/redirect.php";

// Bình thường auto chạy vào home/index
    class authen extends controller {
    // public $MyModels; => Không cần do thừa kế
        public $UserModels;
        public $JWTOKEN;


        function __construct(){
            $this->UserModels = $this->models('UserModels');
            $this->JWTOKEN = $this->heler('JWTOKEN');

        }

        public function index()  {  
            if(isset($_SESSION['user']) && $_SESSION['user'] != NULL){
                header("location: http://localhost/shopping");
            }
            $this->viewFrontEnd('frontend/user/login',);
        }

        public function login(){
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

            //Tìm xem user có tồn tại trong database
            $checkUni = $this->UserModels->select_row('*',['username' => $username]);
            if(isset($checkUni) && $checkUni != NULL){
                if(password_verify($password,$checkUni['password'])){
                    $array = [
                        'time'      => time() + 3600 *24,
                        'keys'      =>KEY,
                        'info'      =>[
                        'id'        => $checkUni['id'],
                        'logged'    => true  
                        ]
                        
                    ];
                    $jwt = $this->JWTOKEN->CreateToken($array);
                    // $_SESSION['admin'] =  $array;
                    $_SESSION['user'] =  $jwt;
                    
                    // echo "<pre>";
                    // print_r( $checkUni);die;

                    header("location: http://localhost/shopping");
                }
                else{
                    $redirect = new redirect('authen/');
                    $redirect -> setFlash('errors', 'Tài khoản hoặc mật khẩu không đúng');
                }
            }
            else{
                $redirect = new redirect('authen');
                $redirect -> setFlash('errors', 'Tài khoản không tồn tại');
            }
            }
        }

        public function register()  {  
            
            if(isset($_SESSION['user']) && $_SESSION['user'] != NULL){
                header("location: http://localhost/shopping");
            }

            if(isset($_POST['submit'])){
                $data_post = $_POST['data_post'];
                $username = $data_post['username'];
                $password = password_hash($data_post['password'],PASSWORD_BCRYPT );
                $data_post['password'] = $password;
                // print_r($data_post);die;
                $checkUni = $this->UserModels->select_row('*',['username' => $username]);
                if(isset($checkUni) && $checkUni != NULL){
                    $redirect = new redirect();
                    $redirect->setFlash('error', 'Tên tài khoản đã tồn tại');
                }
                else{
                    $result  = $this-> UserModels->add($data_post);
                    $return = json_decode($result,true);
                    if($return['type'] == "SuccessFully"){
                        // header("location:".$this->template."/index");
                        $redirect = new redirect();
                        $redirect->setFlash('successful', 'Tạo tài khoản thành công ');
                    } 
                }

            }

            $this->viewFrontEnd('frontend/user/register',);
        }

        function logout(){
            if(isset($_SESSION['user']) && $_SESSION['user'] != NULL){
                unset($_SESSION['user']);
                header("location: http://localhost/shopping");
            }
        }


      

    }