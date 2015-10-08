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
        $response = '<h3 style="color:indianred">Pogresan email ili sifra! <br />Možda Vam korisnik nije aktivan, proverite da li imate email za potvrdu registracije!</h3>';
        header("location:header.php?response={$response}");
    }
}
?>
