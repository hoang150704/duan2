<?php
if (!function_exists('listAllForComment')) {
    function listAllForComment($reply = 1, $status = 1)
    {
        try {
            $sql = "SELECT comment.id, comment.comment_content, comment.account_id, comment.date_comment, comment.product_id, comment.status, comment.reply, comment.rating, product.product_name, product.id AS product_id, account.username 
                    FROM `comment` 
                    INNER JOIN account ON comment.account_id = account.id 
                    INNER JOIN product ON comment.product_id = product.id 
                    WHERE comment.status = 1";

            // Thêm điều kiện lọc theo reply
            if ($reply == 2) {
                $sql .= " AND comment.reply IS NULL";
            } elseif ($reply == 3) {
                $sql .= " AND comment.reply IS NOT NULL";
            }

            // Thêm điều kiện sắp xếp theo status
            if ($status == 2) {
                $sql .= " ORDER BY comment.id ASC";
            } else {
                $sql .= " ORDER BY comment.id DESC";
            }

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
// Lấy 1 bình luận'
if (!function_exists('showOneForComment')) {
    function showOneForComment($id)
    {
        try {
            $sql = "SELECT comment.id, comment.comment_content,comment.account_id,comment.date_comment,comment.product_id,comment.status,comment.reply,comment.rating,account.username,account.fullname,account.avatar,account.phone,account.email,product.product_name,product.main_image 
            FROM `comment` INNER JOIN account ON comment.account_id = account.id 
            INNER JOIN product ON comment.product_id = product.id 
            WHERE comment.id = :id ";
            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
// 
if (!function_exists('getComment')) {
    function getComment($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT comment.id,comment.comment_content,comment.account_id,comment.date_comment,comment.product_id,comment.status,comment.reply,comment.rating,account.fullname,account.avatar FROM `comment` INNER JOIN account ON comment.account_id = account.id WHERE comment.status=1 AND comment.product_id = :id";

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


