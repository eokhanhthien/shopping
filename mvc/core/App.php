<?php 

class App{
    // 3 biến này tương ứng với 3/ của url lần lượt là $controller/$action/$params
    protected $controller = "home";
    protected $action = "index";
    protected $params = [];


    // Hàm __construct chạy dầu kiểm tra xem có file trong controllers hay không
    function __construct(){
        $array = $this->urlProcess();
        // print_r($array);

        // Khác null tức là tồn tại url thì ta cho  $controller = thư mục tồn tại đó
        if($array != NULL){
            if(file_exists("./mvc/controllers/".$array[0].".php")){
                $this -> controller = $array[0];
                unset($array[0]);
            }else{
                // echo 0;
            }
        }
        

        // Nếu bằng null tức không có url nào, thì ta cho chạy mặc định $controller mặc định ban đầu (lúc nào cũng tồn tại)
        require_once "./mvc/controllers/".$this->controller.".php";
        $this->controller = new $this->controller;

       
       
        if(isset($array[1])){
            if(method_exists($this->controller,$array[1])){
                $this->action = $array[1];
                unset($array[1]);
            }
        }

        $this->params = $array?array_values($array):[];
        call_user_func_array([$this->controller, $this->action],$this->params);
    }


    // Cắt dấu / url thành 1 phần tử trong aray[n] // print_r($array);
    function urlProcess(){
        // echo "<pre>";
        // print_r($_SERVER);die;
        if(isset($_SERVER['PATH_INFO'])){
            return explode("/",filter_var(trim($_SERVER['PATH_INFO'],"/")));
        }
    }
}