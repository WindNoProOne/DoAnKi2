<!DOCTYPE html>
<html lang="en">
<?php
//Lay du lieu
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Details Feedback";

$code = $_GET["code"];
$query = "SELECT * FROM tbfeedback where FeedBackId = '{$code}'";
$rs = mysqli_query($conn, $query);
$field = mysqli_fetch_array($rs);

//Lay du lieu tu tbGuest
$tbuser_account = "SELECT * FROM tbuser_account WHERE 'UserID' = '{$field[1]}' ";
$rsuser = mysqli_query($conn, $tbuser_account);
$datauser = mysqli_fetch_array($rsuser);

//Lay du lieu tu tbguest
$tbguest = "SELECT * FROM tbguest WHERE 'GuestID' = '{$field[2]}' ";
$rsguest = mysqli_query($conn, $tbguest);
$dataguest = mysqli_fetch_array($rsguest);


include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="container-fluid">
    <div class="container">
        <h2>View FeedBack</h2>
        <h4><a href="ViewFeedBack.php" class="btn btn-success rounded-pill">Back FeedBack</a></h4>
    </div>

    <div>
        <form action="" method="post">
            <table class="table table-hove table-bordered">
                <tr>
                    <td>FeedBack Id:</td>
                    <td><?= $field[0] ?></td>
                </tr>

                <!-- Customer -->
                <tr>
                    <td>Customer</td>
                    <td></td>
                </tr>
                <!-- Comment -->
                <tr>
                    <td>Comment</td>
                    <td><?= $field[3] ?></td>
                </tr>
                <!-- Date -->
                <tr>
                    <td>Date</td>
                    <td><?= $field[4] ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td class="text-center"><a href="responseFeedBack.php" class="btn btn-warning rounded-pill m-0">Response</a></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>