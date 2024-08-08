<?php
// 
if(!function_exists('countAttributeValue')){
    function countAttributeValue($tableName,$attribute_id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT COUNT(*)AS countValue FROM $tableName WHERE status = 1  AND attribute_id = :attribute_id" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_id",$attribute_id);

            $stmt->execute();

            $data = $stmt ->fetch();
            return $data;

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 
if(!function_exists('listAllAttributeById')){
    function listAllAttributeById($tableName,$attribute_id){
        try {
            //code...
           
            $sql = "SELECT * FROM $tableName WHERE `status`= 1 AND attribute_id = :attribute_id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_id",$attribute_id);

            $stmt->execute();

            return $stmt ->fetchAll();

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
if(!function_exists('checkSameAttributeValueName')){
    function checkSameAttributeValueName($tableName,$attribute_value_name){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE attribute_value_name = :attribute_value_name LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_value_name",$attribute_value_name);

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
if(!function_exists('checkSameAttributeValueNameById')){
    function checkSameAttributeValueNameById($tableName,$attribute_value_name,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE attribute_value_name = :attribute_value_name  AND id <> :id LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_value_name",$attribute_value_name);
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

