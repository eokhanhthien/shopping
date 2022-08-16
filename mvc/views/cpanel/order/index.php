<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
?>
<style>
    .img-symbon{
    width: 34px;
    margin: 0 0px 0 10px;
}
</style>
<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                          
                        </div>


                    </div>
<div class="clearfix"></div>
    <div class="row">
      <div class="col-12">
          <?php 
            if(isset($_SESSION['flash'])) {
          ?>
            <h3 class="text-success"> <?= $redirect->setFlash('flash'); ?> </h3>
          <?php }?>

          <?php 
            if(isset($_SESSION['errors'])) {
          ?>
            <h3 class="text-danger"> <?= $redirect->setFlash('errors'); ?> </h3>
          <?php }?>


      </div>
    </div>
<div class="x_content">


<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action text-center">
    <thead>
      <tr class="headings">

        <th class="column-title">STT </th>
        <th class="column-title">Mã đơn hàng </th>
        <th class="column-title">Tình trạng đơn </th>
        <th class="column-title no-link last"><span class="nobr">Action</span></th>
      </tr>
    </thead>

    <?php if(isset($data['data']) && $data['data'] != NULL ){ ?>
          <tbody>
          <?php foreach($data['data'] as $key => $val) {?>
              <tr class="even pointer">
                  <td><?= $key+1 ?></td>
                  <td><?= $val['order_code']?></td>
                  <td><?= $val['order_status']==1 ? 'Đơn mới <img class="img-symbon" src="mvc/views/frontend/images/new.png" alt="">' : 'Đã xử lý'  ?></td>
                 
                  <td >
                
                  <!-- http://localhost/shopping/category/delete/45  phải vào đúng link hàm delete thì mới delete được -->
                  <a href="order/vieworder/<?php echo $val['order_code']?>/<?php echo $val['shipping_id']?>" class="btn btn-success">Xem chi tiết đơn</a>
                  <a href="order/delete/<?php echo $val['order_code']?>" class="btn btn-danger">Xóa</a>
                  <!-- <button type="submit" name = "delete" class="btn btn-danger">Xóa</button> -->
                </td>

              </tr>
              

          <?php } ?>

          </tbody>

          <?php } ?>



  </table>
</div>
        
    
</div>
</div>