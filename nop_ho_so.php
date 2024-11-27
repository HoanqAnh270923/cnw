<?php
session_start();
if (!isset($_SESSION['login']) && $_SESSION['login'] == 0) {
    header('location:dang_nhap.php');
    exit();
}

include 'function.php';
include 'connectdb.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/e389c3969f.js" crossorigin="anonymous"></script>
<style>
*{
    margin: 0;
    padding: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

header{
    background-color: rgb(7, 24, 74);
    color: rgb(189, 189, 189);
    text-align: center;
    padding: 5px;
    font-size: 20px;
    font-weight: bold;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    margin-bottom: 10px;
}
.header {
    display: flex;
    align-items: center;
}

.header h3{
    color: white;
}
.header img {
    float: left;
    margin-right: 10px; /* Khoảng cách giữa hình ảnh và văn bản */
}
.header h3{
    text-align: center;
    justify-content: center;
}
.center {
    display: flex;
    width: 100%;
    min-height: 100vh;
}

.center .sidebar {
    width: 250px;
    height: 85vh;
    background-color: #e4e4e4;
    transition: all 0.5s ease;
    display: flex;
    flex-direction: column;
}

.icon {
    float: right;
    margin-top: 10px;
    margin-right: 20px;
    cursor: pointer;
    color: #333;
}

.icon i {
    font-size: 25px;
    float: right;
    margin-right: 5px;
    margin-top: 5px;
}

.student{
    text-align: center;
    font-size: 13px;
    
}
.student h2{
    font-size: 20px;
    font-weight: bold;
    margin: 20px;
    margin-top: 40px;
}

.line{
    border-bottom: 1px solid black;
    margin: 10px;
}


.sidebar-item {
    display: flex;
    flex-direction: column;
    margin: 20px;
    flex: 1; /* Fill available space */
}

.sidebar-item a {
    display: flex;
    align-items: center;
    padding: 10px;
    color: #333;
    margin: 5px;
    transition: all 0.3s ease;
    border-radius: 5px;
    text-decoration: none;
}

.sidebar-item a:hover {
    background-color: #d4d4d4;
    transform: translateX(10px);
    cursor: pointer;
}

.sidebar-item i {
    font-size: 25px;
    width: 30px;
    text-align: center;
    margin-right: 10px;
}


/* Thêm vào phần CSS */
.sidebar-item span {
    transition: opacity 0.3s ease;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar.collapsed .student,
.sidebar.collapsed .line,
.sidebar.collapsed .sidebar-item span {
    display: none;
}

.sidebar.collapsed .sidebar-item a {
    justify-content: center;
    padding: 10px 0;
}

.sidebar.collapsed .sidebar-item i {
    margin: 0 10px;
}


.logout {
    margin: 20px;
    margin-top: auto; /* Push to bottom */
}

.logout a {
    display: flex;
    align-items: center;
    padding: 10px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 5px;
}

.logout a:hover {
    background-color: #d4d4d4;
    transform: translateX(10px);
    cursor: pointer;
}

.logout i {
    font-size: 25px;
    width: 30px;
    text-align: center;
    margin-right: 10px;
}

.logout span {
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .logout span {
    display: none;
}
.content {
    flex: 1;
    padding: 10px;
}


.main-content {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; 
    margin-top: 20px;
}

.quanly{
    width: 98%;
    padding-left: 20px; 
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.quanly h3{
    padding-left: 20px;
}

.quanly form{
    padding-left: 20px;
}

.input{
    margin: 10px;
}

.input #tb{
    width: 100px;
    height: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.input button{
    width: 100px;
    height: 30px;
    margin-top: 10px;
    border: 1px solid black;
    border-radius: 3px;
}

.input button:hover{
    background-color: #ccc;
    cursor: pointer;
}

.tieude{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 10px;
}


</style>    
</head>
<body>
    <header>
        <div class="header">
            <img src="./image/hnue-logo-inkythuatso.png" alt="logo" width="100px" height="100px" >
            <h3>Trường đại học sư phạm Hà Nội</h3>
        </div>
    </header>
    <div class="center">
        <div class="sidebar">
            <div class="icon" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="student">
                <h2>Thông tin giáo viên</h2>
            <div class="avata">
                <img src="./image/profile-user.png" alt="user" width="30px" height="30px">
            </div>
                <h3>Nguyễn Phương Hoàng Anh</h3>
                <h3>715105013</h3>
                <h3>Giáo viên</h3>
            </div>
            <div class="line"></div>
            <div class="sidebar-item">
                <a href="trang_chu.php"><i class="fa-solid fa-house"></i>
                <span>Trang chủ</span>
                </a>

                <a><i class="fa-solid fa-book"></i>
                <span>Thống kê hồ sơ</span>
                </a>

                <a><i class="fa-solid fa-check"></i>
                <span>Xử lý hồ sơ</span>
                </a>

                <a href="trang_chu.php"><i class="fa-solid fa-folder-open"></i>
                <span>Danh sách hồ sơ</span>
                </a>
            </div>
            <div class="logout">
                <a href="dangxuat.php"><i class="fa-solid fa-right-from-bracket"></i></i>
                <span>Đăng Xuất</span>
                </a>            
            </div>
        </div>
        <div class="content">
            <div class="tieude">
            <h2>Quản lý hồ sơ xét tuyển</h2>
            <a href="trang_chu.php">
                <i class="fa-solid fa-house"></i>
            </a>
            </div>
            <div class="quanly">
                <h3>Công nghệ thông tin</h3>
                <form>
                    <div class="input">
                    <h4>Khối xét tuyển: A01</h4>
                    <h4>Thời gian kết thúc:</h4>
                    <p>Nhập điểm môn Toán</p>
                    <input id="tb" type="text" placeholder="">
                    <p>Nhập điểm môn Lý</p>
                    <input id="tb" type="text" placeholder="">
                    <p>Nhập điểm môn Hóa</p>
                    <input id="tb" type="text" placeholder=""><br>
                    <span>File ảnh học bạ</span>
                    <input type="file" name="file"><br>
                    <button type="submit">Nộp hồ sơ</button>
                    <button type="submit">Sửa hồ sơ</button>
                    <button type="submit">Xóa hồ sơ</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
<script>    
    function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('collapsed');
    
    const icons = document.querySelectorAll('.sidebar-item i');
    icons.forEach(icon => {
        icon.style.fontSize = '25px';
        icon.style.marginRight = '10px'; 
    });
}
</script>
</html>