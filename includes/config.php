<?php
// Railway configuration
if (getenv('RAILWAY_ENVIRONMENT')) {
    $sql_db_host = getenv('MYSQLHOST') ?: 'localhost';
    $sql_db_user = getenv('MYSQLUSER') ?: 'root';
    $sql_db_pass = getenv('MYSQLPASSWORD') ?: '';
    $sql_db_name = getenv('MYSQLDATABASE') ?: 'railway';
    $sql_db_port = getenv('MYSQLPORT') ?: '3306';

    $railway_domain = getenv('RAILWAY_PUBLIC_DOMAIN');
    if ($railway_domain) {
        $site_url = "https://" . $railway_domain . "/";
    } else {
        $site_url = "https://" . getenv('RAILWAY_STATIC_URL') . "/";
    }
} else {
    // إعدادات الاتصال المحلية
    $sql_db_host = "localhost";
    $sql_db_user = "root";
    $sql_db_pass = "";
    $sql_db_name = "zontal_db";
    $sql_db_port = "3306";
    $site_url = "http://localhost/";
}

// إنشاء اتصال بقاعدة البيانات مع تحديد المنفذ
$con = mysqli_connect($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name, $sql_db_port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>