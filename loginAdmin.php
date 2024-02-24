<?php
#1. Start session
session_start();
#2. Connect to database
include_once 'php/DBConnect.php';
#3. Check form is submitted
if (!empty($_POST["login-btn"])) :
    #4. Read data from field input
    $name = $_POST['username'];
    $password = $_POST['login-password'];
    #5. Execute query
    $query = "SELECT * FROM tbadmin WHERE adminname = '$name' AND password = '$password'";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs)) :
        #6. Assign username to session
        $_SESSION['sessionAdmin'] = $_POST['username'];
        header('Location: admin.php');
    else :
        #8. Show error message
        header('Location: Loginadmin.php?msgErrLogin');
    endif;
endif;
?>
<HTML>
<HEAD>
<TITLE>Admin Login</TITLE>
<link href="registerandlogin/css/style.css" type="text/css"
	rel="stylesheet" />
<link href="registerandlogin/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<script src="registerandlogin/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<style>
    body{
        background-image: none;
        background-color: #d4d4d4
    }
    .signup-heading {
    font-size: 2em;
    font-weight: bold;
    padding-top: 60px;
    text-align: center;
    color: black
    }
    .container button, .container input[type=submit] {
	padding: 8px 0px;
	font-size: 1em;
	cursor: pointer;
	border-radius: 3px;
        color: #fff;
	font-weight: bold;
        background-color: #727272;
        border-color: #b9b8b8;
    }

    .container button, .container input[type=submit]:hover {
        background-color: black;
    }
    input:focus{
        background-color: #e0dfdf
    }
</style>
</HEAD>
<BODY>
	<div class="container">
		<div class="sign-up-container">
			<div class="signup-align">
				<form name="login" action="" method="post"
					onsubmit="return loginValidation()">                                    
					<div class="signup-heading">Admin Login</div>
                                        <?php
                                    if (isset($_GET["msgErrLogin"])) :
                                        echo '<div class="error-msg">Invalid Username or Password</div>';
                                    endif;
                                    if (isset($_GET["msgLogin"])) :
                                        echo '<div class="error-msg">Please login first</div>';
                                    endif;
                                    ?>
				<?php if(!empty($loginResult)){?>
				<div class="error-msg"><?php echo $loginResult;?></div>
				<?php }?>
				<div class="row">
						<div class="inline-block">
							<div class="form-label">
								<strong>Username</strong><span class="required error" id="username-info"></span>
							</div>
							<input class="input-box-330" type="text" name="username"
								id="username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
                                                    <div class="form-label">
								<strong>Password</strong><span class="required error" id="login-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="login-password" id="login-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="login-btn"
							id="login-btn" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
function loginValidation() {
	var valid = true;
	$("#username").removeClass("error-field");
	$("#password").removeClass("error-field");

	var UserName = $("#username").val();
	var Password = $('#login-password').val();

	$("#username-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#login-password-info").html("required.").css("color", "#ee0000").show();
		$("#login-password").addClass("error-field");
		valid = false;
	}
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
</BODY>
</HTML>
