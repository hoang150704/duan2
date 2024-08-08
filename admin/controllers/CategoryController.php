<?php
// List
function categoryListAll()
{
    $title = 'Danh sách danh mục';
    $view = 'categories/list';
    $script = 'listUser';
    $style = 'table';
    $categories = listAll('category');
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// Show one
function categoryShowOne($id)
{
    $category = showOne('category', $id);
    if (empty($category)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết danh mục';
    $view = 'categories/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};


// Delete
function categoryDelete($id)
{

    delete_hidden('category', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=category');
    exit();
};

// Update
function categoryUpdate($id)
{
    $category = showOne('category', $id);
    
    if (empty($category)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($category['category_name']) ;
    $view = 'categories/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "category_name" => $_POST['category_name'] ?? $category['category_name'] ,
            'status'        => 1,
        ];
        $errors = validateCatogoryUpdate($data, $id);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
                     
        }else{
            update('category', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa danh mục thành công";
        }

        

        header('Location:' . BASE_URL_ADMIN . '?act=category-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// 
function validateCatogoryUpdate($data,$id){
    $errors = [];
    if (empty($data['category_name'])) {
        $errors[] = 'Bạn cần nhập tên danh mục';
    } else if (!checkSameCategoryNameById('category', $data['category_name'],$id)) {
        $errors[] = 'Tên danh mục đã tồn tại ở 1 danh mục khác';
    }
    return $errors;
}
// Create
function categoryCreate()
{
    $script = 'create';
    $style = 'create';
    $title = 'Thêm danh mục';
    $view = 'categories/create';



    if (!empty($_POST)) {
        $data = [
            "category_name" => $_POST['category_name'] ?? null,
            "status"   => 1,
        ];
        
        $errors = validateCatogoryCreate($data);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=category-create');
            exit();
        }
        insert('category', $data);
        $_SESSION['success'] = "Bạn đã thêm danh mục thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=category');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// validate create
function validateCatogoryCreate($data){
    $errors = [];
    if (empty($data['category_name'])) {
        $errors[] = 'Bạn cần nhập tên danh mục';
    } else if (!checkSameCategoryName('category', $data['category_name'])) {
        $errors[] = 'Tên danh mục đã tồn tại';
    }
    return $errors;
}
// userShowOne


