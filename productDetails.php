<?php
session_start();

//Connect database
include_once 'php/DBConnect.php';
$pageTitle = "Product Details";

$proID = $_GET["id"];

$queryProduct = "SELECT * FROM `tbProduct` WHERE ProductID = '{$proID}'";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);
$rcProduct = mysqli_fetch_array($rsProduct);



$queryInventory = "SELECT `Quantity`, `Size` FROM `tbInventory` WHERE ProductID = '{$proID}';";
$rsInventory = mysqli_query($conn, $queryInventory);
// $rcInventory = mysqli_fetch_array($rsInventory);
$countInventory = mysqli_num_rows($rsInventory);
$quantitySize = array();
for ($i = 0; $i < $countInventory; $i++) {
  $rcInventory = mysqli_fetch_array($rsInventory);
  array_push($quantitySize, $rcInventory);
}

$disabledAdd = "";
// if ($InQuantity == 0) {
//   $disabledAdd = "disabled";
// }

$showSize38 = "";
$showSize39 = "";
$showSize40 = "";
$showSize41 = "";
$showSize42 = "";
if ($quantitySize[0][0] == 0) {
  $showSize38 = "disabled";
}
if ($quantitySize[1][0] == 0) {
  $showSize39 = "disabled";
}
if ($quantitySize[2][0] == 0) {
  $showSize40 = "disabled";
}
if ($quantitySize[3][0] == 0) {
  $showSize41 = "disabled";
}
if ($quantitySize[4][0] == 0) {
  $showSize42 = "disabled";
}


if (isset($_POST['btnAdd'])) {
  if (!isset($_SESSION["username"])) {
    header("location: login.php");
  } else {
    $size = $_POST['options'];
    $quantity = $_POST['quantity'];

    // for($i = 0; $i < $countInventory; $i++){
    //   if($quantitySize[$i][1] == $size){
    //     if($quantity > $quantitySize[$i][0]){
    //       header("location: productDetails.php?id={$proID}");
    //     }
    //   }
    // }
    if (count($_SESSION["prodID"]) == 0) {
      array_push($_SESSION["prodID"], $proID);
      array_push($_SESSION["size"], $size);
      array_push($_SESSION["quantity"], $quantity);
    } else {
      if (in_array($proID, $_SESSION["prodID"])) {
        $indexProd = array_search($proID, $_SESSION["prodID"]);
        if ($_SESSION["size"][$indexProd] == $size) {
          $_SESSION["quantity"][$indexProd] = $_SESSION["quantity"][$indexProd] + $quantity;
        } else {
          array_push($_SESSION["prodID"], $proID);
          array_push($_SESSION["size"], $size);
          array_push($_SESSION["quantity"], $quantity);
        }
      } else {
        array_push($_SESSION["prodID"], $proID);
        array_push($_SESSION["size"], $size);
        array_push($_SESSION["quantity"], $quantity);
      }
    }
  }

  echo "<script type='text/javascript'>alert('Add to cart successfully!');</script>";
}

$query1 = "SELECT * FROM tbbrand ";
$rs1 = mysqli_query($conn, $query1);
$count1 = mysqli_num_rows($rs1);
$brand = array();
for ($i = 0; $i < $count1; $i++) {
  $rc1 = mysqli_fetch_array($rs1);
  array_push($brand, $rc1);
}

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>

