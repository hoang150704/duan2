<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo đặt hàng thành công</title>
    <!-- Link đến Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link đến Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .notification-box {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            border-left: 6px solid #28a745;
        }
        .notification-icon {
            font-size: 60px;
            color: #28a745;
        }
        .notification-box h4 {
            color: #343a40;
        }
        .notification-box p {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        a{
            text-decoration: none;
            color: white;
            padding: 7px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="notification-box text-center">
                    <div class="notification-icon mb-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="mb-3">Bạn đã đổi email thành công</h3>
                    <p class="mb-4"></p>
                    <a href="<?=BASE_URL. '?act=info'?>" class="btn btn-primary p-3" >Về trang thông tin khách hàng</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link đến Bootstrap JS và Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
