<?php
    session_start();
    if (isset($_SESSION['username'])){
    $link = new mysqli('localhost','root','','baitap3') or die('kết nối thất bại ');
    mysqli_query($link, 'SET NAMES UTF8');
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
                        <h2>TẠO TÀI KHOẢN CHO SINH VIÊN</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Tài khoản  :</label>
                                <input type="text" name="username"/>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Mật khẩu :</label>
                                <input type="text" name="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ và tên :</label>
                            <input type="text" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ :</label>
                            <input type="text" name="address"/>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Giới tinh :</label>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="male" checked>
                                <label for="male">Nam</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="female">
                                <label for="female">Nữ</label>
                                <span class="check"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="cmt">Số chứng minh thư :</label>
                                <input type="text" name="idcard"/>
                            </div>
                            <div class="form-group">
                                <label for="address">Số điện thoại :</label>
                                <input type="text" name="phoneNumber"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Ngày tháng năm sinh :</label>
                            <input type="date" name="birth_date">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Khóa học :</label>
                            <input type="text" name="year">
                        </div>
                        <div class="form-group">
                            <label for="course">Khoa (Chuyên ngành hiện tại) :</label>
                            <div class="form-select">
                                <select name="course">
                                    <option value=""></option>
                                    <option value="CNTT">Công nghệ thông tin</option>
                                    <option value="ATBM">An toàn bảo mật</option>
                                    <option value="CNDPT">Công nghệ đa phương tiện</option>
                                    <option value="TTDPT">Truyền thông đa phương tiện</option>
                                </select>
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="class">Lớp :</label>
                            <input type="class" name="class"/>
                        </div>
                        <div class="form-submit">
                            <form action="registration.php">
                                <input type="submit" class="submit" name="submit" value="Tạo tài khoản" id="submit" />
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
                            if(empty($_POST['username']) and empty($_POST['password'])) {echo'<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';}
                            else
                            {
                                $username = $_POST['username'];
                                $matkhau = $_POST['password'];
                                $hotenSV = $_POST['name'];
                                $ngaySinh = $_POST['birth_date'];
                                $lopID = getClassId();
                                $sDt = $_POST['phoneNumber'];
                                $queQuan = $_POST['address'];
                                $cmt = $_POST['idcard'];
                                $khoa = $_POST['course'];
                                $nienkhoa = $_POST['year'];

                                $query = "INSERT INTO `user`( `username`,`password`,`hoTen`, `dob`,`diaChi`, `cmt`, `sdt`,`khoa`,`nienKhoa`,`role`,`LopmaLop`) 
                                VALUES('$username','$matkhau','$hotenSV','$ngaySinh','$queQuan','$cmt','$sDt','$khoa','$nienkhoa','2','$lopID')";
                                mysqli_query($link,$query) or die("thêm dữ liệu thất bại");
                                $str = "Thêm sinh viên thành công";
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
<?php
}
else{
    header('location:../login.php');
}
?>