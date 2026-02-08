<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Railway configuration
if (getenv('RAILWAY_ENVIRONMENT')) {
    $sql_db_host = getenv('MYSQLHOST') ?: 'localhost';
    $sql_db_user = getenv('MYSQLUSER') ?: 'root';
    $sql_db_pass = getenv('MYSQLPASSWORD') ?: '';
    $sql_db_name = getenv('MYSQLDATABASE') ?: 'railway';
    $sql_db_port = getenv('MYSQLPORT') ?: '3306';

    // تحديث الرابط ليكون ديناميكي بناءً على النطاق الحالي
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $site_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";
} else {
    // إعدادات الاتصال المحلية
    $sql_db_host = "localhost";
    $sql_db_user = "root";
    $sql_db_pass = "";
    $sql_db_name = "zapplay_db";
    $sql_db_port = "3306";
    $site_url = "http://localhost/";
}

// إنشاء اتصال بقاعدة البيانات مع تحديد المنفذ
$con = mysqli_connect($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name, $sql_db_port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>