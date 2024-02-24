<?php
#1. Start session
#2. Kiểm tra
#3. Kết nối
include_once "php/DBConnect.php";
#4. Lấy item code
$pageTitle = "Change Password";
if (!isset($_GET['code'])) :
    header("location: userprofile.php");
endif;
$code = $_GET['code'];
#5. Thực thi
$query = "SELECT * FROM tbUser_Account WHERE userid = '$code' ";
$rs = mysqli_query($conn, $query);
$field = mysqli_fetch_array($rs);
#6. Kiểm tra đã submit
if(isset($_POST['update'])):
if($_POST["currentPassword"] == $field["Password"]) {
    if($_POST["newPassword"] == $_POST["confirmPassword"]){
        mysqli_query($conn,"UPDATE tbUser_Account set password='" . $_POST["newPassword"] . "' WHERE userid = '$code'");
        header("location:userprofile.php?msgSuccess");
    } else {
        $message = "Confirm password and password must be the same";
    }
} else{
    $message = "Current password is incorrect";
}
endif;
include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<style>
    td{
        padding-bottom: 6px
    }
</style>

    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 container">
        <div class="row">
            <div class="col-sm-4">
                <img class="img-responsive" src="img/changepass.png" alt="" width="400px" style="float: right"/>
            </div>
            <div class="col-sm-8 border border-dark rounded border-3">
                <br>
                <h2 style="text-align: center">User Password</h2>
                <?php if(isset($message)) { echo $message; } ?>
                <hr>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th>Current Password </th>
                            <td><input type="password" name="currentPassword" required></td> 
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th>New Password </th>
                            <td><input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" type="password" name="newPassword" required></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Confirm Password&emsp;&emsp;</th>
                            <td><input type="password" name="confirmPassword" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Click update to change your password</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update" name="update" class="btn btn-outline-dark"
                                    onclick="return confirm('Are you sure to change your password?')"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php
include 'php/htmlBody.php';
?>
<div class="container-fluid" style="margin-top: 100px">
        <?php
            include 'php/footer.php';
        ?>
</div>