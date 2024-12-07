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

.pannel-content {
  display: flex;
  gap: 20px;
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Phần bên trái */
.left {
  flex: 2;
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.left h1, .left h2, .left h3 {
  margin-bottom: 15px;
  color: #333;
}

.left h1 {
  font-size: 24px;
  font-weight: bold;
}

.left h2 {
  font-size: 18px;
}

.left h3 {
  font-size: 16px;
}

.left form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.left button {
  padding: 10px 15px;
  font-size: 16px;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 10px;
  
}

.left button[name="accept"] {
  background-color: #4CAF50; 
}

.left button[name="reject"] {
  background-color: #F44336; 
}

.left button[name="delete"] {
  background-color: #FF9800; 
}

.left button:hover {
  opacity: 0.9;
}

.right {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        <form action="" method="post">
        <div id="detailPanel" class="detail-panel">
            <div class="pannel-content">
                <div class="left">
                    <?php
$id = $_GET['id_ho_so']; 
$_SESSION["id"] = $id;

$sql = "SELECT ho_so_nop.*, nghanh_xet_tuyen.ten_nghanh 
        FROM ho_so_nop 
        INNER JOIN nghanh_xet_tuyen 
        ON ho_so_nop.id_nghanh = nghanh_xet_tuyen.id_nghanh 
        WHERE ho_so_nop.id_ho_so = $id";

$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    echo "<h1>Học Sinh: " . $row['ho_va_ten'] . "</h1>";
    echo "<h2>Ngành xét tuyển: " . $row['ten_nghanh'] . "</h2>";
    echo "<h2>Khối xét tuyển: " . $row['khoi_xet_tuyen'] . "</h2>";
    echo "<h2>Thời gian nộp: " . $row['ngay_nop'] . "</h2>";
    echo "<h3>Điểm môn Toán: " . $row['diem_toan'] . "</h3>";
    echo "<h3>Điểm môn Lý: " . $row['diem_ly'] . "</h3>";
    echo "<h3>Điểm môn Hóa: " . $row['diem_hoa'] . "</h3>";
    echo "<h3>Điểm môn Anh: " . $row['diem_anh'] . "</h3>";
    echo "<h3>Điểm môn Sinh: " . $row['diem_sinh'] . "</h3>";
    echo "<h3>Điểm môn Lịch Sử: " . $row['diem_lichsu'] . "</h3>";
    echo "<h3>Tổng điểm: " . 
         ($row['diem_toan'] + $row['diem_ly'] + $row['diem_hoa'] + 
          $row['diem_anh'] + $row['diem_sinh'] + $row['diem_lichsu']) . "</h3>";
    
    if ($_SESSION['role'] <= 1){
        if ($row['trang_thai'] == 0) {
            echo "<button type='submit' name='accept'>Duyệt</button>";
            echo "<button type='submit' name='reject'>Không duyệt</button>";
        if ($_SESSION['role'] == 0) {
            echo "<button type='submit' name='delete'>Xóa hồ sơ</button>";
        }
        } elseif ($row['trang_thai'] == 1) {
            echo '<h3 style="color:red;">Trạng thái: Đã duyệt</h3>';
        } else {
            echo "<h3>Trạng thái: Bị từ chối</h3>";
        }
    }

} else {
    echo "<p>Không tìm thấy hồ sơ!</p>";
}
?>

                </div>
                <div class="right">
                    <div class="hoc_ba">
                        <?php
                            $upload_dir = "uploads/" . $row['khoi_xet_tuyen'] . "/" . $row['ho_va_ten'] . "_" . $row['id_user'] . "_" . $row['khoi_xet_tuyen'];
                            $file_jpg = $upload_dir . '.jpg';
                            $file_png = $upload_dir . '.png';
                            // Kiểm tra file nào tồn tại
                            if (file_exists($file_jpg)) {
                                echo "<img src='" . $file_jpg . "' alt='Học bạ' style='max-width: 500px; max-height: 500px;'>";
                            } elseif (file_exists($file_png)) {
                                echo "<img src='" . $file_png . "' alt='Học bạ' style='max-width: 500px; max-height: 500px;'>";
                            } else {
                                echo "Không tìm thấy file học bạ: " . $file_jpg . " hoặc " . $file_png;
                            }

                            
                        ?>
                    </div>
            </div>
            </form>
                    <?php
                        function profileprocess(){
                            global $conn;
                            if (isset($_POST['accept'])) {
                                $sql = "UPDATE ho_so_nop SET trang_thai = 1 WHERE id_ho_so = $_SESSION[id]";
                                mysqli_query($conn, $sql);
                                header('location: danh_sach_ho_so.php');
                                echo "<script>alert('Hồ sơ đã được duyệt!');</script>";
                            }
                            if (isset($_POST['reject'])) {
                                $sql = "UPDATE ho_so_nop SET trang_thai = 2 WHERE id_ho_so = $_SESSION[id]";
                                mysqli_query($conn, $sql);
                                header('location: danh_sach_ho_so.php');
                                echo "<script>alert('Hồ sơ đã bị từ chối!');</script>";
                            }
                            if (isset($_POST['delete'])) {
                                $sql = "DELETE FROM ho_so_nop WHERE id_ho_so = $_SESSION[id]";
                                mysqli_query($conn, $sql);
                                header('location: danh_sach_ho_so.php');
                                echo "<script>alert('Xóa hồ sơ thành công!');</script>";
                            }
                        }
                        profileprocess();
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