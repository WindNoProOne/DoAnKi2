<?php
session_start();

include_once 'DBConnect.php';

$query = "SELECT UserID FROM tbUser_Account WHERE UserName = '{$_SESSION["username"]}';";
$rs = mysqli_query($conn, $query);
$rc = mysqli_fetch_array($rs);

// $count = count($_SESSION["prodID"]);
// for ($i = 0; $i < $count; $i++) :
//     $prodID = $_SESSION["prodID"][$i];
//     $size = $_SESSION["size"][$i];
//     $quantity = $_SESSION["quantity"][$i];


//     $queryInventory = "SELECT `InventoryID` FROM `tbInventory` WHERE `ProductID` = '{$prodID}' AND `Size` = '{$size}';";
//     $rsInventory = mysqli_query($conn, $queryInventory);
//     $rcInventory = mysqli_fetch_array($rsInventory);

//     // Add Details
    
//     $detailsID = substr($rcInventory[0], 3, 3)."$quantity".date('s');
//     $queryDetails = "INSERT INTO `tbOrder_Details` VALUES ('$detailsID', '{$rcInventory[0]}', {$quantity});";
//     $rsDetails = mysqli_query($conn, $queryDetails);

//     // Reduce Quantity in Inventory
//     $queryStock = "UPDATE `tbInventory` SET `Quantity` = `Quantity` - {$quantity} WHERE `InventoryID` = '{$rcInventory[0]}';";
//     $rsStock = mysqli_query($conn, $queryStock);

//     // Add Master
//     $masterID = "M".substr($detailsID, 0, 3).date('s').$rc[0];
//     $queryMaster = "INSERT INTO `tbOrder_Master` VALUES ('$masterID', '{$detailsID}', '{$rc[0]}', '{$paymentID}', NOW(), '');";
//     $rsMaster = mysqli_query($conn, $queryMaster);

// endfor;



$username = $_SESSION["username"];
mysqli_close($conn);
unset($_SESSION["prodID"]);
unset($_SESSION["size"]);
unset($_SESSION["quantity"]);
header("Location: ../home.php");
