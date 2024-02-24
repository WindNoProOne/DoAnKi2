<?php
include_once "DBConnect.php";
if (!isset($_GET['code'])) :
    header("location: ../user.php");
endif;
$code = $_GET['code'];

$query = "DELETE FROM tbDelivery_Address WHERE userid = '{$code}';"
    . "DELETE FROM tbOrder_Master WHERE userid = '{$code}';"
    . "DELETE FROM tbFeedback WHERE userid = '{$code}';"
    . "DELETE FROM tbUser_Account WHERE userid = '{$code}';";
mysqli_multi_query($conn, $query);
header("location:../user.php");
