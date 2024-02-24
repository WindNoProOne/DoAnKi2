<?php
#1.Connect DB
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update Product";

#2. take data from database where id
$code = $_GET["id"];
$query = "SELECT * FROM tbproduct WHERE ProductID = '{$code}';";
$rs = mysqli_query($conn, $query);
$data = mysqli_fetch_array($rs);

$query2 = "SELECT * FROM tbbrand;";
$rs2 = mysqli_query($conn, $query2);
$count2 = mysqli_num_rows($rs2);

$query3 = "SELECT * FROM tbtype;";
$rs3 = mysqli_query($conn, $query3);
$count3 = mysqli_num_rows($rs3);

//Save
if (isset($_POST["btnSave"])) :
    #1.Process Image Value
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
    if ($thumbnail !== "img/thumbnail_") {
        $query4 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',Thumbnail ='{$thumbnail}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs4 = mysqli_query($conn, $query4);
    } else {
        $query5 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs5 = mysqli_query($conn, $query5);
    }

    if ($image !== "img/image_") {
        $query6 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Image`='{$image}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs6 = mysqli_query($conn, $query6);
    } else {
        $query7 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs7 = mysqli_query($conn, $query7);
    }



    if (!$rs3) :
        die("Update Fails");
    endif;
    header("location: product.php");
endif;
mysqli_close($conn);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div  class="container mx-auto m-5 p-0 w-50">
        <form method="post" class="p-2 needs-validation" enctype="multipart/form-data" novalidate>
        <div class="row justify-content-center mb-4">
                <div class="col-8 text-center input-label my-auto">
        <h2>Update Product</h2>
        </div></div>
       
            <table class="table table-borderless">
                <hr>
                <tr>
                    <td>
                    <div class="row justify-content-center mb-4">
                            <div class="col-2 text-end input-label my-auto">
                                ID                            
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                        <input name="txtProId" value="<?= $data[0]?>" 
                        class="rounded-pill form-input form-control"
                        disabled readonly>
                        </div>
                        </div>
                    </td>
                </tr>

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
                            <input name="txtName" value="<?= $data[1]?>" 
                            class="rounded-pill form-input form-control"
                            required>
                            <div class="invalid-feedback">*Required.</div>
                        </div>
                    </div>
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
                    <input name="txtPrice" type="number" step="any" min="0" max="10000000000"
                    value="<?= $data[2]?>"
                    class="rounded-pill form-input form-control" 
                    oninput="check(this)"
                    required>
                    <div class="invalid-feedback">*Price much be greater than 0.</div>
                                <script>
                                    function check(input) {
                                    if (input.value == 0) {
                                        input.setCustomValidity('The number must not be zero.');
                                    } else {
                                        // input is fine -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                    }
                                </script>
                            </div>
                        </div>
                </td>
                    
                </tr>
                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-2 text-end input-label my-auto">
                                thumbnail*
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                        <input type="file" name="txtThumbnail" 
                        class="rounded-pill form-input input-file ps-0 form-control"
                        value="<?= $data[3]?>" 
                        accept=".jpg, .jpeg, .png,. gif">
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-2 text-end input-label my-auto">
                                Image*
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                        <input type="file" name="txtImage" class="rounded-pill form-input input-file ps-0 form-control"
                        value="<?= $data[4]?>"
                        accept=".jpg, .jpeg, .png,. gif">
                        </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-2 text-end input-label my-auto">
                                Brand
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                        <select name="brand" id="brands" class="form-input form-select rounded-pill">
                    <?php while($field1 = mysqli_fetch_array($rs2)): 
                    $selected = "";
                        if($data[5]==$field1[0]):
                            $selected = 'selected';
                        endif;
                        ?>
                        
                        <option <?= $selected;?> value="<?= $field1[0]?>"><?= $field1[1]?></option>

                    <?php 
                        
                        endwhile; ?>
                    </select>
                    </div></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-2 text-end input-label my-auto">
                                Type
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                        <select name="type" id="type" class="form-input form-select rounded-pill">
                    <?php while($field2 = mysqli_fetch_array($rs3)):
                        $selected = "";
                            if($data[6]==$field2[0]):
                                $selected = 'selected';
                            endif;
                    ?>
                        <option <?= $selected;?> value="<?= $field2[0]?>"><?= $field2[1]?></option>
                        <?php 
                            endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div  class="col-2 text-end input-label my-auto">
                                description
                            </div>
                        </div>
                    </td>
                    <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                        <textarea name="txtDesc" id="desc" cols="30" rows="10"  class="form-control"><?= $data[7]?></textarea>
                        </div></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-2 text-end input-label my-auto">
                        <a href="product.php" class="btn btn-warning rounded-pill">Back</a>
                            </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-8">
                        <input type="submit" class="btn btn-success rounded-pill d-flex justify-content-center"
                        name="btnSave" value="Save" 
                    onclick="return confirm('Are you sure to update <?= $data[1]?>')">
                    </div>
                        </div>
                </td>
                </tr>
            </table>
        </form>
    </div>
    <script>
(function () {
    'use strict'
  
    var forms = document.querySelectorAll('.needs-validation')
  
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
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
include 'php/htmlBody.php';
?>