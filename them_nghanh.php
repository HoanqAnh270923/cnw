<?php
session_start();
include 'function.php';
include 'connectdb.php';

if (!isset($_SESSION['login']) && $_SESSION['login'] == 0) {
    header('location:dang_nhap.php');
    exit();
}

checkRole();

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

.content {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.content h2 {
    color: #2c3e50;
    margin-bottom: 2rem;
    text-align: center;
    font-size: 1.8rem;
}

.add-major-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    color: #34495e;
    font-weight: 500;
    font-size: 1rem;
}

.form-group input,
.form-group select {
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
    outline: none;
}

select {
    background-color: white;
    cursor: pointer;
}

.submit-btn {
    background-color: #2980b9;
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
    background-color: #3498db;
    transform: translateY(-2px);
}

.submit-btn:active {
    transform: translateY(0);
}


@media (max-width: 768px) {
    .content {
        margin: 1rem;
        padding: 1rem;
    }
    
    .form-group input,
    .form-group select,
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
    <h2>Thêm nghành xét tuyển</h2>
    <form action="" method="post" class="add-major-form">
        <div class="form-group">
            <label for="nghanh">Tên nghành:</label>
            <input type="text" name="nghanh" id="nghanh" required>
        </div>
        <div class="form-group">
            <label for="khoi">Khối xét tuyển:</label>
            <select name="khoi" id="khoi">
                <option value="A00">A00</option>
                <option value="A01">A01</option>
                <option value="B00">B00</option>
                <option value="B01">B01</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" name="start_date" id="start_date">
        </div>

        <div class="form-group">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" name="end_date" id="end_date">
        </div>
        
        <div class="form-group">
            <label for="teacher">Giáo viên: </label>
            <select name="teacher" id="teacher">
            <?php
            $sql = "SELECT * FROM user WHERE role = 1";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach($rows as $row) {
                echo "<option value='" . $row['ho_va_ten'] . "'>" . $row['ho_va_ten'] . "</option>";
            }
            ?>
            </select>
        </div>
        <button type="submit" name="them" class="submit-btn">Thêm nghành</button>
    </form>
    <?php
    addmajor();
    ?>  

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