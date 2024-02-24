<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Menu Brand";

#2.tkae  dât from database whereid
$rs = "";
if (isset($_GET['id'])) :
    $code = $_GET["id"];
    $query = "SELECT * FROM tbproduct WHERE BrandID = {$code};";
    $rs = mysqli_query($conn, $query);
    $count = mysqli_num_rows($rs);
else :
    $query = "SELECT * FROM tbproduct;";
    $rs = mysqli_query($conn, $query);
    $count = mysqli_num_rows($rs);
endif;

$queryTitle = "SELECT `BrandName` FROM `tbBrand` WHERE `BrandID` = {$_GET['id']}";
$rsTitle = mysqli_query($conn, $queryTitle);
$titleName = mysqli_fetch_array($rsTitle);

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<div class="container title-box d-flex border-bottom">
    <i class="bi bi-x-diamond-fill title-icon fs-1 me-4"></i>
    <div class="section-title my-auto ms-2 fs-3"><?= $titleName[0];?></div>
</div>
<section class="pt-5 text-center">
    <div class="container">

        <div class="row">

            <?php
            if ($count == 0) :
                echo '<br>Record not found!';
            else :
                while ($data1 = mysqli_fetch_array($rs)) :
            ?>

                    <div class="col-3 d-flex justify-content-center mb-4">
                        <div class="card me-2">
                            <img src="<?= $data1[3] ?>" class="card-img-top" alt="...">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title"><?= $data1[1] ?></h5>
                                <p class="card-text mb-0 mt-auto">$ <?= $data1[2] ?></p>
                                <a href="productDetails.php?id=<?= $data1[0] ?>" class="btn btn-primary rounded-pill mx-4 mt-auto mb-0">
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>
<div class="container">
    <hr>
</div>

<?php
include 'php/slider.php';
include 'php/footer.php';
include 'php/htmlBody.php';
mysqli_close($conn);
?>