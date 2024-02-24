<?php
#1. Start session
#2. Kiểm tra
#3. Kết nối
include_once "php/DBConnect.php";
#4. Lấy item code từ Ex01
if (!isset($_GET['code'])) :
    header("location:user.php");
endif;
$code = $_GET['code'];
#5. Thực thi
$query = "UPDATE tbUser_Account SET status = !status WHERE userid = '{$code}'";
mysqli_query($conn, $query);
header("location:user.php");
