<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once "../../../config/connection.php";
require_once "functions.php";

if(isset($_POST['button']) || isset($_POST['idnewsletter'])){

    $title=$_POST['title'];
    $code=$_POST['code'];
    $error="";

    if($title==""){
        $errors[] = "Title is required";
    }
    if($code==""){
        $errors[] = "Code is required";
    }

    if($error==""){



        try{

            if(isset($_POST['button'])){
                $insertInDatabase=insertNewsletter($title,$code);
            }else{
                $insertInDatabase=true;
            }
            if($insertInDatabase){

                $email=getAllEmail();
                if($email){

                    require_once "../../../assets/PHPMailer/src/PHPMailer.php";
                    require_once "../../../assets/PHPMailer/src/Exception.php";
                    require_once "../../../assets/PHPMailer/src/SMTP.php";

                    $mail=new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host="smtp.gmail.com";
                    $mail->SMTPAuth=true;
                    $mail->Username="markoczv314@gmail.com";
                    $mail->Password="Markoczv314034";
                    $mail->Port=465;
                    $mail->SMTPSecure="ssl";

                    $mail->isHTML(true);
                    $mail->setFrom("markoczv314@gmail.com");
                    foreach($email as $item){
                        $mail->addAddress($item->email);
                    }
                    $mail->Subject=$title;
                    $mail->Body=$code;

                    if($mail->send()){
                        $response="email is sent";
                    }else{
                        $response="Something is wrong ".$mail->ErrorInfo;
                    }

                }else{
                    $response="email is not exist";
                    echo $response;
                }
                
            }        
        }catch(PDOException $e){
            $e->getMessage();
            upisGreskeIzBaze($e);

        }

    }else{
        $response="Error parametars";
        echo $response;

    }

}