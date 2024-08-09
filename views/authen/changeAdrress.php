<hr style="margin-bottom: 0;">
<div style="background-color: #f4f6f9;padding: 30px;">
    <div class="container">
        <div class="content-wrapper" style="margin: 0;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <a href="<?= BASE_URL . '?act=detail-order&id='.$id ?>" class="btn btn-primary">Back</a>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thông tin cá nhân</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= BASE_URL . $_SESSION['user']['avatar'] ?>" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?= $_SESSION['user']['username'] ?></h3>


                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Tên đăng nhập: </b><b class=""><?= $_SESSION['user']['username'] ?></b>

                                        </li>
                                        <li class="list-group-item">
                                            <b>Họ và tên: </b>
                                            <?php if ($_SESSION['user']['fullname'] == '' || empty($_SESSION['user']['fullname']) || $_SESSION['user']['fullname'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= $_SESSION['user']['fullname'] ?></b>
                                            <?php endif ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Số điện thoại: </b>
                                            <?php if ($_SESSION['user']['phone'] == '' || $_SESSION['user']['phone'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= mask_phone($_SESSION['user']['phone']) ?></b>
                                            <?php endif ?>

                                        </li>
                                        <li class="list-group-item">
                                            <b>Email: </b> <b class=""><?= mask_email($_SESSION['user']['email']) ?></b> <a href="<?= BASE_URL . '?act=change-email&check=1' ?>">Sửa</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Địa chỉ: </b>
                                            <?php if ($_SESSION['user']['address'] == '' || $_SESSION['user']['address'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= $_SESSION['user']['address'] ?></b>
                                            <?php endif ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Ngày đăng kí: </b> <b class=""><?= $_SESSION['user']['create_date'] ?></b>
                                        </li>
                                    </ul>
                                    <a href="<?= BASE_URL . '?act=update-user' ?>" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
                                    <a href="<?= BASE_URL . '?act=change-password' ?>" class="btn btn-warning btn-block"><b>Đổi mật khẩu</b></a>
                                    <a href="<?= BASE_URL . '?act=logout' ?>" class="btn btn-danger btn-block"><b>Đăng xuất</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-3">
                                    <h2 class="mb-3" align="center">Thay đổi địa chỉ</h2>
                                    <?php if (isset($_SESSION['success'])) : ?>
                                        <div class="alert alert-success">
                                            <ul>
                                                <li><?= $_SESSION['success'] ?></li>
                                            </ul>
                                        </div>
                                        <?php unset($_SESSION['success']) ?>
                                    <?php endif ?>
                                    <?php if (isset($_SESSION['errors'])) : ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php foreach ($_SESSION['errors'] as $err) : ?>
                                                    <li><?= $err ?></li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                        <?php unset($_SESSION['errors']) ?>
                                    <?php endif ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Họ và tên</label>
                                                    <input type="text" name="order_account_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $order['order_account_name']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                                    <input type="text" name="order_phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $order['order_phone']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                                    <input type="text" name="order_address" class="form-control" id="exampleInputPassword1" value="<?= $order['order_address']?>">
                                                </div>
                                                <div class="form-group">
                                                <label for="floatingTextarea2">Ghi chú</label>
                                                    <textarea class="form-control" placeholder="Ghi chú" name="note" id="floatingTextarea2" style="height: 100px"><?=$order['note']?></textarea>
                                                    
                                                </div>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>
<hr style="margin-top: 0;">