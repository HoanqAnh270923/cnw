<?php

$DB_HOST = 'localhost:3307';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'project_k72_cnw_715105013'; //tên database

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die("Không thể kết nối tới cơ sở dữ liệu");
if ($conn) {
    mysqli_query($conn, "SET NAMES 'utf8'");
    
}

