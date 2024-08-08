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
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=status_order' ?>">
                                <h3 class="card-title">Back to list</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

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
                                        <p><?= $status_order['id'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Tên trạng thái đơn hàng</p>
                                    </td>
                                    <td>
                                        <p><?= $status_order['status_order_name'] ?></p>
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