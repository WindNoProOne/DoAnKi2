<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Details Brand";

$code = $_GET["code"];
$query = "SELECT * FROM tbbrand where BrandID = '{$code}'";
$rs = mysqli_query($conn, $query);
$field = mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="container">
        <h2><?= $field[1]?> Detials</h2>
        <br>
        <a href="brand.php" class="btn btn-outline-info rounded-pill m-0">Back</a>
        <hr>
        <table  class="table text-nowrap table-responsive">
            <tr>
                <td rowspan="2"><img src="./<?= $field[2]?>" alt="Image" width="250px" height="200px"></td>
                <td>Brand ID: </td>
                <td><?= $field[0]?> </td>
            </tr>
            <tr>
                <td>name:</td>
                <td><?= $field[1]?></td>
            </tr>
            <tr>
                <td colspan="3">description:</td>
            </tr>
            <tr>
                <td colspan="3" ><?=$field[3]?></td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                        <a href="editBrand.php?code=<?= $field[0]?>" 
                        class="btn btn-success rounded-pill m-0">Update</a>
                </td>
            </tr>
        </Table>
    </div>

<?php
mysqli_close($conn);
include 'php/htmlBody.php';
?>