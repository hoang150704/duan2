<?php
// Hiển thị form đăng nhập
function showFormLoginController()
{
    if (!empty($_POST)) {
        if (!empty($_POST)) {
            loginUser();
        }
    }
    require_once PATH_VIEW . 'authen/login.php';
}
// Kiểm tra đăng nhâphj
function isUserLoggedIn()
{
    return isset($_SESSION['user']);
}
// Xử lí đăng nhập
function loginUser()
{

    $user = getUserByUsernameAndPassword('account', $_POST['username'], $_POST['password']);
    if (empty($user)) {
        $_SESSION['errors'] = 'Tên đăng nhập hoặc mật khẩu không đúng';

        header('Location:' . BASE_URL . '?act=login');
        exit();
    }

    $_SESSION['user'] = $user;
    if (isset($_GET['redirect'])) {
        $redirect_url = $_GET['redirect'];
        header('Location:' . $redirect_url);
    } elseif (isset($_SESSION['redirect_after_login'])) {
        $redirect_url = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect_url");
        exit();
    } else {
        // Nếu không có URL nào được lưu trữ, chuyển hướng đến trang mặc định (ví dụ: trang chủ)
        header('Location:' . BASE_URL);
    }
    exit();
}
// Đăng xấu
function logoutUser()
{
    if (!empty($_SESSION['user'])) {
        session_destroy();
    }
    if (isset($_GET['redirect'])) {
        $redirect_url = $_GET['redirect'];
        header('Location:' . $redirect_url);
    } else {
        // Nếu không có URL nào được lưu trữ, chuyển hướng đến trang mặc định (ví dụ: trang chủ)
        header('Location:' . BASE_URL);
    }
    exit();
}
// Quên mật khẩu
function forgotPassword($key)
{
    $check = intval($key);
    // Kiểm tra giá trị $check có hợp lệ hay không
    $validChecks = [1, 2, 3, 4];
    if (!in_array($check, $validChecks) || !isset($check)) {
        if (isset($_SESSION['step'])) {
            unset($_SESSION['step']);
        }
        header('Location: ' . BASE_URL . '?act=err-forgot');
        exit;
    }

    // Kiểm tra giá trị $check hợp lệ dựa trên phiên làm việc
    if (!isset($_SESSION['step'])) {
        $_SESSION['step'] = 1;
    }

    // Nếu giá trị $check không khớp với giá trị bước hiện tại hoặc bước kế tiếp, chuyển hướng về bước hợp lệ
    if ($check > $_SESSION['step']) {
        header('Location: ' . BASE_URL . '?act=forgot-password&check=' . $_SESSION['step']);
        exit;
    }
    $_SESSION['step'] = $check;
    if ($check == 1) {
        $style1 = 'style="display: block;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: none;"';
        // 
        if (!empty($_POST)) {
            $user = getPasswordByEmail($_POST['email']);
            if (empty($user)) {
                $_SESSION['errors'] = 'Email không tồn tại trên hệ thống';
            } else {
                $titleEmail = "Mã xác nhận đổi mật khẩu";
                $session_lifetime = 180; // 3 phút

                // Kiểm tra nếu mã xác nhận đã tồn tại và đã hết hạn
                if (isset($_SESSION['verification']) && isset($_SESSION['created'])) {
                    if (time() - $_SESSION['created'] > $session_lifetime) {
                        unset($_SESSION['verification']);
                        unset($_SESSION['created']);
                    }
                }

                // Tạo mã xác nhận mới nếu không tồn tại
                if (!isset($_SESSION['verification'])) {
                    $verification = generateRandomCode();
                    $_SESSION['verification'] = $verification;
                    $_SESSION['created'] = time();
                }

                $body = "Mã xác nhận của bạn là: " . $_SESSION['verification'] . ". Mã chỉ tồn tại trong 3 phút.";
                $kq = SendMail($_POST['email'], $titleEmail, $body);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['step'] = 2;
                header('Location: ' . BASE_URL . '?act=forgot-password&check=2');
                exit;
            }
        }
    }
    if ($check == 2) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: block;"';
        $style3 = 'style="display: none;"';
        // 
        if (!empty($_POST)) {
            if (time() - $_SESSION['created'] > 180) {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                $_SESSION['errors'] = "Mã xác nhận đã hết hạn. Vui lòng thử lại.";
                header('Location: ' . BASE_URL . '?act=forgot-password&check=1');
                exit;
            }

            if ($_POST['vericode'] != $_SESSION['verification']) {
                $_SESSION['errors'] = "Bạn nhập mã không đúng";
                header('Location: ' . BASE_URL . '?act=forgot-password&check=2');
                exit;
            } else {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                $_SESSION['step'] = 3;
                header('Location: ' . BASE_URL . '?act=forgot-password&check=3');
                exit;
            }
        }
    }
    if ($check == 3) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: block;"';
        // 
        if (!empty($_POST)) {
            $repass = $_POST['repassword'];
            $data = [
                'password' => $_POST['password'],
            ];
            if (empty($data['password'])) {
                $_SESSION['errors'] = "Bạn phải nhập mật khẩu";
            } elseif (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
                $_SESSION['errors'] = "Mật khẩu phải lớn hơn bằng 8 kí tự và không quá 20 kí tự";
            } elseif (preg_match('/\s/', $data['password'])) {
                $_SESSION['errors'] = "Mật khẩu không được có khoảng trắng";
            } elseif (regaxVietnamese($data['password'])) {
                $_SESSION['errors'] = "Mật khẩu không được có dấu";
            } elseif ($repass != $data['password']) {
                $_SESSION['errors'] = "Mật khẩu mới phải trung với nhập lại mật khẩu";
                header('Location: ' . BASE_URL . '?act=forgot-password&check=3');
                exit;
            } else {

                update('account', $_SESSION['user_id'], $data);
                unset($_SESSION['user_id']);
                unset($_SESSION['step']);
                header('Location: ' . BASE_URL . '?act=success-forgot');
                exit;
            }
        }
    }
    require_once PATH_VIEW . 'authen/forgotPassword.php';
}
// Lấy lại mật khẩu thành cong
function forgotPasswordSuccess()
{
    require_once PATH_VIEW . 'authen/success_forgot.php';
}
function SignupSuccess()
{
    require_once PATH_VIEW . 'authen/success_sign.php';
}
// Đăng kí tài khoản

