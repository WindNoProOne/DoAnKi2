<?php
session_start();

if (!isset($_GET["index"])) :
    header("Location: ../cart.php");
endif;

$index = $_GET["index"];

if((isset($index))) {
    array_splice($_SESSION["prodID"], $index, 1);
    array_splice($_SESSION["size"], $index, 1);
    array_splice($_SESSION["quantity"], $index, 1);
}

header("Location: ../cart.php");
