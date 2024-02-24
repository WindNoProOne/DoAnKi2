<?php
session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Checkout";

if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
  session_write_close();
} else {
  session_unset();
  session_write_close();
  $url = "./home.php";
  header("Location: $url");
}

$queryBrand = "SELECT * FROM `tbBrand`;";
$rsBrand = mysqli_query($conn, $queryBrand);
$countBrand = mysqli_num_rows($rsBrand);

$brand = array();
for ($i = 0; $i < $countBrand; $i++) {
  $rcBrand = mysqli_fetch_array($rsBrand);
  array_push($brand, $rcBrand);
}

function total($price, $quantity)
{
  return $price * $quantity;
}

$queryPayment = "SELECT `PaymentID`, `Method` FROM tbPayment;";
$rsPayment = mysqli_query($conn, $queryPayment);
$countPayment = mysqli_num_rows($rsPayment);
$payment = array();
for ($i = 0; $i < $countPayment; $i++) {
  $rcPayment = mysqli_fetch_array($rsPayment);
  array_push($payment, $rcPayment);
}

// Get User ID
$queryId = "SELECT `UserID`  FROM tbUser_Account WHERE UserName = '{$_SESSION["username"]}';";
$rsId = mysqli_query($conn, $queryId);
$rc = mysqli_fetch_array($rsId);
$userID = $rc[0];

// Get delivery address array
$queryAddress = "SELECT * FROM `tbdelivery_address` WHERE `UserID` = '{$userID}';";
$rsAddress = mysqli_query($conn, $queryAddress);
$countAddress = mysqli_num_rows($rsAddress);
$address = array();
for ($i = 0; $i < $countAddress; $i++) {
  $rcAddress = mysqli_fetch_array($rsAddress);
  array_push($address, $rcAddress);
}

// Get default address
$addressDefault = "";
for ($i = 0; $i < count($address); $i++) {
  if ($address[$i][3] == 1) {
    $addressDefault = $address[$i][2];
  }
}


$submit = "";
$count = count($_SESSION["prodID"]);
if ($count == 0) {
  $submit = "disabled";
}


// Order Submit
if (isset($_POST["addOrder"])) {
  //Add address
  $delivery = $_POST['delivery'];
  if ($delivery !== $addressDefault) {
    $queryInsertAddress = "INSERT INTO `tbdelivery_address`(`UserID`, `Address`, `Is_default`) VALUES ({$userID}, '{$delivery}', 0)";
    $rsInsertAddress = mysqli_query($conn, $queryInsertAddress);
  }

  for ($i = 0; $i < $count; $i++) :
    $prodID = $_SESSION["prodID"][$i];
    $size = $_SESSION["size"][$i];
    $quantity = $_SESSION["quantity"][$i];


    $queryInventory = "SELECT `InventoryID`, `Quantity` FROM `tbInventory` WHERE `ProductID` = '{$prodID}' AND `Size` = '{$size}';";
    $rsInventory = mysqli_query($conn, $queryInventory);
    $rcInventory = mysqli_fetch_array($rsInventory);

    if ($rcInventory[1] > $quantity) {
      // Add Details
      $detailsID = substr($rcInventory[0], 3, 3) . "$quantity" . date('s');
      $queryDetails = "INSERT INTO `tbOrder_Details` VALUES ('$detailsID', '{$rcInventory[0]}', {$quantity});";
      $rsDetails = mysqli_query($conn, $queryDetails);

      // Reduce Quantity in Inventory
      $queryStock = "UPDATE `tbInventory` SET `Quantity` = `Quantity` - {$quantity} WHERE `InventoryID` = '{$rcInventory[0]}';";
      $rsStock = mysqli_query($conn, $queryStock);

      // Add Master
      $paymentID = $_POST['payment'];
      $note = $_POST['note'];
      $masterID = "M" . substr($detailsID, 0, 3) . date('s') . $rc[0];
      $queryMaster = "INSERT INTO `tbOrder_Master` VALUES ('$masterID', '{$detailsID}', '{$userID}', '{$paymentID}', NOW(), '{$note}');";
      $rsMaster = mysqli_query($conn, $queryMaster);


      header("Location: php/clearCart.php");
    } else {
      $_SESSION["quantity"][$i] = $rcInventory[1];
      header("location: cart.php");
    }
  endfor;
}


