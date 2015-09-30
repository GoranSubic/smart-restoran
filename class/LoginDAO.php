<?php

//include "..\connection\DbConnection.php";

class LoginDAO {

    /*public $db;

    public function __construct(){
        $this->db = new DbConnection();
        $connection = $this->db->connectToDB();
    }*/


    /***for registration process ***/
    public function reg_user($name, $secname, $email, $password){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $password = md5($password);
        $sql = "SELECT * FROM user WHERE email = '$email';";//OR uname = '$username';";

        //checking if the username or email is available in db
        $check = $connection->query($sql);
        $count_row = $check->num_rows;

        //if the email is not in db then insert to the table
        if($count_row == 0){
            $sql1 = "INSERT INTO user SET name = '$name', secname = '$secname', email = '$email', passwd = '$password';";

            if (!$results1 = $connection->query($sql1)){
                die('Ne mogu da izvrsim upit user zbog ['. $connection->error
                    . "]");
            }


            //Provera poslednje inserovanog user.id
            $id = mysqli_insert_id($connection);
            /*$sql_max = "SELECT MAX(id) FROM user";
            if(!$results = $connection->query($sql_max)){
                die("Doslo je do greske u upitu za proveru max user.id: " . $connection->error );
            }
            $maxrow = $results->fetch_assoc();
            $id = $maxrow['MAX(id)'];*/

            $sql2 = "INSERT INTO staff SET work_place = 'korisnik', user_id = {$id};";

            if (!$results2 = $connection->query($sql2)){
                die('Ne mogu da izvrsim upit staff zbog ['. $connection->error
                    . "]");
            }

            if(!$results = $results1 && $results2){
                die('Results nije vratio ispravan result - problem je sa upisom u user ili staff tabelu!');
            }
            return $results;
        }else{
            return false;
        }
    }


    /*** From loginPage ***/
    /*
     * Pokusaj da napravim login odavde
     *
     * umesto sa stranice login.php
     */
    public function login(){
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

            if ($login) {
                //Registration Success
                header("location:ouroffer.php");
            } else {
                //Registration Failed
                $response = '<h3 style="color:indianred">Wrong email or password!</h3>';
                header("location:loginPage.php?response={$response}");
            }
        }
    }


    /*** for login process ***/
    public function check_login($email, $password){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $password = md5($password);
        $sql2 = "SELECT id from user WHERE email = '$email' AND passwd = '$password'";

        //checking if the email is available in the table
        if (!$result = $connection->query($sql2)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $count_row = $result->num_rows;

        $user_data = $result->fetch_assoc();
        //$user_data = $rowcheck['id'];

        if ($count_row == 1){
            //this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user_data['id'];
            return true;
        }
        else{
            return false;
        }
    }

} 