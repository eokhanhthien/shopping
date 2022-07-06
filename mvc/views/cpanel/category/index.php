<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
?>
<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                            <a href="<?= $data['template'].'/add' ?>" class="btn btn-primary">Thêm mới</a>
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
        <th>
          <input type="checkbox" id="check-all" class="flat">
        </th>
        <th class="column-title">Tên danh mục </th>
        <th class="column-title">Hiển thị </th>
        <th class="column-title">Ngày tạo </th>
        <th class="column-title no-link last"><span class="nobr">Action</span>
        </th>
        <th class="bulk-actions" colspan="7">
          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
        </th>
      </tr>
    </thead>


    <?php if(isset($data['datas']) && isset($data['datas']) != NULL ){ ?>
    <tbody>
     <?php foreach($data['datas'] as $key => $val) {?>
        <tr class="even pointer">
        <td class = ""> <input type= "checkbox" value = "<?= $val['id'] ?>"> </td>
        <td class = ""> <?= $val['name'] ?></td>
        <td class = ""> <input type="checkbox" <?= $val['publish'] == 1 ?'checked' : '' ?>> </td>
        <td class = ""><?= date('d/m/Y' , strtotime($val['created_at'])) ?></td>
        <td >
            <a onClick="delete(<?php echo $val['id']?>)" href="<?= $data['template'].'/delete/'?><?php echo$val['id']?>" class="btn btn-danger">Xóa</a>
            <a href="<?= base_url.$data['template'].'/'.'edit/'.$val['id'] ?>" class="btn btn-success">Sửa</a>
        </td>

        </tr>
        <?php if(isset($val['children']) && $val['children'] != NULL){ ?>
          <?php foreach($val['children'] as $key_child => $val_child){ ?>
          <tr class="even pointer">
                <td class = ""> <input type= "checkbox"  name="product_id" value="<?= $val_child['id']?>"> </td>
                <td class = "">---------- <?= $val_child['name'] ?></td>
                <td class = ""><input type="checkbox" <?= $val_child['publish'] == 1 ?'checked' : '' ?>></td>
                <td class = ""><?= date('d/m/Y' , strtotime($val_child['created_at'])) ?></td>
                <td >
                
                <!-- http://localhost/shopping/category/delete/45  phải vào đúng link hàm delete thì mới delete được -->
                  <a onClick="delete(<?php echo $val_child['id']?>)" href="<?= $data['template'].'/delete/'?><?php echo $val_child['id']?>" class="btn btn-danger">Xóa</a>
                  <!-- <button type="submit" name = "delete" class="btn btn-danger">Xóa</button> -->
                  <a href="<?= base_url.$data['template'].'/'.'edit/'.$val_child['id'] ?>" class="btn btn-success">Sửa</a>
           
                </td>
           </tr>
          <?php } ?>

        <?php } ?>

    <?php } ?>

    </tbody>

    <?php } ?>
  </table>
</div>
        
    
</div>
</div>