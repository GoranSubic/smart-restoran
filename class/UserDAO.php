<?php

//include "Staff.php";
//include_once "../connection/DbConnection.php";

class UserDAO {

    public function showUsers(){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sql = "SELECT * FROM user JOIN staff ON user.id = staff.user_id WHERE 1;";

        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        return $results;
    }



    /*
     *Create User + Staff
     * Function for creating User with all parrams + Staff data
     *
     */
    public function createStafs($namef, $secnamef, $jbgf, $emailf, $passwdf, $phonef, $mphonef, $is_stafff, $image_urlf, $photo_idf, $work_placef, $salaryf, $is_adminf){

        echo "Ulazni parametri su : namef - ".$namef." secnamef - ".$secnamef." - jbg - ".$jbgf."<br /><br />";

        //public $id;
        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        /*
         *
         * Upis u user tabelu
         *
         */
        // 1. prepraed SQL statement
        if($sqlup = $connection->prepare("INSERT INTO user ( name, secname, jbg, email, passwd, phone, mphone, is_staff, image_url, photo_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") ){

            // 3. params
            /*
             * Postovano kroz ulazne parametre method-a         *
             *
             * $namef, $secnamef, $jbgf, $emailf, $passwdf, $phonef, $mphonef, $is_stafff, $image_urlf, $photo_idf, $work_placef, $salaryf, $is_adminf
             */
            $name = $namef;
            $secname = 'FixnoPrezime';
            $jbg = $jbgf;
            $email = $emailf;
            $passwd = $passwdf;
            $phone = $phonef;
            $mphone = $mphonef;
            $is_staff = $is_stafff;
            $image_url = $image_urlf;
            $photo_id = $photo_idf;

            //2. binding params
            $sqlup->bind_param(
                'sssssssisi',
                $name,
                $secname,
                $jbg,
                $email,
                $passwd,
                $phone,
                $mphone,
                $is_staff,
                $image_url,
                $photo_id
            );

            //4.  execute statement
            $sqlup->execute();

            // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
            $sqlup->close();

            //Provera poslednje inserovanog user.id
            //$id = mysqli_insert_id($connection);
            $sql_max = "SELECT MAX(id) FROM user";
            if(!$results = $connection->query($sql_max)){
                die("Doslo je do greske u upitu za proveru max user.id: " . $connection->error );
            }
            $maxrow = $results->fetch_assoc();
            $id = $maxrow['MAX(id)'];
            printf ("Novi korisnik <b>" . $id . " " . $name . " " . $secname . " </b>je uspesno upisan u bazu podataka.");


        } else {
            $error = $connection->errno . ' ' . $connection->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }



        /*
         *
         * Upis u staff tabelu
         *
         */
        // 1. prepraed SQL statement
        if($sqlstaff = $connection->prepare("INSERT INTO staff (user_id, work_place, salary, is_admin) VALUES (?, ?, ?, ?)") ){

            // 3. params
            /*
             * Postovano kroz ulazne parametre method-a         *
             *
             */
            $user_id = $id;
            $work_place = $work_placef;
            $salary = $salaryf;
            $is_admin = $is_adminf;

            //2. binding params
            $sqlstaff->bind_param(
                'issi',
                $user_id,
                $work_place,
                $salary,
                $is_admin
            );

            //4.  execute statement
            $sqlstaff->execute();


            // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
            $sqlstaff->close();

            $staffid = mysqli_insert_id($connection);
            printf ("Novi staff <b>" . $staffid . "</b>je uspesno upisan u bazu podataka.");

        } else {
            $error = $connection->errno . ' ' . $connection->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

        //Vraca id da bi pomocu get metode u showUser.php mogao da izlistam poslednje unetog User-a
        return $id;

    }


    /*
     *Edit User + Staff
     * Function for editing User with all parrams + Staff data
     *
     */
    public function editStafs($idf, $namef, $secnamef, $jbgf, $emailf, $passwdf, $phonef, $mphonef, $is_stafff, $image_urlf, $photo_idf, $work_placef, $salaryf, $is_adminf){

        echo "Ulazni parametri su : idf - ".$idf." namef - ".$namef." secnamef - ".$secnamef." - jbg - ".$jbgf."<br /><br />";

        $id = $idf;
        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        /*
         *
         * Upis u user tabelu
         *
         */
        // 1. prepraed SQL statement
        if($sqlup = $connection->prepare("UPDATE user SET name=?, secname=?, jbg=?, email=?, passwd=?, phone=?, mphone=?, is_staff=?, image_url=?, photo_id=? WHERE id= {$idf};")){

            // 3. params
            /*
             * Postovano kroz ulazne parametre method-a         *
             *
             * $namef, $secnamef, $jbgf, $emailf, $passwdf, $phonef, $mphonef, $is_stafff, $image_urlf, $photo_idf, $work_placef, $salaryf, $is_adminf
             */
            //$id = $idf;
            $name = $namef;
            $secname = 'FixnoIme';
            $jbg = $jbgf;
            $email = $emailf;
            $passwd = $passwdf;
            $phone = $phonef;
            $mphone = $mphonef;
            $is_staff = $is_stafff;
            $image_url = $image_urlf;
            $photo_id = $photo_idf;

            //2. binding params
            $sqlup->bind_param(
                'sssssssisi',
                $name,
                $secname,
                $jbg,
                $email,
                $passwd,
                $phone,
                $mphone,
                $is_staff,
                $image_url,
                $photo_id
            );

            //4.  execute statement
            $sqlup->execute();

            // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
            $sqlup->close();

            printf ("Izmenjeni podaci o korisniku <b>" . $id . " " . $name . " " . $secname . " </b>uspesno upisani u bazu podataka.");

        } else {
            $error = $connection->errno . ' ' . $connection->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

        /*
         * Upis u staff tabelu
         */
        // 1. prepraed SQL statement
        if($sqlstaff = $connection->prepare("UPDATE staff SET work_place = ?, salary = ?, is_admin = ? WHERE user_id = {$id}")){

            // 3. params
            /*
             * Postovano kroz ulazne parametre method-a         *
             *
             */
            //$user_id = $id;
            $work_place = $work_placef;
            $salary = $salaryf;
            $is_admin = $is_adminf;

            //2. binding params
            $sqlstaff->bind_param(
                'ssi',
                //$user_id,
                $work_place,
                $salary,
                $is_admin
            );

            //4.  execute statement
            $sqlstaff->execute();


            // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
            $sqlstaff->close();

            //$staffid = mysqli_insert_id($connection);
            //printf ("Novi staff <b>" . $staffid . "</b>je uspesno upisan u bazu podataka.");

        } else {
            $error = $connection->errno . ' ' . $connection->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

        //Vraca id da bi pomocu get metode u showUser.php mogao da izlistam poslednje unetog/editovanog User-a
        return $id;

    }

    public function listPhoto($photo_id){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqlphoto = "SELECT title FROM photo WHERE id = {$photo_id}";
        if (!$results = $connection->query($sqlphoto)){
            $title = "photo_name";
            return $title;
        }
        $rowphoto = $results->fetch_assoc();
        $title = $rowphoto['title'];
        return $title;
    }

    public function deleteUser($id_user){

        $dbConnDel = new DbConnection();
        $connection = $dbConnDel->connectToDB();

        $sqldelstaff = "DELETE FROM staff WHERE user_id = (SELECT id FROM user WHERE id = {$id_user});";
        if (!$resultsstaff = $connection->query($sqldelstaff)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        $sqldel = "DELETE FROM user WHERE id = {$id_user}";
        if (!$results = $connection->query($sqldel)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
    }

}