<section id="productDetails" class="section-margin d-flex container-fluid">
  <div class="container ms-5">
    <img src="<?= $rcProduct[4] ?>" alt="" width="100%" height="500px">
  </div>
  <div class="container m-auto">
    <form method="post">
      <h3 class="product-name"><?= $rcProduct[1] ?></h3>
      <p class="brand-name">
        <?php
        for ($z = 0; $z < count($brand); $z++) {
          if ($rcProduct[5] == $brand[$z][0]) {
            echo $brand[$z][1];
          }
        }
        ?>
      </p>
      <p class="product-price">$<?= $rcProduct[2] ?></p>
      <div class="size m-0 my-2 p-0">
        <div class="container d-inline m-0 p-0">
          <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" value="38" required <?= $showSize38 ?> />
          <label class="btn btn-secondary" for="option1">38</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="39" <?= $showSize39 ?> />
          <label class="btn btn-secondary" for="option2">39</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="40" <?= $showSize40 ?> />
          <label class="btn btn-secondary" for="option3">40</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" value="41" <?= $showSize41 ?> />
          <label class="btn btn-secondary" for="option4">41</label>
        </div>
        <div class="container d-inline d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off" value="42" <?= $showSize42 ?> />
          <label class="btn btn-secondary" for="option5">42</label>
        </div>
      </div>
      <div class="container my-2 p-0">
        <input class="m-0" type="number" name="quantity" id="quantity" min="1" step="1" max="<?= $InQuantity; ?>" pattern="[0-9]{1,}" required>
        <label for="quantity">
          <!-- <p class="fw-light fst-italic">(<span class="fw-bold"><= $InQuantity; ?></span> products remaining)</p> -->
          <p id="size1" class="fw-light fst-italic" hidden>(<span class="fw-bold"><?= $quantitySize[0][0]; ?></span> products remaining)</p>
          <p id="size2" class="fw-light fst-italic" hidden>(<span class="fw-bold"><?= $quantitySize[1][0]; ?></span> products remaining)</p>
          <p id="size3" class="fw-light fst-italic" hidden>(<span class="fw-bold"><?= $quantitySize[2][0]; ?></span> products remaining)</p>
          <p id="size4" class="fw-light fst-italic" hidden>(<span class="fw-bold"><?= $quantitySize[3][0]; ?></span> products remaining)</p>
          <p id="size5" class="fw-light fst-italic" hidden>(<span class="fw-bold"><?= $quantitySize[4][0]; ?></span> products remaining)</p>
        </label>
      </div>
      <button type="submit" class="btn btn-dark btn-lg rounded-0 card-button" name="btnAdd" <?= $disabledAdd; ?>>
        <i class="bi bi-cart2 me-2"></i> Add to cart
      </button>
      <div class="my-3">
        <p class="fw-bold my-1">Description</p>
        <textarea name="description" id="description" cols="40" rows="4" disabled class="bg-white">
            <?= $rcProduct[7] ?>
          </textarea>
      </div>
    </form>
  </div>
</section>

<script>
  const checkbox1 = document.getElementById('option1');
  const checkbox2 = document.getElementById('option2');
  const checkbox3 = document.getElementById('option3');
  const checkbox4 = document.getElementById('option4');
  const checkbox5 = document.getElementById('option5');

  checkbox1.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
      var contentQuantity = document.getElementById('size1').children;
      var maxQuantity = contentQuantity[0].textContent;
      document.getElementById('quantity').setAttribute("max", maxQuantity);
      document.getElementById('size1').removeAttribute("hidden");
      document.getElementById('size2').setAttribute("hidden", "");
      document.getElementById('size3').setAttribute("hidden", "");
      document.getElementById('size4').setAttribute("hidden", "");
      document.getElementById('size5').setAttribute("hidden", "");
    }
  })
  checkbox2.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
      var contentQuantity = document.getElementById('size2').children;
      var maxQuantity = contentQuantity[0].textContent;
      document.getElementById('quantity').setAttribute("max", maxQuantity);
      document.getElementById('size2').removeAttribute("hidden");
      document.getElementById('size1').setAttribute("hidden", "");
      document.getElementById('size3').setAttribute("hidden", "");
      document.getElementById('size4').setAttribute("hidden", "");
      document.getElementById('size5').setAttribute("hidden", "");
    }
  })
  checkbox3.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
      var contentQuantity = document.getElementById('size3').children;
      var maxQuantity = contentQuantity[0].textContent;
      document.getElementById('quantity').setAttribute("max", maxQuantity);
      document.getElementById('size3').removeAttribute("hidden");
      document.getElementById('size2').setAttribute("hidden", "");
      document.getElementById('size1').setAttribute("hidden", "");
      document.getElementById('size4').setAttribute("hidden", "");
      document.getElementById('size5').setAttribute("hidden", "");
    }
  })
  checkbox4.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
      var contentQuantity = document.getElementById('size4').children;
      var maxQuantity = contentQuantity[0].textContent;
      document.getElementById('quantity').setAttribute("max", maxQuantity);
      document.getElementById('size4').removeAttribute("hidden");
      document.getElementById('size2').setAttribute("hidden", "");
      document.getElementById('size3').setAttribute("hidden", "");
      document.getElementById('size1').setAttribute("hidden", "");
      document.getElementById('size5').setAttribute("hidden", "");
    }
  })
  checkbox5.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
      var contentQuantity = document.getElementById('size5').children;
      var maxQuantity = contentQuantity[0].textContent;
      document.getElementById('quantity').setAttribute("max", maxQuantity);
      document.getElementById('size5').removeAttribute("hidden");
      document.getElementById('size2').setAttribute("hidden", "");
      document.getElementById('size3').setAttribute("hidden", "");
      document.getElementById('size4').setAttribute("hidden", "");
      document.getElementById('size1').setAttribute("hidden", "");
    }
  })
</script>

<?php
include 'php/slider.php';
mysqli_close($conn);
include 'php/footer.php';
include 'php/htmlBody.php';
?>