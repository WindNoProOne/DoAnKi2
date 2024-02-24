<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "News Management";

$query = "SELECT *  FROM  tbnews";
$rs    = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs); //mysqli_num_rows: trả về 1 truy vấn được chọn 

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<style>
    .container {
        margin-left: 100px;
    }
    .content-news {
        width: 500px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .content-title{
        width: 30px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="container">
    <table class="table">

        <h2 class="border-bottom">News Management</h2>

        <a class="btn btn-success rounded-pill" href="AddNews.php">Add New</a>

        <thead>
            <tr>
                <th scope="col">News ID</th>
                <th scope="col" class="content-title">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Image</th>
                <th scope="col">DateTime</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count == 0) :
                echo '';
            else :
                while ($data = mysqli_fetch_array($rs)) :
            ?>
                    <tr class="news-row">
                        <td><?= $data[0] ?></td>
                        <td class="content-title"><?= $data[1] ?></td>
                        <td class="content-news"><?= $data[2] ?></td>
                        <td style="text-align:center"><img src="<?= $data[3] ?>" alt="Image" width="80" height="80"></td>
                        <td><?= $data[4] ?></td>
                        <td class="text-center"><a href="UpdateNews.php?id=<?= $data[0]?>" class="btn btn-outline-info rounded-pill m-0">Update</a></td>
                        <td class="text-center"><a href="DetailsNews.php?id=<?= $data[0]?>" class="btn btn-warning rounded-pill m-0">Details</a></td>
                    </tr>
            <?php
                endwhile;

            endif;
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

<?php
include 'php/htmlBody.php';
?>