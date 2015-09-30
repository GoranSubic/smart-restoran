<?php

include_once "connection/DbConnection.php";
include "class/UserDAO.php";
$userDao = new UserDAO();

if(isset($_GET['delU'])){
    $delU = $_GET['delU'];
    $userDao->deleteUser($delU);
    //goto('showUsers.php');
    header("Location: showUsers.php");
}


?>
