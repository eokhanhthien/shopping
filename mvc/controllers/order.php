<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
    class order extends controller {
        public $MyController;
        public $OrderModels;
        public $OrderDetailModels;
        public $ShippingModels;
        public $CouponModels;

        function __construct(){
            $this->MyController  = new MyController();
            $this->OrderModels    = $this->models('OrderModels');
            $this->OrderDetailModels    = $this->models('OrderDetailModels');
            $this->ShippingModels    = $this->models('ShippingModels');
            $this->CouponModels    = $this->models('CouponModels');

        }

        function index(){
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                // $id_user=$_SESSION['admin']['id'];
                // $data_info_admin = $this->AdminModels->select_row('*',['id' => $id_user]);
                $redirect = new redirect('auth/index');

            }
            $data_admin = $this->MyController->getIndexAdmin();
            $data = $this->OrderModels->select_array('*',NULL,'created_at DESC');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Danh sách đơn hàng',
                'page'      => 'order/index',
                'data'      =>$data,
            ];
         
            $this->view('masterlayout',$data);
        }

        function vieworder($order_code , $shipping_id){
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->OrderDetailModels->select_array('*',['order_code' => $order_code]); 
            $info_customer = $this->ShippingModels->select_row('*',['shipping_id' => $shipping_id]);

            // xem đơn hàng có mả giảm giá không
            $order = $this->OrderModels->select_row('*',['shipping_id' => $shipping_id]);
            $order_coupon_code = $order['order_coupon_code'];
            if($order_coupon_code != 'No'){
                $coupon = $this->CouponModels->select_row('*',['coupon_code' => $order_coupon_code]);  
                if($coupon){
                    $data = [
                        'data_admin' => $data_admin,
                        'title'     =>'Chi tiết đơn hàng',
                        'page'      => 'order/orderdetail',
                        'data'      =>$datas,
                        'info_customer'  => $info_customer,
                        'order'     => $order,
                    ];
                }
                else{
                    $data = [
                        'data_admin' => $data_admin,
                        'title'     =>'Chi tiết đơn hàng',
                        'page'      => 'order/orderdetail',
                        'data'      =>$datas,
                        'info_customer'  => $info_customer,
                    ];
                }
            }else{
                $data = [
                    'data_admin' => $data_admin,
                    'title'     =>'Chi tiết đơn hàng',
                    'page'      => 'order/orderdetail',
                    'data'      =>$datas,
                    'info_customer'  => $info_customer,
                ];
            }



         
            $this->view('masterlayout',$data);
        }

}