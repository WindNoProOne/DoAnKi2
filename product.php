<?php
##1. Connect to databse
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Product Management";

$query = "SELECT * FROM tbproduct";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

$query1 = "SELECT * FROM tbbrand ";
$rs1 = mysqli_query($conn, $query1);
$count1 = mysqli_num_rows($rs1);
$brand = array();
for ($i = 0; $i < $count1; $i++) {
    $rc1 = mysqli_fetch_array($rs1);
    array_push($brand, $rc1);
}

$query2 = "SELECT * FROM tbtype ";
$rs2 = mysqli_query($conn, $query2);
$count2 = mysqli_num_rows($rs2);
$type = array();
for ($i = 0; $i < $count2; $i++) {
    $rc2 = mysqli_fetch_array($rs2);
    array_push($type, $rc2);
}

include 'php/htmlHead.php';
include 'php/sidebar.php';

?>

<section>
    <div class="container">
        <h2>Product List</h2>
        <a href="addProduct.php" class="btn btn-success rounded-pill">Add new product</a>
        <table class="table table-hover table-striped  text-nowrap table-responsive">
        <hr>
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Thumbnail</th>
                    <th>Brand</th>
                    <th>Type</th>
                    <th colspan="2" class="text-center">Function</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($count == 0) :
                    echo '<br>Record not found!';
                else :
                    while ($data1 = mysqli_fetch_array($rs)) :
                ?>
                        <tr>
                            <td><?= $data1[0] ?></td>
                            <td><?= $data1[1] ?></td>
                            <td> $ <?= $data1[2] ?></td>
                            <td class="w-auto"><img src="<?= $data1[3] ?>" alt="" width="100rem" height="100rem"></td>
                            <td>
                                <?php
                                for ($z = 0; $z < count($brand); $z++) {
                                    if ($data1[5] == $brand[$z][0]) {
                                        echo $brand[$z][1];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                for ($z = 0; $z < count($type); $z++) {
                                    if ($data1[6] == $type[$z][0]) {
                                        echo $type[$z][1];
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center"><a href="editProduct.php?id=<?= $data1[0] ?>" class="btn btn-outline-info rounded-pill m-0">Update</a></td>
                            <td class="text-center"><a href="detailsProduct.php?id=<?= $data1[0] ?>" class="btn btn-warning rounded-pill m-0">Details</a></td>
                        </tr>
                <?php
                    endwhile;
                endif;
                mysqli_close($conn);
                ?>
            </tbody>

        </table>
    </div>
</section>
<?php
include 'php/htmlBody.php';
?>