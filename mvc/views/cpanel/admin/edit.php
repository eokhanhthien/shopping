<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                            <a href="<?= $data['template'].'/index' ?>" class="btn btn-primary">Trở về</a>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                                    <form class="" action="" method="post" novalidate>
                                       <div class="row">
                                           <div class="col-6">
                                             <div class="form-group">
                                                   <label for="fullname">Họ và tên</label>
                                                   <input id="fullname" type = "text" class="form-control" value='<?= $data['datas']['fullname'] ?>' name="data_post[fullname]"> 
                                                </div>


                                               <div class="form-group">
                                                   <label for="publish">Hiển thị</label>
                                                   <input id="publish" type = "checkbox" class="" <?= $data['datas']['publish'] == 1 ? 'checked' : ''?> name="data_post[publish]"> 
                                               </div>


                                               <div class="form-group">
                                                   <button name="submit" type="submit" class ="btn btn-primary">Cập nhật</button>
                                                   <a href="<?=base_url.$data['template'].'/index' ?>" class ="btn btn-primary">Trở lại</a>
                                               </div>
                                           </div>
                                       </div>
                                    </form>    
                    </div>
</div>

