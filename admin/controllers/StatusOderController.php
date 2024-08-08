<?php
// List

function statusOrderListAll()
{
    $title = 'Danh sách trạng thái đơn hàng';
    $view = 'status_order/list';
    $script = 'listUser';
    $style = 'table';
    $status_orders = listAll('status_order');
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// Show one
function statusOrderShowOne($id)
{
    $status_order = showOne('status_order', $id);
    if (empty($status_order)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết trạng thái đơn hàng';
    $view = 'status_order/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};


// Delete
function statusOrderDelete($id)
{

    delete_hidden('status_order', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=status_order');
    exit();
};

// Update
function statusOrderUpdate($id)
{
    $status_order = showOne('status_order', $id);
    
    if (empty($status_order)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($status_order['status_order_name']) ;
    $view = 'status_order/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "status_order_name" => $_POST['status_order_name'] ?? $status_order['status_order_name'] ,
            'status'        => 1,
        ];
        $errors = validateStatusOrderUpdate($data, $id);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
                     
        }else{
            update('status_order', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa trạng thái đơn hàng thành công";
        }

        

        header('Location:' . BASE_URL_ADMIN . '?act=status_order-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// 
function validateStatusOrderUpdate($data,$id){
    $errors = [];
    if (empty($data['status_order_name'])) {
        $errors[] = 'Bạn cần nhập tên trạng thái đơn hàng';
    } else if (!checkSameStatusOrderNameById('status_order', $data['status_order_name'],$id)) {
        $errors[] = 'Tên trạng thái đơn hàng đã tồn tại ở 1 trạng thái đơn hàng khác';
    }
    return $errors;
}
// Create
function statusOrderCreate()
{
    $script = 'create';
    $style = 'create';
    $title = 'Thêm trạng thái đơn hàng';
    $view = 'status_order/create';



    if (!empty($_POST)) {
        $data = [
            "status_order_name" => $_POST['status_order_name'] ?? null,
            "status"   => 1,
        ];
        
        $errors = validateStatusOrderCreate($data);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=status_order-create');
            exit();
        }
        insert('status_order', $data);
        $_SESSION['success'] = "Bạn đã thêm trạng thái đơn hàng thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=status_order');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// validate create
function validateStatusOrderCreate($data){
    $errors = [];
    if (empty($data['status_order_name'])) {
        $errors[] = 'Bạn cần nhập tên trạng thái đơn hàng';
    } else if (!checkSameStatusOrderName('status_order', $data['status_order_name'])) {
        $errors[] = 'Tên trạng thái đơn hàng đã tồn tại';
    }
    return $errors;
}
// userShowOne


