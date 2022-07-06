
<script src='public/cpanel/ckeditor/ckeditor.js'> </script>
<script src='public/cpanel/ckfinder/ckfinder.js'> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css">
<style>
    img#preview {
    width: 200px;
}

.images_box img{
    width: 100%;
}

</style>
<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $data['title'] ?></h3>
                            <a href="<?= $data['template'].'/index' ?>" class="btn btn-primary">Trở về</a>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                                    <form class="" action="" method="post" novalidate enctype='multipart/form-data' > 
                                       <div class="row">
                                           <div class="col-6">
                                               <div class="form-group">
                                                    <label for="">Danh mục sản phẩm</label>
                                                   <select name="data_post[cateID]" class="form-control"  >
                                                   <option value ="0">Chọn danh mục sản phẩm</option>
                                                        <?php if(isset($data['parent']) && $data['parent'] != NULL) {?>
                                                          
                                                            <?php foreach($data['parent'] as $key => $val){ ?>
                                                                <option value = "<?= $val['id'] ?>" <?= $data['datas']['cateID'] == $val['id'] ? 'selected':''?> ><?= $val['name'] ?></option>
                                                                     <?php if(isset($val['children']) && $val['children'] != NULL) {?>
                                                                         <?php foreach($val['children'] as $key_child => $val_child){ ?>
                                                                            <option value = "<?= $val_child['id'] ?>" <?= $data['datas']['cateID'] == $val_child['id'] ? 'selected':'' ?> >------------<?= $val_child['name'] ?></option>
                                                                         <?php } ?>

                                                                    <?php } ?>

                                                            <?php } ?>   

                                                         <?php } ?>   
                                                   </select>
                                            
                                                </div>

                                               <div class="form-group">
                                                   <label for="name">Tên sản phẩm</label>
                                                   <input onkeyup="removeAccents(this)" id="name" type = "text" class="form-control" name="data_post[name]" value = '<?= $data['datas']['name'] ?>'> 
                                                    <input type="hidden" name="data_post[slug]" id="slug" value = '<?= $data['datas']['slug'] ?>'>
                                                </div>

                                                <div class="form-group">
                                                   <label for="price">Giá</label>
                                                   <input id="price" onkeyup='formatMoney(this)' type = "text" class="form-control" checked name="data_post[price]" value = '<?= number_format($data['datas']['price']) ?>'> 
                                               </div>

                                               <div class="form-group">
                                                   <label for="publish">Hiển thị</label>
                                                   <input id="publish" type = "checkbox" class="" <?= $data['datas']['publish']==1?'checked':'' ?> name="data_post[publish]"> 
                                               </div>

                                            
                                           </div>

                                           <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Ảnh đại điện</label>
                                                <div class="img_box">
                                                    <?php 
                                                        if($data['datas']['image'] != '' && file_exists($data['datas']['image'])){
                                                    ?>
                                                     <img id='preview' src="<?= $data['datas']['image'] ?>" alt="">                       
                                                    <?php }else{?>
                                                     <img id='preview' src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRis-FmrF5lq1jBAEO8tSMrnwGU_yQsfMe8LA&usqp=CAU" alt="">    
                                                     <?php } ?>                   
                                                </div>
                                                <div class="btn_choose">
                                                    <label for="img">Chọn hình ảnh</label>
                                                    <input type= 'file' name='image' id='image' accept='image/png,image/jpeg'>
                                                </div>
                                            </div>
                                           </div>



                                           <div class="form-group">
                                            <label for="">Thuộc tính </label>
                                                <a href="javascript:void(0)" onclick="create()" class="btn btn-primary">Thêm</a>

                                            <div id="multi_properties">

                                                 <?php if(isset($data['arr_properties']) && $data['arr_properties'] != NULL) { ?>
                                                    <?php foreach($data['arr_properties'] as $key => $val ){ ?>
                                                <div class="row item_properties">
                                                    <div class="col-5">
                                                        <label for="">Tên thuộc tính</label>
                                                        <input type="text" class="form-control" value = "<?= $val['name'] ?>" name="data_properties[<?= $key ?>][name]">
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="">Giá trị</label>
                                                        <input type="text" class="form-control" value = "<?= $val['value'] ?>" name="data_properties[<?= $key ?>][value]">
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="">&nbsp;</label>
                                                        <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger d-block">Xóa</a>
                                                    </div>
                                                </div>
                                                    <?php } ?>    
                                                <?php } ?>  
                                            




                                            </div>

                                           </div>

                                           <div class="form-group col-6">
                                                <div  id="mydropzone" class="dropzone">
                                                    <div class="boxID ">
                                                <div class="row">
                                                    <?php if(isset($data['list_photo']) && $data['list_photo'] != NULL) {?>
                                                       <?php foreach($data['list_photo'] as $key => $val) { ?>
                                                            <div class="col-3 text-center box_image">
                                                                <div class="images_box">
                                                                    <img src=" <?= $val['thumb'] ?>" alt="">
                                                                </div>
                                                                <div class="btn">
                                                                    <a href="javascript:void(0)" onclick="delete_photo(this,<?= $val['id'] ?>)" class ="btn btn-danger"><i class="fa fa-trash" > </i></a>
                                                                </div>
                                                            </div>
                                                        <?php }?>   
                                                     <?php }?>   

                                                </div>

                                                    </div>
                                                </div>
                                           </div>



                                           <div class="col-12">
                                                <div class="form-group">
                                                    <label for="publish">Nội dung</label>
                                                    <textarea name="data_post[contents]" class='form-control' id="" cols="30" rows="10">  <?= $data['datas']['contents']?></textarea>
                                                     <script>
                                                        CKEDITOR.replace( 'data_post[contents]', {
                                                            filebrowserBrowseUrl: 'public/cpanel/ckfinder/ckfinder.html',
                                                            filebrowserUploadUrl: 'public/cpanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                            filebrowserWindowWidth: '1000',
                                                            filebrowserWindowHeight: '700'
                                                        } );
                                                     </script>                       
                                                </div>                          
                                           </div>

                                           <div class="col-12 text-left">
                                                <div class="form-group">
                                                   <button name="submit" type="submit" class ="btn btn-primary">Sửa</button>
                                                </div>
                                           </div>
                                       </div>
                                    </form>    
                    </div>
