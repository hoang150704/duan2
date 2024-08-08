<?php
if(!function_exists('checkSameAttributeName')){
    function checkSameAttributeName($tableName,$attribute_name){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE attribute_name = :attribute_name LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_name",$attribute_name);

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
if(!function_exists('checkSameAttributeNameById')){
    function checkSameAttributeNameById($tableName,$attribute_name,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE attribute_name = :attribute_name  AND id <> :id LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":attribute_name",$attribute_name);
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