function signupUser()
{
    if (!empty($_POST)) {
        $data = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'avatar' => 'uploads/avatar5.png',
            'status' => 1,
            'role' => 0,
            'create_date' => date('Y-m-d')
        ];
        $repassword = $_POST['repassword'];
        $errors = validateSignup($data, $repassword);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL . '?act=signup');
            exit();
        } else {
            insert('account', $data);
            header('Location:' . BASE_URL . '?act=success-signup');
            exit();
        }
    }



    require_once PATH_VIEW . 'authen/register.php';
}
// Validate đăng kí
// validateCreate
function validateSignup($data, $repassword)
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
    } elseif (preg_match('/\s/', $data['password'])) {
        $errors[] = 'Mật khẩu không được có khoảng trắng';
    } elseif ($data['password'] != $repassword) {
        $errors[] = 'Nhập lại mật khẩu phải giống nhau mật khẩu';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }



    return $errors;
};

// Thông tin người dùng
function infoUser()
{
    $view = 'authen/info';
    $style = 'style/info';
    $script = 'info';
    $comments = getCommentForUser($_SESSION['user']['id']);
    $statusOrders = getAllStatusOrder();
    $orders = listAllOrderByAccountId($_SESSION['user']['id']);
    $order_detail = listAllDetailOrder();
    $histories = listAllHistoryOrder();
    $combinedData = [];
    foreach ($statusOrders as $statusOrder) {
        $statusId = $statusOrder['id'];
        $combinedData[$statusId] = [
            'status' => $statusOrder,
            'orders' => []
        ];
    }

    // Duyệt qua từng đơn hàng
    foreach ($orders as $order) {
        $statusId = $order['status_id'];

        // Tạo một mảng chứa thông tin đơn hàng hiện tại
        $orderData = [
            'order' => $order,
            'details' => [],
            'history' => []
        ];

        // Tìm các chi tiết sản phẩm thuộc đơn hàng hiện tại
        foreach ($order_detail as $detail) {
            if ($detail['order_id'] == $order['id']) {
                $orderData['details'][] = $detail;
            }
        }

        // Tìm lịch sử trạng thái thuộc đơn hàng hiện tại
        foreach ($histories as $history) {
            if ($history['order_id'] == $order['id']) {
                $orderData['history'][] = $history;
            }
        }

        // Thêm dữ liệu đơn hàng vào mảng tổng hợp theo trạng thái
        $combinedData[$statusId]['orders'][] = $orderData;
    }



    require_once PATH_VIEW . 'layouts/master.php';
}
// Đổi mật khẩu
function changePassword()
{
    $view = 'authen/changePassword';
    $style = 'style/info';
    $script = 'info';
    if (!empty($_POST)) {
        $data = [
            'password' => $_POST['password']
        ];
        $repass = $_POST['rePassword'];
        $oldpass = $_POST['oldPassword'];
        $errors = [];
        if (empty($oldpass)) {
            $errors = 'Mật khẩu cũ không được để trống';
        } else if ($oldpass != $_SESSION['user']['password']) {
            $errors = 'Bạn đã nhập sai mật khẩu cũ';
        } else {
            if (empty($data['password'])) {
                $errors = 'Mật khẩu mới không được để trống';
            } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
                $errors = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
            } elseif (preg_match('/\s/', $data['password'])) {
                $errors = 'Mật khẩu không được có khoảng trắng';
            } else if (regaxVietnamese($data['password'])) {
                $errors = 'Mật khẩu không được có dấu';
            } else if ($data['password'] != $repass) {
                $errors = 'Mật khẩu mới và nhập lại mật khẩu mới phải giống nhau';
            }
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ' . BASE_URL . '?act=change-password');
            exit;
        } else {
            update('account', $_SESSION['user']['id'], $data);
            session_destroy();
            header('Location: ' . BASE_URL . '?act=change-password-success');
            exit;
        }
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Thành công
function changePasswordSuccess()
{
    require_once PATH_VIEW . 'authen/success_change_pass.php';
}
// Up date
function updateUser()
{
    $view = 'authen/update';
    $style = 'style/info';
    $script = 'info';
    if (!empty($_POST)) {
        $data = [
            'fullname' => $_POST['fullname'] ?? $_SESSION['user']['fullname'],
            'address' => $_POST['address'] ?? $_SESSION['user']['address'],
            'phone' => $_POST['phone'] ?? $_SESSION['user']['phone'],
            'avatar' => $_FILES['avatar'] ?? $_SESSION['user']['avatar'],
        ];
        $avatar = $data['avatar'];
        $errors = [];
        if (empty($data['fullname']) || ctype_space($data['fullname'])) {
            $errors[] = 'Vui lòng nhập tên.';
        } else {
            // Xử lý nếu tên hợp lệ
            $data['fullname'] = ltrim($data['fullname']);
        }

        if (empty($data['address']) || ctype_space($data['address'])) {
            $errors[] = 'Vui lòng nhập địa chỉ.';
        } else {
            // Xử lý nếu địa chỉ hợp lệ
            $data['address'] = ltrim($data['address']);
        }

        // Xử lí số đt
        $data['phone'] = preg_replace('/\s+/', '', $data['phone']);
        if (empty($data['phone']) || ctype_space($data['phone'])) {
            $errors[] = 'Vui lòng nhập số điện thoại.';
        } elseif (!ctype_digit($data['phone'])) {
            $errors[] = 'Số điện thoại chỉ được chứa số.';
        } elseif (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
        // Xử lí hình nahr
        if ($data['avatar']['size'] > 0) {
            $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
            if ($data['avatar']['size'] > 2 * 1024 * 1024) {
                $errors[] = 'Không thể tải file quá 2Mb';
            } else if (!in_array($data['avatar']['type'], $typeImage)) {
                $errors[] = 'Chỉ upload file .png .jpg .jpeg';
            }
        }
        // XỬ lí xem có lỗi không
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            if (!empty($avatar) && $avatar['size'] > 0) {
                $data['avatar'] = uploadFlie($avatar, 'uploads/users/');
            } else {
                $data['avatar'] = $_SESSION['user']['avatar'];
            }
            update('account', $_SESSION['user']['id'], $data);
            $_SESSION['user']['fullname'] = $data['fullname'];
            $_SESSION['user']['address'] = $data['address'];
            $_SESSION['user']['phone'] = $data['phone'];
            $_SESSION['user']['avatar'] = $data['avatar'];
            $_SESSION['success'] = 'Bạn đã thay đổi thông tin thành công';
        }
        header('Location: ' . BASE_URL . '?act=update-user');
        exit;
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Đổi email
function changeEmail($key)
{
    $check = intval($key);
    // Kiểm tra giá trị $check có hợp lệ hay không
    $validChecks = [1, 2, 3, 4];
    if (!in_array($check, $validChecks) || !isset($check)) {
        if (isset($_SESSION['step'])) {
            unset($_SESSION['step']);
        }
        header('Location: ' . BASE_URL . '?act=err-email');
        exit;
    }

    // Kiểm tra giá trị $check hợp lệ dựa trên phiên làm việc
    if (!isset($_SESSION['step'])) {
        $_SESSION['step'] = 1;
    }

    // Nếu giá trị $check không khớp với giá trị bước hiện tại hoặc bước kế tiếp, chuyển hướng về bước hợp lệ
    if ($check > $_SESSION['step']) {
        header('Location: ' . BASE_URL . '?act=change-email&check=' . $_SESSION['step']);
        exit;
    }
    $_SESSION['step'] = $check;

    $view = 'authen/changeEmail';
    $style = 'style/info';
    $script = 'info';

    if ($check == 1) {
        $style1 = 'style="display: block;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: none;"';

        if (!empty($_POST)) {
            if ($_POST['email'] != $_SESSION['user']['email']) {
                $_SESSION['errors'] = "Email của bạn không đúng";
                header('Location: ' . BASE_URL . '?act=change-email&check=1');
                exit;
            } else {
                $titleEmail = "Xác nhận email";
                $session_lifetime = 180; // 3 phút

                // Kiểm tra nếu mã xác nhận đã tồn tại và đã hết hạn
                if (isset($_SESSION['verification']) && isset($_SESSION['created'])) {
                    if (time() - $_SESSION['created'] > $session_lifetime) {
                        unset($_SESSION['verification']);
                        unset($_SESSION['created']);
                    }
                }

                // Tạo mã xác nhận mới nếu không tồn tại
                if (!isset($_SESSION['verification'])) {
                    $verification = generateRandomCode();
                    $_SESSION['verification'] = $verification;
                    $_SESSION['created'] = time();
                }

                $body = "Mã xác nhận của bạn là: " . $_SESSION['verification'] . ". Mã chỉ tồn tại trong 3 phút.";
                $kq = SendMail($_POST['email'], $titleEmail, $body);
                $_SESSION['step'] = 2;
                header('Location: ' . BASE_URL . '?act=change-email&check=2');
                exit;
            }
        }
    }

    if ($check == 2) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: block;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: none;"';

        if (!empty($_POST)) {
            if (time() - $_SESSION['created'] > 180) {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                $_SESSION['errors'] = "Mã xác nhận đã hết hạn. Vui lòng thử lại.";
                header('Location: ' . BASE_URL . '?act=change-email&check=1');
                exit;
            }

            if ($_POST['verification'] != $_SESSION['verification']) {
                $_SESSION['errors'] = "Bạn nhập mã không đúng";
                header('Location: ' . BASE_URL . '?act=change-email&check=2');
                exit;
            } else {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                $_SESSION['step'] = 3;
                header('Location: ' . BASE_URL . '?act=change-email&check=3');
                exit;
            }
        }
    }

    if ($check == 3) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: block;"';
        $style4 = 'style="display: none;"';

        if (!empty($_POST)) {
            $newemail = checkSameEmailUserById('account', $_POST['newemail'], $_SESSION['user']['id']);
            if ($_SESSION['user']['email'] == $_POST['newemail']) {
                $_SESSION['errors'] = "Email mới không được trùng với email cũ";
            } elseif (!$newemail) {
                $_SESSION['errors'] = "Email bạn nhập đã được đăng kí tài khoản khác";
            }
            if (!empty($_SESSION['errors'])) {
                header('Location: ' . BASE_URL . '?act=change-email&check=3');
                exit;
            } else {
                $_SESSION['newemail'] = $_POST['newemail'];
                $_SESSION['step'] = 4;
                header('Location: ' . BASE_URL . '?act=change-email&check=4');
                exit;
            }
        }
    }

    if ($check == 4) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: block;"';

        if (!empty($_POST)) {
            if ($_SESSION['user']['password'] != $_POST['password']) {
                $_SESSION['errors'] = "Mật khẩu sai";
                header('Location: ' . BASE_URL . '?act=change-email&check=4');
                exit;
            } else {
                $data = [
                    'email' => $_SESSION['newemail']
                ];
                update('account', $_SESSION['user']['id'], $data);
                $_SESSION['user']['email'] = $_SESSION['newemail'];
                unset($_SESSION['newemail']);
                unset($_SESSION['step']);
                header('Location: ' . BASE_URL . '?act=success-change-email');
                exit;
            }
        }
    }

    require_once PATH_VIEW . 'layouts/master.php';
}

// Random code
function generateRandomCode()
{
    return rand(100000, 999999);
}
// ĐỔi email thành công
function changeEmailSuccess()
{
    require_once PATH_VIEW . 'authen/success-email.php';
}
// Lỗi 
function errEmail()
{
    require_once PATH_VIEW . 'authen/err-email.php';
}
// Lỗi
function errForgot()
{
    require_once PATH_VIEW . 'authen/err-forgot.php';
}
