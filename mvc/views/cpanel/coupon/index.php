<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
?>
<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                            <a href="coupon/add" class="btn btn-primary">Thêm mới</a>
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
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">

        <th class="column-title">Tên mã giảm giá </th>
        <th class="column-title">Mã giảm giá </th>
        <th class="column-title">Giá trị giảm </th>
        <th class="column-title">Số lượng </th>
        <th class="column-title">Tính năng </th>
        <th class="column-title no-link last"><span class="nobr">Action</span></th>
      </tr>
    </thead>

    <?php if(isset($data['data']) && $data['data'] != NULL ){ ?>
          <tbody>
          <?php foreach($data['data'] as $key => $val) {?>
              <tr class="even pointer">
                  <td><?= $val['coupon_name']?></td>
                  <td><?= $val['coupon_code']?></td>
                  <td><?= $val['coupon_number']?></td>
                  <td><?= $val['coupon_time']?></td>
                  <td><?= $val['coupon_condition'] == 1 ?'Giảm theo phần trăm' : 'Giảm theo giá' ?></td>
                 

                  <td >
                
                  <!-- http://localhost/shopping/category/delete/45  phải vào đúng link hàm delete thì mới delete được -->
                  <a href="coupon/delete/<?php echo $val['coupon_id']?>" class="btn btn-danger">Xóa</a>
                  <!-- <button type="submit" name = "delete" class="btn btn-danger">Xóa</button> -->
                  <a href="coupon/edit/<?php echo $val['coupon_id']?>" class="btn btn-success">Sửa</a>
           
                </td>

              </tr>
              

          <?php } ?>

          </tbody>

          <?php } ?>



  </table>
</div>
        
    
</div>
</div>