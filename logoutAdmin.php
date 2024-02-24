<?php
#1 start session
session_start();
#2 clear session
unset($_SESSION['sessionAdmin ']);
session_destroy();
header("location: loginAdmin.php");
exit();