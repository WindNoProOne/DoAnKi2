<!DOCTYPE html>
<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Add Inventory";

if (!isset($_GET["id"])) {
    header("Location: inventory.php");
}

$id = $_GET["id"];

$queryInventory = "SELECT * FROM `tbInventory` WHERE InventoryID = {$id};";
$rsInventory = mysqli_query($conn, $queryInventory);
$rcInventory = mysqli_fetch_array($rsInventory);

if (isset($_POST["btnAdd"])) {
    $quantity = $_POST["quantity"];

   
    $queryAdd = "UPDATE `tbInventory` SET `Quantity` = `Quantity` + {$quantity} WHERE `InventoryID` = {$id};";
    $rsAdd = mysqli_query($conn, $queryAdd);

    header("Location: inventory.php");
}

include 'php/htmlHead.php';
include 'php/sidebar.php';

?>

    <div class="container section-margin">
        <form method="post" enctype="multipart/form-data">
            <caption>
                <h2>Add Quantity</h2>
            </caption>
            <a href="inventory.php">Back to product list</a>
            <table width="50%" class="table table-borderless">
                <tr>
                    <td>Inventory ID:</td>
                    <td><input name="txtProId" placeholder="Enter ID: PPxx" value="<?= $rcInventory[0]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Product ID:</td>
                    <td><input name="txtName" placeholder="Enter Name" value="<?= $rcInventory[1]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Size:</td>
                    <td><input name="txtPrice" placeholder="Enter price" value="<?= $rcInventory[2]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" min="0" step="1" max="1000" name="quantity" pattern="[0-9]{1,}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnAdd"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    mysqli_close($conn);
    include 'php/htmlBody.php';
    ?>