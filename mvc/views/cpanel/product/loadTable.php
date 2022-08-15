<table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">
              <th>
                <input type="checkbox" id="check-all" class="flat">
              </th>
              <th class="column-title">Tên sản phẩm </th>
              <th class="column-title">Danh mục </th>
              <th class="column-title">Hình ảnh </th>
              <th class="column-title">Giá </th>
              <th class="column-title">Hiển thị </th>
              <th class="column-title">Ngày tạo </th>
              <th class="column-title no-link last"><span class="nobr">Action</span></th>

            </tr>
          </thead>


          <?php if(isset($data['datas']) && $data['datas'] != NULL ){ ?>
          <tbody>
          <?php foreach($data['datas'] as $key => $val) {?>
              <tr class="even pointer">
                  <td><input type= "checkbox" value = "<?= $val['id'] ?>"></td>
                  <td><?= $val['name']?></td>
                  <td><?= $val['name_cate']?></td>
                  <td><img src="<?= $val['image']?>" height='100' alt=""> </td>
                  <td><?= number_format($val['price'])?></td>
                  <td class = ""><input type="checkbox" <?= $val['publish'] == 1 ?'checked' : '' ?>></td>
                  <td class = ""><?= date('d/m/Y' , strtotime($val['created_at'])) ?></td>

                  <td >
                
                  <!-- http://localhost/shopping/category/delete/45  phải vào đúng link hàm delete thì mới delete được -->
                  <a onClick="delete(<?php echo $val['id']?>)" href="<?= $data['template'].'/delete/'?><?php echo $val['id']?>" class="btn btn-danger">Xóa</a>
                  <!-- <button type="submit" name = "delete" class="btn btn-danger">Xóa</button> -->
                  <a href="<?= base_url.$data['template'].'/'.'edit/'.$val['id'] ?>" class="btn btn-success">Sửa</a>
           
                </td>

              </tr>
              

          <?php } ?>

          </tbody>

          <?php } ?>
        </table>

      <ul class="pagination">
          <?= $data['button_pagination']; ?>
      </ul>             
              
       


<!-- <script>
    const Start = () =>{
      let data;
      let page = 1;
      const btn = document.querySelectorAll(".page-link");
      // const LoadTable = document.querySelector('#LoadTable');
        for(let i=0;i<btn.length;i++){
        btn[i].onclick = function(){
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
              $('#LoadTable').html(response);
            }
          })
        }
    }
  window.onload = Start;
  setTimeout(() => {
    Start()
  }, 100);
  
</script> -->

<script>
  $(document).ready(function(){
		let data;
		let page = 1;
		$('.page-link').click(function(){
			page = $(this).attr('num-page')
			data = {
				page : page
			}
			callback('product/pagination_page',data);
		})

			function callback(url,data) {
			$.ajax({
				url: url,
				method: "post",
				data: data,
				success : function(response) {
				$('#LoadTable').html(response)
				// LoadTable.html(response);
				// console.log(response);
				}
			})
			}
  }) 
	
    
   

</script>