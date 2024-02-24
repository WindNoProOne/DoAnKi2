<?php
//Ket noi du lieu
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "News Details";
//Detials 
$id = $_GET["id"];
$query = "SELECT * FROM tbnews WHERE NewsID = '{$id}'";
$rs = mysqli_query($conn, $query);
$news = mysqli_fetch_array($rs);


include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<section class="container section-margin">
    <form method="post" enctype="multipart/form-data">
        <h2><?= $news[1]?> Detials</h2>
        <br>
        <a href="ViewsNews.php" class="btn btn-outline-info rounded-pill m-0">Back</a>
        <hr>

        <table class="table">
            <tr>
                <td>Id</td>
                <td><?= $news[0] ?></td>
            </tr>
            <tr>

                <td>Title:</td>
                <td> <?=$news[1] ?> </td>
            </tr>

            <tr>
                <td>Content:</td>
                <td><?= $news[2] ?></td>
            </tr>

            <tr>
                <td>Image</td>
                <td style="text-align:center"><img src="<?= $news[3] ?>" alt="Image" width="300px" height="300px" readonly></td>
            </tr>

            <tr>
                <td>Date Time:</td>
                <td><?= $news[4] ?></td>
            </tr>

        </table>
    </form>
</section>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>

