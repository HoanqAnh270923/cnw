<?php
include 'connectdb.php';
ob_start(); // Start output buffering

function kiem_tra_dang_nhap($tk, $mk){
    global $conn;
    $sql = "SELECT `role`,`ho_va_ten`,`id` FROM `user` WHERE `tai_khoan` = '$tk' AND `mat_khau` = '$mk'";
    $kq = mysqli_query($conn, $sql);
    $_SESSION['login'] = 0;
    if (mysqli_num_rows($kq) > 0) {
        $row = mysqli_fetch_assoc($kq); 
        if ($row['role'] == 0) {
            $_SESSION['login']++;
            $_SESSION['role'] = 0;
            $_SESSION['username'] = $tk;
            $_SESSION['ho_va_ten'] = $row['ho_va_ten'];
            $_SESSION['id_user'] = $row['id'];
            header('location:trang_chu.php');
            ob_end_flush();
            exit();
        }
        if ($row['role'] == 1) {
            $_SESSION['login']++;
            $_SESSION['role'] = 1;
            $_SESSION['username'] = $tk;
            $_SESSION['ho_va_ten'] = $row['ho_va_ten'];
            $_SESSION['id_user'] = $row['id'];
            header('location:trang_chu.php');
            ob_end_flush();
            exit();
        }
        if ($row['role'] == 2) {
            $_SESSION['login']++;
            $_SESSION['role'] = 2;
            $_SESSION['username'] = $tk;
            $_SESSION['ho_va_ten'] = $row['ho_va_ten'];
            $_SESSION['id_user'] = $row['id'];
            header('location:trang_chu.php');
            ob_end_flush();
            exit();
        }
    }
}

function checkRole() {
    ob_start();
    if ($_SESSION['role'] > 0) {
        echo "<script>
            alert('Bạn không có quyền truy cập trang này!');
            window.location.href='trang_chu.php';
        </script>";
        ob_end_flush();
        exit();
    }
}

// trang chu

function ifadmin(){
    global $conn;
    $sql = "SELECT * FROM nghanh_xet_tuyen"; 
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="item-container">';
            echo '<a class="item" href="nop_ho_so.php?id_nghanh=' . $row['id_nghanh'] . '">';
            echo "<h4>" . htmlspecialchars($row['ten_nghanh']) . "</h4>";
            echo "<p>Khối xét tuyển: " . htmlspecialchars($row['khoi_xet_tuyen']) . "</p>";
            echo "<p>Thời gian bắt đầu: " . htmlspecialchars($row['ngay_bat_dau']) . "</p>"; 
            echo "<p>Thời gian kết thúc: " . htmlspecialchars($row['ngay_ket_thuc']) . "</p>";     
            echo "<h5>Giáo viên: " . htmlspecialchars($row['giao_vien']) . "</h5>";          
            echo "</a>";
            if ($_SESSION['role'] == 0) {
                echo '<div class="action-buttons">';
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="id_nghanh" value="' . $row['id_nghanh'] . '">';
                echo '<button type="submit" name="toggle_status" class="toggle-btn ' . ($row['trang_thai'] == 1 ? 'hide' : 'show') . '">';
                echo $row['trang_thai'] == 1 ? 'Ẩn' : 'Hiện';
                echo '</button>';
                echo '</form>';
                echo '</div>';
            }
            echo '</div>';
            }
        }
    exit();
    }

    function ifteacherstudent(){
        global $conn;
        $sql = "SELECT * FROM nghanh_xet_tuyen"; 
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['trang_thai'] == 1) {
                    echo '<div class="item-container">';
                    echo '<a class="item" href="nop_ho_so.php?id_nghanh=' . $row['id_nghanh'] . '">';
                    echo "<h4>" . htmlspecialchars($row['ten_nghanh']) . "</h4>";
                    echo "<p>Khối xét tuyển: " . htmlspecialchars($row['khoi_xet_tuyen']) . "</p>";
                    echo "<p>Thời gian bắt đầu: " . htmlspecialchars($row['ngay_bat_dau']) . "</p>"; 
                    echo "<p>Thời gian kết thúc: " . htmlspecialchars($row['ngay_ket_thuc']) . "</p>";     
                    echo "<h5>Giáo viên: " . htmlspecialchars($row['giao_vien']) . "</h5>";          
                    echo "</a>";
                    echo '</div>';
                }
            }
        }
    }
    



// nop ho so /////////////////////

