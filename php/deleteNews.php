<?php
    #1. Start Sesstion 

        #2. Check Sesstion 

        #3. Connect to database 
        include_once 'DBConnect.php';

        #4. Get item code from Ex01_Read.php
        if (!isset($_GET["code"])):
            header("location: ../news.php");
        endif;
        $code = $_GET ["code"];

        #5. Execute query 
        $query = "DELETE FROM `tbNews` WHERE `NewsID` = '{$code}';";
        $rs = mysqli_query($conn, $query);
        header ("location: ../news.php");
