<?php
// userListAll
function userListAll()
{
    $title = 'Danh sách tài khoản';
    $view = 'users/list';
    $script = 'listUser';
    $style = 'table';
    $users = listAll('account');
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// userShowOne
function userShowOne($id)
{
    $user = showOne('account', $id);
    if (empty($user)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết tài khoản';
    $view = 'users/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// userCreate
function userCreate()
{
    $script = 'create';
    $style = 'create';
    $title = 'Thêm tài khoản';
    $view = 'users/create';



    if (!empty($_POST)) {
        $data = [
            "username" => $_POST['username'] ?? null,
            "password" => $_POST['password'] ?? null,
            "email" => $_POST['email'] ?? null,
            "phone" => $_POST['phone'] ?? null,
            "fullname" => $_POST['fullname'] ?? null,
            "address" => $_POST['address'] ?? null,
            "role" => $_POST['role'] ?? null,
            'status' => 1,
            'avatar' => $_FILES['avatar'] ?? null,


        ];
        
        $repassword = $_POST['repassword'] ?? null;
        $date = date('Y-m-d');
        $data['create_date'] = $date;
        $errors = validateCreate($data, $repassword);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=user-create');
            exit();
        }
        $avatar = $data['avatar'];
        if (!empty($avatar) && $avatar['size'] > 0) {
            $data['avatar'] = uploadFlie($avatar, 'uploads/users/');
        }else{
            $data['avatar'] = 'uploads/avatar5.png';
        }
        insert('account', $data);
        $_SESSION['success'] = "Bạn đã thêm tài khoản thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=user');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validateCreate
function validateCreate($data, $repassword)
{

    $errors = [];
    // username
    if (empty($data['username'])) {
        $errors[] = 'Bạn cần nhập tên đăng nhập';
    } else if (regaxVietnamese($data['username'])) {
        $errors[] = 'Tên đăng nhập không được có dấu';
    } else if (!checkSameUsername('account', $data['username'])) {
        $errors[] = 'Tên đăng nhập đã được sử dụng';
    }

    // fullname dài tối đa 50 kí tự và bắt buộc nhập
    if (empty($data['fullname'])) {
        $errors[] = 'Bạn cần nhập họ và tên';
    } else if (strlen($data['fullname']) > 50) {
        $errors[] = 'Họ và tên chỉ được phép nhập tối đa 50 kí tự';
    }


    // Email
    if (empty($data['email'])) {
        $errors[] = 'Bạn cần nhập email';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không đúng định dạng';
    } else if (!checkSameEmail('account', $data['email'])) {
        $errors[] = 'Email đã được sử dụng';
    }
    // Password
    if (empty($data['password'])) {
        $errors[] = 'Bạn cần nhập mật khẩu';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
    } else if (regaxVietnamese($data['password'])) {
        $errors[] = 'Mật khẩu không được có dấu';
    }
    elseif (preg_match('/\s/', $data['password'])) {
        $errors[] = 'Mật khẩu không được có khoảng trắng';
    } elseif ($data['password'] != $repassword) {
        $errors[] = 'Nhập lại mật khẩu phải giống nhau mật khẩu';
    }
    // type
   

    if ($data['role'] === null) {
        $errors[] = 'Bạn bắt buộc phải nhập quyền';
    } else if ($data['role'] !=0 && $data['role'] !=1) {
        $errors[] = 'Role chỉ có 2 value 1(Admin) | 0(USER)';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }
    // avatar
    if ($data['avatar']['size']>0 && !empty($data['avatar'])){
        $typeImage =['image/png','image/jpg','image/jpeg'];
        if($data['avatar']['size'] > 2*1024*1024){
            $errors[] ='Không thể tải file quá 2Mb';
        }else if(!in_array($data['avatar']['type'],$typeImage)){
            $errors[] ='Chỉ upload file .png .jpg .jpeg';
        }
    }


    return $errors;
};
// userUpdate
function userUpdate($id)
{
    $user = showOne('account', $id);
    if (empty($user)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($user['username']) ;
    $view = 'users/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "username" => $_POST['username'] ?? $user['username'],
            "email" => $_POST['email'] ?? $user['email'],
            "phone" => $_POST['phone'] ?? $user['phone'],
            "fullname" => $_POST['fullname'] ?? $user['fullname'],
            "address" => $_POST['address'] ?? $user['adrress'],
            "role" => $_POST['role'] ?? $user['role'],
            'status' => 1,
            'avatar' => $_FILES['avatar'] ?? $user['avatar'],

        ];

        $date = date('Y-m-d');
        $data['create_date'] = $date;
        $avatar = $data['avatar'];
        $errors = validateUpdate($data, $id);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            
            
        }else{
            
        if (!empty($avatar) && $avatar['size'] > 0) {
            $data['avatar'] = uploadFlie($avatar, 'uploads/users/');
        }else{
            $data['avatar'] = $user['avatar'];
        }
            update('account', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa tài khoản thành công";
        }


        header('Location:' . BASE_URL_ADMIN . '?act=user-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validate update
function validateUpdate($data, $id)
{

    $errors = [];
    // username
    if (empty($data['username'])) {
        $errors[] = 'Bạn cần nhập tên đăng nhập';
    } else if (regaxVietnamese($data['username'])) {
        $errors[] = 'Tên đăng nhập không được có dấu';
    } else if (!checkSameUsernameById('account', $data['username'],$id)) {
        $errors[] = 'Tên đăng nhập đã được sử dụng';
    }

    // fullname dài tối đa 50 kí tự và bắt buộc nhập
    if (empty($data['fullname'])) {
        $errors[] = 'Bạn cần nhập họ và tên';
    } else if (strlen($data['fullname']) > 50) {
        $errors[] = 'Họ và tên chỉ được phép nhập tối đa 50 kí tự';
    }


    // Email
    if (empty($data['email'])) {
        $errors[] = 'Bạn cần nhập email';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không đúng định dạng';
    } else if (!checkSameEmailById('account', $data['email'],$id)) {
        $errors[] = 'Email đã được sử dụng';
    }
    // Password
    if (empty($data['password'])) {
        $errors[] = 'Bạn cần nhập mật khẩu';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
    } else if (regaxVietnamese($data['password'])) {
        $errors[] = 'Mật khẩu không được có dấu';
    }
    // type
   

    if ($data['role'] === null) {
        $errors[] = 'Bạn bắt buộc phải nhập quyền';
    } else if ($data['role'] !=0 && $data['role'] !=1) {
        $errors[] = 'Role chỉ có 2 value 1(Admin) | 0(USER)';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }
    // 
    if ($data['avatar']['size']>0){
        $typeImage =['image/png','image/jpg','image/jpeg'];
        if($data['avatar']['size'] > 2*1024*1024){
            $errors[] ='Không thể tải file quá 2Mb';
        }else if(!in_array($data['avatar']['type'],$typeImage)){
            $errors[] ='Chỉ upload file .png .jpg .jpeg';
        }
    }

    return $errors;
};

// userDelete
function userDelete($id)
{

    delete_hidden('account', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=user');
    exit();
};
