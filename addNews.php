<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Add News";

if (isset($_POST["btnAdd"])) :
    $desc = $_POST["txtDesc"];  //Hình ảnh
    $title = $_POST["txttitle"]; //Tên hình ảnh
    if (isset($_FILES['txtPath'])) :
        $folder = "img/news_";
        //Kiem tra du lieu xem co hop le hay khong
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];  //tmp_name: Đường đẫn của hình
        $path = $folder . $fileName; //Tên Hình ảnh khi chạy vào bên trong database
        move_uploaded_file($fileTmp, $path); // Uploađe hình ảnh lên code
    endif;
    $query = "INSERT INTO `tbNews` (`Title`, `Content`, `Image`, `NewsDate`) VALUES ('{$title}', '{$desc}' ,'{$path}', now())";
    $rs = mysqli_query($conn, $query);
    if (!$rs) :
        die('nothing to save');
    endif;
    header("location:ViewsNews.php");
endif;

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<form method="post" enctype="multipart/form-data" onsubmit="return signupValidation()">
    <caption>
        <h4>News Management/Add News </h4>
    </caption>

    <table class="table table-hove table-bordered" >
        <tr>
            <td>Title:</td>
            <td>
                <div class="form-floating">
                    <input type="text"  class="form-control " id="floatingInputInvalid0" placeholder="Input Title" name="txttitle" maxlength="25">
                    <div class="invalid-feedback">*Required Title.</div>
                </div>
            </td>

        <tr>
            <td>Image: </td>
            <td>
                <div class="form-floating">
                    <input type="file"  class="form-control " id="floatingInputInvalid1"name="txtPath">
                    <div class="invalid-feedback">*Required image.</div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Content:</td>
            <td>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingInputInvalid2" name="txtDesc" rows="10" cols="30"></textarea>
                    <div class="invalid-feedback">*Required Content.</div>

                </div>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" value="Add New" name="btnAdd">
            </td>
        </tr>
    </table>
</form>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>


<!--  -->
<script>
    function signupValidation() {
	    var valid = true;
        
        $("#floatingInputInvalid0").removeClass("is-invalid");
        $("#floatingInputInvalid1").removeClass("is-invalid");
        $("#floatingInputInvalid2").removeClass("is-invalid");

        var UserName = $("#floatingInputInvalid0").val();
        var email = $("#floatingInputInvalid1").val();
        var fullname = $ ("#floatingInputInvalid2").val();

        if (UserName.trim() == "") {
            $("#floatingInputInvalid0").addClass("is-invalid");
            valid = false;
        }
        if (email.trim() == "") {
            $("#floatingInputInvalid1").addClass("is-invalid");
            valid = false;
        }
        if (fullname.trim() == "") {
            $("#floatingInputInvalid2").addClass("is-invalid");
            valid = false;
        }

	return valid;
    }
</script>


