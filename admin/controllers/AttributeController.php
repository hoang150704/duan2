<?php
// List

function attributeListAll()
{
    $title = 'Danh sách thuộc tính';
    $view = 'attributes/list';
    $script = 'listUser';
    $style = 'table';
    $attributes = listAll('attribute');
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// Show one
function attributeShowOne($id)
{
    $attribute = showOne('attribute', $id);
    $attributeValues = listAllAttributeById('attribute_value',$id);
    if (empty($attribute)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết thuộc tính';
    $view = 'attributes/detail';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};


// Delete
function attributeDelete($id)
{

    delete_hidden('attribute', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=attribute');
    exit();
};

// Update
function attributeUpdate($id)
{
    $attribute = showOne('attribute', $id);
    
    if (empty($attribute)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($attribute['attribute_name']) ;
    $view = 'attributes/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "attribute_name" => $_POST['attribute_name'] ?? $attribute['attribute_name'] ,
            'status'        => 1,
        ];
        $errors = validateAttributeUpdate($data, $id);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
                     
        }else{
            update('attribute', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa thuộc tính thành công";
        }

        

        header('Location:' . BASE_URL_ADMIN . '?act=attribute-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// 
function validateAttributeUpdate($data,$id){
    $errors = [];
    if (empty($data['attribute_name'])) {
        $errors[] = 'Bạn cần nhập tên thuộc tính';
    } else if (!checkSameattributeNameById('attribute', $data['attribute_name'],$id)) {
        $errors[] = 'Tên thuộc tính đã tồn tại ở 1 thuộc tính khác';
    }
    return $errors;
}
// Create
function attributeCreate()
{
    $script = 'create';
    $style = 'create';
    $title = 'Thêm thuộc tính';
    $view = 'attributes/create';


    if (!empty($_POST)) {
        $data = [
            "attribute_name" => $_POST['attribute_name'] ?? null,
            "status"   => 1,
        ];
        
        $errors = validateAttributeCreate($data);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=attribute-create');
            exit();
        }
        insert('attribute', $data);
        $_SESSION['success'] = "Bạn đã thêm thuộc tính thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=attribute');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// validate create
function validateAttributeCreate($data){
    $errors = [];
    if (empty($data['attribute_name'])) { 
        $errors[] = 'Bạn cần nhập tên thuộc tính';
    } else if (!checkSameattributeName('attribute', $data['attribute_name'])) {
        $errors[] = 'Tên thuộc tính đã tồn tại';
    }
    return $errors;
}
// userShowOne


