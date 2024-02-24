<?php

use PHPMailer\PHPMailer\PHPMailer;
include 'php/DBConnect.php';
session_start();

if (isset($_POST["send"])) :

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    include('./PHPMailer/src/OAuthTokenProvider.php');

    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->SMTPDebug  = 0;                                       // Xem báo lỗi ở dòng nào nếu == 0 thì k hiện 
    $mail->Username   = 'grow5project2@gmail.com';                     //SMTP username
    $mail->Password   = '123456789qatp';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;  //465                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->isHTML(true);
    $mail->setFrom('systemtest@gmail.com', 'Mailer');
    $mail->addAddress($_POST["txtEmail"], 'Joe User'); // Add a recipient

    $mail->Subject = 'subject lines matter';  //Khai bao chu de email
    $mail->Body    = 'content'; //Thong tin dược gửi đi

    if ($mail->send()) :
        // echo 'Massage clound not be send';
        echo 'Mailer Error:' . $mail->ErrorInfo;
    else :
        echo 'Messsage has been sent ';
    endif;
endif;


include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<h2>ResponseFeedBack :</h2>
<a href="ViewFeedBack.php">Back To Page FeedBack</a>
<form action="" method="post">
    <table align="center">
        <tr>
            <td>Email:</td>
            <td><input type="text" name="txtEmail"></td>
        </tr>

        <tr>
            <td>FeedBack: </td>
            <td><textarea name="content" cols="30" rows="10" id="content"></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><button type="submit" name="send">Send</button></td>
        </tr>
    </table>
</form>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>