<?php
if(!function_exists('getUserByUsernameAndPassword')){
    function getUserByUsernameAndPassword($tableName,$username,$password){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE username = :username  AND password = :password AND `role` =0 LIMIT 1" ;

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

// email
if(!function_exists('getPasswordByEmail')){
    function getPasswordByEmail($email){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM `account` WHERE email = :email AND `role` =0 LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email",$email);
            $stmt->execute();

            return $stmt ->fetch();
            

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Lấy thông tin người dùng
if(!function_exists('checkSameEmailUserById')){
    function checkSameEmailUserById($tableName,$email,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE email = :email  AND id <> :id  LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email",$email);
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
// Lấy đơn hàng
if(!function_exists('checkSameUsername')){
    function checkSameUsername($tableName,$username){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE username = :username LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":username",$username);

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
if(!function_exists('checkSameEmail')){
    function checkSameEmail($tableName,$email){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE email = :email LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email",$email);

            $stmt->execute();

            $data = $stmt ->fetch();
            return empty($data) ? true : false;

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
