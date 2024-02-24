
<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update News";

#2. Truy cập dữ liệu v
$id = $_GET["id"];
$sql = "SELECT * FROM `tbnews` WHERE NewsID ='{$id}' ";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

#3. Updata data to database
if (isset($_POST["txtSubmit"])) :
    $title = $_POST["txtTitle"];
    $content = $_POST["txtContent"];

    if (isset($_FILES['txtImage'])) :
        $folder = "img/news_";
        $fileName = $_FILES["txtImage"]["name"];
        $fileTmp = $_FILES["txtImage"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;

    if ($path !== "img/news_") {
        $query2 = "UPDATE `tbnews` SET `Title`='$title', `Content`='$content', `Image`='$path', `NewsDate` = NOW() WHERE `tbnews`.`NewsID` ='{$id}';";
        $rs = mysqli_query($conn, $query2);
    } else {
        $query3 = "UPDATE `tbnews` SET `Title`='$title', `Content`='$content', `NewsDate` = NOW() WHERE `tbnews`.`NewsID` =' {$id} ';";
        $rs3 = mysqli_query($conn, $query3);
    }

    if (!$result) :
        error_clear_last();
        die("Update Fails");
    endif;
    header("Location: ViewsNews.php");
endif;



include 'php/htmlHead.php';
include 'php/sidebar.php';
?>

<form method="post" class="p-2 needs-validation" enctype="multipart/form-data" novalidate>
        <table class="table table-borderless">
            <div class="row justify-content-center mb-4">
                <div class="col-8 text-center input-label my-auto">
                    <h2> Update <?= $data[1]?></h2>
                </div>
            </div>

            <hr>
            
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-4 text-end input-label my-auto">
                    Id
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
                            Title*
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input name="txtTitle" value="<?= $data[1]?>"
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
                                Img*                            
                            </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input type="file" name="txtImage" value="<?= $data[3]?>" 
                    class="rounded-pill form-input input-file ps-0 form-control"
                    accept=".jpg, .jpeg, .png,. gif">
                    <?= $data[3]?><img src="<?= $data[3] ?>" alt="Image" width="80" height="80" aria-readonly=""></div></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                            <div  class="col-4 text-end input-label my-auto">
                                Content*                            
                            </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <textarea name="txtContent" id="description" class="form-control" 
                    cols="30" rows="10"><?= $data[2]?></textarea>
                    </div></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-4 text-end input-label my-auto">
                    Date Time
                        </div>
                    </div>
                 </td>
                <td>
                    <div class="row justify-content-center mb-4">
                        <div class="col-10">
                    <input name="txtBrandId" value="<?= $data[4]?>" 
                    class="rounded-pill form-input form-control" 
                    disabled readonly>
                    </div></div>
                </td>
            </tr>
            <tr>
                <td>
                        <div class="row justify-content-center mb-4">
                            <div class="col-4 text-end input-label my-auto">
                                <a href="ViewsNews.php"
                                class="btn btn-warning rounded-pill">Back</a>
                                </div>
                        </div>
                </td>
                <td>
                    <div class="row justify-content-center mb-4">
                            <div class="col-8">
                    <input type="submit" name="txtSubmit" value="Save"
                onclick="return confirm('Are you sure to update <?= $data[1]?>')"
                class="btn btn-success rounded-pill d-flex justify-content-center">
                </div></div>
                </td>
            </tr>

        </table>
    </form>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>