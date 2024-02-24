<?php
session_start();

include_once 'php/DBConnect.php';
$pageTitle = 'Admin';



include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="container title-box d-flex border-bottom">
    <i class="bi bi-boxes title-icon fs-1 me-4"></i>
    <div class="section-title my-auto ms-2 fs-3 fw-bold">Admin Management</div>
</div>
<section class="pt-5 text-center">
    <div class="container">
        <div class="row">
            <!-- Card -->
            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-user.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">User Management</h5>
                        <p class="card-text mb-0">Check, turn on or off user account</p>
                        <a href="user.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-order.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">Order Management</h5>
                        <p class="card-text mb-0">Check Order</p>
                        <a href="order.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-inventory.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">Inventory Management</h5>
                        <p class="card-text mb-0">Check product quantity</p>
                        <a href="inventory.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-product.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">Product Management</h5>
                        <p class="card-text mb-0">Check product</p>
                        <a href="product.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-brand.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">Brand Management</h5>
                        <p class="card-text mb-0">Check brand</p>
                        <a href="brand.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-feedback.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">Feedback Management</h5>
                        <p class="card-text mb-0">Check and response feedback of customer</p>
                        <a href="ViewFeedBack.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex justify-content-center mb-4">
                <div class="card me-2">
                    <img src="img/dashboard-news.png" class="card-img-top" alt="...">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">News Management</h5>
                        <p class="card-text mb-0">Check and write news</p>
                        <a href="ViewsNews.php" class="btn btn-outline-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Check</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>