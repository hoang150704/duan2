<div class="header_middel">
    <div class="container-fluid">
        <div class="middel_inner">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="search_bar">
                        <form action="index.php?act='?act=search'" method="get">
                            <input placeholder="Bạn cần tìm gì ..." type="text" name="query">
                            <button type="submit"><i class="ion-ios-search-strong"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/logo/logoHDT1.png" width="150px" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart_area">
                        <div class="cart_link">
                            <a href="#"><i class="fa fa-shopping-basket"></i>item(s)</a>
                            <!--mini cart-->
                            <div class="mini_cart">
                                <?php if (!empty($_SESSION['cart'])) : ?>
                                    <?php foreach ($_SESSION['cart'] as $cart) : ?>
                                        <div class="cart_item top">
                                            <div class="cart_img">
                                                <a href="#"><img src="<?= BASE_URL . $cart['main_image'] ?>" alt=""></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="#"><?= $cart['product_name'] ?></a>
                                                <span class="product_price" data-price="<?= $cart['price'] ?>" data-quantity="<?= $cart['quantity'] ?>"><?= $cart['quantity'] ?> x <?= $cart['price'] ?></span>
                                            </div>
                                           
                                        </div>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <p>Giỏ hàng của bạn đang trống.</p>
                                <?php endif ?>
                                <div class="cart__table">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">Total :</td>
                                                <td class="text-right total-price">$0.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="cart_button view_cart">
                                    <a href="<?= BASE_URL ?>?act=cart">Giỏ hàng</a>
                                </div>
                                <!-- <div class="cart_button checkout">
                                    <a href="checkout.html">Checkout</a>
                                </div> -->
                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>