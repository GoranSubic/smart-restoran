<?php
include "header2.php";
include "connection/DbConnection.php";
include "class/User.php";

include_once "class/LoginDAO.php";

//Checking for user logged in or not

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);

    $user = new User();
    $user->setName($_POST['name']);
    $user->setSecName($_POST['secname']);
    $user->setEmail($_POST['email']);
    $user->setPasswd($_POST['passwd']);
    $user->setJbg($_POST['jbg']);
    $user->setPhone($_POST['phone']);
    $user->setMphone($_POST['mphone']);
    $user->setImageUrl($_POST['image_url']);

    $signup = new LoginDAO();
    $register = $signup->reg_user(
        $user->getName(),
        $user->getSecName(),
        $user->getEmail(),
        $user->getPasswd(),
        $user->getJbg(),
        $user->getPhone(),
        $user->getMphone(),
        $user->getImageUrl()
    );
    if($register){
        echo '<h3>Registration successful <a href="loginPage.php">Click here</a> to login</h3>';
    } else {
        echo '<h3>Registration failed. Email alredy exists, please try again</h3>';
    }
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<h4>Registrujte se da bi ste mogli da kreirate porudzbine</h4>

<script type="text/javascript" language="javascript">
    function submitregister() {
        var form = document.reg;
        if(form.name.value == ""){
            alert( "Enter your name." );
            return false;
        }
        else if(form.secname.value == ""){
            alert( "Enter second name." );
            return false;
        }
        else if(form.passwd.value == ""){
            alert( "Enter password." );
            return false;
        }
        else if(form.email.value == ""){
            alert( "Enter email." );
            return false;
        }
    }
</script>
<div id="container">
    <!--h2>Registration Here</h2-->
    <form action="" method="post" name="register">
        <table>
            <tbody>
            <tr>
                <th>Ime:</th>
                <td><input type="text" name="name" required="" /><span style="color:darkred">*</span></td>
            </tr>
            <tr>
                <th>Prezime:</th>
                <td><input type="text" name="secname" required="" /><span style="color:darkred">*</span></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="email" name="email" required="" /><span style="color:darkred">*</span></td>
            </tr>
            <tr>
                <th>Sifra:</th>
                <td><input type="password" name="passwd" required="" /><span style="color:darkred">*</span></td>
            </tr>

            <tr>
                <th>J B G:</th>
                <td><input type="text" name="jbg" /></td>
            </tr>
            <tr>
                <th>Telefon:</th>
                <td><input type="tel" name="phone" /></td>
            </tr>

            <tr>
                <th>Mob tel:</th>
                <td><input type="tel" name="mphone" /></td>
            </tr>
            <tr>
                <th>URL fotke:</th>
                <td><input type="url" name="image_url" /></td>
            </tr>

            <tr>
                <td></td>
                <td><input onclick="return(submitregister());" type="submit" name="submit" value="Registruj se" /></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="loginPage.php">Ako ste vec registrovani kliknite ovde!</a></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>