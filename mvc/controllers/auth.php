<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class auth extends controller{
    public $AdminModels;
    public $MyController;
    public $JWTOKEN;


    function __construct(){
        $this->AdminModels = $this->models('AdminModels');
        $this->MyController = new MyController();

        $this->JWTOKEN = $this->heler('JWTOKEN');

    }

    

    function index(){
        $this->view('login',[]);
    }

    function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Tìm xem user có tồn tại trong database
            $checkUni = $this->AdminModels->select_row('*',['username' => $username]);
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
                    $_SESSION['admin'] =  $jwt;
                    $redirect = new redirect('dashboard/index');
                }
                else{
                    $redirect = new redirect('auth/index');
                    $redirect -> setFlash('errors', 'Tài khoản hoặc mật khẩu không đúng');
                }
            }
            else{
                $redirect = new redirect('auth/index');
                $redirect -> setFlash('errors', 'Tài khoản không tồn tại');
            }
        }
    }


    function logout(){
        if(isset($_SESSION['admin']) && $_SESSION['admin'] != NULL){
            unset($_SESSION['admin']);
            $redirect = new redirect('auth/index');
        }
        else{
            $redirect = new redirect('auth/index');

        }
    }
}