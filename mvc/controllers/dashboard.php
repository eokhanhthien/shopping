<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class dashboard extends controller{
    public $AdminModels;
    public $MyController;
    var $template = 'dashboard';
    function __construct(){
        $this->AdminModels = $this->models('AdminModels');
        $this->MyController = new MyController();
    }

    function index(){
        $data_admin = $this->MyController->getIndexAdmin();
        $data = [
            'data_admin' => $data_admin,
            'page'      => $this->template.'/index',
            'template'  => $this->template,
        ];
        $this->view('masterlayout',$data);
    }
}