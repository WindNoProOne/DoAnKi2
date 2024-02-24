<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Contact Us";

if (isset($_POST["txtSubmit"])) :
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    $phone = $_POST["txtPhone"];
    $Content = htmlspecialchars($_POST["txtContent"]);

    $tbguest = "INSERT INTO `tbGuest`(`GuestName`, `email`, `Phone`) VALUES ('{$name}','{$email}', '{$phone}');";
    $rstbguest = mysqli_query($conn, $tbguest);

    $guest = "SELECT GuestID FROM tbguest WHERE `email` = '{$email}'";
    $rsguest = mysqli_query($conn, $guest);
    $rcguest = mysqli_fetch_array($rsguest);

    $tbfeedback = "INSERT INTO tbfeedback(`GuestID` ,`Content`, `Date`) VALUES ('{$rcguest[0]}', '{$Content}',now())";
    $rstbfeedback = mysqli_query($conn, $tbfeedback);

    if (!$rstbguest && !$rstbfeedback) :
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
<section class="container my-5">
    <form method="post" enctype="multipart/form-data" class="needs-validation"  onsubmit="return signupValidation()">
        <h2 class="text-white text-center">Contact Us</h2>
        <table class="table table-hove table-bordered bg-white w-50 mx-auto">
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control " id="floatingInputInvalid0" placeholder="Input Name" name="txtName" maxlength="25">
                        <label for="floatingInputInvalid">User Name</label>
                        <div class="invalid-feedback">*Required Name.</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="email" class="form-control " id="floatingInputInvalid1" placeholder="name@example.com" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        <label for="floatingInputInvalid">Email</label>
                        <div class="invalid-feedback">*Required Mail.</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="floatingInputInvalid2" placeholder="Input Phone" name="txtPhone" pattern="([\+84|84|0]+(3|5|7|8|9|1[2|6|8|9]))+([0-9]{8})\b">
                        <label for="floatingInputInvalid">Phone Number</label>
                        <div class="invalid-feedback">*Required Phone Number.</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingInputInvalid3" name="txtContent" rows="10" cols="30" style="height: 10rem;"maxlength="1000"></textarea>
                        <label for="floatingTextarea">Leave your feedback here</label>
                        <div class="invalid-feedback">*Required FeedBack.</div>
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
mysqli_close($conn);
include 'php/footer.php';
include 'php/htmlBody.php';
?>

<!--  -->
<script>
    function signupValidation() {
	    var valid = true;
        
    $("#floatingInputInvalid0").removeClass("is-invalid");
    $("#floatingInputInvalid1").removeClass("is-invalid");
	$("#floatingInputInvalid2").removeClass("is-invalid");
	$("#floatingInputInvalid3").removeClass("is-invalid");

    var UserName = $("#floatingInputInvalid0").val();
	var email = $("#floatingInputInvalid1").val();
	var fullname = $ ("#floatingInputInvalid2").val();
	var fullname = $ ("#floatingInputInvalid3").val();

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
	}if (fullname.trim() == "") {
		$("#floatingInputInvalid3").addClass("is-invalid");
		valid = false;
	}

	return valid;
    }
</script>
