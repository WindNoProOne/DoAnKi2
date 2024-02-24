<?php
include_once 'php/DBConnect.php';
session_start();
$pageTitle = "Tag Management";

$queryProduct = "SELECT `ProductID`, `ProductName`, `Thumbnail` FROM `tbProduct`;";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);

if (isset($_POST['btnSubmit'])) {
    $tag = $_POST['tag'];
    $proID = $_POST['productID'];
    $tagID = "";

    if (gettype($tag) == 'array') {
        for ($i = 0; $i < count($tag); $i++) {
            $tagID = substr($tag[$i], 0, 3) . $proID;
            $queryInsert = "INSERT INTO `tbTag` VALUES('{$tagID}', '{$tag[$i]}', '{$proID}', '{$tag[$i]}');";
            $rsInsert = mysqli_query($conn, $queryInsert);
        }
    } else {
        $tagID = substr($tag, 0, 3) . substr($proID, 0, 3);
        $queryInsert = "INSERT INTO `tbTag` VALUES('{$tagID}', '{$tag}', '{$proID}', '{$tag}');";
        $rsInsert = mysqli_query($conn, $queryInsert);
    }

    header("Location: tag.php");
}

if (isset($_POST['btnClear'])) {
    $clearID = $_POST['clearID'];

    $queryDelete = "DELETE FROM `tbTag` WHERE `ProductID` = '{$clearID}';";
    $rsDelete = mysqli_query($conn, $queryDelete);

    header("Location: tag.php");
}

include 'php/htmlHead.php';
include 'php/sidebar.php';

?>

<div class="container">
    <table class="table text-nowrap table-responsive">
        <thead class="table-dark">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Tag</th>
                <th scope="col" class="text-center">Add</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $countProduct; $i++) :
                // while ($rcProduct = mysqli_fetch_array($rsProduct)) :
                $rcProduct = mysqli_fetch_array($rsProduct);
            ?>
                <tr>
                    <td>
                        <img src="<?= $rcProduct[2]; ?>" alt="" width="100rem" height="100rem" />
                        <a class="link-dark profile-link" href="detailsProduct.php?id=<?= $rcProduct[0]; ?>"><?= $rcProduct[1]; ?></a>
                    </td>
                    <td class="w-auto">
                        <?php
                        $queryTag = "SELECT `TagName` FROM `tbTag` WHERE `ProductID` = '{$rcProduct[0]}';";
                        $rsTag = mysqli_query($conn, $queryTag);
                        $countTag = mysqli_num_rows($rsTag);

                        for ($z = 0; $z < $countTag; $z++) :
                            $rcTag = mysqli_fetch_array($rsTag);
                            // while ($rcTag = mysqli_fetch_array($rsTag)):
                        ?>
                            <button class="btn btn-dark rounded-pill tag disabled"><?= $rcTag[0]; ?></button>
                        <?php
                        // endwhile;
                        endfor;
                        ?>
                    </td>
                    <td class="text-center">
                        <!-- Modal -->
                        <form method="post">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#<?= $rcProduct[0]; ?>">
                                <i class="bi bi-plus-circle me-2"></i>Add</a>
                            </button>
                            <div class="modal fade" id="<?= $rcProduct[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop<?= $rcProduct[0]; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <input type="text" class="modal-title form-input" id="staticBackdrop<?= $rcProduct[0]; ?>" name="productID" value="<?= $rcProduct[0]; ?>">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="checkbox" class="btn-check" id="men<?= $rcProduct[0]; ?>" autocomplete="off" name="tag[]" value="Men" />
                                            <label class="btn btn-outline-dark rounded-pill fw-bold me-2" for="men<?= $rcProduct[0]; ?>">Men</label>

                                            <input type="checkbox" class="btn-check" id="women<?= $rcProduct[0]; ?>" autocomplete="off" name="tag[]" value="Women" />
                                            <label class="btn btn-outline-dark rounded-pill fw-bold me-2" for="women<?= $rcProduct[0]; ?>">Women</label>

                                            <input type="checkbox" class="btn-check" id="new<?= $rcProduct[0]; ?>" autocomplete="off" name="tag[]" value="New" />
                                            <label class="btn btn-outline-dark rounded-pill fw-bold me-2" for="new<?= $rcProduct[0]; ?>">New</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning rounded-pill" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-danger rounded-pill" name="btnSubmit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="post" class="mt-2">
                            <input type="hidden" name="clearID" value="<?= $rcProduct[0]; ?>">
                            <button type="submit" class="btn btn-danger rounded-pill" name="btnClear">Clear</button>
                        </form>
                    </td>
                </tr>
            <?php
            // endwhile;
            endfor;
            ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($conn);
include 'php/htmlBody.php'
?>