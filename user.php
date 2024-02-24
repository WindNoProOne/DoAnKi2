<?php
#1. Start session
#2. Kiểm tra session
#3. Kết nối
include_once "php/DBConnect.php";
session_start();

$pageTitle = "User Management";
#4. Thực hiện
if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM tbUser_Account WHERE CONCAT(userid, username, fullname, email, phonenumber) LIKE '%" . $valueToSearch . "%'";
    $search_result = filterTable($query);
    $count = mysqli_num_rows($search_result);
} else {
    $query = "SELECT * FROM tbUser_Account";
    $search_result = filterTable($query);
    $count = mysqli_num_rows($search_result);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "dbpheidip");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 container">
    <h2>User List</h2>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <form action="" method="post">
        <div class="d-flex border rounded-pill my-3 w-25">
            <input type="submit" name="search" value="Search" class="btn btn-primary px-4 rounded-pill">
            <input class="form-control me-2 border-0 search shadow-none bg-none" type="text" name="valueToSearch" placeholder="Value To Search">
        </div>
        <?php
        if (!$count) {
            echo '<div class = "alert-warning">Records not found!</div>';
        }
        ?>
        <table id="userList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
                <?php
                while ($field = mysqli_fetch_array($search_result)) :
                ?>
                    <tr>
                        <td><?= $field[0] ?></td>
                        <td><?= $field[1] ?></td>
                        <td><?= $field[3] ?></td>
                        <td><?= $field[4] ?></td>
                        <td><?= $field[5] ?></td>
                        <td>
                            <?php
                            $query1 = "SELECT * FROM tbDelivery_Address WHERE userid = '$field[0]' AND is_default = 1";
                            $rs1 = mysqli_query($conn, $query1);
                            while ($field1 = mysqli_fetch_array($rs1)) :
                            ?>
                                <?= $field1[2] ?> <br>
                            <?php
                            endwhile;
                            ?>
                        </td>
                        <td style="text-align: center">
                            <a style="text-decoration: none; color: black" href="blockuser.php?code=<?= $field[0]; ?>" onclick="return confirm('Really want to switch status of <?= $field[1] ?> ???')">
                                <?php
                                if ($field[6]) :
                                    echo '<strong style="color: green">Active</strong>';
                                else :
                                    echo '<strong style="color: red">Inactive</strong>';
                                endif;
                                ?>
                            </a>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
    </form>
    </thead>
    </table>
</div>

<?php
include 'php/htmlBody.php';
?>