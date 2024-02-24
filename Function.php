<?php
//Start Session
session_start();


//Connect database
include_once 'DBConnect.php';
mysqli_close($conn);

// Set page title
$pageTitle = "";


// Check user session
if (!isset($_SESSION["username"])) :
  header("location: home.php");
endif;

// Execute sql query
$query = "";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
$detailsRecord = mysqli_fetch_array($rs);
mysqli_close($conn);


//Start Shopping Session
if (!isset($_SESSION["username"])) :
  $_SESSION["prodID"] = array();
  $_SESSION["size"] = array();
  $_SESSION["quantity"] = array();
endif;


// Add to cart
if (isset($_POST["btnAdd"])) :
  if (isset($_SESSION["userID"])) :
    array_push($_SESSION["prodID"], $productID);
    array_push($_SESSION["size"], $size);
    array_push($_SESSION["quantity"], $quantity);
  else :
    header("location: Login.php");
  endif;
endif;

//Empty Cart
if (isset($_POST['btnEmtpy'])) :
  unset($_SESSION["prodID"]);
  unset($_SESSION["size"]);
  unset($_SESSION["quantity"]);
endif;

// Add inventory
$quantity = $_POST["quantity"];
$productID = $_POST["prodID"];
$size = $_POST["size"];

$query = "UPDATE `tbInventory`
SET `Quantity` = `Quantity` + {$quantity}
WHERE `ProductID` = '{$productID}' AND `Size` = '{$size}';";
$rs = mysqli_query($conn, $query);

header("location: inventory.php");

// Inventory
for ($i = 0; $i < $countProduct; $i++) :
  if ($countInventory == 0) :
    $rcProduct = mysqli_fetch_array($rsProduct);
    $InvenID = $rcProduct[0] . "38";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '38', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "39";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '39', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "40";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '40', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "41";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '41', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "42";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '42', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

  else :
    for ($x = 0; $x < $countInventory; $x++) :
      $rcProduct = mysqli_fetch_array($rsProduct);
      $rcInventory = mysqli_fetch_array($rsInventory);
      if ($rcProduct[0] !== $rcInventory[1]) :
        $InvenID = $rcProduct[0] . "38";
        $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '38', 0);";
        $executeInsert = mysqli_query($conn, $queryInsert);

        $InvenID = $rcProduct[0] . "39";
        $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '39', 0);";
        $executeInsert = mysqli_query($conn, $queryInsert);

        $InvenID = $rcProduct[0] . "40";
        $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '40', 0);";
        $executeInsert = mysqli_query($conn, $queryInsert);

        $InvenID = $rcProduct[0] . "41";
        $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '41', 0);";
        $executeInsert = mysqli_query($conn, $queryInsert);

        $InvenID = $rcProduct[0] . "42";
        $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '42', 0);";
        $executeInsert = mysqli_query($conn, $queryInsert);
      endif;
    endfor;
  endif;
endfor;
