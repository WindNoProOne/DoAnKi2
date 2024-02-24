<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Add Product";

$query1 = "SELECT * FROM tbbrand ";
$rs1 = mysqli_query($conn, $query1);
$count1 = mysqli_num_rows($rs1);

$query2 = "SELECT * FROM tbtype ";
$rs2 = mysqli_query($conn, $query2);
$count2 = mysqli_num_rows($rs2);

$query3 = "SELECT * FROM tbtag";
$rs3 = mysqli_query($conn, $query3);
$count3 = mysqli_num_rows($rs3);

//add
if (isset($_POST["btnAdd"])) :
    #1.Process Image Value
    $proId = substr(strtoupper($_POST["txtName"]), 0, 3) . date('YmdHis');
    $name = ucwords($_POST["txtName"]);
    $price = $_POST["txtPrice"];
    $brandId = $_POST["brand"];
    $typeId = $_POST["type"];
    $desc = $_POST["txtDesc"];

    //thumnail
    if (isset($_FILES['txtThumbnail'])) :
        $folder1 = "img/thumbnail_";
        $fileName1 = $_FILES["txtThumbnail"]["name"];
        $fileTmp1 = $_FILES["txtThumbnail"]["tmp_name"];
        $thumbnail = $folder1 . $fileName1;
        move_uploaded_file($fileTmp1, $thumbnail);
    endif;

    //image
    if (isset($_FILES['txtImage'])) :
        $folder2 = "img/image_";
        $fileName2 = $_FILES["txtImage"]["name"];
        $fileTmp2 = $_FILES["txtImage"]["tmp_name"];
        $image = $folder2 . $fileName2;
        move_uploaded_file($fileTmp2, $image);
    endif;

    //SQL


    $query = "  INSERT INTO tbproduct VALUES('{$proId}','{$name}','{$price}','{$thumbnail}','{$image}','{$brandId}','{$typeId}','{$desc}')";
    $rs = mysqli_query($conn, $query);
    if (!$rs) :
        die('nothing to save');
    endif;
    header("location: inventory.php");
endif;

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="container mx-auto m-5 p-0 w-50">
    <form method="post" class="p-2 needs-validation" enctype="multipart/form-data" novalidate>
        <div class="row justify-content-center mb-4">
            <div class="col-8 text-end input-label my-auto">
                <h2>New Product information form</h2>
            </div>
        </div>
        <table class="table table-borderless">
            <hr>
            <!-- <tr>
                    <td class="col-sm-3">Product ID: </td>
                    <td colspan="4" class="col-sm-9" ><input name="txtProId" class="form-control" placeholder="Enter ID: PROxx"></td>
                </tr> -->
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Name*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <input name="txtName" placeholder="Enter Product Name" class="rounded-pill form-input form-control" required>
                            <div class="invalid-feedback">*Required.</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Price*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <input name="txtPrice" class="rounded-pill form-input form-control" pattern="^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$" required placeholder="Enter price, much greater than 0">
                            <div class="invalid-feedback">much greater than 0.</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Thumbnail*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <input type="file" name="txtThumbnail" class="rounded-pill form-input input-file ps-0 form-control" required>
                            <div class="invalid-feedback">*Required.</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Image*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <input type="file" name="txtImage" class="rounded-pill form-input input-file ps-0 form-control" required>
                            <div class="invalid-feedback">*Required.</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Brand*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <select name="brand" id="brands" class="form-input form-select rounded-pill">
                                <?php while ($field1 = mysqli_fetch_array($rs1)) : ?>

                                    <option value="<?= $field1[0] ?>" class="form-control"><?= $field1[1] ?></option>

                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Type*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                            <select name="type" id="type" class="form-input form-select rounded-pill">
                                <?php while ($field2 = mysqli_fetch_array($rs2)) : ?>

                                    <option value="<?= $field2[0] ?>" class="form-control"><?= $field2[1] ?></option>

                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <!-- <tr class="was-validated">
                    <td>Tags:</td>
                    <td><input type="checkbox" id="tagMen" name="tagMen" value="Men">Men</td>
                    <td><input type="checkbox" id="tagWomen" name="tagWomen" value="Women" >Women</td>
                    <td><input type="checkbox" id="tagCollection" name="tagCollection" value="Collection" >Collection</td>
                    <td><input type="checkbox" id="tagNew" name="tagNew" value="New">New</td>
                </tr> -->
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-2 text-end input-label my-auto">
                            Description
                        </div>
                    </div>
                </td>
                <td colspan="4"><textarea name="txtDesc" id="desc" cols="30" rows="5" class="form-control"></textarea></td>
            </tr>
            <tr>
                <td> <a href="product.php" class="btn btn-secondary" class="form-control">Back</a></td>
                <td colspan="4">
                    <input type="submit" class="btn btn-success" class="form-control" name="btnAdd" value="Add New" onclick="return confirm('Ready to add new product ')">
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php
mysqli_close($conn);
include 'php/htmlBody.php';
?>