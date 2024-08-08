<?php
// Lấy 8 sản phẩm theo mã danh mục
if (!function_exists('listProductByCategoryLimit')) {
    function listProductByCategoryLimit($id, $number)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT product.id, 
       product.product_name, 
       product.category_id,
       product.main_image,
       product.status, 
       MIN(product_lookup.price) AS price,
       MIN(product_lookup.sale_price) AS sale_price
        FROM `product` 
        INNER JOIN product_variant ON product.id = product_variant.product_id 
        INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id 
        WHERE category_id = :category_id AND product.status = 1  
        GROUP BY product.id  
        ORDER BY product.id DESC 
        LIMIT $number";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_id", $id);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy 8 sản phẩm 
if (!function_exists('listProductLimit')) {
    function listProductLimit($number)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT 
            product.id, 
            product.product_name, 
            product.category_id,
            product.main_image,
            product.status, 
            MAX(product_lookup.price) AS price,
            MAX(product_lookup.sale_price) AS sale_price
            FROM `product` 
            INNER JOIN product_variant ON product.id = product_variant.product_id 
            INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id 
            WHERE product.status = 1  
            GROUP BY product.id  
            ORDER BY product.id DESC 
            LIMIT $number";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy sản phẩm theo danh mục
if (!function_exists('listProductByCategory')) {
    function listProductByCategory($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT product.id, product.product_name, product.category_id,product.main_image,product.status, MIN(product_lookup.price) AS price,MIN(product_lookup.sale_price) AS sale_price FROM `product` 
            INNER JOIN product_variant on product.id = product_variant.product_id INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id 
            WHERE  category_id = :category_id AND product.status = 1 GROUP BY product.id  
            ORDER BY product.id DESC ";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_id", $id);
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

            $sql = "SELECT product.id, product.product_name, product.category_id, product.des, product.main_image, product.status, product_lookup.id as product_lookup_id, product_lookup.price,product_lookup.sale_price,product_lookup.quantity,product_variant.attribute_value_id FROM `product` 
            INNER JOIN product_variant on product.id = product_variant.product_id INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id 
            WHERE status=1 AND product.id = :id";

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
function getProductVariants($id)
{

    $sql = "SELECT 
            pv.product_variant_id, 
            pv.attribute_value_id, 
            av.attribute_value_name, 
            a.attribute_name, 
            pl.price, 
            pl.sale_price, 
            pl.quantity
            FROM 
                product_variant pv
            JOIN 
                product_lookup pl ON pv.product_variant_id = pl.id
            JOIN 
                attribute_value av ON pv.attribute_value_id = av.id
            JOIN 
                attribute a ON av.attribute_id = a.id
            WHERE 
                pv.product_id = :id
            ORDER BY 
                pv.product_variant_id";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $results = $stmt->fetchAll();

    $variants = [];
    foreach ($results as $row) {
        $variants[$row['product_variant_id']][] = $row;
    }


    return $variants;
}
// Hàm lấy số lượng lookup

if (!function_exists('getProductLookup')) {
    function getProductLookup($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT 
            product.id,
            product.product_name,
            product.category_id,
            product.des,
            product.main_image,
            product.status,
            product_variant.id as product_variant,
            product_variant.product_variant_id AS product_lookup_id,
            product_variant.attribute_value_id,
            attribute_value.attribute_value_name,
            attribute.attribute_name,
            product_lookup.id as lookup_id,
            product_lookup.price,
            product_lookup.sale_price,
            product_lookup.quantity
            FROM 
                product
            INNER JOIN 
                product_variant ON product.id = product_variant.product_id
            INNER JOIN 
                product_lookup ON product_variant.product_variant_id = product_lookup.id
            INNER JOIN 
                attribute_value ON product_variant.attribute_value_id = attribute_value.id
            INNER JOIN 
                attribute ON attribute_value.attribute_id = attribute.id
            WHERE 
                product.id = :id
            LIMIT 0, 25";

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
// Lấy tên các biến thể
if (!function_exists('getProductLookupById')) {
    function getProductLookupById($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT * FROM product_lookup WHERE id = :id";

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
