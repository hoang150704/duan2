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
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=order' ?>">
                                <h3 class="card-title">Back to list</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 border">
                                    <b>Chung:</b>
                                    <p>Ngày đặt hàng: <?= $order['date_order'] ?></p>
                                    <p>Tình trạng đơn hàng: <b class="btn btn-info"><?= $order['status_name'] ?></b></p>
                                    <p>Khách hàng: <?= ucfirst($account['username']) ?></p>
                                    <p>Phương thức thanh toán: Trả tiền khi nhận hàng</p>
                                    <p>Phí ship: <?= $order['shipping'] ?> VND</p>
                                    <p>Ghi chú: <?= $order['note'] ?></p>
                                </div>
                                <div class="col-4 border">
                                    <b>Người đặt: </b>
                                    <p>Họ tên: <?= $account['fullname'] ?></p>
                                    <p>Số điện thoại: <?= $account['phone'] ?></p>
                                    <p>Địa chỉ: <?= $account['address'] ?></p>
                                    <p>Email: <?= $account['email'] ?></p>
                                </div>
                                <div class="col-4 border">
                                    <b>Người nhận</b>
                                    <p>Họ tên: <?= $order['order_account_name'] ?></p>
                                    <p>Số điện thoại: <?= $order['order_phone'] ?></p>
                                    <p>Địa chỉ: <?= $order['order_address'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <table id="example2" class="table table-hover border mt-3">
                                    <tr class="bg-secondary">
                                        <th>Sản phẩm</th>
                                        <th>Chi phí</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                    <?php
                                    $i = 0;

                                    foreach ($details as $detail) :
                                    ?>
                                        <tr class="bg-light">
                                            <td><?= $detail['product_name'] ?></td>
                                            <td><?= $detail['product_price'] ?> VND</td>
                                            <td><?= $detail['detail_quantity'] ?></td>
                                            <td><?= $total_money[$i] ?> VND</td>
                                        </tr>
                                    <?php
                                        $i++;
                                    endforeach
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p>Tạm tính: <?= $allMoney ?> VND</p>
                                            <p>Phí ship: <?= $order['shipping'] ?> VND</p>
                                            <p>Thành tiền: <?= $order['total_money'] ?> VND</p>
                                        </td>
                                    </tr>

                                </table>
                            </div>
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