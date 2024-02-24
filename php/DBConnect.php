<?php

#1. Declare information of database
$server = "localhost";
$account = "root";
$password = "";
$database = "dbpheidip"; //database's name

#2. Connect Database
$conn = mysqli_connect($server, $account, $password, $database);

#3. Test
//if($conn == null):
//    exit("Connection fails!"); //die("Connection fails!");
//else:
//    echo '<p class="alert alert-success" role="alert">Connection Success </p>';
//endif;