include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<div class="container title-box d-flex border-bottom">
  <i class="bi bi-x-diamond-fill title-icon fs-1 me-4"></i>
  <div class="section-title ms-2 fs-3 mt-2">Checkout</div>
</div>
<section class="container">
  <form method="post">
    <!-- Form table -->
    <table class="table">
      <thead>
        <tr class="text-center">
          <th scope="col"></th>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <?php
      $count = count($_SESSION["prodID"]);
      $subtotal = 0;
      for ($i = 0; $i < $count; $i++) :
        $prodID = $_SESSION["prodID"][$i];
        $queryProduct = "SELECT * FROM `tbProduct` WHERE ProductID = '{$prodID}'";
        $rsProduct = mysqli_query($conn, $queryProduct);
        $rcProduct = mysqli_fetch_array($rsProduct);

        $size = $_SESSION["size"][$i];
        $quantity = $_SESSION["quantity"][$i];

      ?>
        <tbody>
          <tr class="text-center align-middle">
            <th scope="row"><?= $i + 1; ?></th>
            <td>
              <div class="product-card">
                <img src="<?= $rcProduct[3]; ?>" alt="" class="product-card-item product-card-img">
                <div class="product-card-item text-start">
                  <h5><?= $rcProduct[1]; ?></h5>
                  <p><?php
                      for ($x = 0; $x < count($brand); $x++) {
                        if ($rcProduct[5] == $brand[$x][0]) {
                          echo $brand[$x][1];
                        }
                      }

                      ?></p>
                  <p>Size: <?= $size; ?></p>
                </div>
              </div>
            </td>
            <td>
              <div>
                <span><?= $quantity; ?></span>
              </div>
            </td>
            <td>$<span class="price"><?= $rcProduct[2]; ?></span></td>
            <td>
              $<span class="total"><?= total((float)$rcProduct[2], (int)$quantity) ?></span>
            </td>
          </tr>
        </tbody>
      <?php
        $subtotal = $subtotal + total((float)$rcProduct[2], (int)$quantity);
      endfor;
      ?>
    </table>


    <div class="container-fluid text-start my-5">
      <div class="row align-items-start border-bottom">
        <div class="col fs-3 fw-bold my-3">
          Order Confirmation
        </div>
      </div>
      <div class="row align-items-start justify-content-start">
        <div class="col-2 fw-bold">
          Subtotal:
        </div>
        <div class="col-10">
          $<?= $subtotal; ?>
        </div>
      </div>
      <div class="row align-items-start justify-content-start">
        <div class="col-2 fw-bold">
          Taxes:
        </div>
        <div class="col-10">
          $<?= $subtotal * 0.1; ?>
        </div>
      </div>
      <div class="row align-items-start justify-content-start">
        <div class="col-2 fw-bold">
          Total:
        </div>
        <div class="col-10">
          $<?= $subtotal * 1.1; ?>
        </div>
      </div>
      <div class="row align-items-start justify-content-start">
        <div class="col-2 fw-bold">
          Payment:
        </div>
        <div class="col-10">
          <select class="form-select bg-white" name="payment" id="payment">
            <?php for ($i = 0; $i < count($payment); $i++) : ?>
              <option value="<?= $payment[$i][0] ?>"><?= $payment[$i][1] ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
      <div class="row align-items-start justify-content-start my-2">
        <div class="col-2 fw-bold">
          Delivery Address:
        </div>
        <div class="col-10">
          <input list="datalist" class="form-control" name="delivery" placeholder="<?= $addressDefault; ?>">
          <datalist id="datalist">
            <?php
            for ($i = 0; $i < count($address); $i++) :
            ?>
              <option value="<?= $address[$i][2] ?>">
              <?php
            endfor;
              ?>
          </datalist>
        </div>
      </div>
      <div class="row align-items-start justify-content-start">
        <div class="col-2 fw-bold">
          Note:
        </div>
        <div class="col-10">
          <input type="text" name="note" class="form-control">
        </div>
      </div>
    </div>
    <div class="m-2 me-5 pe-3 text-start">
      <button type="submit" class="btn btn-danger <?= $submit; ?>" name="addOrder" onclick="return confirm('Click OK to confirm your order!')">Submit</button>
    </div>
  </form>
</section>


<?php mysqli_close($conn);
include 'php/htmlBody.php';
?>