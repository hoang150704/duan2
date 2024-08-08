<?php
if(!function_exists('listAllForProduct')){
    function listAllForProduct(){
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

            return $stmt ->fetchAll();

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