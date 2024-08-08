    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>/</li>
                            <li>cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- shopping cart area start -->
    <!-- shopping cart area start -->
    <div class="shopping_cart_area">
        <div class="container">
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Xóa</th>
                                            <th class="product_thumb">Ảnh</th>
                                            <th class="product_name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product_quantity">Số lượng</th>
                                            <th class="product_total">Tổng tiền sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($_SESSION['cart'])) : ?>
                                            <?php $total = 0;
                                            foreach ($_SESSION['cart'] as $index => $cart) : ?>
                                                <?php $product = getProductLookupById($cart['product_lookup_id']) ?>
                                                <tr id="product-<?= $index ?>">
                                                    <td class="product_remove">
                                                        <a href="#" class="remove-product" data-index="<?= $index ?>">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                        <input type="hidden" name="remove[<?= $index ?>]" value="">
                                                    </td>
                                                    <td class="product_thumb"><a href="#"><img src="<?= BASE_URL . $cart['main_image'] ?>" alt=""></a></td>
                                                    <?php if (empty($variants[$cart['product_lookup_id']])) : ?>
                                                        <td class="product_name"><a href="#"><?= $cart['product_name'] ?></a></td>
                                                    <?php else : ?>
                                                        <td class="product_name"><a href="#"><?= $cart['product_name'] ?></a>
                                                            <p>|
                                                                <?php foreach($variants[$cart['product_lookup_id']] as $variant): ?>
                                                                     <?=$variant['attribute_value_name']?> |
                                                                 <?php endforeach ?>   
                                                            </p>
                                                        </td>
                                                    <?php endif ?>
                                                    <td class="product-price"><?= $cart['price'] ?> đ</td>
                                                    <td class="product_quantity">
                                                        <input class="quantity-input" data-price="<?= $cart['price'] ?> đ" data-stock="<?= $product['quantity'] ?>" min="1" max="<?= $product['quantity'] ?>" value="<?= $cart['quantity'] ?>" type="number" name="quantity[<?= $index ?>]">
                                                        <span class="quantity-warning" style="display: none; color: red;">Bạn không thể nhập quá số lượng</span>
                                                    </td>
                                                    <td class="product_total"><?= $cart['price'] * $cart['quantity'] ?> đ</td>
                                                </tr>
                                            <?php $total += $cart['price'] * $cart['quantity'];
                                            endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Giỏ hàng trống</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php $total = 0;
                                        endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button type="submit" id="cart_submit" name="update_cart">Cập nhật giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- coupon code area start -->
                <div class="coupon_area">
                    <div class="col-lg-12 col-md-6">
                        <div class="coupon_code right">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tổng tiền</p>
                                    <p class="cart_amount"><?= $total ?> đ</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="<?= BASE_URL . '?act=checkout' ?>">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- coupon code area end -->
            </form>
        </div>
    </div>
    <!-- shopping cart area end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-product').forEach(function(removeLink) {
                removeLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                        const index = this.getAttribute('data-index');
                        document.getElementById('product-' + index).style.display = 'none';

                        // Optionally, mark the item for removal by setting a hidden input value
                        document.querySelector(`input[name="remove[${index}]"]`).value = '1';
                    }
                });
            });
        });
    </script>

    <!-- shopping cart area end -->