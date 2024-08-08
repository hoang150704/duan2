<?php
if (!function_exists('getComment')) {
    function getComment($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT comment.id,comment.comment_content,comment.account_id,comment.date_comment,comment.product_id,comment.status,comment.reply,comment.rating,account.fullname,account.avatar FROM `comment` INNER JOIN account ON comment.account_id = account.id WHERE comment.status=1 AND comment.product_id = :id LIMIT 6";

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
// Lấy comment theo id người dùng
if (!function_exists('getCommentForUser')) {
    function getCommentForUser($id)
    {
        try {
            //Nếu không trùng trả về true

            $sql = "SELECT comment.id,comment.comment_content,comment.account_id,comment.date_comment,comment.product_id,comment.status,comment.reply,comment.rating,account.fullname,account.avatar FROM `comment` INNER JOIN account ON comment.account_id = account.id WHERE comment.status=1 AND comment.account_id = :id";

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