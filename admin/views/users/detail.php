<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php';
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=user' ?>">
                                <h3 class="card-title">Back to list</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="image row d-flex align-items-center mb-3">
                                <div class="col-2"><b>Ảnh đại diện:</b></div>
                                <div col-9> 
                                    <img width="70px" src="<?= BASE_URL.$user['avatar'] ?>" class="img-circle elevation-2" alt="User Image"></div>

                            </div>
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                    <td>
                                        <b> <span>Trường dữ liệu</span></b>
                                    </td>
                                    <td>
                                        <b> <span>Dữ liệu</span></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>ID</p>
                                    </td>
                                    <td>
                                        <p><?= $user['id'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Tên đăng nhập</p>
                                    </td>
                                    <td>
                                        <p><?= $user['username'] ?></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p>Email</p>
                                    </td>
                                    <td>
                                        <p><?= $user['email'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Số điện thoại</p>
                                    </td>
                                    <td>
                                        <p><?=  $user['phone'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Họ và tên</p>
                                    </td>
                                    <td>
                                        <p><?= $user['fullname'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Địa chỉ</p>
                                    </td>
                                    <td>
                                        <p><?= $user['address'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ngày tạo tài khoản</p>
                                    </td>
                                    <td>
                                        <p><?= $user['create_date'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Quyền</p>
                                    </td>
                                    <td>
                                        <p><?= $user['role'] ? '<h5><span class="btn btn-success btn-sm">Admin</span></h5>' : '<h5><span class="btn btn-primary btn-sm">User</span></h5>'  ?></p>
                                    </td>
                                </tr>




                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>