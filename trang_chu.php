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

/* Content Area */
.content {
    flex: 1;
    padding: 2rem;
    background-color: #fff;
}

.content h2 {
    color: #333;
    margin-bottom: 1.5rem;
}

.add {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background: #0a74da;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
    margin-bottom: 2rem;
}

.add:hover {
    background: #0d47a1;
    transform: translateY(-2px);
}

/* Items Grid */
.main-content {
    display: flex;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.item-container {
    position: relative;
}

.item {
    display: block;
    padding: 1.5rem;
    background: #fff;
    border-radius: 10px;
    border: 1px solid #eee;
    transition: all 0.3s ease;
    height: 100%;
    text-decoration: none;
    color: #333;
}

.item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.item h4 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: #0a74da;
}

.item p {
    margin-bottom: 0.5rem;
    color: #666;
}


.action-buttons {
    position: absolute;
    right: -100px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 1000;
}

.item-container:hover .action-buttons {
    opacity: 1;
    right: -70px;
}

.toggle-btn {
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-btn.hide {
    background: #e74c3c;
    color: white;
}

.toggle-btn.show {
    background: #2ecc71;
    color: white;
}

.toggle-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}



</style>    
</head>
<body>
    <header>
        <div class="header">
            <img src="./image/hnue-logo-inkythuatso.png" alt="logo" width="100px" height="100px">
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
                echo "<h3>" . $_SESSION['ho_va_ten'] . "</h3>";
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
                <a href="dangxuat.php"><i class="fa-solid fa-right-from-bracket"></i>
                <span>Đăng Xuất</span>
                </a>            
            </div>
        </div>
        <div class="content">
            <h2>Các nghành xét tuyển</h2>
            <?php
            if ($_SESSION['role'] == 0) {
                echo '<a class="add" href="them_nghanh.php">Thêm Nghành Xét Tuyển</a>';
            }
            ?>
    
            <div class="main-content">
                <?php
                if ($_SESSION['role'] == 0) {
                    ifadmin();
                } else {
                    ifteacherstudent();
                }
                if (isset($_POST['toggle_status'])) {
                    $id = $_POST['id_nghanh'];
                    $sql = "UPDATE nghanh_xet_tuyen SET trang_thai = 1 - trang_thai WHERE id_nghanh = '$id'";
                    mysqli_query($conn, $sql);
                    header("Location: trang_chu.php");
                    exit();
                }
                ?>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
<script>    
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const spans = document.querySelectorAll('.sidebar-item span, .student h2, .student h3, .logout span');
        
        sidebar.classList.toggle('collapsed');
        
        if (sidebar.classList.contains('collapsed')) {
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