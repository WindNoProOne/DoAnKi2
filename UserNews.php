<?php
//Lay du lieu
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Information";

//Lay du lieu tu database
$query = "SELECT *  FROM  tbnews";
$rs    = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs); //mysqli_num_rows: trả về 1 truy vấn được chọn 

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>

<style>
    .navbar-top {
        border: 1px solid wheat;
        background-color: burlywood;
        height: 400px;
    }

    .navbar-top-home {
        margin: 40px 40px 0px 180px;
    }

    .navbar-top-Notify {
        margin: 40px 40px 0px 180px;
        font-family: Blippo, fantasy;
    }

    .navbar-top-Notify h1 {
        font-size: 40px;
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        text-transform: none;
        font-style: normal;
        color: white;
    }

    .navbar-top-time {
        font-size: large;
        color: burlywood;
        margin: 20px 850px 0px 30px;
        font-size: 20px;
        font-family: "Helvetica Neue", Helvetica, sans-serif;
    }

    .navbar-title {
        font-family: Florence, cursive, Blippo;
        font-size: 40px;
    }

    .table {
        margin: 10px 0px 0px 0px;
    }


    .navbar-Information {
        font-family: Florence, cursive;
        font-size: 17px;
    }
</style>

<head>

<body>
    <!-- Backround - top -->
    <div class="navbar-top">
        <!-- <div class="navbar-top-home">
            <button type="button" class="btn btn-light"><a href="#.php" class="text-decoration-none text-warning">Home Pate</a></button>
        </div> -->

        <div class="navbar-top-Notify">
            <h1>Philip Shop would like to introduce Information about some new </h1> <br>
            <h1>SHOE MODELS on the market today</h1>
        </div>
    </div>

    <!-- News -->
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 container">
        <div class="navbar">
            <!-- Mo du lieu -->
            <?php
            if ($count == 0) :
                echo '';
            else :
                while ($data = mysqli_fetch_array($rs)) :
            ?>
                    <table class="table">
                        <tr>
                            <td class="navbar-title"><?= $data[1] ?></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="navbar-Information"><?= $data[2] ?></td>
                            <td style="text-align:center"><img src="<?= $data[3] ?>" alt="Image" width="500px" height="500px"></td>
                        </tr>
                    </table>

                    <!-- Dong du lieu -->
            <?php
                endwhile;
            endif;
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</head>

<?php
include 'php/footer.php';
include 'php/htmlBody.php';
?>