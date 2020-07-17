<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $link = new mysqli('localhost','root','','baitap3') or die('kết nối thất bại ');
    mysqli_query($link, 'SET NAMES UTF8');
    $query = "SELECT user.id, user.username, user.password FROM user WHERE user.username = '{$username}'" ;
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) != 0){
        while ($r = mysqli_fetch_assoc($result)){
           $id = $r['id'];
           $username=$r['username'];
           $pass = $r['password'];
        }
    }
    //echo $query;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from https://bootdey.com  -->
    <!--  All snippets are MIT license https://bootdey.com/license -->
    <title>QLDT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .separator {
            border-right: 1px solid #dfdfe0;
        }
        .icon-btn-save {
            padding-top: 0;
            padding-bottom: 0;
        }
        .input-group {
            margin-bottom:10px;
        }
        .btn-save-label {
            position: relative;
            left: -12px;
            display: inline-block;
            padding: 6px 12px;
            background: rgba(0,0,0,0.15);
            border-radius: 3px 0 0 3px;
        }
    </style>
</head>
<body>

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Thay đổi mật khẩu
                    </h3>
                </div>
                <div class="panel-body">
                    <h4>
                        Tên đăng nhập:
                        <?php echo $_SESSION['username'] ?>
                    </h4>

                </div>
                <div class="form">
                    <form action="changepassword.php" method="POST">
                    <label for="old">Mật khẩu cũ</label>
                        <br>
                    <input type="password" name="old">
                        <br>
                    <label for="new">Mật khẩu mới</label>
                        <br>
                    <input type="password" name="new">
                        <br>
                     <label for="new">Nhập lại mật khẩu</label>
                        <br>
                     <input type="password" name="current">
                        <br><br>
                    <input type="submit" value="Sửa" name="sua">
                    </form>
                    <br>
                    <form action="student.php">
                        <input type="submit" class="submit" value="Quay lại" />
                    </form>
                </div>
                <?php
                if(isset($_POST['sua'])){
                    if(empty($_POST['old']) or empty($_POST['new'])) {echo'</br> <p style="color:red;font-weight:bold; "> Vui lòng không để trống</p> </br>';}
                    else{
                        if ($_POST['old'] == $pass && $_POST['new'] == $_POST['current']){
                            $matkhau = $_POST['new'];

                            $query = "UPDATE `user` SET password ='$matkhau' WHERE id = '$id'";
                            mysqli_query($link, $query) or die("sửa không thành công");
                            header('location: student.php');
                        }else{
                            echo'</br> <p style="color:red;font-weight:bold; "> Mật khẩu không trùng khớp</p> </br>';
                        }
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
<?php
}
else {
    header('location:login.php');
}
?>
