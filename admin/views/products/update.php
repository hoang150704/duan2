 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <?php
        require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php';
        ?>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-12">
                     <!-- general form elements -->
                     <div class="card card-primay">
                         <div class="card-header">
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=product' ?>">
                                 <h3 class="card-title">Back to list</h3>
                             </a>
                         </div>
                         <?php if (isset($_SESSION['success'])) : ?>
                             <div class="d-flex align-items-center alert alert-success">

                                 <i class="fas fa-check-circle"></i>
                                 <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>

                             </div>
                             <?php unset($_SESSION['success']) ?>
                         <?php endif ?>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <?php if (isset($_SESSION['errors'])) : ?>
                                     <div class="alert alert-danger">
                                         <ul>
                                             <?php
                                                foreach ($_SESSION['errors'] as $error) : ?>
                                                 <li><?= $error ?></li>
                                             <?php endforeach ?>

                                         </ul>
                                     </div>
                                     <?php unset($_SESSION['errors']) ?>
                                 <?php endif ?>

                                 <div class="row">
                                     <div class="col-9">
                                         <div class="form-group">

                                             <input type="text" class="form-control" id="exampleInputproduct_name1" placeholder="Tên sản phẩm" name="product_name" value="<?= $product['product_name'] ?>">
                                             <span></span>
                                         </div>
                                         <div class="">
                                             <label for="content" class="form-label">Mô tả</label>
                                             <textarea name="des" id="content"><?= $product['des'] ?></textarea>
                                             <span></span>
                                         </div>
                                         <div id="product_no_variant" style="display: block;">
                                             <div class="form-group">
                                                 <label for="price">Giá thường</label>
                                                 <input type="number" class="form-control" id="price" placeholder="Giá sản phẩm" name="price" value="<?= $product['price'] ?>">
                                                 <span></span>
                                             </div>
                                             <div class="form-group">
                                                 <label for="sale_price">Giá ưu đãi</label>
                                                 <input type="number" class="form-control" id="sale_price" placeholder="Giá ưu đãi" name="sale_price" value="<?= $product['sale_price'] ?>">
                                                 <span></span>
                                             </div>
                                             <div class="form-group">
                                                 <label for="quantity">Số lượng</label>
                                                 <input type="number" class="form-control" id="quantity" placeholder="Số lượng sản phẩm" name="quantity" value="<?= $product['quantity'] ?>">
                                                 <span></span>
                                             </div>
                                             <!-- <div class="form-group row" id="class-variant">
                                                 <div class="col-3">
                                                     <label for="">Tên thuộc tính</label>
                                                     <input type="text" id="form-control" placeholder="Nhập tên thuộc tính">
                                                 </div>
                                                 <div class="col-1"></div>
                                                 <div class="col-8" id="group">
                                                     <label for="">Giá trị thuộc tính</label>
                                                     <div class="variant_input">
                                                         <ul>
                                                             <input type="text" id="inputVariant" class="" placeholder="">
                                                         </ul>
                                                     </div>
                                                 </div>
                                             </div> -->
                                         </div>
                                         <div id="product_variant" style="display: none;">
                                             <div class="form-group">
                                                 <label for="exampleInputcategory_id1">Thuộc tính</label>
                                                 <select name="attribute_id" id="attributes" class="form-control" multiple>
                                                     <?php foreach ($attributes as $attribute) : ?>
                                                         <option value="<?= $attribute['id'] ?>"><?= $attribute['attribute_name'] ?></option>
                                                     <?php endforeach ?>
                                                 </select>
                                                 <p id="addAttribute" class="btn btn-success mt-3">Cập nhật</p>
                                             </div>


                                             <div id="dynamicFieldsContainer"></div>

                                             <div id="variantsContainer"></div>
                                         </div>

                                     </div>
                                     <div class="col-3 border rounded">
                                         <div class="form-group">
                                             <label for="exampleInputcategory_id1">Danh mục</label>
                                             <select name="category_id" id="exampleInputcategory_id1" class="form-control">
                                                 <?php foreach ($categories as $category) : ?>
                                                     <option value="<?= $category['id'] ?>" <?php if ($category['id'] == $product['category_id']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $category['category_name'] ?></option>
                                                 <?php endforeach ?>
                                             </select>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFile">Ảnh đại diện sản phẩm</label>
                                             <div class="input-group">
                                                 <div class="custom-file">

                                                     <input type="file" class="custom-file-input" id="main_image" name="main_image" onchange="handleFileChange()" onclick="saveCurrentImage()">
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>

                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                             <div class="input-group">
                                                 <img src="<?= BASE_URL . $product['main_image'] ?>" width="240px" id="main_image_preview" alt="">
                                             </div>
                                         </div>
                                         <div class="input-group">
                                             <img src="" width="240px" id="main_image_preview" alt="">
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFile">Thư viện ảnh sản phẩm</label>
                                             <div class="input-group">
                                                 <div class="custom-file">

                                                     <input type="file" class="custom-file-input" id="images" name="image[]" multiple onchange="handleFiles(this.files)">
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>
                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                             <div id="custom_image_preview_container">
                                                 <?php foreach ($images as $image) : ?>
                                                     <div class="custom-image-container" data-image-id="<?= $image['id'] ?>">
                                                         <img src="<?= BASE_URL . $image['image'] ?>" class="custom-image">
                                                         <button type="button" class="custom-remove-button"><i class="fas fa-times-circle" style="color: #dd0000;"></i></button>
                                                     </div>
                                                 <?php endforeach; ?>
                                             </div>
                                         </div>
                                         <div id="image_preview_container"></div>

                                         <div class="form-group">
                                             <label for="type">Loại sản phẩm</label>
                                             <select name="type_product" id="type" class="form-control">
                                                 <option value="1">Sản phẩm đơn giản</option>
                                                 <option value="2">Sản phẩm biến thể</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>



                             </div>
                             <!-- /.card-body -->

                             <div class="card-footer ">
                                 <button type="submit" class="btn btn-primary " name="submit">Submit</button>
                             </div>

                         </form>
                         <!-- END FORM -->

                     </div>
                     <!-- /.card -->


                 </div>

             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->

     </section>

     <!-- /.content -->
 </div>



 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const typeSelect = document.getElementById('type');
         const productNoVariant = document.getElementById('product_no_variant');
         const productVariant = document.getElementById('product_variant');

         typeSelect.addEventListener('change', function() {
             if (this.value == '2') {
                 productNoVariant.style.display = 'none';
                 productVariant.style.display = 'block';
             } else {
                 productNoVariant.style.display = 'block';
                 productVariant.style.display = 'none';
             }
         });
     })
 </script>