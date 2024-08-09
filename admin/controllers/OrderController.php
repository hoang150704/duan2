<?php
// orderListAll
function orderListAll()
{
    $title = 'Danh sách đơn hàng';
    $view = 'orders/list';
    $script = 'listUser';
    $style = 'table';
    $status_orders = listAll('status_order');
    $status_id = 0;
    $order_code = '';
    if (!empty($_POST['status_id'])) {
        $status_id = $_POST['status_id'];
    }
    if (!empty($_POST['order_code'])) {
        $order_code = $_POST['order_code'];
    }
    $orders = listAllForOrder($status_id, $order_code);


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// orderShowOne
function orderShowOne($id)
{
    $order = showOneForOrder($id);
    if (empty($order)) {
        e404();
    }
    $account = getAccountOnOrder($order['account_id']);
    $details = getDetailOnOrder($order['id']);
  
    $i = 0;
    $allMoney = 0;
    foreach ($details as $detail) {
        $total_money[$i] = $detail['product_price'] * $detail['detail_quantity'];
        $allMoney = $allMoney + $total_money[$i];
        $i++;
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết đơn hàng';
    $view = 'orders/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};



// orderUpdate
function orderUpdate($id)
{
    $order = showOne('order_shop', $id);
    $_SESSION['status_id'] = $order['status_id'];
    if (empty($order)) {
        e404();
    }
    $details = getDetailOnOrder($order['id']);
    
    $status_orders = listAll('status_order');
    $title = 'Cập nhật thông tin đơn hàng ' . '#' . ucfirst($order['id']);
    $view = 'orders/update';
    $script = 'create';
    $style = 'create';
    // Khi người dùng nhấn submit
    if (!empty($_POST)) {
        // Lấy data đơn hàng chính
        $data = [
            "order_account_name" => !empty($_POST['order_account_name']) ? $_POST['order_account_name'] : $order['order_account_name'],
            "order_phone" => !empty($_POST['order_phone']) ? $_POST['order_phone'] : $order['order_phone'],
            "order_address" => !empty($_POST['order_address']) ? $_POST['order_address'] : $order['order_address'],
            "total_money" => !empty($_POST['total_money']) ? $_POST['total_money'] : $order['total_money'],
            "shipping" => !empty($_POST['shipping']) ? $_POST['shipping'] : 0,
            "note" => !empty($_POST['note']) ? $_POST['note'] : $order['note'],
            "status_id" => !empty($_POST['status_id']) ? $_POST['status_id'] : $order['status_id'],

        ];
        // Kiểm tra lỗi
        $errors = validateUpdateOrder($data, $id);
        // Nếu có lỗi thì ngừng chạy
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location:' . BASE_URL_ADMIN . '?act=order-update&id=' . $id);
            exit();
        }
        // Nếu  chọn đã hoàn thành thì cập nhật ngày hoàn thành 
        if ($data['status_id'] == 5) {
            $data['date_success_order'] = date('Y-m-d');
        }
        // Nếu hủy thì update lại số lượng
        if ($data['status_id'] == 6) {
            foreach ($details as $detail) {
                $product_lookup = showOne('product_lookup', $detail['product_lookup_id']);
                $quantity = $detail['detail_quantity'] + $product_lookup['quantity'];
                $data_product = [
                    'quantity' => $quantity
                ];
                update('product_lookup', $detail['product_lookup_id'], $data_product);
            }
        }
        // Nếu đã hoàn hàng về kho 
        if ($data['status_id'] == 8) {
            foreach ($details as $detail) {
                $product_lookup = showOne('product_lookup', $detail['product_lookup_id']);
                $quantity = $detail['detail_quantity'] + $product_lookup['quantity'];
                $data_product = [
                    'quantity' => $quantity
                ];
                update('product_lookup', $detail['product_lookup_id'], $data_product);
            }
        }
        // Update đơn hàng chính
        update('order_shop', $id, $data);
        // Nếu người dùng cập nhật trạng thái mới cho đơn hàng thì update vào lịch sử trạng thái đơn hàng
        if ($data['status_id'] != $_SESSION['status_id']) {
            $data1 = [
                'order_id' => $id,
                'status_id' => $data['status_id'],
            ];
            insert('order_status_history', $data1);
        }
        // Tiên hàng nhập số lượng cho đơn hàng chi tiết
        $arr = [3, 4, 5, 6, 7, 8, 9]; 
        // Nếu trạng thái đơn hàng không nằm trong mảng các trạng thái không được sửa số lượng thì lấy số lượng mới lên
        if (!in_array($data['status_id'], $arr)) {
            $details_data = [
                "detail_quantity" => $_POST['detail_quantity'] ?? $order['detail_quantity'],
            ];

            $i = 0;
            $errors = [];
            // Update số lượng đơn hàng chi tiết
            foreach ($details as $de) {
                $new_quantity = $details_data['detail_quantity'][$i];
                $old_quantity = $de['detail_quantity'];
                $product_lookup = showOne('product_lookup', $de['product_lookup_id']);
                $product_quantity = $product_lookup['quantity'];

                if ($new_quantity > $old_quantity) {
                    // Tính toán chênh lệch
                    $difference = $new_quantity - $old_quantity;

                    // Kiểm tra xem có đủ số lượng sản phẩm không
                    if ($product_quantity < $difference) {
                        $errors[] = "Số lượng sản phẩm trong kho là " . $product_quantity . ". Bạn không thể tăng số lượng sản phẩm";
                        break; // Ngừng xử lý nếu có lỗi
                    }

                    // Cập nhật số lượng chi tiết đơn hàng
                    $detail_data = [
                        "detail_quantity" => $new_quantity,
                    ];
                    update('detail_order', $de['id'], $detail_data);

                    // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
                    $product_lookup_quantity = [
                        'quantity' => $product_quantity - $difference,
                    ];
                    update('product_lookup', $de['product_lookup_id'], $product_lookup_quantity);
                } elseif ($new_quantity < $old_quantity) {
                    // Tính toán chênh lệch
                    $difference = $old_quantity - $new_quantity;

                    // Cập nhật số lượng chi tiết đơn hàng
                    $detail_data = [
                        "detail_quantity" => $new_quantity,
                    ];
                    update('detail_order', $de['id'], $detail_data);

                    // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
                    $product_lookup_quantity = [
                        'quantity' => $product_quantity + $difference,
                    ];
                    update('product_lookup', $de['product_lookup_id'], $product_lookup_quantity);
                }

                $i++;
            }
            //  Kiểm tra lỗi lần 2
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ' . BASE_URL_ADMIN . '?act=order-update&id=' . $id);
                exit();
            }
        }
        // Nếu không có lỗi thì báo lỗi thành công
        $_SESSION['success'] = "Bạn đã sửa đơn hàng thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=order-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// validate update
function validateUpdateOrder($data, $id)
{
    $errors = [];

    // Kiểm tra các trường bắt buộc
    if (empty($data['order_account_name'])) {
        $errors[] = 'Tên khách hàng không được để trống.';
    }
    if (!regaxPhone($data['order_phone'])) {
        $errors[] = 'Số điện thoại chưa đúng định dạng';
    }
    if (empty($data['order_address'])) {
        $errors[] = 'Địa chỉ không được để trống.';
    }
    if (empty($data['total_money']) || $data['total_money'] <= 0) {
        $errors[] = 'Tổng số tiền phải lớn hơn 0.';
    }

    if (empty($data['status_id'])) {
        $errors[] = 'Trạng thái đơn hàng không được để trống.';
    }

    return $errors;
}

// orderDelete
function orderDelete($id)
{

    delete_hidden('order_shop', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=order');
    exit();
};
