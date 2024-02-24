<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Contact Us";

$queryId = "SELECT `UserID`  FROM tbUser_Account WHERE UserName = '{$_SESSION["username"]}'";
$rsId = mysqli_query($conn, $queryId);
$rc = mysqli_fetch_array($rsId);
$userID = $rc[0];

//Lay du lieu TbUser_Acount
$tbuser_accont = "SELECT * FROM tbuser_account WHERE UserID ='{$userID}'";
$rs = mysqli_query($conn, $tbuser_accont);
$data = mysqli_fetch_array($rs);

//Lay du lieu tbFeedBack
$tbfeedback = "SELECT * FROM tbfeedback";
$rs2 = mysqli_query($conn, $tbfeedback);
$data2 = mysqli_fetch_array($rs2);

//Sever
if (isset($_POST["txtSubmit"])) :
    $Content = htmlspecialchars($_POST["txtContent"]);

    $query = "INSERT INTO tbfeedback (`UserID` ,`Content`, `Date`) VALUES ('{$userID}','{$Content}',now());";
    $rs3 = mysqli_query($conn, $query);

    if (!$rs2) :
        die('nothing to save');
    endif;
    header("location: home.php");
endif;
include 'php/htmlHead.php';
include 'php/navigationBar.php';

?>
<style>
    body {
        background-image: url('img/contact-background.jpg');
    }
</style>
<section class="container my-5 px-5">
    <form method="post" enctype="multipart/form-data" onsubmit="return signupValidation()">
        <h2 class="text-center text-white">Contact Us</h2>
        <table class="table table-hove table-bordered bg-white w-50 mx-auto">
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputInvalid" placeholder="Phone Number" name="txtName" value="<?= $data[1] ?>" readonly disabled>
                        <label for="floatingInputInvalid">User Name</label>
                    </div>
                </td>
            </tr>
            <tr>

                <td>
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="floatingInputInvalid" placeholder="Phone" name="txtPhone" value="<?= $data[5] ?>" readonly disabled>
                        <label for="floatingInputInvalid">Phone Number</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInputInvalid" placeholder="name@example.com" name="txtEmail" value="<?= $data[4] ?>" readonly disabled>
                        <label for="floatingInputInvalid">Email</label>
                    </div>
                </td>
            </tr>

            <tr>
            
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingInputInvalid3" name="txtContent" rows="40" cols="20" style="height: 10rem;" maxlength="1000"></textarea>
                        <label for="floatingTextarea">Leave your feedback here</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center"> <input type="submit" name="txtSubmit" value="Send" class="btn btn-warning rounded-pill"></td>
            </tr>
        </table>
    </form>
</section>

<?php
include 'php/footer.php';
include 'php/htmlBody.php';
?>

<!--  -->
<script>
    function signupValidation() {
	    var valid = true;
        
	$("#floatingInputInvalid3").removeClass("is-invalid");

	var fullname = $ ("#floatingInputInvalid3").val();

    if (fullname.trim() == "") {
		$("#floatingInputInvalid3").addClass("is-invalid");
		valid = false;
	}

	return valid;
    }
</script>
