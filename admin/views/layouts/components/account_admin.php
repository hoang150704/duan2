<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="<?=BASE_URL.$_SESSION['admin']['avatar'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h3 href="#" class="d-block"><p class=" badge badge-info m-0"><?=ucfirst($_SESSION['admin']['fullname']) ?></p></h3>
                        <a onclick="return confirm('Bạn có chắc chắn đăng xuất không !!!')" href="<?= BASE_URL_ADMIN . '?act=logout' ?>">Đăng xuất</a>
                    </div>
                </div>