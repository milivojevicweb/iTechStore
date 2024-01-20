<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once "../../config/connection.php";
require_once "functions.php";

if(isset($_POST['sendEmail'])){

    $email=$_POST['email'];
    $token=rand(143,1111999)+time();
    $message="You activation link for password is: http://itechstore.epizy.com/index.php?page=resetPassword&email=".$email."&token=".$token;
    if(checkEmail($email)){


        require_once "../../assets/PHPMailer/src/PHPMailer.php";
        require_once "../../assets/PHPMailer/src/Exception.php";
        require_once "../../assets/PHPMailer/src/SMTP.php";

        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth=true;
        $mail->Username="maywantechnology@gmail.com";
        $mail->Password="Markoczv314034";
        $mail->Port=587;
        $mail->SMTPSecure="tls";

        $mail->isHTML(true);
        $mail->setFrom("maywantechnology@gmail.com");
        $mail->addAddress($email);
        $mail->Subject="Reset Password";
        $mail->Body=$message;

        if($mail->send()){
            $response="email is sent";
            updateToken($token,$email);
            header("Location: ../../index.php?page=resetPassword");

        }else{
            $response="Something is wrong ".$mail->ErrorInfo;
        }

    }else{
        header("Location: ../../index.php?page=resetPassword");
    }

}