</div>

<script>


function removeAccents(str) {
        let substr = str.value;
        var AccentsMap = [
            "aàảãáạăằẳẵắặâầẩẫấậ",
            "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
            "dđ", "DĐ",
            "eèẻẽéẹêềểễếệ",
            "EÈẺẼÉẸÊỀỂỄẾỆ",
            "iìỉĩíị",
            "IÌỈĨÍỊ",
            "oòỏõóọôồổỗốộơờởỡớợ",
            "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
            "uùủũúụưừửữứự",
            "UÙỦŨÚỤƯỪỬỮỨỰ",
            "yỳỷỹýỵ",
            "YỲỶỸÝỴ",
            " .:/@#<>%^*()",
        ];
        for (var i=0; i<AccentsMap.length; i++) {
            var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
            var char = AccentsMap[i][0];
            substr = substr.replace(re, char);
            substr = substr.replace(/\s/g,'-');
        }
        document.querySelector('#slug').value = substr;
    }

function formatMoney(__this){
    let val = __this.value;
    let num = val.replace(/[^\d.]/g,"");
    let arr = num.split('.');
    let val_num = arr[0];
    let len = val_num.length;
    let result = '';
    let j=0;
    for(let index = len; index >0 ; index--){
        j++;
        if(j % 3 == 1 && j != 1){
            result = val_num.substr(index - 1, 1) + ',' + result;
        }
        else{
            result = val_num.substr(index - 1, 1) + result;
        }
    }

    __this.value = result;
}

let image = document.querySelector('#image');
image.addEventListener('change',(e)=>{
    let input = e.target.files[0];
    if(input){
        let reader = new FileReader();
        reader.onload = function(e){
            document.querySelector('#preview').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input);
    }
    else{
        document.querySelector('#preview').setAttribute('src', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRis-FmrF5lq1jBAEO8tSMrnwGU_yQsfMe8LA&usqp=CAU');
    }
})

function create(){
    let count_items = document.querySelectorAll(".item_properties").length -1;
    count_items++;
    $('#multi_properties').append(`
     <div class="row item_properties">
      <div class="col-5">
    <label for="">Tên thuộc tính</label>
        <input type="text" class="form-control" name="data_properties[${count_items}][name]">
         </div>
         <div class="col-5">
     <label for="">Giá trị</label>
     <input type="text" class="form-control" name="data_properties[${count_items}][value]">
      </div>
     <div class="col-2">
     <label for="">&nbsp;</label>
     <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger d-block">Xóa</a>
      </div>
     </div>
    `);
}

function delete_(__this){
    let count_items = document.querySelectorAll(".item_properties").length -1;
    count_items--;
    $(__this).closest('.item_properties').remove();
}

Dropzone.autoDiscover = false;
let Mydropzone = new Dropzone('#mydropzone',{
    url:"product/uploads",
    acceptedFiles: 'image/*', // chỉ chọn hình ảnh
    addRemoveLinks: true, // Xóa hình ảnh
    init:function(){
        this.on('complete',function(file){
            // console.log(file)
            $('.boxID').append(`<input type="text" name="photoID[]" value="${file.upload.uuid}" >`)
        });
        this.on('removedfile',function(file){
            $.ajax({
                url: "product/deletezone",
                method:"post",
                data: {id:file.upload.uuid}, 
                success : function(response) {
                }
            })
        });
        this.on('sending',function(file, xhr , formData){
            formData.append('uuid', file.upload.uuid)
        });
    }
});

function delete_photo(__this,id){
    $.ajax({
        url:"product/deletePhotoID",
        method:"post",
        data: {id:id}, 
        dataType: "json",
        success : function(response) {
            if(response.type === "SuccessFully"){
                $(__this).closest('.box_image').remove();
            }
            else{

            }
		}
    })

}



</script>