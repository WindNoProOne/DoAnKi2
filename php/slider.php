<?php

$queryProduct = "SELECT TagName, p.ProductID, ProductName, Price, Thumbnail         
FROM tbproduct p
    JOIN tbtag tg ON p.ProductID = tg.ProductID 
WHERE TagName = 'New';";
$rsProduct = mysqli_query($conn, $queryProduct);


?>
<section class="slider py-5 text-center">
  <h3>New Product</h3>
  <div class="carousel" data-flickity='{ "wrapAround": true }'>
    <?php
    while ($rcProduct = mysqli_fetch_array($rsProduct)) :
    ?>
      <div class="carousel-cell p-3">
        <div class="card me-2">
          <img src="<?= $rcProduct[4] ?>" class="card-img-top" alt="...">
          <div class="card-body text-center d-flex flex-column">
            <h5 class="card-title"><?= $rcProduct[2]; ?></h5>
            <p class="card-text mb-0">$ <?= $rcProduct[3]; ?></p>
            <a href="productDetails.php?id=<?= $rcProduct[1]; ?>" class="btn btn-primary rounded-pill mx-4 mt-auto mb-0"><i class="bi bi-cart-plus me-2"></i>Add to
              Cart</a>
          </div>
        </div>
      </div>

    <?php
    endwhile;
    ?>
  </div>
</section>