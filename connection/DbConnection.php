<?php

include_once "db_config.php";
//require_once "Log.php";

class DbConnection {

    private $db;
    private $db_id;

    public function connectToDB()
    {
        /*$connection = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        if($connection->connect_errno > 0){
            die('Ne mogu da se povezem sa bazom zbog ['.
                $connection->connect_error .']');
        }
        mysqli_set_charset($connection,"utf8");*/

    //    $logger = new Log();
        if (!isset($db)) {
    //        $logger->dataToLog .= "Usao u kreiranje konekcije i setuje db";
            $this->db = new \mysqli(
                DB_SERVER, DB_USERNAME,
                DB_PASSWORD, DB_DATABASE
            );

            if (mysqli_connect_errno()) {
                echo "Error: Could not connect to database.";
    //            $logger->dataToLog .= "Error: Could not connect to database.";
            } /*else {
                echo "Usao u kreiranje konekcije i vratio db";
                return $this->db;
            }*/
        }

    //    $logger->WriteLog($logger->dataToLog);
        return $this->db;
    }

} 