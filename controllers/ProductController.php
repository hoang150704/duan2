<?php
function productDetail($id)
{
    $view = 'products/detail';
    $style = 'style/product-detail';
    $script = 'product-detail';
    // Lấy dữ liệu
    $data = getProductById($id); // Lấy sản phẩm theo id
    $listAoThun = listProductByCategoryLimit(1, 7); //Lấy sản phẩm theo danh mục
    $listImage = listImageOnProduct($id); //Lấy list hình ảnh
    $listComments = getComment($id); // Lấy comment
    $countListComment = count($listComments); // Đếm số hàng comment
    // Tính % rating
    $totalRating = 0;
    foreach ($listComments as $cmt) {
        $totalRating = $totalRating + $cmt['rating'];
    }
    if ($countListComment > 0) {
        $averageRating = $totalRating / $countListComment;
        $percentRating = ($averageRating / 5) * 100;
    } else {
        $averageRating = 0;
        $percentRating = 0;
    }
    // Xử lí data
    if ($data['attribute_value_id'] == 0) {
        $data['variants'] = [];
        $result[$id] = $data;
    } else {
        $kq = getProductLookup($id);
        $groupedData = [];
        foreach ($kq as $item) {
            $productId = $item['id'];
            $lookupId = $item['product_lookup_id'];

            if (!isset($groupedData[$productId])) {
                $groupedData[$productId] = [
                    'id' => $item['id'],
                    'product_name' => $item['product_name'],
                    'category_id' => $item['category_id'],
                    'des' => $item['des'],
                    'main_image' => $item['main_image'],
                    'status' => $item['status'],
                    'variants' => []
                ];
            }

            $groupedData[$productId]['variants'][$lookupId]['product_variant'] = $item['product_variant'];
            $groupedData[$productId]['variants'][$lookupId]['product_lookup_id'] = $item['product_lookup_id'];
            $groupedData[$productId]['variants'][$lookupId]['price'] = $item['price'];
            $groupedData[$productId]['variants'][$lookupId]['sale_price'] = $item['sale_price'];
            $groupedData[$productId]['variants'][$lookupId]['quantity'] = $item['quantity'];

            $attributeName = $item['attribute_name'];
            if (!isset($groupedData[$productId]['variants'][$lookupId]['attributes'][$attributeName])) {
                $groupedData[$productId]['variants'][$lookupId]['attributes'][$attributeName] = [];
            }

            $groupedData[$productId]['variants'][$lookupId]['attributes'][$attributeName][] = $item['attribute_value_name'];
        }
        $result = $groupedData;
    }
    $product = $result[$id];


    // Xử lí người dùng bình luận
    if (isset($_POST['submitcomment']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];
        if (empty($_POST['comment'])) {
            $errors[] = 'Nội dung bình luận là bắt buộc.';
        }

        // Kiểm tra xem rating có tồn tại trong dữ liệu POST không
        if (empty($_POST['rating'])) {
            $errors[] = 'Đánh giá là bắt buộc.';
        }
        // 
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            $comment = [
                'comment_content' => $_POST['comment'] ?? null,
                'account_id' => $_SESSION['user']['id'] ?? null,
                'product_id' => $id,
                'status' => 1,
                'reply' => null,
                'rating' => $_POST['rating']
            ];
            insert('comment', $comment);
            $_SESSION['success_comment'] = 'Bạn đã thêm bình luận thành công';
            header('Location:' . BASE_URL . '?act=product-detail&id=' . $id);
            exit;
        }
    }
    // Thêm giỏ hàng
    if (isset($_POST['addtocart']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isUserLoggedIn()) {
            // Lưu trang hiện tại vào session để quay lại sau khi đăng nhập
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            // Chuyển hướng đến trang đăng nhập
            // Thông báo
            $_SESSION['warningLogin'] = 'Vui lòng đăng nhập để có thể thêm sản phẩm vào giỏ hàng';
            header('Location:' . BASE_URL . '?act=login');
            exit();
        } else {
            $cart = [
                'id' => $id,
                'product_name' => $_POST['product_name'],
                'main_image' => $_POST['main_image'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'product_lookup_id' => $_POST['product_lookup_id'],
            ];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $product_exists = false;
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['product_lookup_id'] == $cart['product_lookup_id']) {
                    // Sản phẩm đã tồn tại, cập nhật số lượng
                    $cart_item['quantity'] += $cart['quantity'];
                    if ($cart_item['quantity'] > $product['quantity']) {
                        $cart_item['quantity'] = $product['quantity'];
                        $_SESSION['warning'] = 'Không thể thêm vào giỏ hàng số lượng lớn hơn số hàng trong kho.';
                    } else {
                        $_SESSION['success'] = 'Bạn đã thêm vào giỏ hàng thành công';
                    };

                    $product_exists = true;
                    break;
                }
            }

            if (!$product_exists) {
                // Sản phẩm chưa tồn tại, thêm vào giỏ hàng
                $_SESSION['cart'][] = $cart;
                $_SESSION['success'] = 'Bạn đã thêm vào giỏ hàng thành công';
            }
        }




        // 
        header('Location:' . BASE_URL . '?act=product-detail&id=' . $id);
        exit;
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Lấy sản phẩm theo category
function productList($id)
{
    $view = 'products/listByCategory';
    $style = 'style/home';
    $script = 'home';
    $listProducts = listProductByCategory($id);

    require_once PATH_VIEW . 'layouts/master.php';
}
