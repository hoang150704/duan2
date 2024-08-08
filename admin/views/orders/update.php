<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php'; ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=order' ?>">
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
                                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <?php unset($_SESSION['errors']) ?>
                                <?php endif ?>
                                <div class="row">
                                    <div class="col-6 border">
                                        <h5><b>Thông tin người nhận:</b></h5>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Họ và tên</label>
                                            <input type="text" class="form-control" id="order_account_name" name="order_account_name" value="<?= $order['order_account_name'] ?>">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Số điện thoại</label>
                                            <input type="text" class="form-control" id="order_phone" placeholder="Số điện thoại" name="order_phone" value="<?= $order['order_phone'] ?>">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Địa chỉ</label>
                                            <input type="text" class="form-control" id="order_address" placeholder="Địa chỉ" name="order_address" value="<?= $order['order_address'] ?>">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-6 border">
                                        <h5><b>Chung:</h5>
                                        <div class="form-group">
                                            <label for="status_id">Trạng thái đơn hàng</label>
                                            <select name="status_id" id="status_id" class="form-control">
                                                <?php foreach ($status_orders as $status_order) : ?>
                                                    <option value="<?= $status_order['id'] ?>" <?php if ($order['status_id'] == $status_order['id']) echo 'selected'; ?>><?= $status_order['status_order_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFullName1">Phí ship</label>
                                            <input type="text" class="form-control" id="shippingFee" placeholder="Phí ship" name="shipping" value="<?= $order['shipping'] ?>" onchange="updateShippingFee()">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAddress1">Ghi chú</label>
                                            <input type="text" class="form-control" id="note" placeholder="Ghi chú ....." name="note" value="<?= $order['note'] ?>">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border mt-3">
                                    <div class="col">
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
                                                    <td>
                                                        <input type="number" name="detail_quantity[]" id="quantity<?= $i ?>" class="quantity" value="<?= $detail['detail_quantity'] ?>" onchange="validate(<?= $i ?>)">
                                                        <span id="validateQuantity<?= $i ?>" class="validateQuantity" style="color: #dd0000; display: none;">Bạn không thể nhập số lượng nhỏ hơn hoặc bằng 0</span>
                                                    </td>
                                                    <td id="total<?= $i ?>"> <?= $detail['product_price'] * $detail['detail_quantity'] ?> VND</td>
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
                                                    <p id="subtotal">Tạm tính: VND</p>
                                                    <p id="ship">Phí ship: <?= $order['shipping'] ?> VND</p>

                                                    <p>Thành tiền: </p>
                                                    <input type="text" class="form-control" id="total_money" name="total_money" readonly>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form>
                        <!-- END FORM -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    function updateTotal(index, price) {
        var quantity = document.getElementById('quantity' + index).value;
        var total = price * quantity;
        document.getElementById('total' + index).innerText = total + ' VND';

        updateSubtotal();
    }

    function showWarning(index) {
        var quantityInput = document.getElementById('quantity' + index);
        var quantityValue = quantityInput.value;
        var validateQuantity = document.getElementById('validateQuantity' + index);

        if (quantityValue <= 0) {
            // Hiển thị thông báo lỗi nếu giá trị nhỏ hơn hoặc bằng 0
            validateQuantity.style.display = 'block';
        } else {
            // Ẩn thông báo lỗi nếu giá trị hợp lệ
            validateQuantity.style.display = 'none';
        }
    }

    function setDefaultValue(index) {
        var quantityInput = document.getElementById('quantity' + index);
        var quantityValue = quantityInput.value;

        if (quantityValue === '' || quantityValue <= 0) {
            // Đặt lại giá trị của ô nhập thành 1 nếu không có giá trị hoặc giá trị là 0
            quantityInput.value = 1;
            // Cập nhật thông báo lỗi nếu cần
            var validateQuantity = document.getElementById('validateQuantity' + index);
            validateQuantity.style.display = 'block';
        }
    }

    // Đảm bảo rằng sự kiện được gán cho tất cả các ô nhập khi trang đã tải xong
    document.querySelectorAll('.quantity').forEach((input, index) => {
        input.addEventListener('input', function() {
            showWarning(index);
        });
        input.addEventListener('blur', function() {
            setDefaultValue(index);
            showWarning(index);
        });
    });

    function updateShippingFee() {
        var shippingFee = parseInt(document.getElementById('shippingFee').value) || 0;
        document.getElementById('ship').innerText = 'Phí ship: ' + shippingFee + ' VND';

        updateSubtotal();
    }

    function updateSubtotal() {
        var rows = document.querySelectorAll('table tr.bg-light');
        var subtotal = 0;

        rows.forEach(function(row, index) {
            var total = parseInt(document.getElementById('total' + index).innerText.replace(' VND', ''));
            subtotal += total;
        });

        document.getElementById('subtotal').innerText = 'Tạm tính: ' + subtotal + ' VND';

        var shippingFee = parseInt(document.getElementById('shippingFee').value) || 0;
        document.getElementById('ship').innerText = 'Phí ship: ' + shippingFee + ' VND';

        var totalMoney = subtotal + shippingFee;
        document.getElementById('total_money').value = totalMoney;
    }

    // Update the total values initially
    updateSubtotal();
</script>
<select name="status_id" id="status_id" class="form-control">
    <?php foreach ($status_orders as $status_order) : ?>
        <option value="<?= $status_order['id'] ?>" <?php if ($order['status_id'] == $status_order['id']) echo 'selected'; ?>><?= $status_order['status_order_name'] ?></option>
    <?php endforeach ?>
</select>

<script>
    // Object chứa logic cho phép chuyển trạng thái
    const statusTransitions = {
        1: [2, 6], // Chưa xác nhận: Chỉ có thể chọn Đã xác nhận và Đã hủy
        2: [3, 6], // Đã xác nhận: Chỉ có thể chọn Đang vận chuyển hoặc Đã hủy
        3: [4], // Đang vận chuyển: Chỉ có thể chọn Đã giao hàng
        4: [5, 7], // Đã giao hàng: Chỉ có thể chọn Đã hoàn thành hoặc Hoàn hàng
        5: [], // Đã hoàn thành: Không thể chuyển sang trạng thái khác
        6: [9], // Đã hủy: Không thể chuyển sang trạng thái khác
        7: [8], // Hoàn hàng: Chỉ có thể chọn Đã hoàn hàng
        8: [9], // Đã hoàn hàng: Chỉ có thể chọn Đã hoàn tiền
        9: [], // Đã hoàn tiền: Không thể chuyển sang trạng thái khác
        10: [11, 6], // Chưa thanh toán: Chỉ có thể chọn Đã thanh toán hoặc Đã hủy
        11: [6, 2] // Đã thanh toán: Chỉ có thể chọn Đã hủy hoặc Đã xác nhận
    };

    function updateFields() {
        var status_id = parseInt(document.getElementById('status_id').value);
        var fields = [
            'note', 'shippingFee', 'order_address', 'order_phone', 'order_account_name'
        ];

        // Vô hiệu hóa các trường nhập liệu dựa trên status_id
        if (status_id >= 3 && status_id <= 9) {
            fields.forEach(function(field) {
                document.getElementById(field).setAttribute('disabled', 'disabled');
            });

            for (var i = 0; i < <?= count($details) ?>; i++) {
                document.getElementById('quantity' + i).setAttribute('disabled', 'disabled');
            }
        } else {
            fields.forEach(function(field) {
                document.getElementById(field).removeAttribute('disabled');
            });

            for (var i = 0; i < <?= count($details) ?>; i++) {
                document.getElementById('quantity' + i).removeAttribute('disabled');
            }
        }
    }

    function updateStatusOptions() {
        const statusSelect = document.getElementById('status_id');
        const currentStatus = parseInt(statusSelect.value);

        // Lấy các tùy chọn hợp lệ cho trạng thái hiện tại
        const validOptions = statusTransitions[currentStatus] || [];

        // Disable tất cả các tùy chọn trước khi enable tùy chọn hợp lệ
        for (let option of statusSelect.options) {
            option.disabled = true;
        }

        // Enable tùy chọn hợp lệ
        for (let validOption of validOptions) {
            const option = statusSelect.querySelector(`option[value="${validOption}"]`);
            if (option) {
                option.disabled = false;
            }
        }
    }

    window.onload = function() {
        updateFields(); // Kiểm tra khi trang tải lần đầu
        updateStatusOptions(); // Kiểm tra khi trang tải lần đầu
    }
</script>