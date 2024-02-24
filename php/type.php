<?php

$sneakerLink = "001SNE";
$bootsLink = "002BOO";
$sandalsLink = "003SAN";
$slippersLink = "004SLI";


?>

<section class="section-margin my-5">
    <div class="container mx-auto d-flex justify-content-center">
        <div class="row">
            <div class="card type-card text-white p-0 col-2 me-3">
                <img src="img/type-1.jpg" class="card-img rounded-0">
                <div class="card-img-overlay d-flex justify-content-center">
                    <button class="btn type-button" onclick="location.href='menuType.php?id=\'<?= $sneakerLink; ?>\''">Sneaker</button>
                </div>
            </div>
            <div class="card type-card text-white p-0 col-2 me-3">
                <img src="img/type-2.jpg" class="card-img rounded-0">
                <div class="card-img-overlay d-flex justify-content-center">
                    <button class="btn type-button" onclick="location.href='menuType.php?id=\'<?= $bootsLink; ?>\''">Boots</button>
                </div>
            </div>
            <div class="card type-card text-white p-0 col-2 me-3">
                <img src="img/type-3.jpg" class="card-img rounded-0">
                <div class="card-img-overlay d-flex justify-content-center">
                    <button class="btn type-button" onclick="location.href='menuType.php?id=\'<?= $sandalsLink; ?>\''">Sandals</button>
                </div>
            </div>
            <div class="card type-card text-white p-0 col-2 me-3">
                <img src="img/type-4.jpg" class="card-img rounded-0">
                <div class="card-img-overlay d-flex justify-content-center">
                    <button class="btn type-button" onclick="location.href='menuType.php?id=\'<?= $slippersLink; ?>\''">Slipper</button>
                </div>
            </div>
        </div>
    </div>
</section>