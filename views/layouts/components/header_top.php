<div class="header_top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-12">
                <div class="welcome_text">
                    <ul>
                        <li><span>Số điện thoại:</span> 0796385112</li>
                        <li><span>Địa chỉ: </span> 68 phố Nhổn, Tây Tựu, Bắc Từ Liêm, Hà nội</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="top_right text-right">
                    <ul>
                        <?php if (!empty($_SESSION['user'])) : ?>
                            <li class="top_links"><a href="#"><?= $_SESSION['user']['username'] ?> <i class="ion-chevron-down"></i></a>
                                <ul class="dropdown_links">
                                    <li><a href="<?= BASE_URL . '?act=info' ?>">Thông tin </a></li>
                                    <li><a href="<?= BASE_URL . '?act=logout&redirect='.urlencode($_SERVER['REQUEST_URI']) ?>">Đăng xuất</a></li>

                                </ul>
                            <?php else : ?>
                                <a href="<?= BASE_URL . '?act=login&redirect='.urlencode($_SERVER['REQUEST_URI']) ?>" style="color: white; " id="login">Đăng nhập </a>
                            <?php endif ?>

                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>