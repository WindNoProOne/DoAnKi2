<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update Brand";

$code = $_GET["code"];
$query1 = "SELECT * FROM tbbrand WHERE BrandID = '{$code}'";
$rs = mysqli_query($conn, $query1);
$data = mysqli_fetch_array($rs);

#3. Updata data to database
if (isset($_POST["btnSave"])) :
    $name = ucwords($_POST["txtName"]);
    $desc = $_POST["txtDesc"];
    if (isset($_FILES['txtPath'])) :
        $folder = "img/brand_";
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;

    if ($path !== "img/brand_") {
        $query2 = "UPDATE tbbrand SET BrandName ='{$name}',Logo ='{$path}',`Desc`='{$desc}' WHERE `tbbrand`.`BrandID` = '{$code}' ";
        $rs = mysqli_query($conn, $query2);
    } else {
        $query3 = "UPDATE tbbrand SET BrandName ='{$name}',`Desc`='{$desc}' WHERE `tbbrand`.`BrandID` = '{$code}' ";
        $rs3 = mysqli_query($conn, $query3);
    }

    if (!$rs) :
        error_clear_last();
        die("Update Fails");
    endif;
    header("Location: brand.php");
endif;
mysqli_close($conn);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>

<div class="container mx-auto m-5 p-0 w-50">
    <form method="post" class="p-2 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="row justify-content-center mb-4">
                <div class="col-8 text-center input-label my-auto">
                    <h2> Update <?= $data[1]?></h2>
                </div>
            </div>
        <table class="table table-borderless">
            <hr>

            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-4 text-end input-label my-auto">
                    ID
                        </div>
                    </div>
                 </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input name="txtBrandId" value="<?= $data[0]?>" 
                    class="rounded-pill form-input form-control" 
                    disabled readonly>
                    </div></div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-4 text-end input-label my-auto">
                            Name*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input name="txtName" value="<?= $data[1]?>"
                    class="rounded-pill form-input form-control"
                            required>
                    <div class="invalid-feedback">*Required.</div>
                        </div></div>
                </td>
            </tr>

            <tr>
                <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-4 text-end input-label my-auto">
                                Logo*                            
                            </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input type="file" name="txtPath" value="<?= $data[2]?>" 
                    class="rounded-pill form-input input-file ps-0 form-control"
                    accept=".jpg, .jpeg, .png,. gif">
                    <?= $data[2]?></div></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                            <div  class="col-4 text-end input-label my-auto">
                                description                            
                            </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <textarea name="txtDesc" id="description" class="form-control" 
                    cols="30" rows="10"><?= $data[3]?></textarea>
                    </div></div>
                </td>
            </tr>
            <tr>
                <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-4 text-end input-label my-auto">
                                <a href="brand.php"
                                class="btn btn-warning rounded-pill">Back</a>
                                </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                            <div class="col-8">
                    <input type="submit" name="btnSave" value="Save"
                onclick="return confirm('Are you sure to update <?= $data[1]?>')"
                class="btn btn-success rounded-pill d-flex justify-content-center">
                </div></div>
                </td>
            </tr>
        </table>
    </form>
    </div>

    
<?php
include 'php/htmlBody.php';
?>