<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location: login.php");
}
else{
    $link = new mysqli('localhost','root','','baitap3') or die('kết nối thất bại ');
    mysqli_query($link, 'SET NAMES UTF8');
    $query = 'SELECT * FROM user WHERE id = "'.$_GET['id'].'"' ;
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) > 0){
        $i=0;
        while ($r = mysqli_fetch_assoc($result)){
            $i++;
            $idSV = $r['id'];
            $username=$r['username'];
            $pass = $r['password'];
            $ten= $r['hoTen'];
            $ngaysinh=$r['dob'];
            $sdt = $r['sdt'];
            $quequan = $r['diaChi'];
            $cmt=$r['cmt'];
            $khoa = $r['khoa'];
            $nienKhoa = $r['nienKhoa'];
            $idLop = $r['LopmaLop'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Trang quản lý đào tạo</title>
     <!-- Font Icon -->
     <link rel="stylesheet" href="../registration/fonts/material-icon/css/material-design-iconic-font.min.css">
     <!-- Main css -->
    <link rel="stylesheet" href="../registration/css/style.css">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <form method="POST" class="register-form" id="register-form">
                        <h2>SỬA THÔNG TIN SINH VIÊN</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Tài khoản  :</label>
                                <td> <?php echo $username?></td>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Mật khẩu :</label>
                                <td> <input type="password" name="password" autofocus value="<?php echo $pass ?>"></td>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ và tên :</label>
                            <td> <input type="text" name="hoTen" autofocus value="<?php echo $ten?>"></td>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ :</label>
                            <td> <input type="text" name="diaChi"value="<?php echo $quequan?>"></td>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="cmt">Số chứng minh thư :</label>
                                <td> <input type="text" name="cmt" autofocus value="<?php echo $cmt?>"></td>
                            </div>
                            <div class="form-group">
                                <label for="address">Số điện thoại :</label>
                                <td> <input type="text" name="sdt"value="<?php echo $sdt?>"></td>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Ngày tháng năm sinh :</label>
                            <td> <input type="date" name="dob"value="<?php echo $ngaysinh?>"></td>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Khóa học :</label>
                            <td> <input type="text" name="nienKhoa" autofocus value="<?php echo $nienKhoa?>"></td>
                        </div>
                        <div class="form-group">
                            <label for="course">Khoa (Chuyên ngành hiện tại) :</label>
                            <td> <input type="text" name="khoa" autofocus value="<?php echo $khoa?>"></td>
                        </div>
                        <div class="form-group">
                        <tr>
                            <?php
                                $q = "SELECT * FROM lop";
                                $rs = mysqli_query($link, $q);
                                if(mysqli_num_rows($rs)>0)
                                {
                                    $i =0;
                                    while ($row  = mysqli_fetch_assoc($rs))
                                    {
                                        $i++;
                                        if ($idLop == $row['maLop']){
                                            $tenlop = $row['tenLop'];
                                        }
                                    }
                                }
                            ?>
                            </tr>
                            <label for="class">Lớp :</label>
                            <td> <input type="text" name="class" autofocus value="<?php echo $tenlop?>"></td>
                        </div>
                        <div class="form-submit">
                            <form action="registration.php">
                                <input type="submit" class="submit" name="submit" value="Sửa thông tin" id="submit" />
                            </form>
                            <form action="admin.php">
                                <input type="submit" class="submit" value="Quay lại trang chủ" />
                            </form>
                        </div>

                        <?php
                        function getClassId() {
                            $link = new mysqli('localhost','root','','baitap3') or die('kết nối thất bại ');
                            $q = "SELECT * FROM lop";
                            $rs = mysqli_query($link, $q);
                            if(mysqli_num_rows($rs)>0)
                            {
                                $i =0;
                                while ($row  = mysqli_fetch_assoc($rs))
                                {
                                    $i++;
                                    $lopID = $row['maLop'];
                                    $tenlop = $row['tenLop'];

                                    if (strcasecmp($tenlop, $_POST['class']) == 0){
                                        return $lopID;
                                        break;
                                    }
                                }
                            }
                        }

                        if(isset($_POST['submit'])){
                            if(empty($_POST['username']) or empty($_POST['password'])) {echo'</br> <p style="color:red;font-weight:bold; "> vui lòng không để trống các trường!</p> </br>';}
                            else{
                                $username = $_POST['username'];
                                $matkhau = $_POST['password'];
                                $hotenSV = $_POST['hoTen'];
                                $ngaySinh = $_POST['dob'];
                                $sDt = $_POST['sdt'];
                                $queQuan = $_POST['diaChi'];
                                $cmt = $_POST['cmt'];
                                $khoa = $_POST['khoa'];
                                $nienkhoa = $_POST['nienKhoa'];
                                $lopID = $idLop;
                                $query = "UPDATE `user` SET username='$username', password ='$matkhau' hoTen = '$hotenSV', dob = '$ngaySinh', sdt = '$sDt', diaChi = '$queQuan'
                                ,cmt ='$cmt' ,khoa = '$khoa', nienKhoa ='$nienkhoa', LopmaLop='$lopID'
                                 , role = '2' WHERE id = '$idSV'";
                                mysqli_query($link, $query);
                                header('location:../sinhvien.php');
                            }
                        }
                        ?>
                </form>
            </div>
        </div>
     </div>
</div>

<!-- JS -->
<script src="../registration/vendor/jquery/jquery.min.js"></script>
<script src="../registration/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
