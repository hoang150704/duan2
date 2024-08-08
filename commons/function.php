<?php
// 
if (!function_exists('get_str_key')) {
    function get_str_data($data)
    {
        $keys = array_keys($data);
        $keysTenTen = array_map(function ($key) {
            return "`$key`";
        }, $keys);
        return implode(',', $keysTenTen);
    }
}
if (!function_exists('get_virtual_params')) {
    function get_virtual_params($data)
    {
        $keys = array_keys($data);
        $tmp = [];
        foreach ($keys as $key) {
            $tmp[] = ":$key";
        }
        return implode(',', $tmp);
    }
}
if (!function_exists('get_set_params')) {
    function get_set_params($data)
    {
        $keys = array_keys($data);
        $tmp = [];
        foreach ($keys as $key) {
            $tmp[] = "`$key`= :$key";
        }
        return implode(',', $tmp);
    }
}
// CREATE

if (!function_exists('insert')) {
    function insert($tableName, $data = [])
    {
        try {
            //code...
            $strKeys = get_str_data($data);
            $params = get_virtual_params($data);


            $sql = "INSERT INTO $tableName($strKeys) VALUES ($params)";

            $stmt = $GLOBALS['conn']->prepare($sql);

            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }
            $stmt->execute();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// create trả về last id
if (!function_exists('insert_get_last_id')) {
    function insert_get_last_id($tableName, $data = [])
    {
        try {
            //code...
            $strKeys = get_str_data($data);
            $params = get_virtual_params($data);


            $sql = "INSERT INTO $tableName($strKeys) VALUES ($params)";

            $stmt = $GLOBALS['conn']->prepare($sql);

            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }
            $stmt->execute();
            return $GLOBALS['conn']->lastInsertId();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// LIST
if (!function_exists('listAll')) {
    function listAll($tableName)
    {
        try {
            //code...

            $sql = "SELECT * FROM $tableName WHERE `status`= 1";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Show 1
if (!function_exists('showOne')) {
    function showOne($tableName, $id)
    {
        try {
            //code...

            $sql = "SELECT * FROM $tableName WHERE id = :id LIMIT 1";

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
// update
if (!function_exists('update')) {
    function update($tableName, $id, $data = [])
    {
        try {
            //code...

            $setParams = get_set_params($data);


            $sql = "UPDATE $tableName
            SET $setParams
            WHERE id =:id;
            
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// Xóa
if (!function_exists('delete_hidden')) {
    function delete_hidden($tableName, $id,)
    {
        try {
            //code...




            $sql = "UPDATE $tableName SET `status`= 0 WHERE id=:id
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
if (!function_exists('delete')) {
    function delete($tableName, $id,)
    {
        try {
            //code...




            $sql = "DELETE FROM $tableName WHERE id=:id
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);


            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
if (!function_exists('mask_email')) {
    function mask_email($email) {
        $em = explode("@", $email);
        $name = $em[0];
        $domain = $em[1];
        $len = strlen($name);

        // Số lượng * mặc định là 5 nếu len - 2 lớn hơn 5
        

        // Tạo tên đã được ẩn
        $masked_name = substr($name, 0, 2) . str_repeat('*', 5);

        return $masked_name . "@" . $domain;
    }
}
// Hàm ẩn sos điện thoại
if (!function_exists('mask_phone')) {
    function mask_phone($phone)
    {
        $last_three_digits = substr($phone, -3);
        return "0******" . $last_three_digits;
    }
}
// SENDMAIL
function SendMail($email,$titleEmail,$body){

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'chubenghocnghech@gmail.com'; // SMTP username
        $mail->Password = 'pdma brxm bjmf uwui';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('admin@gmail.com', 'Admin' ); 
        $mail->addAddress($email); 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $titleEmail; 
        $mail->Body = $body;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Error: ', $mail->ErrorInfo;
        return false;
    }
}
