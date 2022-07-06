<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
?>
<style>
  .view .mask, .view .content {
    position: absolute;
    width: 100%;
    overflow: hidden;
    top: 0;
    left: 0;
    bottom: 0;
}
/* 
.pagination li{
  border: 1px solid #3333;
  padding: 6px;
  
} */
.pagination li a.disabled{
  pointer-events: none;
}

.pagination li a.active{
 color: red;
}
</style>
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
      <div id="LoadTable">
        <?php require_once "./mvc/views/cpanel/product/loadTable.php" ?>
      </div>     

      <!-- <div class="paging">
        <ul class="pagination">
            <?= $data['button_pagination']; ?>
        </ul> 
      </div>      -->

      </div>
        
    
</div>
</div>

<!-- <script>
  window.onload = function(){ 
    let data;
    let page = 1;

  const btn = document.querySelectorAll(".page-link");
  const LoadTable = document.querySelector('#LoadTable');
   for(let i=0;i<btn.length;i++){
    btn[i].onclick = function(e){
      // for (let index = 0; index < btn.length; index++) {
      //   btn[index].classList.remove('active')
      // }
      // e.target.classList.add('active')
      // console.log(btn[i].getAttribute('num-page'));
        page = btn[i].getAttribute('num-page');
        data = {
          page: page
        }
        callback('product/pagination_page' , data)
      }
    }

    function callback(url,data) {
      $.ajax({
        url: url,
        method: "post",
        data: data,
        success : function(response) {
          LoadTable.innerHTML = response;
          // LoadTable.html(response);
          // console.log(response);
        }
      })
    }
   
}
</script> -->