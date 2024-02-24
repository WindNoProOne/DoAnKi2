<?php

include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Inventory Management";

$queryInventory = "SELECT * FROM `tbInventory`";
$rsInventory = mysqli_query($conn, $queryInventory);
$countInventory = mysqli_num_rows($rsInventory);

$queryProduct = "SELECT * FROM `tbProduct`";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);

// ProductID array in Inventory
$proInven = array();
for ($i = 0; $i < $countInventory; $i++) :
  $rcInventory = mysqli_fetch_array($rsInventory);
  array_push($proInven, $rcInventory[1]);
endfor;
array_unique($proInven);

for ($x = 0; $x < $countProduct; $x++) :
  $rcProduct = mysqli_fetch_array(($rsProduct));
  if (!in_array($rcProduct[0], $proInven)) {
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
  }
endfor;

function filterTable($query)
{
  $connect = mysqli_connect("localhost", "root", "", "dbpheidip");
  $filter_Result = mysqli_query($connect, $query);
  return $filter_Result;
}


if (isset($_POST['search'])) {
  $valueToSearch = $_POST['valueToSearch'];
  $queryInventory = "SELECT * FROM `tbInventory` WHERE CONCAT(InventoryID, ProductID, Size) LIKE '%" . $valueToSearch . "%'";
  $search_result = filterTable($queryInventory);
  $countInventory = mysqli_num_rows($search_result);
} else {
  $queryInventory = "SELECT * FROM `tbInventory`";
  $search_result = filterTable($queryInventory);
  $count = mysqli_num_rows($search_result);
}

$queryInventory = "SELECT * FROM `tbInventory`";
$rsInventory = mysqli_query($conn, $queryInventory);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<section class="container">
  <h2 class="border-bottom py-2">Inventory</h2>
  <form method="post">
    <div class="d-flex border rounded-pill my-3 w-25">
        <input type="submit" name="search" class="btn btn-primary px-4 rounded-pill" value="Search">
      <input class="form-control me-2 border-0 search shadow-none bg-none" name="valueToSearch" type="search" placeholder="Enter value" aria-label="Search" />
    </div>
    <table class="table table-hove table-bordered text-center">
      <thead class="table-dark">
        <th>Inventory ID</th>
        <th>Product ID</th>
        <th>Size</th>
        <th>Quantity</th>
        <th colspan="2">Add</th>
      </thead>
      <?php
      while ($rcInventory = mysqli_fetch_array($search_result)) :
      ?>
        <tr>
          <td><?= $rcInventory[0]; ?></td>
          <td><?= $rcInventory[1]; ?></td>
          <td><?= $rcInventory[2]; ?></td>
          <td><?= $rcInventory[3]; ?></td>
          <td><a class="btn btn-success rounded-pill" href="addInventory.php?id='<?= $rcInventory[0]; ?>'">Add</a></td>
        </tr>
      <?php
      endwhile;
      ?>
  </form>
  </table>

</section>
<?php
mysqli_close($conn);
include 'php/htmlBody.php';
?>