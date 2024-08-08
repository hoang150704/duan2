<?php

    $host = DB_HOST;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port =$port;dbname=$dbname", $username, $password);
        // Cài đặt chế độ báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
        debug("Connection failed: " . $e->getMessage());
      }