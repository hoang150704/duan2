<?php
if (!function_exists('require_file')) {
    function require_file($pathFolder)
    {
        $files = array_diff(scandir($pathFolder), ['.', '..']);

        foreach ($files as $file) {
            require_once $pathFolder . $file;
        }
    }
}

if (!function_exists('debug')) {
    function debug($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }
}

if (!function_exists('e404')) {
    function e404()
    {
        echo "404 - Not found";
        die;
    }
}

if (!function_exists('uploadFlie')) {
    function uploadFlie($file, $pathFolderUpload)
    {

        $imagePath = $pathFolderUpload . time() . basename($file['name']);

        if (move_uploaded_file($file["tmp_name"], PATH_UPLOAFD . $imagePath)) {
            return $imagePath;
        }
        return null;
    }
}
if (!function_exists('get_file_upload')) {
    function get_file_upload($field, $default = null)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['size'] > 0) {
            return $_FILES[$field];
        }
        return $default ?? null;
    }
}

if (!function_exists('regaxPhone')) {
    function regaxPhone($phone)
    {


        $regex = '/^(07|03|08|09|05|847|843|848|849|845|\+847|\+843|\+848|\+849|\+845)([0-9]{8})$/';

        return preg_match($regex, $phone);
    }
}
if (!function_exists('regaxVietnamese')) {
    function regaxVietnamese($data)
    {


        $regex = '/[àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]/u';

        return preg_match($regex, $data);
    }
}
// 
if (!function_exists('checkLoginAuthen')) {
    function checkLoginAuthen($act)
    {
        if ($act == 'login') {
            if (!empty($_SESSION['admin'])) {
                header('Location:' . BASE_URL_ADMIN);
                exit();
            }
        } else if (empty($_SESSION['admin'])) {
            header('Location:' . BASE_URL_ADMIN . '?act=login');
            exit();
        }
    }
}

// Check giỏ hàng
if (!function_exists('checkCheckout')) {
    function checkCheckout($act)
    {
        if ($act == 'checkout') {
            if (empty($_SESSION['order'])) {
                header('Location:' . BASE_URL . '?act=cart');
                exit();
            }
        }
    }
}
// 
if (!function_exists('checkLoginRequired')) {
    function checkLoginRequired($act)
    {
        $protectedActions = [
            'info',
            'order',
            'change-password',
            'change-password-success',
            'update-user',
            'change-email',
            'success-change-email',
            'err-email',
            'detail-order'

        ];

        if (in_array($act, $protectedActions)) {
            if (empty($_SESSION['user'])) { // Assuming you store user login status in $_SESSION['user']
                header('Location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }
}
