<?php
// productListAll
function productListAll()
{
    $title = 'Danh sách sản phẩm';
    $view = 'products/list';
    $script = 'listUser';
    $style = 'table';
    $products = listAllForProduct();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// productShowOne
function productShowOne($id)
{
    $product = getProductById($id);
    $images = listImageOnProduct($id);
    $listComments = getComment($id);
    $countListComment = count($listComments);
    if (empty($product)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết sản phẩm';
    $view = 'products/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// productCreate
function productCreate()
{
    $script = 'create';
    $script2 = 'tinyMCE';
    $style = 'createproduct';
    $title = 'Thêm sản phẩm';
    $view = 'products/create';


    // Lấy danh mục
    $categories = listAll('category');
    for ($i = 0; $i < count($categories); $i++) {
        $valuesId[] = $categories[$i]['id'];
    }
    // List thuộc tính
    $attributes = listAll('attribute');
    foreach ($attributes as $attribute) {
        $listAllAttributeValues[$attribute['id']] = listAllAttributeById('attribute_value', $attribute['id']);
    }
    if (!empty($_POST)) {
        $type_product = $_POST['type_product'];
        // Sản phẩm chính
        $data = [
            'product_name' => $_POST['product_name'],
            'des' => $_POST['des'],
            'category_id' => $_POST['category_id'],
            'main_image' => get_file_upload('main_image'),
            'status' => 1
        ];

        // validate sản phẩm chính
        validateProductCreate($data, $valuesId);
        // Ảnh đại diện sản phẩm
        $main_image = $data['main_image'];
        if (is_array($main_image)) {
            $data['main_image'] = uploadFlie($main_image, 'uploads/products/');
        }
        // Bắt đầu insert
        try {
            //code...
            $GLOBALS['conn']->beginTransaction();
            // Lấy id sản phẩm vừa thêm
            $product_id = insert_get_last_id('product', $data);
            // XỬ lí nhiều hình ảnh sản phẩm được thêm
            $files = get_file_upload('image');
            $fileNameArr = $files['name'];
            if ($files['size'][0] > 0) {
                for ($i = 0; $i < count($fileNameArr); $i++) {
                    $file = [
                        'name' => $files['name'][$i],
                        'type' => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'size' => $files['size'][$i]
                    ];
                    $fileUpdates[] = uploadFlie($file, 'uploads/products/');
                }
            }
            foreach ($fileUpdates as $fileUpdate) {
                $image = [
                    'product_id' => $product_id,
                    'image' => $fileUpdate
                ];
                insert('image', $image);
            }
            // Xử lí bảng sản phẩm biến thể

            if ($type_product == 1) {
                $detail = [
                    'quantity' => $_POST['quantity'] ?? null,
                    'price' => $_POST['price'] ?? null,
                    'sale_price' => $_POST['sale_price'] ?? null
                ];
                if (empty($detail['price'])) {
                    $detail['price'] = 0;
                }
                if (empty($detail['sale_price'])) {
                    $detail['sale_price'] = 0;
                }
                if (empty($detail['quantity'])) {
                    $detail['quantity'] = 0;
                }
                $id_lookup = insert_get_last_id('product_lookup', $detail);
                $variant = [
                    'product_id' => $product_id,
                    'product_variant_id' => $id_lookup,

                    'attribute_value_id' => 0,

                ];
                insert('product_variant', $variant);
            } else {
                if (isset($_POST['variants'])) {
                    $variants2 = $_POST['variants'];
                }
                foreach ($variants2 as $idPrefix => $variant2) {
                    $lookup = [
                        'price' => $variant2['price'],
                        'sale_price' => $variant2['sale_price'],
                        'quantity' => $variant2['quantity'],
                    ];
                    $lookup_id = insert_get_last_id('product_lookup', $lookup);
                    $attributes2 = $variant2['attributes'];
                    foreach ($attributes2 as $attributes2) {
                        $variant = [
                            'product_id' => $product_id,
                            'product_variant_id' => $lookup_id,
                            'attribute_value_id' => $attributes2,
                        ];
                        insert('product_variant', $variant);
                    }
                }
            }

            $GLOBALS['conn']->commit();
        } catch (\Throwable $th) {
            $GLOBALS['conn']->rollBack();
        }



        $_SESSION['success'] = "Bạn đã thêm sản phẩm thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=product');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validateProductCreate
function validateProductCreate($data, $valuesId)
{

    $errors = [];
    // productname
    if (empty($data['product_name'])) {
        $errors[] = 'Bạn cần nhập tên sản phẩm';
    }
    // 

    if ($data['category_id'] === null) {
        $errors[] = 'Bạn bắt buộc phải nhập danh mục sản phẩm';
    } elseif (!in_array($data['category_id'], $valuesId)) {
        $errors[] = 'Bạn bắt buộc phải nhập danh mục sản phẩm có tồn tại';
    }

    // Ảnh chính sản phẩm
    $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
    if (!is_array($data['main_image'])) {
        $errors[] = 'Bạn cần thêm ảnh đại diện sản phẩm';
    } else if ($data['main_image']['size'] > 2 * 1024 * 1024) {
        $errors[] = 'Không thể tải file quá 2Mb';
    } else if (!in_array($data['main_image']['type'], $typeImage)) {
        $errors[] = 'Chỉ upload file .png .jpg .jpeg';
    }



    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $data;
        header('Location:' . BASE_URL_ADMIN . '?act=product-create');
        exit();
    }
};
// productUpdate
function productUpdate($id)
{
    $script = 'create';
    $script2 = 'tinyMCE';
    $style = 'createproduct';
    $title = 'Thêm sản phẩm';
    $view = 'products/update';
    $product = getProductById($id);
    $attributes = listAll('attribute');
    foreach ($attributes as $attribute) {
        $listAllAttributeValues[$attribute['id']] = listAllAttributeById('attribute_value', $attribute['id']);
    }
    if ($product['attribute_value_id'] != 0) {
        $oldtype = 2;
    } else {
        $oldtype = 1;
    }
    $images = listImageOnProduct($id);
    $categories = listAll('category');
    if (!empty($_POST)) {
        $type_product = $_POST['type_product'];
        $data = [
            'product_name' => $_POST['product_name'] ?? $product['product_name'],
            'des' => $_POST['des'] ?? $product['des'],
            'category_id' => $_POST['category_id'] ?? $product['category_id'],
            'main_image' => get_file_upload('main_image') ?? $product['main_image'],
            'status' => 1
        ];
        $main_image = $data['main_image'];
        if (is_array($main_image)) {
            $data['main_image'] = uploadFlie($main_image, 'uploads/products/');
        } else {
            $data['main_image'] = $product['main_image'];
        }
        update('product', $id, $data);
        // upload list hình ảnh
        $files = get_file_upload('image');
        $fileNameArr = $files['name'];
        if ($files['size'][0] > 0) {
            for ($i = 0; $i < count($fileNameArr); $i++) {
                $file = [
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                ];
                $fileUpdates[] = uploadFlie($file, 'uploads/products/');
            }
        }
        foreach ($fileUpdates as $fileUpdate) {
            $image = [
                'product_id' => $id,
                'image' => $fileUpdate
            ];
            insert('image', $image);
        }
        // Xóa hình ảnh đã có
        $deleted_images = $_POST['deleted_images'];
        foreach ($deleted_images as $deleted_id) {
            delete('image', $deleted_id);
        }
        // Cập nhật giá 
        if ($type_product == $oldtype) {
            if ($type_product == 1) {
                $detail = [
                    'quantity' => $_POST['quantity'] ?? $product['quantity'],
                    'price' => $_POST['price']  ?? $product['price'],
                    'sale_price' => $_POST['sale_price'] ?? $product['sale_price']
                ];
                if (empty($detail['price'])) {
                    $detail['price'] = $product['price'];
                }
                if (empty($detail['sale_price'])) {
                    $detail['sale_price'] = $product['sale_price'];
                }
                if (empty($detail['quantity'])) {
                    $detail['quantity'] = $product['quantity'];
                }
                update('product_lookup', $product['product_lookup_id'], $detail);
            } else {
            }
        } else {
            if ($type_product == 1) {
                deleteProductById($id);
                $detail = [
                    'quantity' => $_POST['quantity'] ?? null,
                    'price' => $_POST['price'] ?? null,
                    'sale_price' => $_POST['sale_price'] ?? null
                ];
                if (empty($detail['price'])) {
                    $detail['price'] = 0;
                }
                if (empty($detail['sale_price'])) {
                    $detail['sale_price'] = 0;
                }
                if (empty($detail['quantity'])) {
                    $detail['quantity'] = 0;
                }
                $id_lookup = insert_get_last_id('product_lookup', $detail);
                $variant = [
                    'product_id' => $id,
                    'product_variant_id' => $id_lookup,

                    'attribute_value_id' => 0,

                ];
                insert('product_variant', $variant);
            }else{
                deleteProductById($id);
                if (isset($_POST['variants'])) {
                    $variants2 = $_POST['variants'];
                }
                foreach ($variants2 as $idPrefix => $variant2) {
                    $lookup = [
                        'price' => $variant2['price'],
                        'sale_price' => $variant2['sale_price'],
                        'quantity' => $variant2['quantity'],
                    ];
                    $lookup_id = insert_get_last_id('product_lookup', $lookup);
                    $attributes2 = $variant2['attributes'];
                    foreach ($attributes2 as $attributes2) {
                        $variant = [
                            'product_id' => $id,
                            'product_variant_id' => $lookup_id,
                            'attribute_value_id' => $attributes2,
                        ];
                        insert('product_variant', $variant);
                    }
                }

            }
        }

        $_SESSION['success'] = "Bạn đã sửa sản phẩm thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=product-update&id=' . $id);
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validate update
function validateProductUpdate($data, $id)
{

    $errors = [];
    // productname
    if (empty($data['productname'])) {
        $errors[] = 'Bạn cần nhập tên đăng nhập';
    } else if (regaxVietnamese($data['productname'])) {
        $errors[] = 'Tên đăng nhập không được có dấu';
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
    } else if (!checkSameEmailById('account', $data['email'], $id)) {
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
    } else if ($data['role'] != 0 && $data['role'] != 1) {
        $errors[] = 'Role chỉ có 2 value 1(Admin) | 0(product)';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }
    // 
    if ($data['avatar']['size'] > 0) {
        $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
        if ($data['avatar']['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Không thể tải file quá 2Mb';
        } else if (!in_array($data['avatar']['type'], $typeImage)) {
            $errors[] = 'Chỉ upload file .png .jpg .jpeg';
        }
    }

    return $errors;
};

// productDelete
function productDelete($id)
{

    delete_hidden('product', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=product');
    exit();
};
