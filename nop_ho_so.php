<?php
session_start();
include 'function.php';
include 'connectdb.php';


if (!isset($_SESSION['login']) && $_SESSION['login'] == 0) {
    header('location:dang_nhap.php');
    exit();
}

if (isset($_GET['id_nghanh']) && (isset($_GET['giao_vien_duyet']))) {
    $_SESSION['id_nghanh'] = $_GET['id_nghanh'];
    $_SESSION['giao_vien_duyet'] = $_GET['giao_vien_duyet'];
}

if (!isset($_SESSION['id_nghanh'])) {
    header('location:trang_chu.php');
    exit();
}

// check xem da nop ho so hay chua
da_nop();

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

.center {
    display: flex;
    min-height: calc(100vh - 120px);
}


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

.application-form {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.form-header h3 {
    color: #2c3e50;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.form-header h4 {
    color: #34495e;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    color: #2c3e50;
    font-weight: 500;
    font-size: 1rem;
}

.form-group input[type="number"] {
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input[type="number"]:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
    outline: none;
}

.file-upload input[type="file"] {
    padding: 0.8rem;
    border: 2px dashed #ddd;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-upload input[type="file"]:hover {
    border-color: #3498db;
    background: rgba(52,152,219,0.05);
}

.submit-btn {
    background: #2980b9;
    color: white;
    padding: 1rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.submit-btn:hover {
    background: #3498db;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.submit-btn:active {
    transform: translateY(0);
}


@media (max-width: 768px) {
    .application-form{
        margin: 1rem;
        padding: 1rem;
    }

    .form-header h3 {
        font-size: 1.5rem;
    }

    .form-group input[type="number"],
    .file-upload input[type="file"],
    .submit-btn {
        padding: 0.7rem;
    }
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
                <div class="application-form">
                <div class="form-container">
                    <div class="form-header">
                        <?php
                            $id_nghanh = $_SESSION['id_nghanh'];
                            $sql = "SELECT * FROM nghanh_xet_tuyen WHERE id_nghanh = '$id_nghanh'";
                            $result = mysqli_query($conn, $sql);               
                            $row = mysqli_fetch_assoc($result);

                            if ($row['ngay_ket_thuc'] < date('Y-m-d')) {
                                echo "<script>
                                alert('Đã hết thời gian nộp hồ sơ!');
                                window.location.href='trang_chu.php';
                            </script>";
                            } else {
                            }
                            echo "<h3>" . ($row['ten_nghanh']) . "</h3>";
                            echo "<h4>Khối xét tuyển: " . ($row['khoi_xet_tuyen']) . "</h4>";
                            echo "<h4>Ngày kết thúc: " . ($row['ngay_ket_thuc']) . "</h4>";
                        ?>
                    </div>
                    <div class="form-group">
                    <?php
                            form_ho_so();
                    ?>
                    </div>
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