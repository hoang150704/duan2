    <!--slider area start-->
    <div class="slider_area slider_style home_three_slider owl-carousel">
        <div class="single_slider" data-bgimg="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/slider4.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_one">
                            <img src="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/content3.png" alt="">
                            <p>Bộ sưu tập áo thun đã quay trở lại với mức giá chỉ bằng một nửa</p>
                            <a href="shop.html">Mua ngay</a>
                        </div>    
                    </div>
                </div>
            </div>    
        </div>
        <div class="single_slider" data-bgimg="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/slider5.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_two">
                            <img src="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/content4.png" alt="">
                            <p>Thiết kế độc đáo - Phong cách riêng biệt - Hết mình với đam mê</p>
                            <a href="shop.html">Mua ngay</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider" data-bgimg="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/banner.png">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_three">
                            <img src="<?= BASE_URL?>assets/user/theme_shop/assets/img/slider/content5.png" alt="">
                            <p>Siêu SALE chào hè - Mua sắm thỏa ga - Không lo về giá</p>
                            <a href="shop.html">Mua ngay</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider area end-->
<!-- Banner -->
<div class="banner_section banner_section_three">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner8.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner9.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="banner_area bottom">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner10.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product section area start-->
<section class="product_section womens_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản phẩm của chúng tôi</h2>
                    <p>Các sản phẩm thiết kế hiện đại,mới nhất</p>
                </div>
            </div>
        </div>
        <div class="product_area">
            <div class="row">
                <div class="col-12">
                    <div class="product_tab_button">
                        <ul class="nav" role="tablist">

                            <?php  foreach($listAllCategories as $category ): ?>
                                <li>
                                <a class="<?php if($category['id'] == 1){echo'active';}else{echo '';} ?>" data-toggle="tab" href="#clothing<?=$category['id']?>" role="tab" aria-controls="clothing<?=$category['id']?>" aria-selected="true"><?=$category['category_name']?></a>
                            </li>
                            <?php  endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <?php $i=1; foreach($listProduct as $products): ?>
                <div class="tab-pane fade show <?php if($i == 1){echo'active';}else{echo '';} ?>" id="clothing<?=$i?>" role="tabpanel">
                    <div class="product_container">
                        <div class="row product_column4">
                            <?php foreach ($products as $product) :  ?>
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img"  href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>"><img style="width: 253px !important; height: 253px !important; object-fit: cover; overflow: hidden;" src="<?= BASE_URL . $product['main_image'] ?>" alt="" id="main_image"></a>
                                            <!-- <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product22.jpg" alt=""></a> -->

                                            <div class="quick_button">
                                                <a href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>" title="quick_view">Xem sản phẩm</a>

                                            </div>

                                            <div class="product_sale">
                                                <span><?php if($product['sale_price'] !=0){
                                                    $percent= round(100- $product['sale_price']/$product['price']*100);
                                                    echo $percent.'%';
                                                }else{ echo 'New';} ?></span>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; font-size: 14px; min-height: 55px;" href="<?=BASE_URL.'?act=product-detail&id='.$product['id'] ?>"><?= $product['product_name'] ?></a></h3>
                                            <?php if ($product['sale_price'] == 0) : ?>
                                                <?php if ($product['price'] == 0) : ?>
                                                    <span class="current_price">Liên hệ</span>
                                                <?php else : ?>
                                                    <span class="current_price"><?=$product['price']. ' đ' ?></span>
                                                <?php endif ?>
                                                <?php else: ?>
                                                    <span class="current_price"><?=$product['sale_price']. ' đ' ?></span>
                                                    <span class="old_price"><?=$product['price']. ' đ' ?></span>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <?php $i++; endforeach ?>
            </div>
        </div>

    </div>
</section>
<!--product section area end-->

<!--banner area start-->
<section class="banner_section banner_section_three">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-6 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner11.jpg" alt="#"></a>
                        <div class="banner_content">
                            <h1>Handbag <br> Men’s Collection</h1>
                            <a href="shop.html">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner12.jpg" alt="#"></a>
                        <div class="banner_content">
                            <h1>Sneaker <br> Men’s Collection</h1>
                            <a href="shop.html">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--banner area end-->

<!--product section area start-->
<section class="product_section womens_product bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản phẩm mới</h2>
                    <p>Sản phẩm ấn tượng mới</p>
                </div>
            </div>
        </div>
        <div class="product_area">
            <div class="row">
                <div class="product_carousel product_three_column4 owl-carousel">
                    <?php foreach($newProduct as $newProduct) :?>
                        <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img"  href="<?=BASE_URL.'?act=product-detail&id='.$newProduct['id'] ?>"><img style="width: 253px !important; height: 253px !important; object-fit: cover; overflow: hidden;" src="<?= BASE_URL . $newProduct['main_image'] ?>" alt="" id="main_image"></a>
                                            <!-- <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product22.jpg" alt=""></a> -->

                                            <div class="quick_button">
                                                <a href="<?=BASE_URL.'?act=product-detail&id='.$newProduct['id'] ?>" title="quick_view">Xem sản phẩm</a>

                                            </div>

                                            <div class="product_sale">
                                                <span><?php if($newProduct['sale_price'] !=0){
                                                    $percent= round(100- $newProduct['sale_price']/$newProduct['price']*100);
                                                    echo $percent.'%';
                                                }else{ echo 'New';} ?></span>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; font-size: 14px; min-height: 55px;" href="<?=BASE_URL.'?act=product-detail&id='.$newProduct['id'] ?>"><?= $newProduct['product_name'] ?></a></h3>
                                            <?php if ($newProduct['sale_price'] == 0) : ?>
                                                <?php if ($newProduct['price'] == 0) : ?>
                                                    <span class="current_price">Liên hệ</span>
                                                <?php else : ?>
                                                    <span class="current_price"><?=$newProduct['price']. ' đ' ?></span>
                                                <?php endif ?>
                                                <?php else: ?>
                                                    <span class="current_price"><?=$newProduct['sale_price']. ' đ' ?></span>
                                                    <span class="old_price"><?=$newProduct['price']. ' đ' ?></span>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                </div>
                        <?php endforeach ?>
                </div>
            </div>
        </div>

    </div>
</section>
<!--product section area end-->