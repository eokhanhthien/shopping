
<div class="row ">

<?php if(isset($data['product']) && $data['product'] != NULL) {?>
    <?php foreach($data['product'] as $key => $val){ ?>
        <div class="col col-xl-4 product-item">
        <div class="thumbnail-avt-product">
        <a href="home/detail/<?= $val['slug'] ?>"><img src="<?= $val['image'] ?>" alt=""></a> 
        <div class="tab-detail-product">CHI TIẾT</div>
        </div>
        <div class="thumbnail-name-product"><?= $val['name'] ?></div>
        <div class="thumbnail-price-product"><?=number_format( $val['price'] ) ?>đ</div>
        <a href="javascript:void(0)" ><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>
    </div>
<?php } ?>
<?php } ?>

</div>
      <div class="center-pagination">
                <ul class="pagination">
                <?= $data['button_pagination']; ?>
              </ul>  
      </div>


        <script>
  $(document).ready(function(){
    var selected = $('#filterLowHightPrice').val();
    var radio_ele = document.querySelector('input[name="brand"]:checked');
    var radio_ele_price = document.querySelector('input[name="price"]:checked');
		let data;
		let page = 1;
		$('.page-link').click(function(){
			page = $(this).attr('num-page')
			data = {
				page : page,
                orderby : selected,
                cateID : radio_ele.value,
                betweenPrice : radio_ele_price.value,
			}
			callback('home/loadProduct',data);
		})

			function callback(url,data) {
			$.ajax({
				url: url,
				method: "post",
				data: data,
				success : function(response) {
				$('#loadProduct').html(response)
				// LoadTable.html(response);
				// console.log(response);
				}
			})
			}
  }) 
	
</script>