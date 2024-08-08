<hr style="margin-bottom: 0;">
<div style="background-color: #f4f6f9;padding: 30px;">
    <div class="container">
        <div class="content-wrapper" style="margin: 0;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
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
                            <div class="card-body border rounded" style="background-color: #fff;">
                                <a href="<?= BASE_URL . '?act=info' ?>" class="btn btn-primary mb-3">Quay lại</a>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="timeline">
                                        <div class="card">
                                            <?php foreach ($combinedData as $key => $value) : ?>
                                                <div class="card-header p-2 ">
                                                    <h6 class="m-0 d-flex justify-content-between alert alert-primary">
                                                        <p class="p-0 m-0">Chi tiết đơn hàng #<?=$value['orders'][0]['order']['id'] ?></p>
                                                        <p class="p-0 m-0"><?= $value['status']['status_order_name'] ?></p>
                                                    </h6>

                                                </div><!-- /.card-header -->
                                                <div class="card-body p-2" style="background-color: #f4f6f9;">
                                                    <div class="tab-content ">

                                                        <div class="m-2">
                                                            <!-- Bắt đầu -->
                                                            <?php foreach ($value['orders'] as $order) : ?>
                                                                <?php if($value['status']['id'] == 7): ?>
                                                                    <div class="row p-2 border rounded mb-3 " style="background-color: white;">
                                                                    <h6 class="alert alert-warning m-0">Chúng tôi đã nhận được yêu cầu hoàn hàng của bạn. Chúng tôi sẽ liên hệ cho bạn sớm nhất</h6>
                                                                </div>
                                                                <?php endif ?>
                                                                <div class="row p-2 border rounded mb-3 " style="background-color: white;">
                                                                    <!-- Địa chỉ giao hàng -->
                                                                    <div class="col-6 border-end">
                                                                        <h6 class="border-bottom fs-6 pb-3 mb-3 fw-bold">Địa chỉ giao hàng</h6>
                                                                        <p>Họ và tên: <?= $order['order']['order_account_name'] ?></p>
                                                                        <p>Số điện thoại: <?= $order['order']['order_phone'] ?></p>
                                                                        <p>Địa chỉ: <?= $order['order']['order_address'] ?></p>
                                                                        <p>Ngày đặt hàng: <?= $order['order']['date_order'] ?></p>
                                                                        <p>Ghi chú: <?= $order['order']['note'] ?></p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <section class="timeline_area section_padding_130">
                                                                            <div class="container">
                                                                                <h6 class="border-bottom fs-6 pb-3 mb-3 fw-bold">Lịch trình</h6>
                                                                                <div class="card">
                                                                                    <div id="content">
                                                                                        <ul class="timeline">
                                                                                            <?php foreach ($order['history'] as $history) : ?>
                                                                                                <li class="event ">
                                                                                                    <h3><?= $history['status_order_name'] ?></h3>
                                                                                                    <p><?= $history['timestamp'] ?></p>
                                                                                                </li>
                                                                                            <?php endforeach ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                    <!-- End địa chỉ giao hàng -->
                                                                </div>
                                                                <div class="row p-2 border rounded mb-3" style="background-color: white;">
                                                                    <h6 class="border-bottom fs-6 pb-3 mb-3 fw-bold">Sản phẩm</h6>

                                                                    <?php $total = 0;
                                                                    foreach ($order['details'] as $detail) : ?>
                                                                        <div class="row pb-3 mb-3 border-bottom">
                                                                            <!-- Sản phẩm -->
                                                                            <div class="col-2">
                                                                                <img src="<?= BASE_URL . $detail['image'] ?>" class="border rounded" alt="">
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <h5><?= $detail['product_name'] ?></h5>
                                                                                <p>Số lượng: <?= $detail['detail_quantity'] ?></p>
                                                                            </div>
                                                                            <div class="col-2 d-flex justify-content-between">
                                                                                <h5></h5>
                                                                                <h6><?= $detail['product_price'] ?> đ</h6>
                                                                            </div>
                                                                            <!-- End sản phẩm -->
                                                                        </div>

                                                                    <?php $total = $total + $detail['product_price'];
                                                                    endforeach ?>
                                                                    <div class="row m-1">
                                                                        <!-- Tổng tiền -->
                                                                        <div class="order-summary d-flex flex-column">
                                                                            <div class="d-flex justify-content-between">
                                                                                <span class="title">Tạm tính:</span>
                                                                                <span><?= $total ?> đ</span>
                                                                            </div>
                                                                            <div class="d-flex justify-content-between">
                                                                                <span class="title">Phí ship:</span>
                                                                                <span><?= $order['order']['shipping'] ?></span>
                                                                            </div>
                                                                            <div class="d-flex justify-content-between mt-2 border-top pt-2">
                                                                                <span class="title">Tổng:</span>
                                                                                <span><?= $order['order']['total_money'] ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- End tổng tiền -->
                                                                    </div>
                                                                </div>
                                                                <?php if (in_array($value['status']['id'], [1, 2, 10, 11, 4])) : ?>
                                                                    <div class="row p-2 border rounded mb-3" style="background-color: white;">
                                                                        <!-- Form yêu cầu lý do hủy đơn hàng -->
                                                                        <div class="d-flex gap-3">
                                                                            <form id="main-form" action="" method="POST">
                                                                                <?php if (in_array($value['status']['id'], [1, 2, 10, 11])) : ?>
                                                                                    <button type="submit" class="btn btn-danger mx-auto" onclick="return confirmCancellation()">Hủy đơn hàng</button>
                                                                                <?php else : ?>
                                                                                    <button type="submit" class="btn btn-danger mx-auto" onclick="return confirmCancellation()">Hoàn hàng</button>
                                                                                <?php endif; ?>
                                                                            </form>
                                                                            <?php if (in_array($value['status']['id'], [4])) : ?>
                                                                                <form id="main-form-2" action="" method="POST">
                                                                                <button type="submit" name="success" class="btn btn-success mx-auto" onclick="return confirm('Bạn có chắc chắn hoàn thành đơn hàng không !! Bạn sẽ không thể hoàn hàng nếu đồng ý !!')">Hoàn thành</button>
                                                                                </form>
                                                                            <?php endif; ?>
                                                                            <?php if (in_array($value['status']['id'], [10])) : ?>
                                                                                <form id="main-form-3" action="" method="POST">
                                                                                    <input type="hidden" name="id" value="<?=$order['order']['id']?>">
                                                                                    <input type="hidden" name="total_money" value="<?=$order['order']['total_money']?>">
                                                                                    <input type="hidden" name="order_code" value="<?=$order['order']['order_code']?>">
                                                                                <button type="submit" name="payment" class="btn btn-success mx-auto" >Thanh toán</button>
                                                                                </form>
                                                                            <?php endif; ?>
                                                                            </div>
                                                                            <!-- Form yêu cầu lý do hủy đơn hàng -->
                                                                            <form id="reason-form" class="hidden" action="" method="POST">
                                                                                <div class="form-group">
                                                                                    <label for="reason">Nhập lý do:</label>
                                                                                    <textarea id="reason" name="reason" class="form-control" rows="3" required></textarea>
                                                                                    <input type="hidden" value="<?= $value['status']['id'] ?>">
                                                                                </div>
                                                                                <button type="submit" class="btn btn-primary" name="cancel">Gửi lý do</button>
                                                                                <button type="button" class="btn btn-secondary" onclick="cancelForm()">Quay lại</button>
                                                                            </form>
                                                                        
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach ?>
                                                            <!-- Chi tiết -->
                                                        </div>
                                                    <?php endforeach ?>
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div><!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
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
<script>
    function confirmCancellation() {
        // Hiển thị hộp thoại xác nhận
        if (confirm("Bạn có chắc chắn không?")) {
            // Ngăn chặn form chính gửi dữ liệu ngay lập tức
            event.preventDefault();
            // Hiển thị form yêu cầu lý do hủy
            document.getElementById('main-form').classList.add('hidden');
            document.getElementById('reason-form').classList.remove('hidden');
            document.getElementById('main-form-2').classList.add('hidden');
            document.getElementById('main-form-3').classList.add('hidden');
            return false;
        }
        // Nếu người dùng không xác nhận, không gửi form chính
        return false;
    }

    function cancelForm() {
        // Hiển thị lại form chính và ẩn form yêu cầu lý do
        document.getElementById('main-form').classList.remove('hidden');
        document.getElementById('main-form-2').classList.remove('hidden');
        document.getElementById('main-form-3').classList.remove('hidden');
        document.getElementById('reason-form').classList.add('hidden');
    }
</script>