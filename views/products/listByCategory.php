<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>/</li>
                        <li>shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_reverse">
    <div class="container">
        <div class="shop_inner_area">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <div class="sidebar_widget">


                    </div>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_title">
                        <h1>Shop</h1>
                    </div>
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">

                            <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>

                            <button data-role="grid_4" type="button" class=" btn-grid-4" data-toggle="tooltip" title="4"></button>

                            <button data-role="grid_5" type="button" class="btn-grid-5" data-toggle="tooltip" title="5"></button>

                            <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="List"></button>
                        </div>

                        <div class="page_amount">
                            <p>Showing </p>
                        </div>
                    </div>
                    <!--shop toolbar end-->

                    <div class="row shop_wrapper">
                        <?php if(empty($listProducts)): ?>
                            <h3>Không tìm thấy sản phẩm nào</h3>
                            <?php else: ?>
                        <?php foreach ($listProducts as $product) : ?>
                            <div class="col-lg-4 col-md-4 col-12 ">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>"><img src="<?= BASE_URL . $product['main_image'] ?>" alt=""></a>
                                        <!-- <a class="secondary_img" href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>"><img src="assets/img/product/product16.jpg" alt=""></a> -->

                                        <div class="quick_button">
                                            <a href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>" title="quick_view">Xem sản phẩm</a>
                                        </div>

                                        <div class="double_base">
                                            <div class="product_sale">
                                                <span><?php if ($product['sale_price'] != 0) {
                                                            $percent = round(100 - $product['sale_price'] / $product['price'] * 100);
                                                            echo $percent . '%';
                                                        } else {
                                                            echo 'New';
                                                        } ?></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="product_content grid_content">
                                        <h3><a href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>"><?= $product['product_name'] ?></a></h3>
                                        <?php if ($product['sale_price'] == 0) : ?>
                                            <?php if ($product['price'] == 0) : ?>
                                                <span class="current_price">Liên hệ</span>
                                            <?php else : ?>
                                                <span class="current_price"><?= $product['price'] . ' đ' ?></span>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <span class="current_price"><?= $product['sale_price'] . ' đ' ?></span>
                                            <span class="old_price"><?= $product['price'] . ' đ' ?></span>
                                        <?php endif ?>
                                    </div>


                                    <div class="product_content list_content">
                                        <h3><a href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>">Marshall Portable Bluetooth</a></h3>
                                        <div class="product_ratting">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product_price">
                                            <span class="current_price">£60.00</span>
                                            <span class="old_price">£86.00</span>
                                        </div>
                                        <div class="product_desc">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores eligendi quia fugiat minus doloribus distinctio assumenda pariatur, quidem laborum quae quasi suscipit. Cupiditate dolor blanditiis rerum aliquid temporibus, libero minus nihil, veniam suscipit? Autem repellendus illo, amet praesentium fugit, velit natus? Dolorum perferendis reiciendis in quam porro ratione eveniet, tempora saepe ducimus, alias?</p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php endforeach ?>
                        <?php endif ?>
                    </div>


                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>

    </div>
</div>