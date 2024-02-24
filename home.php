<?php
session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Pheidip Shop";


$showLogin = "";
$hideLogout = "";

if (isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	if (!isset($_SESSION["prodID"])) {
		$_SESSION["prodID"] = array();
		$_SESSION["size"] = array();
		$_SESSION["quantity"] = array();
	}


	$showLogin = "hidden";
} else {
	session_unset();
	session_write_close();

	$hideLogout = "hidden";
	// $url = "./index.php";
	// header("Location: $url");
}

include 'php/htmlHead.php';
include 'php/navigationBar.php';
include 'php/carousel.php';
include 'php/type.php';
include 'php/slider.php';
include 'php/brandSection.php';
include 'php/footer.php';
include 'php/htmlBody.php';
mysqli_close($conn);
