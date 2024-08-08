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
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=attribute' ?>">
                                 <h3 class="card-title">Back to list</h3>
                             </a>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <?php if (isset($_SESSION['success'])) : ?>
                                     <div class="d-flex align-items-center alert alert-success">

                                         <i class="fas fa-check-circle"></i>
                                         <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>

                                     </div>

                                     <?php unset($_SESSION['success']) ?>
                                 <?php endif ?>
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
                                     <label for="exampleInputattributeName1">Tên danh mục</label>
                                     <input type="text" class="form-control" id="exampleInputattributeName1" placeholder="Tên danh mục" name="attribute_name" value="<?=$attribute['attribute_name'] ?>">
                                     <span></span>
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