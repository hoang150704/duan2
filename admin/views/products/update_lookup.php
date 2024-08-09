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
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=product-update&id='.$id ?>">
                                 <h3 class="card-title">Back</h3>
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



                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Giá</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="price" value="<?= $lookup['price'] ?>" placeholder="Giá">
                                 </div>

                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Giá ưu đãi</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="sale_price" value="<?= $lookup['sale_price'] ?>" placeholder="Giá ưu đãi">
                                 </div>

                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Số lượng</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="quantity" value="<?= $lookup['quantity'] ?>" placeholder="Số lượng">
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