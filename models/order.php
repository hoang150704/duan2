<?php
if (!function_exists('getAllStatusOrder')) {
    function getAllStatusOrder()
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT * FROM `status_order` WHERE `status` = 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy đơn hàng theo khách hàng
if (!function_exists('listAllOrderByAccountId')) {
    function listAllOrderByAccountId($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT * FROM `order_shop` WHERE account_id = :id";

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
// 
if (!function_exists('getOrder')) {
    function getOrder()
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT 
                o.id ,
                o.date_order,
                o.total_money,
                o.order_address,
                o.order_phone,
                o.order_account_name,
                o.shipping,
                d.product_name,
                d.product_price,
                d.detail_quantity
            FROM 
                order_shop o
            INNER JOIN 
                detail_order d ON o.id = d.order_id
            WHERE 
                o.id = :order_id";

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
if (!function_exists('listAllDetailOrder')) {
    function listAllDetailOrder()
    {
        try {
            //code...

            $sql = "SELECT * FROM detail_order WHERE 1";

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
if (!function_exists('listAllHistoryOrder')) {
    function listAllHistoryOrder()
    {
        try {
            //code...

            $sql = "SELECT * FROM order_status_history WHERE 1";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}