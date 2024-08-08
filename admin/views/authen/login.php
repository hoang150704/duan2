<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= BASE_URL ?>assets/admin/index2.html" class=""><b>Đăng nhập với Admin</b></a>
    </div>
    <?php if (isset($_SESSION['errors'])) : ?>
      <div class="alert alert-danger">
        
          <p><?= $_SESSION['errors'] ?></p>

        
      </div>
      <?php unset($_SESSION['errors']) ?>
    <?php endif ?>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body d-flex justify-conten-center flex-column">
        <img height="50px" class="mb-4 img-fluid" src="<?= BASE_URL . 'uploads/logoHDT1.png' ?>" alt="">

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="username" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Nhớ thông tin
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">Quên mật khẩu ?</a>
        </p>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= BASE_URL ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= BASE_URL ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= BASE_URL ?>assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>