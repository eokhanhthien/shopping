<?php
require_once "./mvc/core/redirect.php";
// Bình thường auto chạy vào home/index
    class payment extends controller {
        function __construct(){
            $this->CityModels = $this->models('CityModels');
            $this->ProvinceModels = $this->models('ProvinceModels');
            $this->WardsModels = $this->models('WardsModels');
            $this->ShippingModels = $this->models('ShippingModels');
            $this->OrderModels = $this->models('OrderModels');
            $this->OrderDetailModels = $this->models('OrderDetailModels');
            

        }
        public function index()  { 
            $city = $this->CityModels->select_array('*');
            // echo "<pre>";
            // print_r($city);die;

                $data = [
                    'page'      => 'home/payment',
                    'city'      => $city,
                ];
                $this->viewFrontEnd('frontend/masterlayout',$data);        
        }

        function confirm_order(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data_payment = $_POST['data_payment'];
                $data_payment['created_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                $data_payment['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
                $result  = $this-> ShippingModels->add($data_payment);
                $return = json_decode($result,true);
         

                $checkout_code = substr(md5(microtime()),rand(0,26),5);
                $order['customer_id'] = $_SESSION['user-info']['info']['id'];
                $order['shipping_id'] = $return['id'];
                $order['order_status'] = 1;
                $order['order_code'] = $checkout_code;
                $order['order_coupon_code'] = isset($_SESSION['coupon']['coupon_code']) ? $_SESSION['coupon']['coupon_code'] :'No';
                $order['order_coupon_condition'] = isset($_SESSION['coupon']['coupon_condition']) ? $_SESSION['coupon']['coupon_condition'] :0;
                $order['order_coupon_number'] = isset($_SESSION['coupon']['coupon_number']) ? $_SESSION['coupon']['coupon_number'] :0;
                $order['created_at'] = $data_payment['created_at'];
                $order['updated_at'] = $data_payment['updated_at'];
                $this-> OrderModels->add($order);

                if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
                    foreach($_SESSION['cart'] as $key => $val){
                        $order_detail['order_code'] = $checkout_code;
                        $order_detail['product_id'] = $val['id'];
                        $order_detail['product_name'] = $val['name'];
                        $order_detail['product_price'] = $val['price'];
                        $order_detail['product_image'] = $val['image'];
                        $order_detail['product_quantity'] = $val['qty'];
                        $this-> OrderDetailModels->add($order_detail);
                    }
                }

                if($return['type'] == "SuccessFully"){
                    // header("location:".$this->template."/index");
                    $redirect = new redirect('/payment');
                    $redirect->setFlash('flash', 'Đặt hàng thành công, đơn hàng của bạn đang được xử lý');
                }
            }
        }

        function getAddress(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $output = '';
                if($_POST['action'] == 'city'){
                    $select_province = $this->ProvinceModels->select_array('*',['matp' => $_POST['matp']] );
                    $output = '<option value="" >Chọn quận / huyện</option>';
                    foreach($select_province as $key => $val){
                        $output .=  '<option value="'.$val['name_quanhuyen'].'" data-city="'.$val['maqh'].'" >'. $val['name_quanhuyen'] .'</option>';
                    }
                    
                }
                else{
                    $select_wards = $this->WardsModels->select_array('*',['maqh' => $_POST['matp']] );
                    $output = '<option value="" >Chọn xã phường / thị trấn</option>';
                    foreach($select_wards as $key => $val){
                        $output .=  '<option value= "'.$val['name_xaphuong'].'" >'. $val['name_xaphuong'] .'</option>';
                    }
                }
                echo $output;
            }

        }
    }