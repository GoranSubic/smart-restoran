<?php
session_start();

include_once "connection/DbConnection.php";

include_once "class/LoginDAO.php";
include "class/User.php";

if (isset($_REQUEST['submit'])){
    extract($_REQUEST);

    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setPasswd($_POST['password']);

    $signin = new LoginDAO();
    $login = $signin->check_login(
        $user->getEmail(),
        $user->getPasswd()
    );

    if($login){
        //Registration Success
        header("location:ouroffer.php");
    } else {
        //Registration Failed
        $response = '<h3 style="color:indianred">Wrong email or password!</h3>';
        header("location:loginPage.php?response={$response}");
    }
}
?>
