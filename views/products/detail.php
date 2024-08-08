<div class="breadcrumbs_area product_bread">
    <div class="container border p-3 rounded">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content ">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>/</li>
                        <li><?= $product['product_name'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--product details start-->
<div class="product_details">
    <div class="container">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="d-flex align-items-center alert alert-success">

                <i class="fas fa-check-circle"></i>
                <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>

            </div>


        <?php endif ?>
        <?php unset($_SESSION['success']) ?>
        <?php if (isset($_SESSION['warning'])) : ?>
            <div class="d-flex align-items-center alert alert-warning">

                <i class="fas fa-exclamation-circle"></i>
                <p class="p-2 m-0"><?= $_SESSION['warning'] ?></p>

            </div>


        <?php endif ?>
        <?php unset($_SESSION['warning']) ?>
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="product-details-tab">

                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="<?= BASE_URL . $product['main_image'] ?>" data-zoom-image="<?= BASE_URL . $product['main_image'] ?>" alt="big-1">
                        </a>
                    </div>

                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            <?php foreach ($listImage as $image) : ?>
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?= BASE_URL . $image['image'] ?>" data-zoom-image="<?= BASE_URL . $image['image'] ?>">
                                        <img src="<?= BASE_URL . $image['image'] ?>" alt="zo-th-1" />
                                    </a>

                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="product_d_right">
                    <!-- Thoong tin chung -->
                    <h1><?= $product['product_name'] ?></h1>
                    <!-- Đánh giá -->
                    <div class=" product_ratting" id="rating">
                        <ul>
                            <?php
                            // Hiển thị sao vàng đầy đủ
                            $full_stars = floor($averageRating);
                            $partial_star_percentage = ($averageRating - $full_stars) * 100;

                            for ($i = 1; $i <= $full_stars; $i++) {
                                echo '<li><a href="#"><i class="fa fa-star full-star" style="color: gold;"></i></a></li>';
                            }

                            if ($partial_star_percentage > 0) {
                                echo '<li><a href="#"><i class="fa fa-star partial-star" style="background: linear-gradient(90deg, gold ' . $partial_star_percentage . '%, gray ' . $partial_star_percentage . '%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i></a></li>';
                            }

                            for ($i = $full_stars + ($partial_star_percentage > 0 ? 1 : 0); $i < 5; $i++) {
                                echo '<li><a href="#"><i class="fa fa-star empty-star"></i></a></li>';
                            }
                            ?>
                            <li class="review"> <?= $countListComment ?> Đánh giá </li>

                        </ul>
                    </div>
                    <!-- Kết thúc đánh giá -->
                    <!-- Bắt đầu form -->
                    <form action="" method="post" id="variant-form">
                        <!-- Thông tin chun -->
                        <input type="hidden" value="<?= $product['main_image'] ?>" name="main_image">
                        <input type="hidden" value="<?= $product['product_name'] ?>" name="product_name">
                        <!-- Kết thúc thông tin chung -->
                        <?php if (empty($product['variants'])) : ?>
                            <input type="hidden" name="product_lookup_id" value="<?= $product['product_lookup_id'] ?>">
                            <!-- Hàm rỗng -->
                            <div class="product_price">
                                <?php if ($product['sale_price'] == 0) : ?>
                                    <?php if ($product['price'] == 0) : ?>
                                        <span class="current_price">Liên hệ</span>
                                        <input type="hidden" value="0" name="price">
                                    <?php else : ?>
                                        <input type="hidden" value="<?= $product['price'] ?>" name="price">
                                        <span class="current_price"><?= $product['price'] . ' đ' ?></span>
                                    <?php endif ?>
                                <?php else : ?>
                                    <input type="hidden" value="<?= $product['sale_price'] ?>" name="price">
                                    <span class="current_price"><?= $product['sale_price'] . ' đ' ?></span>
                                    <del><span class="old_price"><?= $product['price'] . ' đ' ?></span></del>
                                <?php endif ?>
                                <!-- Số lượng -->
                            </div>
                            <div class="product_variant quantity" id="quantityaddtocart">
                                <label>Số lượng</label>
                                <input min="1" max="<?= $product['quantity'] ?>" id="quantity-input" value="1" type="number" name="quantity">
                                <button class="button" name="addtocart" type="submit">add to cart</button>

                            </div>
                            <div id="out-of-stock-message" style="display:none; color:red;">Sản phẩm đã hết hàng.</div>
                            <span id="quantity-warning" style="display: none; color: red;">Bạn không thể nhập quá số lượng</span>
                            <div class="product_variant quantity">
                                <label for="">Số lượng còn lại: <?= $product['quantity'] ?></label>
                                <input type="hidden" id="quantityinputhidden" value="<?= $product['quantity'] ?>">
                            </div>
                        <?php else : ?>
                            <!-- XỬ lí có biến thể -->
                            <div class="product_price">
                                <span class="current_price" id="price"></span>
                                <del><span class="old_price" id="old_price"></span></del>
                            </div>
                            <?php
                            if (isset($product['variants']) && !empty($product['variants'])) {
                                $attributes = [];
                                $defaultVariant = reset($product['variants']);

                                foreach ($product['variants'] as $variant) {
                                    foreach ($variant['attributes'] as $key => $value) {
                                        if (!isset($attributes[$key])) {
                                            $attributes[$key] = [];
                                        }
                                        foreach ($value as $val) {
                                            if (!in_array($val, $attributes[$key])) {
                                                $attributes[$key][] = $val;
                                            }
                                        }
                                    }
                                }

                                foreach ($attributes as $attributeName => $attributeValues) {
                                    echo '<div class="form-group">';
                                    echo '<h4>' . $attributeName . '</h4>';
                                    foreach ($attributeValues as $value) {
                                        $radioId = 'radio-' . $attributeName . '-' . $value;
                                        $isChecked = '';
                                        if ($defaultVariant) {
                                            if (isset($defaultVariant['attributes'][$attributeName]) && in_array($value, $defaultVariant['attributes'][$attributeName])) {
                                                $isChecked = 'checked';
                                            }
                                        }
                                        echo '<input type="radio" id="' . $radioId . '" name="' . $attributeName . '" value="' . $value . '" ' . $isChecked . '>';
                                        echo '<label for="' . $radioId . '" class="attribute-value' . ($isChecked ? ' selected' : '') . '" onclick="handleAttributeClick(\'' . $attributeName . '\', \'' . $value . '\')">' . $value . '</label>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>

                            <div id="out-of-stock-message" style="display:none; color:red;">Phiên bản bạn chọn đã hết hàng.</div>

                            <!-- Lấy giá và id -->
                            <input type="hidden" id="product_lookup_id" name="product_lookup_id">
                            <input type="hidden" id="price_lookup" name="price">
                            <!-- end -->

                            <div class="product_variant quantity mt-3" id="quantityaddtocart">
                                <label>Số lượng</label>
                                <input min="1" value="1" type="number" id="quantity-input" name="quantity">
                                <button class="button" name="addtocart" type="submit">add to cart</button>
                            </div>

                            <span id="quantity-warning" style="display: none; color: red;">Bạn không thể nhập quá số lượng</span>

                            <div class="product_variant quantity">
                                <label for="" id="quantity">Số lượng còn lại:</label>
                            </div>
                        <?php endif ?>
                    </form>
                    <div class="priduct_social">
                        <h3>Share on:</h3>
                        <ul>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <!-- Mô tả -->
                    <div class="product_desc">
                        <b>
                            <h4>Mô tả</h4>
                        </b>
                        <hr>
                        <?= $product['des'] ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <!-- <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">More info</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Data sheet</a>
                            </li> -->
                            <li>
                                <a data-toggle="tab" class="active" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Bình luận</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <section class="content-item" id="comments">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if (empty($_SESSION['user'])) : ?>
                                            <h3><a href="<?= BASE_URL . '?act=login&redirect=' . urlencode($_SERVER['REQUEST_URI']) ?>" style="color: #0071e3;">Đăng nhập</a> để bình luận</h3>
                                        <?php else : ?>
                                            <form method="POST" action="">
                                                <h3 class="pull-left">New Comment</h3>
                                                <button type="submit" class="btn btn-primary pull-right" name="submitcomment">Submit</button>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-sm-3 col-lg-1 hidden-xs">
                                                            <img class="img-responsive" src="<?= BASE_URL . $_SESSION['user']['avatar'] ?>" alt="">
                                                            <p><?= $_SESSION['user']['fullname'] ?></p>
                                                        </div>
                                                        <div class="form-group col-xs-12 col-sm-9 col-lg-11">
                                                            <textarea class="form-control" id="message" name="comment" placeholder="Bình luận"></textarea>
                                                        </div>
                                                        <div class="row mt-3 d-flex align-items-center">
                                                            <div class="col-sm-3 pr-0 col-lg-1 hidden-xs">
                                                                <h5><b>Đánh giá: </b></h5>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-9 col-lg-11">
                                                                <div id="rating" class="rating">
                                                                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" class="fa fa-star commentstar"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" class="fa fa-star commentstar"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" class="fa fa-star commentstar"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" class="fa fa-star commentstar"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" class="fa fa-star commentstar"></label>

                                                                </div>
                                                                <input type="hidden" name="rating" id="rating-value">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <?php if (isset($_SESSION['errors'])) : ?>
                                                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                                                                <span class="alert alert-danger mt-3"><?= $error ?></span>
                                                            <?php endforeach ?>

                                                        <?php endif ?>
                                                        <?php unset($_SESSION['errors']); ?>
                                                        <?php if (isset($_SESSION['success_comment'])) : ?>
                                                            <span class="alert alert-success mt-3"><?= $_SESSION['success_comment'] ?></span>
                                                        <?php endif ?>
                                                        <?php unset($_SESSION['success_comment']); ?>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        <?php endif ?>
                                        <h3><?= $countListComment ?> Comments</h3>

                                        <!-- COMMENT 1 - START -->
                                        <?php foreach ($listComments as $comments) : ?>
                                            <div class="media row">
                                                <a class="pull-left col-1" href="#"><img class="media-object" src="<?= BASE_URL . $comments['avatar'] ?>" alt=""></a>
                                                <div class="media-body col-10">
                                                    <h4 class="media-heading"><?= $comments['fullname'] ?></h4>
                                                    <div class=" product_ratting">
                                                        <ul>
                                                            <?php
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $comments['rating']) {
                                                                    // Sao vàng
                                                                    echo '<li><i class="fa fa-star" style="color: gold;"></i></li>';
                                                                } else {
                                                                    // Sao xám
                                                                    echo '<li><i class="fa fa-star" style="color: gray;"></i></li>';
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <p><?= $comments['comment_content'] ?>.</p>
                                                    <ul class="list-unstyled list-inline media-detail pull-left">
                                                        <li><i class="fa fa-calendar"></i><?= $comments['date_comment'] ?></li>

                                                    </ul>
                                                    <ul class="list-unstyled list-inline media-detail pull-right">

                                                    </ul>
                                                </div>

                                            </div>
                                            <?php if (!empty($comments['reply'])) : ?>
                                                <div class="row">
                                                    <p class="alert alert-success mb-2">Admin: <?= $comments['reply'] ?></p>
                                                </div>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <!-- COMMENT 1 - END -->
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->

<!--product section area start-->
<section class="product_section related_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Có thể bạn sẽ thích</h2>
                    <p>Thiết kế basic, hợp thời trang</p>
                </div>
            </div>
        </div>
        <div class="product_area">
            <div class="row">
                <div class="product_carousel product_three_column4 owl-carousel">
                    <?php foreach ($listAoThun as $AoThun) :  ?>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="<?= BASE_URL . '?act=product-detail&id=' . $AoThun['id'] ?>"><img style="width: 253px !important; height: 253px !important; object-fit: cover; overflow: hidden;" src="<?= BASE_URL . $AoThun['main_image'] ?>" alt="" id="main_image"></a>
                                    <!-- <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product22.jpg" alt=""></a> -->

                                    <div class="quick_button">
                                        <a href="<?= BASE_URL . '?act=product-detail&id=' . $AoThun['id'] ?>" title="quick_view">Xem sản phẩm</a>

                                    </div>

                                    <div class="product_sale">
                                        <span><?php if ($AoThun['sale_price'] != 0) {
                                                    $percent = round(100 - $AoThun['sale_price'] / $AoThun['price'] * 100);
                                                    echo $percent . '%';
                                                } else {
                                                    echo 'New';
                                                } ?></span>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="<?= BASE_URL . '?act=product-detail&id=' . $AoThun['id'] ?>" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; font-size: 14px; min-height: 55px;"><?= $AoThun['product_name'] ?></a></h3>
                                    <?php if ($AoThun['sale_price'] == 0) : ?>
                                        <?php if ($AoThun['price'] == 0) : ?>
                                            <span class="current_price">Liên hệ</span>
                                        <?php else : ?>
                                            <span class="current_price"><?= $AoThun['price'] . ' đ' ?></span>
                                        <?php endif ?>
                                    <?php else : ?>
                                        <span class="current_price"><?= $AoThun['sale_price'] . ' đ' ?></span>
                                        <span class="old_price"><?= $AoThun['price'] . ' đ' ?></span>
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