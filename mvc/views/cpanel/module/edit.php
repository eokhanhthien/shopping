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
                                                    <label for="">Danh mục cha</label>
                                                   <select name="data_post[parentID]" class="form-control"  >
                                                        <option value ="0">Chọn danh mục cha</option>
                                                        <?php if(isset($data['parent']) && $data['parent'] != NULL) {?>
                                                          
                                                            <?php foreach($data['parent'] as $key => $val){ ?>
                                                                <option <?= $data['datas']['parentID'] == $val['id']?'selected' : '' ?> value = "<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                                            <?php } ?>   

                                                         <?php } ?>   
                                                   </select>
                                            
                                                </div>

                                               <div class="form-group">
                                                   <label for="name">Tên module</label>
                                                   <input id="name" value = '<?= $data['datas']['name'] ?>' type = "text" class="form-control" name="data_post[name]"> 
                                                </div>

                                                <div class="form-group">
                                                   <label for="link">Liên kết</label>
                                                   <input id="link" value = '<?= $data['datas']['link'] ?>' type = "text" class="form-control" name="data_post[link]"> 
                                                </div>

                                                <div class="form-group">
                                                   <label for="controller">Controller</label>
                                                   <input id="controller" value = '<?= $data['datas']['controller'] ?>' type = "text" class="form-control" name="data_post[controller]"> 
                                                </div>

                                                <div class="form-group">
                                                   <label for="icon">Icon</label>
                                                   <input id="icon" value = '<?= $data['datas']['icon'] ?>' type = "text" class="form-control" name="data_post[icon]"> 
                                                </div>

                                               <div class="form-group">
                                                   <label for="publish">Hiển thị</label>
                                                   <input id="publish" <?= $data['datas']['publish'] == 1? 'checked' : '' ?>  type = "checkbox" class="" name="data_post[publish]"> 
                                               </div>

                                               <div class="form-group">
                                                   <button name="submit" type="submit" class ="btn btn-primary">Cập nhật</button>
                                               </div>
                                           </div>
                                       </div>
                                    </form>    
                    </div>
</div>

