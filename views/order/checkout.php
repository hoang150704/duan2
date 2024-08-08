    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>/</li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!-- Nội dung -->
    <div class="shopping_cart_area">
        <div class="container mb-5">
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
            <form action="" method="post">
                <div class="row gx-3">

                    <div class="col-md-4 order-2 border p-2">
                        <h4 class="d-flex justify-content-between align-items-center mb-3" style="color:black;">
                            <span class="text-muted">Đơn hàng của bạn</span>
                            <span class="badge rounded-pill bg-secondary">3</span>
                        </h4>

                        <div class="card">
                            <?php foreach ($_SESSION['order']['cart'] as $order) : ?>

                                <li class="d-flex p-2">
                                    <img src="<?= BASE_URL . $order['main_image'] ?>" alt="" style="width: 50px;">
                                    <div class="ps-2">
                                        <h6 class="my-0"><?= $order['product_name'] ?></h6>
                                        <div class="d-flex">
                                            <span></span>
                                            <span class="text-muted"><?= $order['quantity'] ?>x<?= $order['price'] ?></span>
                                        </div>
                                    </div>


                                </li>
                            <?php endforeach ?>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span>Tổng tiền(VND)</span>
                            <strong><?= $_SESSION['order']['total_price'] ?></strong>
                        </div>
                        <hr class="mb-4">
                        <h4>Phương thức thanh toán</h4>
                        <div class="form-check m-2">
                            <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="0" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        <div class="form-check m-2">
                            <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán online
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">
                                Đặt hàng
                            </button>
                        </div>

                    </div>

                    <div class="col-md-8 order-1">
                        <h4 class="mb-3">Địa chỉ giao hàng</h4>
                        <div class="row">
                            <div class="col mb-4">
                                <label for="First name"> Họ và tên </label>
                                <input type="text" name="order_account_name" class="form-control" value="<?= $_SESSION['user']['fullname'] ?>" placeholder="Nguyễn Văn A" aria-label="First name">
                            </div>

                        </div>
                        <div class="mb-4">
                            <label for="Address">Địa chỉ</label>
                            <input type="text" name="order_address" class="form-control" value="<?= $_SESSION['user']['address'] ?>" placeholder="Địa chỉ nhận hàng" aria-label="Address">
                        </div>

                        <div class="mb-4">
                            <label for="Address2">Số điện thoại</label>
                            <input type="text" name="order_phone" class="form-control" value="<?= $_SESSION['user']['phone'] ?>" placeholder="Số điện thoại" aria-label="Address2">
                        </div>
                        <div class="mb-4">
                            <label for="Address2">Email</label>
                            <input type="email" name="order_email" class="form-control" value="<?= $_SESSION['user']['email'] ?>" placeholder="Email" aria-label="Address2">
                        </div>
                        <hr class="mb-4">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="note" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Ghi chú</label>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>