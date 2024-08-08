<?php
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

// 
if(!function_exists('checkSameEmailById')){
    function checkSameEmailById($tableName,$email,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE email = :email  AND id <> :id LIMIT 1" ;

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

// 
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
if(!function_exists('checkSameEmailById')){
    function checkSameEmailById($tableName,$email,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE email = :email  AND id <> :id LIMIT 1" ;

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
if(!function_exists('checkSameUsernameById')){
    function checkSameUsernameById($tableName,$username,$id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE username = :username  AND id <> :id LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":username",$username);
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
// Lấy số người dùng
if(!function_exists('listAllAccountUser')){
    function listAllAccountUser(){
        try {
            //code...
           
            $sql = "SELECT * FROM account WHERE `status`= 1 AND `role` = 0";

            $stmt = $GLOBALS['conn']->prepare($sql);
           

            $stmt->execute();

            return $stmt ->fetchAll();

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
