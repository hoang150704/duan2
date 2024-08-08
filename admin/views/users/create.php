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
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=user' ?>">
                                 <h3 class="card-title">Back to list</h3>
                             </a>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                <?php if(isset($_SESSION['errors'])): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                       <?php
                                       foreach($_SESSION['errors'] as $error): ?>
                                        <li><?=$error?></li>
                                       <?php endforeach ?>
                                       
                                    </ul>
                                </div>
                                <?php unset($_SESSION['errors']) ?>
                                <?php endif?>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="exampleInputUsername1">Tên đăng nhập</label>
                                             <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username" value="<?= isset($_SESSION['data'])?$_SESSION['data']['username']: '' ?>">
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputPassword1">Mật khẩu</label>
                                             <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" >
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputRePassword1">Nhập lại mật khẩu</label>
                                             <input type="password" class="form-control" id="exampleInputRePassword1" placeholder="Re-Password" name="repassword">
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputEmail1">Email</label>
                                             <input type="email" class="form-control" id="exampleInputEmail1" placeholder="example@gmail.com" name="email" value="<?= isset($_SESSION['data'])?$_SESSION['data']['email']: '' ?>">
                                             <span></span>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="exampleInputPhone1">Số điện thoại</label>
                                             <input type="text" class="form-control" id="exampleInputPhone1" placeholder="VD:0123456789" name="phone" value="<?= isset($_SESSION['data'])?$_SESSION['data']['phone']: '' ?>">
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFullName1">Họ và tên</label>
                                             <input type="text" class="form-control" id="exampleInputFullName1" placeholder="Nguyễn Văn A" name="fullname" value="<?= isset($_SESSION['data'])?$_SESSION['data']['fullname']: '' ?>">
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputAddress1">Địa chỉ</label>
                                             <input type="text" class="form-control" id="exampleInputAddress1" placeholder="Số 1, Ngõ 1 ..." name="address" value="<?= isset($_SESSION['data'])?$_SESSION['data']['address']: '' ?>">
                                             <span></span>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputRole1">Quyền</label>
                                             <select name="role" id="exampleInputRole1" class="form-control">

                                                 <option <?= isset($_SESSION['data'])&&$_SESSION['data']['role'] == 1 ? 'selected' : null  ?> value="1">Admin</option>
                                                 <option <?= isset($_SESSION['data'])&&$_SESSION['data']['role'] == 0 ? 'selected' : null  ?> value="0">User</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>


                                 <div class="form-group">
                                     <label for="exampleInputFile">Ảnh đại diện</label>
                                     <div class="input-group">
                                         <div class="custom-file">

                                             <input type="file" class="custom-file-input" id="avatarInputFile" name="avatar">
                                             <label class="custom-file-label" for="avatarInputFile">Choose file</label>
                                         </div>
                                         <div class="input-group-append">
                                             <span class="input-group-text">Upload</span>
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
     <?php unset($_SESSION['data']) ?>
     <!-- /.content -->
 </div>