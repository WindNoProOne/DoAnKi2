<?php

if(!isset($_SESSION['sessionAdmin'])){
  header("location: loginAdmin.php");
}

?>
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid justify-content-start">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasDarkNavbar"
          aria-controls="offcanvasDarkNavbar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="admin.php"
          ><img src="img/source/Logo.png " alt=""
        /></a>

        <div
          class="offcanvas offcanvas-start text-bg-dark"
          tabindex="-1"
          id="offcanvasDarkNavbar"
          aria-labelledby="offcanvasDarkNavbarLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
              Management Menu
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link text-light" href="admin.php"><i class="bi bi-box mx-2"></i>Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="user.php"><i class="bi bi-box mx-2"></i>User Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="order.php"><i class="bi bi-box mx-2"></i>Order Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="inventory.php"><i class="bi bi-box mx-2"></i>Inventory Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="product.php"><i class="bi bi-box mx-2"></i>Product Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="brand.php"><i class="bi bi-box mx-2"></i>Brand Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="ViewFeedBack.php"><i class="bi bi-box mx-2"></i>Feedback Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="ViewsNews.php"><i class="bi bi-box mx-2"></i>News Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="tag.php"><i class="bi bi-box mx-2"></i>Tag Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="logoutAdmin.php"><i class="bi bi-box-arrow-left mx-2"></i>Log out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="nav-space"></div>
