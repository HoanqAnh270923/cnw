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
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

/* Header Styles */
header {
    background: linear-gradient(135deg, #0a74da 0%, #0d47a1 100%);
    padding: 0.5rem;
    margin-bottom: 0;
}

.header {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 0.5rem 2rem;
}

.header h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
}

/* Layout */
.center {
    display: flex;
    min-height: calc(100vh - 120px);
}

/* Sidebar */
.sidebar {
    width: 280px;
    background-color: #f5f5f5;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
}

.sidebar.collapsed {
    width: 80px;
}

.icon {
    padding: 1rem;
    text-align: right;
}

.icon i {
    font-size: 1.5rem;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
}

.student {
    padding: 1.5rem 1rem;
    text-align: center;
}

.student h2 {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    color: #333;
}

.avata {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #0a74da;
}

.avata img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.line {
    height: 1px;
    background: #ddd;
    margin: 1rem;
}

/* Sidebar Items */
.sidebar-item {
    flex: 1;
    padding: 0 1rem;
}

.sidebar-item a {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.sidebar-item a:hover {
    background-color: rgba(10, 116, 218, 0.1);
    transform: translateX(5px);
}

.sidebar-item i {
    font-size: 1.2rem;
    margin-right: 1rem;
    color: #0a74da;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header h3 {
        font-size: 1.2rem;
    }
    
    .sidebar {
        width: 240px;
    }
    
    .content {
        padding: 1rem;
    }
    
    .main-content {
        grid-template-columns: 1fr;
    }
}

.sidebar-item span, 
.student h2, 
.student h3, 
.logout span {
    transition: all 0.3s ease;
}

.sidebar.collapsed .sidebar-item a,
.sidebar.collapsed .logout a {
    justify-content: center;
}

.sidebar.collapsed .avata {
    width: 40px;
    height: 40px;
}

/* Logout Button */
.logout {
    padding: 1rem;
    margin-top: auto;
}

.logout a {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    background: #ff3737;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.logout a:hover {
    background: #e62e2e;
    transform: translateX(5px);
}

.logout i {
    font-size: 1.2rem;
    margin-right: 1rem;
}

.content {
    flex: 1;
    padding: 10px;
}

.center {
    display: flex;
    width: 100%;
    min-height: 100vh;
    border: 1px solid black;
    position: relative;
    top: -10px;
}

.center .sidebar {
    width: 250px;
    min-height: 100%;
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
                    echo "<h3>".$_SESSION['username']."</h3>";
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
            <h2>Công nghệ thông tin</h2>
            <form method="post">
            <div class="main">
                <h3>Tên Sinh Viên</h3>
                <h4>Điểm Toán: </h4>
                <h4>Điểm Lý: </h4>
                <h4>Điểm Hóa: </h4>
                <h4>Tổng điểm: </h4>
            </div>
            <button>Duyệt</button>
            <button>Không Duyệt</button>
            <button>Xóa hồ sơ</button>
            </form>
            
        </div>
    </div>
    <footer></footer>
</body>
<script>    
    function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const spans = document.querySelectorAll('.sidebar-item span, .student h2, .student h3, .logout span');
    
    sidebar.classList.toggle('collapsed');
    
    if(sidebar.classList.contains('collapsed')) {
        spans.forEach(span => {
            span.style.display = 'none';
        });
    } else {
        spans.forEach(span => {
            span.style.display = 'block';
        });
    }
    
    const icons = document.querySelectorAll('.sidebar-item i');
    icons.forEach(icon => {
        icon.style.fontSize = '25px';
        icon.style.marginRight = sidebar.classList.contains('collapsed') ? '0' : '10px';
    });
}
</script>
</html>