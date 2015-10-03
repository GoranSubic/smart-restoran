<?php

include "class.phpmailer.php";
class OrderDAO {

    public function writeOrder($order_array){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        //print_r($order_array);

        $uid = 0;
        foreach($order_array as $order_key=>$order_value){

            //foreach($order_one as $order_key=>$order_value){

                $idi = $order_value[0];
                $price = $order_value[1];
                $coli = $order_value[2];
                $uid = $order_value[3];

                $dt = new DateTime();
                //echo $dt->format('Y-m-d H:i:s');
                $today = $dt->format('Y-m-d H:i:s');

            $insertupdate = 0;
            if(!isset($userorder_id)){
                $insertupdate = 1;
                //echo "<br />Bio u proveri insertupdate = 1";
            }else{
                $insertupdate = 2;
                //echo "<br />Bio u proveri insertupdate = 2";
            }

                /*$insertupdate = 0;
                $sqlcheck1 = "SELECT id FROM userorder WHERE id = {$uid}";
                if (!$resultscheck = $connection->query($sqlcheck1)){
                    $insertupdate = 1;
                    echo "<br />Bio u proveri insertupdate = 1";
                }else{
                    $insertupdate = 2;
                    echo "<br />Bio u proveri insertupdate = 2";
                }*/

                if($insertupdate == 1){
                    //Insert
                    $sqlinsusr = "INSERT INTO userorder (order_date, orderstatus, started, finished, user_id) VALUES ('$today', 'nije', '$today', '$today', $uid); ";
                    if (!$resultswrite = $connection->query($sqlinsusr)){
                        die('<br />Ne mogu da izvrsim Insert upit u userorder tabelu zbog ['. $connection->error
                            . "]");
                    }
                    //Provera poslednje insertovanog userorder.id
                    //$userorder_id = mysqli_insert_id($connection);
                    $sql_max = "SELECT MAX(id) FROM userorder";
                    if(!$resultsmax = $connection->query($sql_max)){
                        die("<br />Doslo je do greske u upitu za proveru max user.id: " . $connection->error );
                    }
                    $maxrow = $resultsmax->fetch_assoc();
                    $userorder_id = $maxrow['MAX(id)'];


                    $sqlinsitm = "INSERT INTO userorder_item (item_id, price, quantity, userorder_id) VALUES ($idi, $price, $coli, $userorder_id); ";
                    if (!$resultswriteitem = $connection->query($sqlinsitm)){
                        die('<br />Ne mogu da izvrsim Insert upit u userorder_item zbog ['. $connection->error
                            . "]");
                    }

                    //$sqlreturn = "SELECT userorder.id FROM userorder WHERE userorder.id = {}";

                    //return $userorder_id;

                }elseif($insertupdate == 2){
                    //$sqlupditm = "UPDATE userorder_item SET (item_id = {$idi}, price = '{$price}', quantity = {$coli}) WHERE userorder_id = {$userorder_id}";
                    $sqlupditm = "INSERT INTO userorder_item (item_id, price, quantity, userorder_id) VALUES ($idi, $price, $coli, $userorder_id); ";
                    //var_dump($sqlupditm);
                    if (!$resultsupditem = $connection->query($sqlupditm)){
                        die('<br />Ne mogu da izvrsim Update upit zbog ['. $connection->error
                            . "]");
                    }


                }
            //}
        }

        return $userorder_id;

    }

    /*
    public function writeOrder($idi, $coli, $uid, $price){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqlcheck = "SELECT ";

        $sqlwrite = "INSERT INTO userorder (order_date, status, started, finished, user_id) VALUES  = (today(), '0', '1', '0', $uid); ";
        if (!$resultswrite = $connection->query($sqlwrite)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        //Provera poslednje insertovanog userorder.id
        $userorder_id = mysqli_insert_id($connection);

        //Provera poslednje insertovanog user.id
        //$id = mysqli_insert_id($connection);
        /*$sql_max = "SELECT MAX(id) FROM user";
        //if(!$results = $connection->query($sql_max)){
        //    die("Doslo je do greske u upitu za proveru max user.id: " . $connection->error );
        //}
        //$maxrow = $results->fetch_assoc();
        //$id = $maxrow['MAX(id)'];


        $sqlwriteitem = "INSERT INTO userorder_item (item_id, price, quantity, userorder_id) VALUES  = ($idi, $price, $coli, $userorder_id); ";
        if (!$resultswriteitem = $connection->query($sqlwriteitem)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        //$sqlreturn = "SELECT userorder.id FROM userorder WHERE userorder.id = {}";

        return $userorder_id;

    }*/


    public function sendEmail($foremail1){

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


        $mail->AddReplyTo("restoransmart@gmail.com","Smart Restoran - Kreirana porudzbina");
        //$mail->AddReplyTo($emailun,"Podrska BB Trade ad");

        $mail->From       = "restoransmart@gmail.com";
        $mail->FromName   = "Smart Restoran";
        $mail->AddAddress($_SESSION['email']);
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
        $mail->Subject = "Smart Restoran - Kreirana porudzbina";

        // From
        //$header="from: your name <your email>";
        $mail->Header = "from: Smart Restoran <restoransmart@gmail.com>";

        // Your message
        //$message="Your Comfirmation link \r\n";
        //$message.="Click on this link to activate your account \r\n";
        //$message.="http://www.yourweb.com/confirmation.php?passkey=$confirm_code";
        $mail->Body = "Smart Restoran - Kreirana porudzbina {$foremail1}";                      //HTML Body
        $mail->AltBody    = "AltBody - Smart Restoran - Kreirana porudzbina"; // optional, comment out and test
        $mail->WordWrap   = 50; // set word wrap

        //$mail->MsgHTML($body);


        // send email
        //$mail = mail($to,$subject,$message,$header);

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }

        echo '<br />';
        echo "Ako ste upisali ispravnu email adresu, fajl ce Vam biti isporucen putem email-a.";
    }
}