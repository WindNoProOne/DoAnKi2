<?php
session_start();

if (!isset($_GET["index"])) :
    header("Location: ../cart.php");
endif;

$index = $_GET["index"];

$_SESSION["quantity"][$index] = $_SESSION["quantity"][$index] - 1;

header("Location: ../cart.php");