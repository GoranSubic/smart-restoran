<?php

include_once "connection/DbConnection.php";
include_once "connection/db_config.php";


class LoginDAO {

    /*public $db;

    public function __construct(){
        $this->db = new DbConnection();
        $connection = $this->db->connectToDB();
    }*/


    /** Enabling login **/
    public function confirmLogin($cr){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqldrcheck = "SELECT checkuser_id FROM user WHERE checkuser_id = {$cr}";
        $resultcheck = $connection->query($sqldrcheck);
        $rowcheck = $resultcheck->fetch_assoc();

        //print_r($rowcheck['checkuser_id']);
        if($rowcheck['checkuser_id'] == NULL){
            return $confirmdr = "Nije pronadjen niti jedan zapis!";
        }else{
            $sqlcr = "UPDATE user SET enabled = '1' WHERE checkuser_id = {$cr}; ";
            if(!$resultcr = $connection->query($sqlcr)){
                die('Ne mogu da izvrsim upit checkuser_id 1 user zbog: ['. $connection->error
                    . "]");
            }else{
                return $confirmcr = "<h3>Registracija je uspesna, mozete se ulogovati!</h3>";
            }
        }
    }

    /** Disabling login **/
    public function disableLogin($dr){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqldrcheck = "SELECT checkuser_id FROM user WHERE checkuser_id = {$dr}";
        $resultcheck = $connection->query($sqldrcheck);
        $rowcheck = $resultcheck->fetch_assoc();

        //print_r($rowcheck['checkuser_id']);
        if($rowcheck['checkuser_id'] == NULL){
            return $confirmdr = "Nije pronadjen niti jedan zapis!";
        }else{
            $sqldr = "UPDATE user SET enabled = '0' WHERE checkuser_id = {$dr}";
            if(!$resultdr = $connection->query($sqldr)){
                die("Ne mogu da izvrsim upit checkuser_id 0 user zbog: [". $connection->error
                    . "]");
            }else{
                return $confirmdr = "Uspešno je otkazan Vaš LogIn!";
            }
        }
    }

    /***for registration process ***/
    public function reg_user($name, $secname, $adress, $city, $email, $passwordf, $jbg, $phone, $mphone, $image_url){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $password = md5($passwordf);
        $sql = "SELECT * FROM user WHERE email = '$email';";//OR uname = '$username';";

        //checking if the username or email is available in db
        $check = $connection->query($sql);
        $count_row = $check->num_rows;

        //if the email is not in db then insert to the table
        if($count_row == 0){
            $sql1 = "INSERT INTO user SET name = '$name', secname = '$secname', adress = '$adress', city = '$city', email = '$email', passwd = '$password', ";
            $sql1 .= " jbg = '$jbg', phone = '$phone', mphone = '$mphone', image_url = '$image_url';";

            if (!$results1 = $connection->query($sql1)){
                die('Ne mogu da izvrsim upit user zbog ['. $connection->error
                    . "]");
            }


            //Provera poslednje insertovanog user.id
            $id = mysqli_insert_id($connection);
            /*$sql_max = "SELECT MAX(id) FROM user";
            if(!$results = $connection->query($sql_max)){
                die("Doslo je do greske u upitu za proveru max user.id: " . $connection->error );
            }
            $maxrow = $results->fetch_assoc();
            $id = $maxrow['MAX(id)'];*/

            $ch = 0;
            do{
                $ch++;
                //create $checkorder_id number for checking of order confirm
                $checkuser_id = mt_rand(1000, 100000) . $id . mt_rand(1000, 100000);

                /*check if $checkorder_id exists in db  */
                $sqlcheck = "SELECT checkuser_id FROM user WHERE checkuser_id = {$checkuser_id}";

                //print_r("SQL upit za checkuser_id je: ".$sqlcheck);

                $resultcheck = $connection->query($sqlcheck);
                $rowcheck = $resultcheck->fetch_assoc();

                if(($rowcheck['checkuser_id'] === NULL) || (($rowcheck['checkuser_id']) != $checkuser_id) ){

                    //echo "<br />Row iznosi: ";
                    //echo $rowcheck = $resultcheck->fetch_assoc();
                    //echo "<br />";
                    //print_r($resultcheck);
                    //var_dump($resultcheck);
                    //if not exists checkorder_id - add it
                    $sqlinscheck = "UPDATE user SET checkuser_id = '{$checkuser_id}' WHERE id = '{$id}'; ";

                    if(!$resultinscheck = $connection->query($sqlinscheck)){
                        die("<br />Doslo je do greske u upitu za update checklogin_id: " . $connection->error );
                    }else{
                        $rowcheck = 1;
                        //$rowinscheck = $resultinscheck->fetch_assoc();
                    }
                }else {
                    $rowcheck = 2;
                }
            }while($rowcheck == 2);


            $sql2 = "INSERT INTO staff SET work_place = 'korisnik', user_id = {$id};";

            if (!$results2 = $connection->query($sql2)){
                die('Ne mogu da izvrsim upit staff zbog ['. $connection->error
                    . "]");
            }

            if(!$results = $results1 && $results2){
                die('Results nije vratio ispravan result - problem je sa upisom u user ili staff tabelu!');
            }else {

                $sqlres = "SELECT * FROM user WHERE id = {$id}; ";
                if(!$results = $connection->query($sqlres)){
                    die('Results nije vratio ispravan result - problem je kod podataka za registraciju!'.$connection->error);
                }
                return $results;
            }
        }else{
            return false;
        }
    }


