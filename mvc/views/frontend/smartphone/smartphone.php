<script src="mvc/views/frontend/bootstrap/jquery/dist/jquery.min.js"></script>
<div class="Content">
    <div class="Content-banner-category">  
      <div class="intrduce-category">
        <div class="introduce-title">Sale Sập Sàn</div>
        <div class="introduce-product">BLACK FRIDAY</div>
        <div class="introduce-title">OFF 20% TOÀN BỘ CỬA HÀNG</div>
      </div>
    </div>

    <div class="Container-app mt-60"> 
        <div class="row mb-60">
            <div class="col col-xl-3">
                <div class="tag-category-product">ĐIỆN THOẠI</div>
            </div>
            <div class="col col-xl-9">
                <div class="row g-0 sort-select-container"> 
                    <!-- <div class="col col-xl-4">Hiển thị của 1 - 6 của 12 kết quả</div> -->
                 
                    <div class="col col-xl-3 custom-select-sort">
                        <select class="" id="filterLowHightPrice">
                            <option value =""  >Mặc định</option>
                            <option value ="ASC">Giá thấp đến cao</option>
                            <option value ="DESC">Giá cao đến thấp</option>
                        </select>
                    </div>

                </div>
            
            </div>
        </div>
        <div class="row">
            <div class="col col-xl-3">
                <div class="tag-category-product"><i class="fas fa-filter"></i> Lọc theo:</div>
                <div class="filter-tag-container">
                    <div class="filter-tag"><i class="fas fa-caret-down"></i> Giá</div>               
                </div>
                <div class="filter-option-container" id="filter_between_price">
                        <div class="filter-option"><input type="radio" name="price" value=" and price > 0"id="" checked> Tất cả</div>
                        <div class="filter-option"><input type="radio" name="price" value=" and price BETWEEN 0 AND 5000000" id="" > Dưới 5 triệu</div>
                        <div class="filter-option"><input type="radio" name="price" value=" and price BETWEEN 5000000 AND 10000000" id=""> Từ 5 - 10 triệu </div> 
                        <div class="filter-option"><input type="radio" name="price" value=" and price BETWEEN 10000000 AND 15000000" id=""> Từ 10 - 15 triệu </div> 
                        <div class="filter-option"><input type="radio" name="price" value=" and price > 15000000" id=""> trên 15 triệu </div> 
                </div>

                
                <div class="filter-tag-container border-filter">
                    <div class="filter-tag"><i class="fas fa-caret-down"></i> Hãng</div>
                </div>
                <div class="filter-option-container" id="filter_brand">
                    <div class="filter-option"><input type="radio" value="ALL" name="brand" id="" checked> Tất cả</div>

                    <?php if(isset($data['brand']) && $data['brand'] != NULL) {?>
                        <?php foreach($data['brand'] as $key => $val){ ?>
                        <div class="filter-option"><input type="radio" value="<?= $val['id'] ?>" name="brand" id=""> <?= $val['name'] ?></div>
                    <?php }?> 
                    <?php }?> 
                </div>

            </div>
            <div id="loadProduct" class="col col-xl-9">
                <?php require_once "mvc/views/frontend/smartphone/loadProduct.php" ?>

            </div>
        </div>
    </div>


</div>

<script>
    const filter_tag_container = document.querySelectorAll(".filter-tag-container");
    const filter_option_container = document.querySelectorAll(".filter-option-container");
    for(let i=0 ; i<filter_tag_container.length ; i++){
         filter_tag_container[i].onclick = () =>{
            filter_option_container[i].classList.toggle('filter-active');
        }
    }

    const filter_brand = document.querySelector("#filter_brand");
    filter_brand.onchange = ()=>{   
        var selected = $('#filterLowHightPrice').val();       
        var radio_ele = document.querySelector('input[name="brand"]:checked');
        var radio_ele_price = document.querySelector('input[name="price"]:checked');

        // console.log(radio_ele_price.value , radio_ele.value , selected)
        $.ajax({
            url:"smartphone/loadProduct",
            method:"post",
            data: {
                cateID : radio_ele.value,
                orderby : selected,
                betweenPrice : radio_ele_price.value,

            }, 
            success : function(response) { 
                $('#loadProduct').html(response);

            }
        })
    }

    const filter_between_price = document.querySelector("#filter_between_price");
    filter_between_price.onchange = ()=>{   
        var selected = $('#filterLowHightPrice').val();
        var radio_ele = document.querySelector('input[name="brand"]:checked');
        var radio_ele_price = document.querySelector('input[name="price"]:checked');
        console.log(radio_ele_price.value , radio_ele.value , selected)
        $.ajax({
            url:"smartphone/loadProduct",
            method:"post",
            data: {             
                orderby : selected,
                cateID : radio_ele.value,
                betweenPrice : radio_ele_price.value,
            }, 
            success : function(response) { 
                $('#loadProduct').html(response);

            }
        })
    }
   

</script>

<script>
$(document).ready(function () {
$("#filterLowHightPrice").change(function() {
    var selected = $('#filterLowHightPrice').val();
    var radio_ele = document.querySelector('input[name="brand"]:checked');
    var radio_ele_price = document.querySelector('input[name="price"]:checked');

    $.ajax({
    url:"smartphone/loadProduct",
    method:"post",
    data: {
        orderby : selected,
        cateID : radio_ele.value,
        betweenPrice : radio_ele_price.value,

    }, 
    success : function(response) { 
        $('#loadProduct').html(response);

    }
})
});
});

</script>

