<?php
##1. Connect to databse
// session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Order History";

// Get User ID
$queryId = "SELECT `UserID`  FROM tbUser_Account WHERE UserName = '{$_SESSION["username"]}';";
$rsId = mysqli_query($conn, $queryId);
$rc = mysqli_fetch_array($rsId);
$userID = $rc[0];

$queryMaster = "SELECT * FROM tbOrder_Master WHERE `UserID` = {$userID};";
$rsMaster = mysqli_query($conn, $queryMaster);
$countMaster = mysqli_num_rows($rsMaster);

$queryDetails = "SELECT * FROM tbOrder_Details;";
$rsDetails = mysqli_query($conn, $queryDetails);
$countDetails = mysqli_num_rows($rsDetails);
$details = array();
for ($i = 0; $i < $countDetails; $i++) {
    $rcDetails = mysqli_fetch_array($rsDetails);
    array_push($details, $rcDetails);
}


$queryInventory = "SELECT `InventoryID`, `ProductID`, `Size` FROM tbInventory;";
$rsInventory = mysqli_query($conn, $queryInventory);
$countInventory = mysqli_num_rows($rsInventory);
$inventory = array();
for ($i = 0; $i < $countInventory; $i++) {
    $rcInventory = mysqli_fetch_array($rsInventory);
    array_push($inventory, $rcInventory);
}

$queryProduct = "SELECT `ProductID`, `ProductName` FROM tbProduct;";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);
$product = array();
for ($i = 0; $i < $countProduct; $i++) {
    $rcProduct = mysqli_fetch_array($rsProduct);
    array_push($product, $rcProduct);
}

$queryPayment = "SELECT `PaymentID`, `Method` FROM tbPayment;";
$rsPayment = mysqli_query($conn, $queryPayment);
$countPayment = mysqli_num_rows($rsPayment);
$payment = array();
for ($i = 0; $i < $countPayment; $i++) {
    $rcPayment = mysqli_fetch_array($rsPayment);
    array_push($payment, $rcPayment);
}


?>

<section class="mx-5">
    <table class="table table-hove table-bordered">
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Payment</th>
            <th>Date</th>
        </tr>
        <?php
        for ($i = 0; $i < $countMaster; $i++) :
            $rcMaster = mysqli_fetch_array($rsMaster);

        ?>
            <tr>
                <td><?= $rcMaster[0] ?></td>
                <td>
                    <?php
                    for ($z = 0; $z < count($details); $z++) {
                        if ($rcMaster[1] == $details[$z][0]) {
                            for ($y = 0; $y < count($inventory); $y++) {
                                if ($details[$z][1] == $inventory[$y][0]) {
                                    for ($k = 0; $k < count($product); $k++) {
                                        if ($inventory[$y][1] == $product[$k][0]) {
                                            echo $product[$k][1];
                                        }
                                    }
                                }
                            };
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    for ($z = 0; $z < count($details); $z++) {
                        if ($rcMaster[1] == $details[$z][0]) {
                            for ($y = 0; $y < count($inventory); $y++) {
                                if ($details[$z][1] == $inventory[$y][0]) {
                                    echo $inventory[$y][2];
                                }
                            }
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    for ($z = 0; $z < count($details); $z++) {
                        if ($rcMaster[1] == $details[$z][0]) {
                            echo $details[$z][2];
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    for ($z = 0; $z < count($payment); $z++) {
                        if ($rcMaster[3] == $payment[$z][0]) {
                            echo $payment[$z][1];
                        }
                    }
                    ?>
                </td>
                <td>
                    <?= $rcMaster[4] ?>
                </td>

            </tr>
        <?php
        endfor;
        ?>
    </table>
</section>
<?php
mysqli_close($conn);
?>