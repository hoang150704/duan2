<?php
if (!function_exists('listAllForProduct')) {
    function listAllForProduct()
    {
        try {
            //code...

            $sql = "SELECT 
                    product.id AS product_id, 
                    product.product_name, 
                    product.category_id, 
                    product.des, 
                    product.main_image, 
                    product.status AS product_status, 
                    category.category_name 
                    FROM 
                    product 
                    INNER JOIN 
                    category ON product.category_id = category.id 
                    WHERE 
                    product.status = 1;";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 
if (!function_exists('deleteProductById')) {
    function deleteProductById($product_id) {
        try {
            // Bắt đầu transaction
            $GLOBALS['conn']->beginTransaction();

            // Lưu lại các giá trị product_variant_id trước khi xóa
            $sql = "SELECT `product_variant_id` FROM `product_variant` WHERE `product_id` = :product_id";
            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();
            $product_variant_ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            if (!empty($product_variant_ids)) {
                // Xóa từ bảng product_variant
                $sql = "DELETE FROM `product_variant` WHERE `product_id` = :product_id";
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();

                // Xóa từ bảng product_lookup dựa trên product_variant_id
                $sql = "DELETE FROM `product_lookup` WHERE `id` IN (" . implode(',', array_fill(0, count($product_variant_ids), '?')) . ")";
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->execute($product_variant_ids);
            }

            // Commit transaction
            $GLOBALS['conn']->commit();

        } catch (\Exception $e) {
            // Rollback nếu có lỗi
            $GLOBALS['conn']->rollBack();
            debug($e);
        }
    }
}
// 
if (!function_exists('getVariantByLookupId')) {
    function getVariantByLookupId($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT product_variant.id,attribute_value.attribute_value_name,product_variant.product_variant_id FROM `product_variant` INNER JOIN attribute_value ON product_variant.attribute_value_id = attribute_value.id WHERE product_variant_id = :id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}

// Lấy 1 sản phẩm
if (!function_exists('getProductById')) {
    function getProductById($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT product.id, product.product_name, product.category_id, product.des, product.main_image, product.status,category.category_name, product_lookup.id as product_lookup_id, product_lookup.price,product_lookup.sale_price,product_lookup.quantity,product_variant.attribute_value_id FROM `product` 
            INNER JOIN product_variant on product.id = product_variant.product_id INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id INNER JOIN category ON product.category_id = category.id
            WHERE product.status=1 AND product.id = :id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy list ảnh
if (!function_exists('listImageOnProduct')) {
    function listImageOnProduct($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT * FROM `image` WHERE product_id = :product_id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":product_id", $id);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
