<div class="Content">
    <div class="Content-banner-category">  
      <div class="intrduce-category">
        <div class="introduce-title">Sale Sập Sàn</div>
        <div class="introduce-product">BLACK FRIDAY</div>
        <div class="introduce-title">OFF 20% TOÀN BỘ CỬA HÀNG</div>
      </div>
    </div>

    <div class="Container-app mt-60"> 
        <div class="row mb-40">
            <div class="col col-xl-3">
                <div class="tag-category-product">ĐIỆN THOẠI</div>
            </div>
            <div class="col col-xl-9">
                <div class="row g-0 sort-select-container"> 
                    <div class="col col-xl-4">Hiển thị của 1 - 6 của 12 kết quả</div>
                 
                    <div class="col col-xl-3 custom-select-sort">
                        <select class="">
                            <option>Mặc định</option>
                            <option>Giá thấp đến cao</option>
                            <option>Giá cao đến thấp</option>
                        </select>
                    </div>

                </div>
            
            </div>
        </div>
        <div class="row">
            <div class="col col-xl-3">
                <div class="tag-category-product">Lọc theo:</div>
                <div class="filter-tag-container">
                    <div class="filter-tag"><i class="fas fa-caret-down"></i> Giá</div>               
                </div>
                <div class="filter-option-container">
                        <div class="filter-option"><input type="radio" name="filter['price']" id=""> Dưới 5 triệu</div>
                        <div class="filter-option"><input type="radio" name="filter['price']" id=""> Từ 5 - 10 triệu </div> 
                        <div class="filter-option"><input type="radio" name="filter['price']" id=""> Từ 10 - 15 triệu </div> 
                        <div class="filter-option"><input type="radio" name="filter['price']" id=""> trên 15 triệu </div> 
                </div>

                
                <div class="filter-tag-container border-filter">
                    <div class="filter-tag"><i class="fas fa-caret-down"></i> Hãng</div>
                </div>
                <div class="filter-option-container">
                        <div class="filter-option"><input type="radio" name="filter['hang']" id=""> Dưới 5 triệu</div>
                        <div class="filter-option"><input type="radio" name="filter['hang']" id=""> Từ 5 - 10 triệu </div> 
                        <div class="filter-option"><input type="radio" name="filter['hang']" id=""> Từ 10 - 15 triệu </div> 
                        <div class="filter-option"><input type="radio" name="filter['hang']" id=""> trên 15 triệu </div> 
                </div>

            </div>
            <div class="col col-xl-9">
                <div class="row g-0">
                    <div class="col col-xl-4 product-item">
                        <div class="thumbnail-avt-product">
                        <a href="home/detail/"><img src="https://cdn2.cellphones.com.vn/358x/media/catalog/product/i/p/ip13-pro_2.jpg" alt=""></a> 
                        <div class="tab-detail-product">CHI TIẾT</div>
                        </div>
                        <div class="thumbnail-name-product">iphone 13</div>
                        <div class="thumbnail-price-product">22.000.000đ</div>
                        <a href="javascript:void(0)" ><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>
                    </div>
                   
                    <div class="col col-xl-4 product-item">
                        <div class="thumbnail-avt-product">
                        <a href="home/detail/"><img src="https://cdn2.cellphones.com.vn/358x/media/catalog/product/i/p/ip13-pro_2.jpg" alt=""></a> 
                        <div class="tab-detail-product">CHI TIẾT</div>
                        </div>
                        <div class="thumbnail-name-product">iphone 13</div>
                        <div class="thumbnail-price-product">22.000.000đ</div>
                        <a href="javascript:void(0)" ><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>
                    </div>

                    <div class="col col-xl-4 product-item">
                        <div class="thumbnail-avt-product">
                        <a href="home/detail/"><img src="https://cdn2.cellphones.com.vn/358x/media/catalog/product/i/p/ip13-pro_2.jpg" alt=""></a> 
                        <div class="tab-detail-product">CHI TIẾT</div>
                        </div>
                        <div class="thumbnail-name-product">iphone 13</div>
                        <div class="thumbnail-price-product">22.000.000đ</div>
                        <a href="javascript:void(0)" ><button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button></a>
                    </div>

                </div>

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
   
</script>