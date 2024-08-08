<?php
if(!function_exists('checkSameCategoryName')){
    function checkSameCategoryName($tableName,$category_name){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE category_name = :category_name LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_name",$category_name);

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
if(!function_exists('checkSameCategoryNameById')){
    function checkSameCategoryNameById($tableName,$category_name,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE category_name = :category_name  AND id <> :id LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_name",$category_name);
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
