<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once "../../../config/connection.php";
require_once "functions.php";

if(isset($_POST['id']) || isset($_POST['text'])){

    $text=$_POST['text'];
    $id=$_POST['id'];


    $error="";

    if($text==""){
        $errors[] = "Text is required";
    }
    if($id==""){
        $errors[] = "Id is required";
    }

    if($error==""){

        try{

                $contact=getOneContact($id);;
                if($contact){

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
                    $mail->addAddress($contact->email);
                    $mail->Subject="Itech Answer";
                    $mail->Body=$text;

                    if($mail->send()){
                        $response="email is sent";
                        updateContactStatus($id);
                    }else{
                        $response="Something is wrong ".$mail->ErrorInfo;
                    }

                }else{
                    $response="email is not exist";
                    echo $response;
                }
                
                
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
        

    }else{
        $response="Error parametars";
        echo $response;

    }

}