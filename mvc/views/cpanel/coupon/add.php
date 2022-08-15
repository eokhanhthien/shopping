<style>
.label-ct {
    margin: 10px 0 0px 0 !important;
    color: #333;
}
.coupon-select-condition{
    padding: 5px 10px;
    margin: 10px 0;
    outline: none;
    border: 1px solid #ccc;
}
.button-custom{
    margin: 10px 0;

}
</style>
<div class="page-title-coupon">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                            <a href="coupon" class="btn btn-primary">Trở về</a>
                        </div>
</div>
                        <form action='coupon/add' method="post">
                            <div class="row">

                                        <div class="form-group col-6">         
                                                    <div class="col-5">
                                                        <label class="label-ct" for="">Tên mã giảm giá</label>
                                                        <input type="text" class="form-control"  name="data_coupon[coupon_name]">
                                                    </div>

                                                    <div class="col-5">
                                                        <label class="label-ct" for="">Mã giảm giá</label>
                                                        <input type="text" class="form-control"  name="data_coupon[coupon_code]">
                                                    </div>
                                                    <div class="col-5">
                                                        <label class="label-ct" for="">Số lượng mã</label>
                                                        <input type="text" class="form-control"  name="data_coupon[coupon_time]">
                                                    </div>

                                                    <div class="col-5">
                                                        <label class="label-ct" for="">Tính năng mã</label>
                                                        <!-- <input type="text" class="form-control"  name="data_coupon[demand]"> -->
                                                        <select class="coupon-select-condition" name="data_coupon[coupon_condition]" id="">
                                                            <option value="">Chọn tính năng</option>
                                                            <option value="1">Giảm theo phần trăm</option>
                                                            <option value="2">Giảm theo giá</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-5">
                                                        <label class="label-ct" for="">Số phần trăm hoặc tiền giảm</label>
                                                        <input type="text" class="form-control"  name="data_coupon[coupon_number]">
                                                    </div>
                                                    <button type ="submit" name="submit" class="btn btn-primary button-custom">Thêm</button>
                                                 
                                        </div>

                            </div>        
                        </form> 