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
            $datas = $this->OrderModels->select_array('*',NULL,'created_at DESC');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Danh sách đơn hàng',
                'page'      => 'order/index',
                'data'      =>$datas,
            ];
         
            $this->view('masterlayout',$data);
        }

        function unconfirmed(){
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                $redirect = new redirect('auth/index');
            }
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->OrderModels->select_array('*',['order_status' => 1],'created_at DESC');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Đơn chưa xác nhận',
                'page'      => 'order/index',
                'data'      =>$datas,
            ];
         
            $this->view('masterlayout',$data);
        }

        function shipping(){
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                $redirect = new redirect('auth/index');
            }
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->OrderModels->select_array('*',['order_status' => 2],'created_at DESC');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Đơn đang giao',
                'page'      => 'order/index',
                'data'      =>$datas,
            ];
         
            $this->view('masterlayout',$data);
        }

        function delivered(){
            if(!isset($_SESSION['admin']) && $_SESSION['admin'] == NULL){
                $redirect = new redirect('auth/index');
            }
            $data_admin = $this->MyController->getIndexAdmin();
            $datas = $this->OrderModels->select_array('*',['order_status' => 3],'created_at DESC');
            $data = [
                'data_admin' => $data_admin,
                'title'     =>'Đơn đã giao',
                'page'      => 'order/index',
                'data'      =>$datas,
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
          
                    $data = [
                        'data_admin' => $data_admin,
                        'title'     =>'Chi tiết đơn hàng',
                        'page'      => 'order/orderdetail',
                        'data'      =>$datas,
                        'info_customer'  => $info_customer,
                        'order'     => $order,
                    ];
               



         
            $this->view('masterlayout',$data);
        }

        function printorder($shipping_id){
            require_once 'mvc/views/cpanel/order/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();
            $info_customer = $this->ShippingModels->select_row('*',['shipping_id' => $shipping_id]);
            $order = $this->OrderModels->select_row('*',['shipping_id' => $shipping_id]);
            $listproduct = $this->OrderDetailModels->select_array('*',['order_code' => $order['order_code']]); 

            if($info_customer['shipping_method']==1){
                $info_customer['shipping_method'] = 'Thanh toán khi nhận hàng';
            }
            else{
                $info_customer['shipping_method'] = 'Thanh toán chuyển khoản';

            }
            $info_customer['created_at'] = date('d/m/Y' , strtotime($info_customer['created_at']));

            $order_coupon_code = $order['order_coupon_code'];
    
            $output = '';
            $output .= '
            <style>
            table, td, th {
                border: 1px solid;
              }
              
              table {
                width: 100%;
                border-collapse: collapse;
              }
            .text-center{
                text-align: center;
            }
            .mt-20{
                margin: 20px 0 10px 0;
            }
            .order_info_tag{
                font-weight: 600;
            }
            .row{
                line-height: 22px;
            }

            .text-end {
                float:left;

            }
            .text-custom{
                display: inline;
            }
            </style>

            <div class="text-center"><h2>Hóa đơn</h2></div>

            <div class="mt-20" >Thông tin khách hàng</div>
            <div class="order-info ">
                <div class="row">
                    <span class="col order_info_tag">Tên khách hàng:</span>
                    <span class="col">'.$info_customer['shipping_name'] .'</span>
                </div>
                
                <div class="row">
                    <span class="col order_info_tag">Số điện thoại:</span>
                    <span class="col">'.$info_customer['shipping_phone'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Email:</span>
                <span class="col">'.$info_customer['shipping_email'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Tỉnh/thành phố:</span>
                <span class="col">'.$info_customer['shipping_address_city'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Quận/huyện:</span>
                <span class="col">'.$info_customer['shipping_address_province'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Xã/phường/thị trấn:</span>
                <span class="col">'.$info_customer['shipping_address_wards'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Ghi chú:</span>
                <span class="col">'.$info_customer['shipping_notes'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Hình thức thanh toán:</span>
                <span class="col">'.$info_customer['shipping_method'] .'</span>
                </div>

                <div class="row">
                <span class="col order_info_tag">Ngày đặt hàng:</span>
                <span class="col">'.$info_customer['created_at'] .'</span>
                </div>

            </div>

            <div class="mt-20" >Danh sách sản phẩm</div>
            <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">STT </th>
                <th class="column-title">Tên sản phẩm </th>
                <th class="column-title">Giá </th>
                <th class="column-title">Số lượng </th>
            </tr>
            </thead>

            <tbody>';
            $totalMoney=0;
            foreach($listproduct as $key => $val){
                $tamtinh=0;
                $tamtinh=$val['product_price'] * $val['product_quantity'];
                $totalMoney += $tamtinh;

                $output .= '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$val['product_name'].' </td>
                                <td>'.number_format($val['product_price']).'đ</td>
                                <td>'.$val['product_quantity'].' </td>
                            </tr>';
            }


            $output .= ' </tbody>
                        </table>
                        ';

          $output .= '
            <div class="row mt-20">
                <span class="col order_info_tag ">Tổng tiền: </span>
                <span class="col">'.number_format($totalMoney + 20000).'</span>
            </div>

            ';
            $isCoupon = '';
            if($order_coupon_code != 'No'){
                $coupon = $this->CouponModels->select_row('*',['coupon_code' => $order_coupon_code]);  
                if($coupon){
                    if($order['order_coupon_condition'] == 1){
                        $total_coupon = ($totalMoney*$order['order_coupon_number'])/100;
                        $isCoupon .='
                        <div class="row ">
                            <span class="col order_info_tag ">Mã giảm: </span>
                            <span class="col">'.$order['order_coupon_number'].'%</span>
                        </div> 
                        <div class="row ">
                        <span class="col order_info_tag ">Tiền sau giảm: </span>
                        <span class="col">'.number_format(($totalMoney-$total_coupon)+20000).'đ</span>
                        </div> ' ;
                }else{
                    $total_coupon = $order['order_coupon_number'];
                    $isCoupon .='
                    <div class="row ">
                        <span class="col order_info_tag ">Mã giảm: </span>
                        <span class="col">'.$order['order_coupon_number'].'%</span>
                    </div> 
                    <div class="row ">
                    <span class="col order_info_tag ">Tiền sau giảm: </span>
                    <span class="col">'.number_format(($totalMoney-$total_coupon)+20000).'đ</span>
                    </div> ' ;
                }}
                else{
                    $isCoupon = '';
                }
            }

            $output .= ''.$isCoupon.'';

            $output .= '
            
            <span class="text-custom" >Người lập đơn </span>

             ';

            $mpdf->WriteHTML($output);
            $mpdf->Output();
        }

        function confirm_order_admin($order_code){
            $order['order_status'] = 2;
            $order['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
            $this-> OrderModels->update($order , ['order_code' => $order_code]);
            $redirect = new redirect('order');

        }

        function undo_order_admin($order_code){
            $order['order_status'] = 1;
            $order['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
            $this-> OrderModels->update($order , ['order_code' => $order_code]);
            $redirect = new redirect('order');
        }

        function delivered_order_admin($order_code){
            $order['order_status'] = 3;
            $this-> OrderModels->update($order , ['order_code' => $order_code]);
            $redirect = new redirect('order');
        }
        
}