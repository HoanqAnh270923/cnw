<?php
include 'connectdb.php';
ob_start(); // Start output buffering

function kiem_tra_dang_nhap($tk, $mk){
    global $conn;
    $sql = "SELECT * FROM `user` WHERE `tai_khoan` = '$tk' AND `mat_khau` = '$mk'";
    $sql1 = "SELECT `role` FROM `user` WHERE `tai_khoan` = '$tk' AND `mat_khau` = '$mk'";
    $kq = mysqli_query($conn, $sql);
    $kq1 = mysqli_query($conn, $sql1);
    $_SESSION['login'] = 0;
    if (mysqli_num_rows($kq) > 0) {
        $row = mysqli_fetch_assoc($kq); 
        $row1 = mysqli_fetch_assoc($kq1);
        if ($row1['role'] == 0) {
            $_SESSION['login']++;
            $_SESSION['role'] = 0;
            $_SESSION['username'] = $tk;
            header('location:index.php');
            ob_end_flush();
            exit();
        }
        if ($row1['role'] == 1) {
            $_SESSION['login']++;
            $_SESSION['role'] = 1;
            $_SESSION['username'] = $tk;
            header('location:index.php');
            ob_end_flush();
            exit();
        }
        if ($row1['role'] == 2) {
            $_SESSION['login']++;
            $_SESSION['role'] = 2;
            $_SESSION['username'] = $tk;
            header('location:index.php');
            ob_end_flush();
            exit();
        }
    }
}
?>