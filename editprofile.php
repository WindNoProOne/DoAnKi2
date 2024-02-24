<?php
#1. Start session
#2. Kiểm tra
#3. Kết nối
include_once "php/DBConnect.php";
$pageTitle = "Edit Profile";
#4. Lấy item code
if (!isset($_GET['code'])) :
    header("location: userprofile.php");
endif;
$code = $_GET['code'];
#5. Thực thi
$query = "SELECT * FROM tbUser_Account WHERE userid = '$code' ";
$rs = mysqli_query($conn, $query);
$field = mysqli_fetch_array($rs);
$query1 = "SELECT * FROM tbDelivery_Address WHERE userid = '$field[0]'";
$rs1 = mysqli_query($conn, $query1);
$field1 = mysqli_fetch_array($rs1);
#6. Kiểm tra đã submit
if (isset($_POST['update'])) :
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $query = "UPDATE tbUser_Account SET fullname = '$fullname', email = '$email', phonenumber = '$phone' WHERE userid = '$code';"
            . "UPDATE tbDelivery_Address SET address = '$address' WHERE addressid = '$field1[0]'";
    $rs = mysqli_multi_query($conn,$query);
    if (!$rs) :
        error_clear_last();
        die("Nothing to save");
    endif;
    header("location:userprofile.php?msgSuccess");
endif;

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<style>
    td{
        padding-bottom: 5px
    }
</style>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img class="img-responsive" src="img/editprofile.png" alt="" width="400px" style="float: right"/>
            </div>
            <div class="col-sm-8 border border-dark rounded border-3">
                <br>
                <h2 style="text-align: center">User profile</h2>
                <hr>
                <form action="" method="post">
                    <table style="width: auto">
                        <tr>
                            <th>Full Name </th>
                            <td><input pattern="^[a-zA-Z]{3,}( {1,2}[a-zA-Z]{3,}){0,}$" type="text" name="fullname" placeholder="Full Name" value="<?= $field[3] ?>" required></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Email </th>
                            <td><input pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" name="email" placeholder="Email" value="<?= $field[4] ?>" required></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Phone Number&emsp;&emsp;</th>
                            <td><input pattern="[0-9]{10,14}" type="text" name="phone" placeholder="Phone Number" value="<?= $field[5] ?>" required></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top">Address </th>
                            <td>
                                <input pattern="{3,}" type="text" name="address" placeholder="Address" value="<?= $field1[2] ?>" required> <br> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">                                
                                Click update to change your profile information
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">                                
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update" name="update" class="btn btn-outline-dark"
                                    onclick="return confirm('Are you sure to change your profile?')"></td>
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