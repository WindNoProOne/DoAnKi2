<?php
$hidden = "";
if(isset($_SESSION["username"])){
    $hidden = "hidden";
}

?>
<footer class="bg-dark text-white footer px-0">
    <div class="container-fluid">
      <div class="row text-center mx-4 row-border py-4 my-2">
        <div class="col-6 text-lg-start">
          <a href=""><img src="img/source/Logo.png" alt=""></a>
        </div>
        <div class="col-1 text-lg-start">
          <div class="row pb-3">
            <div><span class="fw-bold text-footer text-header">Product</span></div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Men</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Women</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">New</div>
          </div>
        </div>
        <div class="col-1 text-lg-start">
          <div class="row pb-3">
            <div><span class="fw-bold text-footer text-header">Type</span></div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Sneaker</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Boots</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Sandals</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer">Slipper</div>
          </div>
        </div>
        <div class="col-2 text-lg-start">
          <div class="row pb-3">
            <div><span class="fw-bold text-footer text-header">Contact</span></div>
          </div>
          <div class="row">
            <div class="fw-light text-footer"><a href="<?= $contact;?>"></a></div>
          </div>
          <div class="row">
            <div class="fw-light text-footer"><i class="bi bi-house-door"></i> CMT8, District 3, HCM</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer"><i class="bi bi-mailbox"></i> phedip05@gmail.com</div>
          </div>
          <div class="row">
            <div class="fw-light text-footer"><i class="bi bi-telephone"></i> +84 908 993 9890</div>
          </div>
        </div>
        <div class="col-2 text-lg-end">
          <div class="row pb-3">
            <div><a href="login.php" class="btn btn-outline-info rounded-pill" <?= $hidden;?>>Login</a></div>
          </div>
          <div class="row pb-3">
            <div><a href="user-registration.php" class="btn btn-outline-secondary rounded-pill" <?= $hidden;?>>Register</a></div>
          </div>
        </div>
      </div>
      <div class="row text-center mx-4 pb-5">
        <div class="col-6 text-sm-start text-footer">@2022 ProjectSem02</div>
        <div class="col-6 text-end text-footer">Follow Us: <i class="bi bi-twitter"></i> <i class="bi bi-facebook"></i>
          <i class="bi bi-youtube"></i>
          <i class="bi bi-instagram"></i>
        </div>
      </div>
    </div>
  </footer>