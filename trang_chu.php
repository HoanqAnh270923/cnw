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
    flex: 1; 
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
    gap: 10px; /* Khoảng cách giữa các item */
    margin-top: 20px;
}

.item {
    width: 295px;
    height: 140px;
    border: 1px solid #ccc;
    padding: 10px;
    box-sizing: border-box;
    border-radius: 10px;
    transition: all 0.5s ease;
    margin: 10px;
    text-decoration: none;
    color: black;
}

.item h4 {
    margin-bottom: 5px;
}   

.item:hover {
    background-color: #ccc;
    transform: translateX(13px);
    cursor: pointer;
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
            <?php
                    echo "<h3>".$_SESSION['ho_va_ten']."</h3>";
                    echo "<h3>715105000</h3>";
                    if ($_SESSION['role'] == 0) {
                        echo "<h3>Admin</h3>";
                    }
                    if ($_SESSION['role'] == 1) {
                        echo "<h3>Giáo viên</h3>";
                    }
                    if ($_SESSION['role'] == 2) {
                        echo "<h3>Học sinh</h3>";
                    }
                ?>
            </div>
            <div class="line"></div>
            <div class="sidebar-item">
                <a href="trang_chu.php"><i class="fa-solid fa-house"></i>
                <span>Trang chủ</span>
                </a>

                <a href="thong_ke_ho_so.php"><i class="fa-solid fa-book"></i>
                <span>Thống kê hồ sơ</span>
                </a>

                <a><i class="fa-solid fa-check"></i>
                <span>Xử lý hồ sơ</span>
                </a>

                <a href="danh_sach_ho_so.php"><i class="fa-solid fa-folder-open"></i>
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
            <h2>Các nghành xét tuyển</h2>
            <div class="main-content">
                <a class="item" href="nop_ho_so.php">
                    <h4>Công nghệ thông tin</h4>
                    <p>Khối xét tuyển: A01</p>
                    <p>Thời gian bắt đầu</p>
                    <p>Thời gian kết thúc</p>
                    <h5>Giáo viên: </h5>
                </a>
                <a class="item" href="nop_ho_so.php">
                    <h4>Y đa khoa</h4>
                    <p>Khối xét tuyển: B00</p>
                    <p>Thời gian bắt đầu</p>
                    <p>Thời gian kết thúc</p>
                    <h5>Giáo viên: </h5>
                </a>
                <a class="item" href="nop_ho_so.php">
                    <h4>Công nghệ ô tô</h4>
                    <p>Khối xét tuyển: A00</p>
                    <p>Thời gian bắt đầu</p>
                    <p>Thời gian kết thúc</p>
                    <h5>Giáo viên: </h5>
                </a>
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
        icon.style.marginRight = '10px'; // Keep margin constant
    });
}






</script>
</html>