<?php

include "class.phpmailer.php";
include_once "connection/db_config.php";

class OrderDAO {

    public function orderList(){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqlmaxuo = "SELECT MAX(userorder.id) as id FROM userorder";
        if(!$resultmax = $connection->query($sqlmaxuo)){
            die("<br />Doslo je do greske u upitu za proveru max userorder.id: " . $connection->error );
        }
        $rowmax = $resultmax->fetch_assoc();
        $maxuoid = $rowmax['id'] - COL_NUM;

        //echo "maxuoid iznosi ".$maxuoid;

        $sqllist = "SELECT userorder.id as oid, userorder.order_date as odate, userorder.orderstatus as ostatus, userorder.started as ostarted, userorder.finished as ofinished, ";
        $sqllist .= "user.name as uname, user.secname as usecname, user.email as uemail, user.adress as uadress, user.city as ucity ";
        //$sqllist .= "user.email as uemail ";
        $sqllist .= "FROM userorder, user ";
        $sqllist .= "WHERE userorder.user_id = user.id ";
        $sqllist .= "AND userorder.id > {$maxuoid} ";
        $sqllist .= "ORDER BY userorder.id DESC; ";

        //print_r($sqllist);
        if(!$resultlist = $connection->query($sqllist)){
            die("<br />Doslo je do greske u upitu za proveru max userorder.id: " . $connection->error );
        }

        //$rowlist = $resultlist->fetch_assoc();

        return $resultlist;

    }

    public function orderItems($uoid){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqloi = "SELECT userorder_item.item_id, userorder_item.userorder_id, userorder_item.quantity, userorder_item.price, ";
        $sqloi .= "item.title ";
        $sqloi .= "FROM userorder_item JOIN item ON userorder_item.item_id = item.id ";
        $sqloi .= " WHERE userorder_item.userorder_id = {$uoid}";
        if(!$resultsoi = $connection->query($sqloi)){
            die("<br />Doslo je do greske u upitu za ispis userorder_item's: " . $connection->error );
        }

        return $resultsoi;

    }

    public function writeOrder($order_array){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $uid = 0;
        foreach($order_array as $order_key=>$order_value){

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

                if($insertupdate == 1){
                    //Insert
                    $sqlinsusr = "INSERT INTO userorder (order_date, orderstatus, user_id) VALUES ('$today', 'nije', $uid); ";
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

                    $ch = 0;
                    do{
                        $ch++;
                        //create $checkorder_id number for checking of order confirm
                        $checkorder_id = mt_rand(1000, 100000) . $userorder_id . mt_rand(1000, 100000);

                        /*check if $checkorder_id exists in db  */
                        $sqlcheck = "SELECT checkorder_id FROM userorder WHERE checkorder_id = {$checkorder_id}";

                        $resultcheck = $connection->query($sqlcheck);
                        $rowcheck = $resultcheck->fetch_assoc();

                        if(($rowcheck['checkorder_id'] === NULL) || (($rowcheck['checkorder_id']) <> $checkorder_id) ){

                            //echo "<br />Row iznosi: ";
                            //echo $rowcheck = $resultcheck->fetch_assoc();
                            //echo "<br />";
                            //print_r($resultcheck);
                            //var_dump($resultcheck);
                            //if not exists checkorder_id - add it
                            $sqlinscheck = "UPDATE userorder SET checkorder_id = '{$checkorder_id}' WHERE id = '{$userorder_id}'; ";

                            if(!$resultinscheck = $connection->query($sqlinscheck)){
                                die("<br />Doslo je do greske u upitu za update checkorder_id: " . $connection->error );
                            }else{
                                $rowcheck = 1;
                                //$rowinscheck = $resultinscheck->fetch_assoc();
                            }
                        }else {
                            $rowcheck = 2;
                        }
                    }while($rowcheck == 2);

                    $sqlinsitm = "INSERT INTO userorder_item (item_id, price, quantity, userorder_id) VALUES ($idi, $price, $coli, $userorder_id); ";
                    if (!$resultswriteitem = $connection->query($sqlinsitm)){
                        die('<br />Ne mogu da izvrsim Insert upit u userorder_item zbog ['. $connection->error
                            . "]");
                    }

                }elseif($insertupdate == 2){
                    $sqlupditm = "INSERT INTO userorder_item (item_id, price, quantity, userorder_id) VALUES ($idi, $price, $coli, $userorder_id); ";
                    if (!$resultsupditem = $connection->query($sqlupditm)){
                        die('<br />Ne mogu da izvrsim Update upit zbog ['. $connection->error
                            . "]");
                    }


                }
        }


        $order_results = array($userorder_id, $checkorder_id);

        return $order_results;

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


    public function sendEmail($foremail1, $checkorder_id){

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