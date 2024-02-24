<?php
if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/registerandlogin/Model/Member.php';
    $member = new Member();
    $loginResult = $member->loginMember();
}
?>
<HTML>
<HEAD>
<TITLE>Login</TITLE>
<link href="registerandlogin/css/style.css" type="text/css"
	rel="stylesheet" />
<link href="registerandlogin/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
<script src="registerandlogin/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<style>
.form-label {
    margin-bottom: 5px;
    margin-left: 20px;
    text-align: left;
}
.sign-up-container {
    border: 1px solid;
    border-color: #9a9a9a;
    background: #fff;
    border-radius: 4px;
    padding: 10px;
    width: 300px;
    margin: 50px auto;
}
.login-signup {
    margin: 10px;
    text-decoration: none;
    float: left;
    margin-left: 15px
}
</style>
</HEAD>
<BODY>
	<div class="container">
		<div class="sign-up-container">
			<div class="login-signup" >
				<a href="home.php">Homepage</a> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="user-registration.php">Sign up</a>
			</div>
			<div class="signup-align">
				<form name="login" action="" method="post"
					onsubmit="return loginValidation()">
					<div class="signup-heading" style="color: #3F4E4F">Login</div>
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
                                            <div>
						<input class="btn btn-success rounded-pill" type="submit" name="login-btn"
							id="login-btn" value="Login">
                                            </div>
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
