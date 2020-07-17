<?php
include ('connect.php');
$error='';
session_start();

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from user where username='$username' and password='$password'";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['ROLE']=$row['role'];
        $_SESSION['IS_LOGIN']='yes';
        if($row['role']==1){

            $_SESSION['username']= $username;
            header('location:admin.php');
            /*die();*/
        }if($row['role']==2){

            $_SESSION['username']= $username;
            header('location:student.php');
            /*	die();*/
        }
    }else{
        $error='Sai tài khoản hoặc mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Trang đăng nhập</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../admin/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="https://portal.ptit.edu.vn/wp-content/uploads/2016/04/ptit-logo.png" alt="logo">
              </div>
              <h4>Xin chào</h4>
              <h6 class="font-weight-light">Đăng nhập để tiếp tục</h6>
              <form  class="pt-3" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail">Mã sinh viên hoặc giáo viên</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="username" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Mã SV hoặc GV">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Mật khẩu</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Mật khẩu">
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Lưu đăng nhập
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                </div>
                <div class="my-3">
                  <input type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"></input>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end"></p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../admin/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../admin/js/off-canvas.js"></script>
  <script src="../admin/js/hoverable-collapse.js"></script>
  <script src="../admin/js/template.js"></script>
  <script src="../admin/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
