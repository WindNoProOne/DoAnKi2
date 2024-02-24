<?php
session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Brand Management";

$query = "select * from tbbrand";
$rs    = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>

<section>
<div class="container">
        <h2 >Brand List</h2>
        <a href="addBrand.php" class="btn btn-success rounded-pill">ADD NEW BRAND</a>
        <table  class="table table-hover table-striped text-nowrap table-responsive">
        <hr>
            <thead class="table-dark">
                <tr>
                    <th>Brand ID</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th colspan="2" class="text-center">Function</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($count == 0):
                    echo 'Record not found!';
                else:
                    while( $data= mysqli_fetch_array($rs) ):

                ?>
                <tr>
                    <td><?= $data[0]?></td>
                    <td><?= $data[1]?></td>
                    <td class="w-auto"><img src="<?= $data[2]?>" alt="Image" width="100rem" height="100rem"></td>
                    <td class="text-center"><a href="editBrand.php?code=<?= $data[0]?>" class="btn btn-outline-info rounded-pill m-0">Update</a></td>
                    <td class="text-center"><a href="detailsBrand.php?code=<?= $data[0]?>" class="btn btn-warning rounded-pill m-0">Details</a></td>
                </tr>
                <?php 
            endwhile;
        endif;
            ?>
            </tbody>
        </table>
       
    </div>
</section>
<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>