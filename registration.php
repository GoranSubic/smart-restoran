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

    $signup = new LoginDAO();
    $register = $signup->reg_user(
        $user->getName(),
        $user->getSecName(),
        $user->getEmail(),
        $user->getPasswd()
    );
    if($register){
        echo '<h3>Registration successful <a href="login.php">Click here</a> to login</h3>';
    } else {
        echo '<h3>Registration failed. Email alredy exists, please try again</h3>';
    }
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<h4>Register to make orders</h4>

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
                <th>Enter Name:</th>
                <td><input type="text" name="name" required="" /></td>
            </tr>
            <tr>
                <th>Enter SecondName:</th>
                <td><input type="text" name="secname" required="" /></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="text" name="email" required="" /></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="passwd" required="" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input onclick="return(submitregister());" type="submit" name="submit" value="Register" /></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="login.php">Already registered! Click Here!</a></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>