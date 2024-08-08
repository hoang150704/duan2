<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/login/css/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
</head>

<body>
    <!-- Form without bootstrap -->
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-action-left">
                <div class="auth-form-outer">
                    <a href="<?= BASE_URL ?>">Trang chủ</a>
                    <div class="d-flex flex-column">

                        <h2 class="auth-form-title">
                            Đăng kí
                        </h2>
                        <?php if (isset($_SESSION['errors'])) : ?>
                            <div class="alert alert-danger" style="background-color: #f8d7da; color: #a22029;">
                                <ul style="padding: 5px 0px 5px 10px;">
                                    <?php
                                    foreach ($_SESSION['errors'] as $error) : ?>
                                        <li style="list-style: none;"><?= $error ?></li>
                                    <?php endforeach ?>

                                </ul>
                            </div>
                            <?php unset($_SESSION['errors']) ?>
                        <?php endif ?>
                    </div>
                    <form class="login-form" method="post">
                        <input type="text" class="auth-form-input" placeholder="Họ và tên" value="<?= isset($_SESSION['data'])?$_SESSION['data']['fullname']: '' ?>" name="fullname">
                        <input type="email" class="auth-form-input" placeholder="Email" name="email" value="<?= isset($_SESSION['data'])?$_SESSION['data']['email']: '' ?>" >
                        <input type="text" class="auth-form-input" placeholder="Tên đăng nhập" name="username" value="<?= isset($_SESSION['data'])?$_SESSION['data']['username']: '' ?>" >
                        <div class="input-icon">
                            <input type="password" class="auth-form-input" placeholder="Mật khẩu" name="password">
                            <i class="fa fa-eye show-password"></i>
                        </div>
                        <div class="input-icon">
                            <input type="password" class="auth-form-input" placeholder="Xác nhận mật khẩu" name="repassword">
                            <i class="fa fa-eye show-repassword"></i>
                        </div>
                        <div class="footer-action">
                            <input type="submit" value="Đăng ký" class="auth-submit">
                            <a href="<?= BASE_URL . '?act=login' ?>" class="auth-btn-direct">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="auth-action-right">
                <div class="auth-image">
                    <img src="<?= BASE_URL ?>assets/login/assets/vector.jpg" alt="login">
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>assets/login/js/common.js"></script>
</body>
<?php unset($_SESSION['data']) ?>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.querySelector("input[name='password']");
        const repasswordInput = document.querySelector("input[name='repassword']");
        const showPasswordIcon = document.querySelector(".show-password");
        const showRepasswordIcon = document.querySelector(".show-repassword");

        function togglePasswordVisibility(input, icon) {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        showPasswordIcon.addEventListener("click", function() {
            togglePasswordVisibility(passwordInput, showPasswordIcon);
        });

        showRepasswordIcon.addEventListener("click", function() {
            togglePasswordVisibility(repasswordInput, showRepasswordIcon);
        });
    });
</script>