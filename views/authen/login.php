<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                    <div class="d-flex flex-column mt-5">
                        <h2 class="auth-form-title ">
                            Đăng nhập
                        </h2>
                    </div>
                    <?php if (isset($_SESSION['errors'])) : ?>
                        <div class="alert alert-danger">

                            <p><?= $_SESSION['errors'] ?></p>

                        </div>
                        <?php unset($_SESSION['errors']) ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['warningLogin'])) : ?>
                        <div class="alert alert-warning">

                            <p><?= $_SESSION['warningLogin'] ?></p>

                        </div>
                        <?php unset($_SESSION['warningLogin']) ?>
                    <?php endif ?>
                    <form class="login-form" method="post">
                        <input type="text" class="auth-form-input" placeholder="Username" name="username">
                        <div class="input-icon">
                            <input type="password" class="auth-form-input" placeholder="Password" name="password">
                            <i class="fa fa-eye show-password"></i>
                        </div>
                       
                        <div class="footer-action">
                            <input type="submit" value="Đăng nhập" class="auth-submit">
                            <a href="<?= BASE_URL . '?act=forgot-password&check=1' ?>" class="auth-btn-direct">Quên mật khẩu</a>
                        </div>
                        <p>Bạn chưa có tài khoản ? <a href="<?= BASE_URL . '?act=signup' ?>">Đăng kí</a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>assets/login/js/common.js"></script>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.querySelector("input[name='password']");
        const showPasswordIcon = document.querySelector(".show-password");

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
    });
</script>
