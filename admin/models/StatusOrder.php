<?php
if(!function_exists('checkSameStatusOrderName')){
    function checkSameStatusOrderName($tableName,$status_order_name){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE status_order_name = :status_order_name LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":status_order_name",$status_order_name);

            $stmt->execute();

            $data = $stmt ->fetch();
            return empty($data) ? true : false;

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 
if(!function_exists('checkSameStatusOrderNameById')){
    function checkSameStatusOrderNameById($tableName,$status_order_name,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE status_order_name = :status_order_name  AND id <> :id LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":status_order_name",$status_order_name);
            $stmt->bindParam(":id",$id);

            $stmt->execute();

            $data = $stmt ->fetch();
            return empty($data) ? true : false;

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
