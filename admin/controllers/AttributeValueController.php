<?php
function attributeValueCreate($id)
{
    $script = 'create';
    $style = 'create';
    $title = 'Thêm giá trị thuộc tính';
    $view = 'attribute_values/create';



    if (!empty($_POST)) {
        $data = [
            "attribute_value_name" => $_POST['attribute_value_name'] ?? null,
            "attribute_id"         =>$id,
            "status"               => 1,
        ];
        
        $errors = validateAttributeValueCreate($data);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=attributeValue-create&id='.$id);
            exit();
        }
        insert('attribute_value', $data);
        $_SESSION['success'] = "Bạn đã thêm giá trị thuộc tính thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=attribute-detail&id='.$id);
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// 
function validateAttributeValueCreate($data){
    $errors = [];
    if (empty($data['attribute_value_name'])) {
        $errors[] = 'Bạn cần nhập tên giá trị thuộc tính';
    } else if (!checkSameAttributeValueName('attribute_value', $data['attribute_value_name'])) {
        $errors[] = 'Tên giá trị thuộc tính đã tồn tại';
    }
    return $errors;
} 
// 
function attributeValueDelete($idAttribute,$id)
{

    delete_hidden('attribute', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=attribute-detail&id='.$idAttribute);
    exit();
};
// 
function attributeValueUpdate($idAttribute,$id)
{
    $attributeValue = showOne('attribute_value', $id);
    
    if (empty($attributeValue)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($attributeValue['attribute_value_name']) ;
    $view = 'attribute_values/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "attribute_value_name" => $_POST['attribute_value_name'] ?? $attributeValue['attribute_value_name'] ,
            'status'               => 1,
  
        ];
        
        $errors = validateAttributeValueUpdate($data, $id);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
                     
        }else{
            update('attribute_value', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa giá trị thuộc tính thành công";
        }

        

        header('Location:' . BASE_URL_ADMIN . '?act=attributeValue-update&idat='.$idAttribute.'&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
function validateAttributeValueUpdate($data,$id){
    $errors = [];
    if (empty($data['attribute_value_name'])) {
        $errors[] = 'Bạn cần nhập tên giá trị thuộc tính';
    } else if (!checkSameAttributeValueNameById('attribute_value', $data['attribute_value_name'],$id)) {
        $errors[] = 'Tên giá trị thuộc tính đã tồn tại ở 1 thuộc tính khác';
    }
    return $errors;
}
// 