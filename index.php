<?php
session_start();
// require file trong commons
require_once "./commons/env.php";
require_once "./commons/helper.php";
require_once "./commons/connect-db.php";
require_once "./commons/function.php";
// require tự động
require __DIR__ ."/PHPMailer-master/src/PHPMailer.php"; 
require __DIR__ ."/PHPMailer-master/src/SMTP.php"; 
require __DIR__ .'/PHPMailer-master/src/Exception.php';
require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

if(empty($_GET['search'])){
    $search='';
}else{
    $search = $_GET['search'];
}
// Điều hướng
$act=$_GET['act'] ?? '/';
checkCheckout($act);
checkLoginRequired($act);
match ($act) {
    '/' =>homeController($search),
    // Tài khoản
    'login'=>showFormLoginController(), 
    'logout'=>logoutUser(),
    'signup'=>signupUser(),
    'success-signup'=>SignupSuccess(),
    // Thông tin khách hàng
    'info'=>infoUser(),
    'detail-order'=>detailOrder($_GET['id']),
    // Đổi thông tin
    'change-address'=>changeAddress($_GET['id']),
    'change-password'=>changePassword(),
    'change-password-success'=>changePasswordSuccess(),
    'update-user'=>updateUser(),
    'change-email'=>changeEmail( $_GET['check']),
    'success-change-email'=>changeEmailSuccess(),
    'err-email'=>errEmail(),   
    'forgot-password'=>forgotPassword($_GET['check']), 
    'err-forgot'=>errForgot(),
    'success-forgot'=>forgotPasswordSuccess(),
    // Sản phẩm
    'product-detail'=>productDetail($_GET['id']),
    'product-list'=>productList($_GET['id']),
    // Giỏ hàng
    'cart'=>cartView(),
    // Đơn hàng
    'checkout'=>checkoutOrder(),
    'success'=>successOrder(),
    'payment'=>successOrderPayment($_GET['id'],$_GET['check'],$_GET['vnp_TxnRef'],$_GET['vnp_ResponseCode']),
    // 
    'search'=>search($_GET['content']),
    // Nếu không
    default => err()

};

// 
require_once "./commons/disconnect-db.php";

?>