function form_ho_so() {
    global $conn;    
    $id_nghanh = $_SESSION['id_nghanh'];

    $sql = "SELECT * FROM nghanh_xet_tuyen WHERE id_nghanh = '$id_nghanh'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $khoi_xet_tuyen = $row['khoi_xet_tuyen'];
    $id_user = $_SESSION['id_user'];
    $ho_va_ten = $_SESSION['ho_va_ten'];


    echo '<form method="post" action="" enctype="multipart/form-data">';
    if ($khoi_xet_tuyen == "A01") {
        echo "<div class='form-group'>";
        echo "<label for='toan'>Điểm môn Toán</label>";
        echo "<input type='number' step='0.01' id='toan' name='toan' placeholder='Nhập điểm Toán' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='ly'>Điểm môn Lý</label>";
        echo "<input type='number' step='0.01' id='ly' name='ly' placeholder='Nhập điểm Lý' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='anh'>Điểm môn Anh</label>";
        echo "<input type='number' step='0.01' id='anh' name='anh' placeholder='Nhập điểm Anh' required>";
        echo "<label for='hoc_ba'>Ảnh học bạ (PNG/JPG, tối đa 100MB)</label>";
        echo "<input type='file' 
             id='hoc_ba' 
             name='hoc_ba' 
             accept='.png,.jpg' 
             >";
        echo "</div>";

        echo "<input type='hidden' name='hoa' value='0'>";
        echo "<input type='hidden' name='sinh' value='0'>";
        echo "<input type='hidden' name='lichsu' value='0'>";
        echo '<button type="submit" name="submit" class="submit-btn">Nộp hồ sơ</button>';
    } else if ($khoi_xet_tuyen == "A00"){
        echo "<div class='form-group'>";
        echo "<label for='toan'>Điểm môn Toán</label>";
        echo "<input type='number' step='0.01' id='toan' name='toan' placeholder='Nhập điểm Toán' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='ly'>Điểm môn Lý</label>";
        echo "<input type='number' step='0.01' id='ly' name='ly' placeholder='Nhập điểm Lý' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='anh'>Điểm môn Hóa</label>";
        echo "<input type='number' step='0.01' id='hoa' name='hoa' placeholder='Nhập điểm Hóa' required>";
        echo "<label for='hoc_ba'>Ảnh học bạ (PNG/JPG, tối đa 100MB)</label>";
        echo "<input type='file' 
             id='hoc_ba' 
             name='hoc_ba' 
             accept='.png,.jpg' 
             required>";
        echo "</div>";

        echo "<input type='hidden' name='anh' value='0'>";
        echo "<input type='hidden' name='sinh' value='0'>";
        echo "<input type='hidden' name='lichsu' value='0'>";
        echo '<button type="submit" name="submit" class="submit-btn">Nộp hồ sơ</button>';
}   else if ($khoi_xet_tuyen == "B00"){
    echo "<div class='form-group'>";
    echo "<label for='toan'>Điểm môn Toán</label>";
    echo "<input type='number' step='0.01' id='toan' name='toan' placeholder='Nhập điểm Toán' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='ly'>Điểm môn Sinh</label>";
    echo "<input type='number' step='0.01' id='sinh' name='sinh' placeholder='Nhập điểm Sinh' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='anh'>Điểm môn Hóa</label>";
    echo "<input type='number' step='0.01' id='hoa' name='hoa' placeholder='Nhập điểm Hóa' required>";
    echo "<label for='hoc_ba'>Ảnh học bạ (PNG/JPG, tối đa 100MB)</label>";
    echo "<input type='file' 
             id='hoc_ba' 
             name='hoc_ba' 
             accept='.png,.jpg' 
             required>";
    echo "</div>";

    echo "<input type='hidden' name='anh' value='0'>";
    echo "<input type='hidden' name='ly' value='0'>";
    echo "<input type='hidden' name='lichsu' value='0'>";
    echo '<button type="submit" name="submit" class="submit-btn">Nộp hồ sơ</button>';
        echo "</div>";
} else if ($khoi_xet_tuyen == "B01"){
    echo "<div class='form-group'>";
        echo "<label for='toan'>Điểm môn Toán</label>";
        echo "<input type='number' step='0.01' id='toan' name='toan' placeholder='Nhập điểm Toán' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='ly'>Điểm môn Sinh</label>";
        echo "<input type='number' step='0.01' id='sinh' name='sinh' placeholder='Nhập điểm Sinh' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='anh'>Điểm môn Lịch sử</label>";
        echo "<input type='number' step='0.01' id='su' name='lichsu' placeholder='Nhập điểm Lịch sử' required>";
        echo "<label for='hoc_ba'>Ảnh học bạ (PNG/JPG, tối đa 100MB)</label>";
        echo "<input type='file' 
             id='hoc_ba' 
             name='hoc_ba' 
             accept='.png,.jpg' 
             required>";
        echo "</div>";

        echo "<input type='hidden' name='anh' value='0'>";
        echo "<input type='hidden' name='ly' value='0'>";
        echo "<input type='hidden' name='hoa' value='0'>";
        echo '<button type="submit" name="submit" class="submit-btn">Nộp hồ sơ</button>';
}
    echo "</form>";

    if(isset($_POST['submit'])) {
        $toan = $_POST['toan'] ?? 0;
        $ly = $_POST['ly'] ?? 0; 
        $hoa = $_POST['hoa'] ?? 0;
        $sinh = $_POST['sinh'] ?? 0;
        $anh = $_POST['anh'] ?? 0;
        $lichsu = $_POST['lichsu'] ?? 0;
        
        $id_user = $_SESSION['id_user'];
        $id_nghanh = $_SESSION['id_nghanh'];
        $ho_va_ten = $_SESSION['ho_va_ten'];
        
        $sql = "INSERT INTO `ho_so_nop`(`id_ho_so`, `id_user`, `id_nghanh`, `ho_va_ten`, `khoi_xet_tuyen`, `diem_toan`, `diem_ly`, `diem_hoa`, `diem_anh`, `diem_sinh`, `diem_lichsu`, `ngay_nop`, `trang_thai`) 
                VALUES ('','$id_user', '$id_nghanh', '$ho_va_ten','$khoi_xet_tuyen', '$toan', '$ly', 
                '$hoa', '$anh', '$sinh', '$lichsu', NOW() , 0)";
                
                if(mysqli_query($conn, $sql)) {
                    if (isset($_FILES['hoc_ba'])){
                        $upload_dir = "uploads/" . $khoi_xet_tuyen;
                        if (!file_exists($upload_dir)){
                            mkdir($upload_dir, 0777, true);
                        }
                
                        if ($_FILES["hoc_ba"]["size"] > 104857600){
                            echo "Giới hạn dung lượng file <100Mb";
                        }
                        else{
                            $hoc_ba = strtolower(pathinfo($_FILES['hoc_ba']['name'], PATHINFO_EXTENSION));
                            if ($hoc_ba != "jpg" && $hoc_ba != "png"){
                                echo "File không đúng định dạng";
                            }
                            else{
                                
                                $new_filename = $_SESSION['ho_va_ten'] . '_' . $_SESSION['id_user'] .'_' . $khoi_xet_tuyen .'.'. $hoc_ba;
                                $file_path = $upload_dir . '/' . $new_filename;
                
                                
                                if (move_uploaded_file($_FILES['hoc_ba']['tmp_name'], $file_path)) {
                                    $_SESSION['hoc_ba_path'] = $file_path;
                                    header('location:trang_chu.php');
                                    echo "<script>alert('Đã nộp hồ sơ thành công');</script>";
                                    exit();
                                } else {
                                    echo "<script>alert('Lỗi upload file')</script>";
                                }
                            }
                        }
                    }
                }
                
                
                else {
                    echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                }
                
    }


    

    // if (isset($_POST['btn-submit'])) {
    //     $toan = $_POST['toan'] ?? 0;
    //     $ly = $_POST['ly'] ?? 0; 
    //     $hoa = $_POST['hoa'] ?? 0;
    //     $sinh = $_POST['sinh'] ?? 0;
    //     $anh = $_POST['anh'] ?? 0;
    //     $lichsu = $_POST['lichsu'] ?? 0;

    //     $sql = "INSERT INTO `ho_so_nop`(`id_ho_so`, `id_user`, `id_nghanh`, `ho_va_ten`,`khoi_xet_tuyen`, `diem_toan`, `diem_ly`, `diem_hoa`, `diem_anh`, `diem_sinh`, `diem_lichsu`, `ngay_nop`)
    //         VALUES ('','$id_user', '$id_nghanh','$ho_va_ten','$khoi_xet_tuyen', '$toan', '$ly', '$hoa', '$sinh', '$anh', '$lichsu',now())";
    //     if (mysqli_query($conn, $sql)) {
    //         if (isset($_FILES['hoc_ba'])){
    //             $upload_dir = "uploads/" . $khoi_xet_tuyen;
    //             if (!file_exists($upload_dir)){
    //                 mkdir($upload_dir, 0777, true);
    //             }

    //             if ($_FILES["hoc_ba"]["size"] > 104857600){
    //                 echo "Giới hạn dung lượng file <100Mb";
    //             }
    //             else{
    //             $hoc_ba = strtolower(pathinfo($_FILES['hoc_ba']['name'], PATHINFO_EXTENSION));
    //                 if ($hoc_ba != "jpg" && $hoc_ba != "png"){
    //                     echo "File không đúng định dạng";
    //                 }
    //                 else{
    //                     $new_filename = time() . '_' . $_SESSION['id_user'] . '';
    //                     $file_path = $upload_dir . '/' . $new_filename;
    //                     // Move file to directory
    //                     if (move_uploaded_file($_FILES['hoc_ba']['tmp_name'], $file_path)) {
    //                         $_SESSION['hoc_ba_path'] = $file_path;
    //                     } else {
    //                         echo "<script>alert('Lỗi upload file')</script>";
    //                     }
    //                 }
    //             }
    //         }
    //         echo "<script>
    //             alert('Nộp hồ sơ thành công!');
    //             </script>";
    //     } else {
    //         echo "Lỗi: " . mysqli_error($conn);
    //     }

    // }

}

