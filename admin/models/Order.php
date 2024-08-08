<?php
if (!function_exists('listAllForOrder')) {
    function listAllForOrder($status_id = 0,$order_code_substring = '')
    {
        try {
            //code...

            $sql = "SELECT `order_shop`.`id`, `order_shop`.`order_code`, `order_shop`.`status_id`, `order_shop`.`account_id`, `order_shop`.`date_order`, `order_shop`.`total_money`, `order_shop`.`order_address`, `order_shop`.`order_phone`, `order_shop`.`order_account_name`, `status_order`.`status_order_name` AS `status_name`,`account`.`fullname` AS `fullname`
            FROM `order_shop`
            INNER JOIN `status_order` ON `order_shop`.`status_id` = `status_order`.`id`
            INNER JOIN `account` ON `order_shop`.`account_id` = `account`.`id`
            WHERE `order_shop`.`status` = 1";
            if ($status_id >= 1 && $status_id <= 11) {
                $sql .= " AND `order_shop`.`status_id` = $status_id";
            }
            if (!empty($order_code_substring)) {
                $sql .= " AND `order_shop`.`order_code` LIKE :order_code_substring";
            }
            $stmt = $GLOBALS['conn']->prepare($sql);
            if (!empty($order_code_substring)) {
                $order_code_substring = "%$order_code_substring%";
                $stmt->bindParam(':order_code_substring', $order_code_substring);
            }
            
            

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 
if (!function_exists('showOneForOrder')) {
    function showOneForOrder($id)
    {
        try {
            //code...

            $sql = "SELECT `order_shop`.`id` , `order_shop`.`status_id`, `order_shop`.`account_id`,`order_shop`.`shipping`, `order_shop`.`date_order`, `order_shop`.`total_money`, `order_shop`.`order_address`, `order_shop`.`order_phone`, `order_shop`.`order_account_name`,`order_shop`.`note`, `status_order`.`status_order_name` AS `status_name`
            FROM `order_shop`
            INNER JOIN `status_order` ON `order_shop`.`status_id` = `status_order`.`id`
            WHERE `order_shop`.`status` = 1 AND order_shop.id = :id ";

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
if (!function_exists('getAccountOnOrder')) {
    function getAccountOnOrder($id)
    {
        try {
            //code...

            $sql = "SELECT * FROM account WHERE id = :id LIMIT 1";

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
if (!function_exists('getDetailOnOrder')) {
    function getDetailOnOrder($id)
    {
        try {
            //code...

            $sql = "SELECT * FROM detail_order WHERE order_id = :id ";

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
// Lấy đơn hàng chưa xử lí
if (!function_exists('listAllOrderProcessing')) {
    function listAllOrderProcessing($tableName)
    {
        try {
            //code...

            $sql = "SELECT * FROM $tableName WHERE `status`= 1 AND `status_id` IN (1,11)";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy doanh thu trong ngày
if (!function_exists('listAllOrderTotalMoneyOnDAY')) {
    function listAllOrderTotalMoneyOnDAY($date)
    {
        try {
            //code...

            $sql = "SELECT`total_money` FROM `order_shop` WHERE DATE(date_success_order)  = :date_success_order AND `status_id` = 5";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":date_success_order", $date);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy số đơn hàng
if (!function_exists('getCountOrder')) {
    function getCountOrder()
    {
        try {
            //code...

            $sql = "SELECT COUNT(*) AS order_count FROM `order_shop`";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 
if (!function_exists('getCountCancel')) {
    function getCountCancel()
    {
        try {
            //code...

            $sql = "SELECT COUNT(*) AS order_count FROM `order_shop` WHERE `status_id` IN (6, 9)";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy dữ liệu vẽ biểu đồ
if (!function_exists('getDailyRevenue')) {
    function getDailyRevenue()
    {
        try {
            //code...

            $sql = "SELECT 
            DATE(`date_success_order`) AS `order_date`, 
            SUM(`total_money`) AS `total_revenue`
            FROM `order_shop`
            WHERE `status_id` = 5
            GROUP BY `order_date`
            ORDER BY `order_date` ASC
            LIMIT 7";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
