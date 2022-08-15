<?php 
require_once "MyModels.php";
class OrderDetailModels extends MyModels{
    //Ở đây chỉ thừa kế lớp cha và truyền bảng cần thao tác , vì vậy trong MyModels sẽ bỏ đi tham số đầu vào là table , chỉ sử dụng biến $this->table ở đây
    protected $table = 'tbl_order_detail';
}
?>