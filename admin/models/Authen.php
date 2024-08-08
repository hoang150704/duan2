<?php
if(!function_exists('getAdminByUsernameAndPassword')){
    function getAdminByUsernameAndPassword($tableName,$username,$password){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE username = :username  AND password = :password AND `role` =1 LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$password);

            $stmt->execute();

            return $stmt ->fetch();
            

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}