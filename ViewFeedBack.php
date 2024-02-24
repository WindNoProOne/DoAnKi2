<?php
//Lay du lieu
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Feedback Management";

//Lay du lieu tu tbFeedBack
$tbfeedback = "SELECT * FROM tbfeedback";
$rsfeedback = mysqli_query($conn, $tbfeedback);
$datafeedback = mysqli_num_rows($rsfeedback);

//Lay du lieu tu tbGuest
$tbuser_account = "SELECT * FROM tbuser_account";
$rsuser = mysqli_query($conn, $tbuser_account);
$datauser = mysqli_num_rows($rsuser);
$user = array();
for ($i = 0; $i < $datauser; $i++) {
    $rcUser = mysqli_fetch_array($rsuser);  //mysqli_fetch_array: chuyen thanh array
    array_push($user, $rcUser);              //array_push: day du lieu vao array
}

//Lay du lieu tu tbguest
$tbguest = "SELECT * FROM tbguest";
$rsguest = mysqli_query($conn, $tbguest);
$dataguest = mysqli_num_rows($rsguest);
$guest = array();
for ($i = 0; $i < $dataguest; $i++) {
    $rcGuest = mysqli_fetch_array($rsguest);
    array_push($user, $rcGuest);
}

include 'php/htmlHead.php';
include 'php/sidebar.php';

?>

<div class="container">
    <table class="table">

        <h2 class="border-bottom">View FeedBack Management</h2>

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Customer</th>
                <th scope="col">Content</th>
                <th scope="col">DateTime</th>
                <th scope="col">Details</th>
                <th scope="col">Function</th>
            </tr>
        </thead>
        <tbody>
        <?php
            for ($i = 0; $i < $datafeedback; $i++) :
                $rcfeedback = mysqli_fetch_array($rsfeedback);
            ?>
                <tr>
                    <td><?= $rcfeedback[0] ?></td>
                    <td>
                        <?php
                        for ($z = 0; $z < count($user); $z++) {
                            if ($rcfeedback[1] == $user[$z][0]) {
                                echo $user[$z][3];
                            }
                        };

                        for ($z = 0; $z < count($guest); $z++) {
                            if ($rcfeedback[2] == $guest[$z][0]) {
                                echo $guest[$z][1];
                            }
                        };
                        ?>
                    </td>
                    <td class="overflow-hidden text-start"><?= $rcfeedback[3] ?></td>
                    <td><?= $rcfeedback[4] ?></td>

                    <td class="text-center"><a href="DetailsFeedBack.php?code=<?= $rcfeedback[0]?>" class="btn btn-outline-info rounded-pill m-0">View</a></td>
                    <td class="text-center"><a href="responseFeedBack.php" class="btn btn-warning rounded-pill m-0">Response</a></td>
                </tr>
            <?php
            endfor;
            ?>
        </tbody>
    </table>
</div>

<?php
include 'php/htmlBody.php';
?>