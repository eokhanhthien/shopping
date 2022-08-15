<?php
require_once "./mvc/controllers/MyController.php";
require_once "./mvc/core/redirect.php";

// Bình thường auto chạy vào home/index
    class coupon extends controller {
        public $MyController;
        public $CouponModels;

        function __construct(){
            $this->MyController  = new MyController();
            $this->CouponModels    = $this->models('CouponModels');

        }

        function index(){
            $data_admin = $this->MyController->getIndexAdmin();
            $data = $this->CouponModels->select_array('*');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Danh sách mã giảm giá',
                'page'      => 'coupon/index',
                'data'      =>$data,
            ];
         
            $this->view('masterlayout',$data);
        }

        function add(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data_coupon = $_POST['data_coupon'];
                $result  = $this-> CouponModels->add($data_coupon);
                $return = json_decode($result,true);

                if($return['type'] == "SuccessFully"){
                    $redirect = new redirect('coupon/index');
                    $redirect->setFlash('flash', 'Thêm thành công mã giảm giá');
                }
            }

            $data_admin = $this->MyController->getIndexAdmin();
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Thêm mã giảm giá',
                'page'      => 'coupon/add',
            ];
         
            $this->view('masterlayout',$data);
        }

        public function edit($id){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
                $data_coupon = $_POST['data_coupon'];
                $result  = $this-> CouponModels->update($data_coupon , ['coupon_id' => $id]);
                $return = json_decode($result,true);

                if($return['type'] == "SuccessFully"){
                    $redirect = new redirect('coupon/index');
                    $redirect->setFlash('flash', 'Cập nhật thành công mã giảm giá');
                }
            }

            $datas = $this->CouponModels->select_row('*',['coupon_id' => $id]);
            $data_admin = $this->MyController->getIndexAdmin();

            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Sửa mã giảm giá',
                'page'      => 'coupon/edit',
                'datas'      =>  $datas,
            ];
            $this->view('masterlayout',$data);

        }
        public function delete($id){  
            $result  = $this-> CouponModels->delete(['coupon_id' => $id ]);
            $return = json_decode($result,true);
            if($return['type'] == "SuccessFully"){
                // header("location:".$this->template."/index");
                $redirect = new redirect('coupon/index');
                $redirect->setFlash('flash', 'Xóa thành công mã giảm giá');
            } 
        }

        function check_coupon(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $coupon = $this->CouponModels->select_row('*',['coupon_code' => $_POST['coupon']]);
              if($coupon){ 
                $arr =[
                    'coupon_code' => $coupon['coupon_code'],
                    'coupon_condition' => $coupon['coupon_condition'],
                    'coupon_number' => $coupon['coupon_number'],
                ];
                $_SESSION['coupon'] = $arr;
                $redirect = new redirect('home/cart');
                $redirect->setFlash('flash', 'Thêm thành công mã giảm giá');
            }
            else{
                unset($_SESSION['coupon']);
                $redirect = new redirect('home/cart');
                $redirect->setFlash('errors', 'Mã giảm giá không đúng');
            }

            }
        }

        function cancel_coupon(){
                unset($_SESSION['coupon']);
                $redirect = new redirect('home/cart');
                $redirect->setFlash('flash', 'Hủy mã giảm giá thành công');
        }
    }