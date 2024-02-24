<?php
session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Add Brand";

if (isset($_POST["btnAdd"])) :
    $code = substr(strtoupper($_POST["txtName"]), 0, 3) . date('YmdHis');
    $name = ucwords($_POST["txtName"]);
    $desc = $_POST["txtDesc"];
    if (isset($_FILES['txtPath'])) :
        $folder = "img/brand_";
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;
    $query = "insert into tbbrand values('{$code}','{$name}','{$path}','(desc)')";
    $rs = mysqli_query($conn, $query);
    if (!$rs) :
        die('nothing to save');
    endif;
    header("location: brand.php");
endif;

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>

<div class="container mx-auto m-5 p-0 w-50">
        <form method="post" class="p-2 needs-validation" enctype="multipart/form-data" novalidate >
            <div class="row justify-content-center mb-4">
                <div class="col-8 text-center input-label my-auto">
                    <h2>New brand</h2> 
                </div>
            </div>
            <table class="table table-borderless" >
                 <hr>
                <!-- <tr>
                    <td>Brand ID: </td>
                    <td>
                        <input name="txtBrandId" placeholder="Enter Brand Code" 
                        class="form-control"
                        required>
                    </td>
                </tr> -->
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
                            <input name="txtName" placeholder="Enter Brand Name" 
                            class="rounded-pill form-input form-control"
                            required />
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
                        <input type="file" name="txtPath" 
                            class="rounded-pill form-input input-file ps-0 form-control"
                            accept=".jpg, .jpeg, .png,. gif"
                            required />
                            <div class="invalid-feedback">*Required.</div>
                            </div></div>
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
                            <textarea name="txtDesc" class="form-control" id="description" cols="30" rows="10"></textarea>
                        </div></div>
                    </td>
                </tr>

                <!-- <tr class=" was-validated">
                    <td></td>
                    <td>
                        <input class="form-check-input" type="checkbox" id="myCheck"  name="remember" required>
                        <label class="form-check-label" for="myCheck">I agree that information is correct.</label>
                        <div class="valid-feedback">The information is correct.</div>
                        <div class="invalid-feedback">Please check to add new brand.</div>
                    </td>
                </tr> -->

                <tr>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-4 text-end input-label my-auto">
                                <a href="brand.php" class="btn btn-warning rounded-pill">Back</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-8">
                                <input type="submit"  class="btn btn-success rounded-pill d-flex justify-content-center" 
                                    value="+ Add New" name="btnAdd"
                                    onclick="return confirm('Ready to add new product ')">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
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