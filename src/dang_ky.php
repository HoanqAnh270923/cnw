<?php
    include './connectdb.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | HNUE</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
        .container {
            display: flex;
            height: 100%;
        }
        .banner {
            flex: 1;
            background-size: cover;
            background-position: center;
        }

        .banner img {
            width: 100%;
            height: 100%;
            
        }
        .login-section {
            width: 480px;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .logo {

            text-align: center;
            margin-bottom: 15px;
        }
        .logo img {
            width: 80px;
            height: 80px;
        }
        .university-name {
            color: #00008B;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .portal-name {
            color: #00008B;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 30px;
        }
        .login-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .login-form h2 {
            font-size: 35px;
            margin-bottom: 20px;
        }
        .login-form p {
            color: #666;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group input {
            width: 95%;
            height: 35px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #00008B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-button:hover {
            background-color: #0000CD;
        }

        .forgot-password {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .forgot-password .fg-pass {
            text-align: left;
            margin-top: 10px;
        }

        .forgot-password .create-account {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #00008B;
            text-decoration: none;
        }
        .create-account a {
            color: #00008B;
            text-decoration: none;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="banner">
            <img src="https://dtdh.hnue.edu.vn/static/images/Carousel/bn1.jpg">
        </div>
        <div class="login-section">
            <div>
                <div class="logo">
                    <img src="./image/hnue-logo-inkythuatso.png" alt="HNUE Logo">
                </div>
                <div class="university-name">TRƯỜNG ĐẠI HỌC SƯ PHẠM HÀ NỘI</div>
                <div class="portal-name">CỔNG THÔNG TIN ĐÀO TẠO</div>
                <div class="login-form">
                    <h2>ĐĂNG NHẬP</h2>
                    <p>Cổng thông tin đào tạo</p>
                    <form method="post">
                    <div class="input-group">
                            <input type="text" name="ho_va_ten" placeholder="Họ và Tên" required>
                        </div>
                        <div class="input-group">
                            <input type="text" name="username" placeholder="Tên đăng nhập" required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="Mật khẩu" required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <button type="submit" name="btn_dang_ky" class="login-button">Đăng kí</button>
                    </form>
                    <?php
                        if (isset($_POST['btn_dang_ky'])) {
                            if ($_POST['password'] != $_POST['repassword']) {
                                header("Location: dang_ky.php");
                                echo "<script>
                                alert('Mật khẩu không khớp!');
                                window.location.href='dang_ky.php';
                                </script>";
                            }
                            $ho_va_ten = $_POST['ho_va_ten'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $password = md5($password);
                            $role = 2;
                            $sql = "INSERT INTO `user`(`id`, `ho_va_ten`, `tai_khoan`, `mat_khau`, `role`) VALUES ('','$ho_va_ten', '$username', '$password', '$role')";
                            if(mysqli_query($conn, $sql)){
                                header("Location: dang_nhap.php");
                                echo "<script>
                                alert('Đăng ký thành công!');
                                window.location.href='dang_nhap.php';
                            </script>";
                            }
                        }

                    ?>



                    <div class="forgot-password">
                        <a class="fg-pass" href="#">Quên mật khẩu</a>
                        <a class="create-account" href="dang_nhap.php">Đăng nhập</a>
                    </div>
                </div>
            </div>
            <div class="footer">
                All Rights Reserved Developed by Nguyen Phuong Hoang Anh
            </div>
        </div>
    </div>
</body>
</html>