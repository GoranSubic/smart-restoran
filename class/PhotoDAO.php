<?php

//include_once "../connection/DbConnection.php";

class PhotoDAO {

    public function showPhotos(){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sql = "SELECT * FROM photo WHERE 1;";

        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        return $results;
    }

    public function showPhotoItems(){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sql = "SELECT * FROM photo WHERE is_item = 1;";

        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        return $results;
    }

    public function showPhotoUsers(){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sql = "SELECT * FROM photo WHERE is_photo = 1;";

        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }

        return $results;
    }

    public function showPhoto($photoid){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $sqlphoto = "SELECT * FROM photo WHERE id = {$photoid}";
        if (!$resultsphoto = $connection->query($sqlphoto)){
            die('Ne mogu da izvrsim upit --showPhoto-- 1 zbog ['. $connection->error
                . "]");
        }

        $rowphoto = $resultsphoto->fetch_assoc();

        return $rowphoto;

    }

    public function editOne($oneidf, $descf, $is_itemf, $is_photof){

        $dbConn = new DbConnection();
        $connection = $dbConn->connectToDB();

        $id = $oneidf;

        /*
         * Upis u photo tabelu
         */
        // 1. prepared SQL statement
        if($sqlup = $connection->prepare("UPDATE photo SET description = ?, is_item = ?, is_photo = ? WHERE id = {$id}")){

            // 3. params
            /*
             * Postovano kroz ulazne parametre method-a         *
             *
             * $oneid, $desc
             */
            //$id = $oneid;
            $desc = $descf;
            $is_item = $is_itemf;
            $is_photo = $is_photof;

            //2. binding params
            $sqlup->bind_param(
                'sii',
                $desc,
                $is_item,
                $is_photo
            );

            //4.  execute statement
            $sqlup->execute();

            // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
            $sqlup->close();

            printf ("Izmenjeni podaci o fotki <b>" . $id . " " . $desc . " </b>uspesno upisani u bazu podataka.");

        } else {
            $error = $connection->errno . ' ' . $connection->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

        $sqledit = "SELECT * FROM photo WHERE id = {$id};";

        if (!$resultedit = $connection->query($sqledit)){
            die('Ne mogu da izvrsim upit editPhoto 2 zbog ['. $connection->error
                . "]");
        }

        $rowedit = $resultedit->fetch_assoc();

        return $rowedit;

    }

}