function da_nop(){
    global $conn;
    $sql = "SELECT * FROM ho_so_nop WHERE id_user = ".$_SESSION['id_user'] . " AND id_nghanh = " . $_SESSION['id_nghanh'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
            alert('Bạn đã nộp hồ sơ cho ngành này rồi!');
            window.location.href='trang_chu.php';
        </script>";
        exit();
    }

}









// danh sach ho so 


function danhsachifgiaovien(){
    global $conn;
    $sql = "SELECT * FROM ho_so_nop";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
                if ($row['khoi_xet_tuyen'] == 'A00') {
                    echo '<div class="item" onclick="chi_tiet_ho_so()">';
                    echo "<h4 class='gv'>Giáo Viên: </h4>";
                    echo "<h5>Khối xét tuyển:".$row['khoi_xet_tuyen']."</h5>";
                    echo "<span>Điểm Toán: ".$row['diem_toan']."</span>";
                    echo "<span>Điểm Lý: ".$row['diem_ly']."</span>";
                    echo "<span>Điểm hóa: ".$row['diem_hoa']."</span>";
                    echo "<p>Tổng điểm: ".$row['diem_toan'] + $row['diem_ly'] + $row['diem_hoa']."</p>";
                    echo "<h5>Trạng Thái: " . ($row['trang_thai'] == 1 ? "Đã xử lý" : "Chưa xử lý") . "</h5>";
                }
                if ($row['khoi_xet_tuyen'] == 'A01') {
                    echo '<div class="item" onclick="chi_tiet_ho_so()">';
                    echo "<h4 class='gv'>Giáo Viên: </h4>";
                    echo "<h5>Khối xét tuyển:".$row['khoi_xet_tuyen']."</h5>";
                    echo "<span>Điểm Toán: ".$row['diem_toan']."</span>";
                    echo "<span>Điểm Lý: ".$row['diem_ly']."</span>";
                    echo "<span>Điểm Anh: ".$row['diem_anh']."</span>";
                    echo "<p>Tổng điểm: ".$row['diem_toan'] + $row['diem_ly'] + $row['diem_anh']."</p>";
                    echo "<h5>Trạng Thái: " . ($row['trang_thai'] == 1 ? "Đã xử lý" : "Chưa xử lý") . "</h5>";
                }
                if ($row['khoi_xet_tuyen'] == 'B00') {
                    echo '<div class="item" onclick="chi_tiet_ho_so()">';
                    echo "<h4 class='gv'>Giáo Viên: </h4>";
                    echo "<h5>Khối xét tuyển:".$row['khoi_xet_tuyen']."</h5>";
                    echo "<span>Điểm Toán: ".$row['diem_toan']."</span>";
                    echo "<span>Điểm Sinh: ".$row['diem_sinh']."</span>";
                    echo "<span>Điểm Hóa: ".$row['diem_hoa']."</span>";
                    echo "<p>Tổng điểm: ".$row['diem_toan'] + $row['diem_sinh'] + $row['diem_hoa']."</p>";
                    echo "<h5>Trạng Thái: " . ($row['trang_thai'] == 1 ? "Đã xử lý" : "Chưa xử lý") . "</h5>";
                }
                if ($row['khoi_xet_tuyen'] == 'B01') {
                    echo '<div class="item" onclick="chi_tiet_ho_so()">';
                    echo "<h4 class='gv'>Giáo Viên: </h4>";
                    echo "<h5>Khối xét tuyển:".$row['khoi_xet_tuyen']."</h5>";
                    echo "<span>Điểm Toán: ".$row['diem_toan']."</span>";
                    echo "<span>Điểm Sinh: ".$row['diem_sinh']."</span>";
                    echo "<span>Điểm Lịch Sử: ".$row['diem_lichsu']."</span>";
                    echo "<p>Tổng điểm: ".$row['diem_toan'] + $row['diem_sinh'] + $row['diem_lichsu']."</p>";
                    echo "<h5>Trạng Thái: " . ($row['trang_thai'] == 1 ? "Đã xử lý" : "Chưa xử lý") . "</h5>";
                }
            echo "</div>";
        }
    }

}







?>