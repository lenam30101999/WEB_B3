<?php
$link = new mysqli('localhost','root','','baitap3') or die('kết nối thất bại ');
mysqli_query($link, 'SET NAMES UTF8');

if(isset($_GET['id'])){
    $hoTen = $_GET['id'];
    echo $hoTen;
    $query = 'DELETE FROM `user` WHERE id = "'.$_GET['id'].'"' ;
    mysqli_query($link,$query) or die("xóa dữ liệu thất bại");
    header('location:table-admin.php');
}
?>