    /*** From loginPage ***/
    /*
     * Pokusaj da napravim login odavde
     *
     * umesto sa stranice login.php
     *
     * Na ovaj nacin u oba slucaja vraca na loginPage.php
     */
    /*public function login(){
        if (isset($_REQUEST['submit'])) {
            extract($_REQUEST);

            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPasswd($_POST['password']);

            //$signin = new LoginDAO();
            $login = $this->check_login(
                $user->getEmail(),
                $user->getPasswd()
            );

     */       /*** Code from login.php ***/
/*
            if($login === 1){
                //Registration Success
                header("location:adminPage.php");
            }
            if($login === 2){
                //Registration Success
                header("location:ouroffer.php");
            }
            if($login === 0){
                //Registration Failed
                $response = '<h3 style="color:indianred">Wrong email or password!</h3>';
                header("location:header.php?response={$response}");
            }

*/

            /**** to ****/
           /* if ($login) {
                //Registration Success
                //header("location:ouroffer.php");
                $response = '<h3 style="color:indianred">You are logged in!</h3>';
                echo $response;
            } else {
                //Registration Failed
                $response = '<h3 style="color:indianred">Wrong email or password!</h3>';
                echo $response;
            }*/

 //       }
 //   }


    /*** for login process ***/
    public function check_login($email, $password){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $password1 = md5($password);
        $sql4 = "SELECT user.id, user.email, user.image_url, user.is_staff, user.jbg, user.mphone, user.name, ";
        $sql4 .= " user.secname, user.passwd, user.phone, user.photo_id, user.enabled, staff.is_admin,  ";
        $sql4 .= " staff.salary, staff.user_id, staff.work_place ";
        $sql4 .= " from user JOIN staff ON user.id = staff.user_id WHERE user.email = '{$email}' AND user.passwd = '{$password1}'";

        var_dump($sql4);
        //checking if the email is available in the table
        if (!$result = $connection->query($sql4)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $count_row = $result->num_rows;

        $user_data = $result->fetch_assoc();
        //$user_data = $rowcheck['id'];

        if (($count_row == 1) && ($user_data['enabled'] == 1)){
            //this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user_data['id'];
            $_SESSION['name'] = $user_data['name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['is_admin'] = $user_data['is_admin'];

            if($_SESSION['is_admin'] == TRUE){
                return $useris = 1;
            }else{
                return $useris = 2;
            }
        }
        else{
            return $useris = 0;
        }
    }

    /*** for showing the user ***/
    public function get_fullname($uid){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sql3 = "SELECT fullname FROM users WHERE id = {$uid}";
        if (!$result = $connection->query($sql3)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $resultrow = $result->fetch_assoc();
        echo $resultrow['name'];
    }

    /**** starting the session ***/
    public function get_session(){
        return $_SESSION['login'];
    }

    public function user_logout(){
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

} 