<?php

include "class.phpmailer.php";
include_once "connection/db_config.php";

class EmailDAO {

    public function sendEmail($foremail1, $checkorder_id, $to_email, $subject){

        // ---------------- SEND MAIL FORM ----------------
        $mail = new PHPMailer();
        //$mail->SetLanguage('en',dirname(__FILE__)); // . '/phpmailer/language/');
        //$body             = $mail->getFile('contents.html');
        //$body             = eregi_replace("[\]",'',$body);

        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->CharSet="utf-8";
        //ne znam kako da vucem un iz settings.php	$mail->Username   = "'".$emailun."'@gmail.com";  // GMAIL username
        $mail->Username   = "restoransmart@gmail.com";
        //ne znam kako da vucem pass iz settings.php	$mail->Password = $emailpass;            // GMAIL password
        $mail->Password   = "smart2015";            // GMAIL password


        $mail->AddReplyTo("restoransmart@gmail.com,{$subject}");
        //$mail->AddReplyTo($emailun,"Podrska BB Trade ad");

        $mail->From       = "restoransmart@gmail.com";
        $mail->FromName   = "Smart Restoran";
        $mail->AddAddress($to_email);
        $restoran = "restoransmart@gmail.com";
        $mail->AddCC($restoran, $name = 'Smart Restoran');
        //$mail->AddAttachment('gsubic@gmail.com', 'Goran Subic');
        //AddCC($address, $name = '')
        //$mail->AddAttachment("/tmp/izvestaj.csv");             // attachment

        // send e-mail to ...
        //$to=$email;
        //$mail->AddAddress("$email");

        // Your subject
        //$subject="Your confirmation link here";
        $mail->Subject = $subject;

        // From
        //$header="from: your name <your email>";
        $mail->Header = "from: Smart Restoran <restoransmart@gmail.com>";

        // Your message
        //$message="Your Comfirmation link \r\n";
        //$message.="Click on this link to activate your account \r\n";
        //$message.="http://www.yourweb.com/confirmation.php?passkey=$confirm_code";
        $mail->Body = $subject . $foremail1;                      //HTML Body
        $mail->AltBody    = "AltBody - ".$subject; // optional, comment out and test
        $mail->WordWrap   = 50; // set word wrap

        //$mail->MsgHTML($body);


        // send email
        //$mail = mail($to,$subject,$message,$header);

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Poruka je poslata na email koji ste registrovali.";
            echo "Molimo Vas da sa email-a potvrdite porudžbinu klikom na odgovarajući link.";
        }

        echo '<br />';
        echo "Ako ste upisali ispravnu email adresu, fajl ce Vam biti isporucen putem email-a.";
    }


    public function confirmOrder($co){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $dt = new DateTime();
        $today = $dt->format('Y-m-d H:i:s');

        $sqlco = "UPDATE userorder SET orderstatus = 'Potvrđeno', started = '$today' WHERE checkorder_id = {$co}";
        if(!$results = $connection->query($sqlco)){
            die("Postoji problem prilikom confirm update userorder tabele zbog: [". $connection->error
                            . "]");
        }

        if($results > 0){
            return $confirmorder = "Uspešno je potvrđena Vaša porudžbina!";
        }else{
            echo "Nije pronadjen niti jedan zapis!";
        }

    }

    public function disableOrder($do){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $dt = new DateTime();
        $today = $dt->format('Y-m-d H:i:s');

        $sqldo = "UPDATE userorder SET orderstatus = 'Otkazano', finished = '$today' WHERE checkorder_id = {$do}";
        if(!$results = $connection->query($sqldo)){
            die("Postoji problem prilikom confirm update userorder tabele zbog: [". $connection->error
                . "]");
        }

        if($results > 0){
            print_r($results);
            var_dump($results);
            return $confirmorder = "Uspešno je otkazana Vaša porudžbina!";
        }else{
            echo "Nije pronadjen niti jedan zapis!";
        }

    }


}