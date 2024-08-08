<?php
function authenShowFormLoginAdmin(){
    if(!empty($_POST)){
        loginAuthen();
    }
    require_once PATH_VIEW_ADMIN . 'authen/login.php';
}
function loginAuthen(){
    $admin = getAdminByUsernameAndPassword('account',$_POST['username'],$_POST['password']);
    if(empty($admin)){
        $_SESSION['errors'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
        header('Location:' . BASE_URL_ADMIN . '?act=login');
        exit();
    }
    
        $_SESSION['admin'] = $admin;
        header('Location:' . BASE_URL_ADMIN );
        exit();
    
}
function logoutAuthen(){
    if(!empty($_SESSION['admin'])){
        session_destroy();
    }
    header('Location:'.BASE_URL);
    exit;
}