<?php

include "header2.php";

if(isset($_GET['response'])){
    echo $_GET['response'];
}
?>

<script type="text/javascript" language="javascript">

            function submitlogin() {
                var form = document.login;
                if(form.emailusername.value == ""){
                    alert( "Enter email." );
                    return false;
                }
                else if(form.password.value == ""){
                    alert( "Enter password." );
                    return false;
                }
            }

</script>


<h4>Login Page</h4>


<form action="login.php" method="post" name="login">
    <table>
        <tbody>
        <tr>
            <th>Enter with Email:</th>
            <td><input type="text" name="email" required="" /></td>
        </tr>
        <tr>
            <th>And Password:</th>
            <td><input type="password" name="password" required="" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input onclick="return(submitlogin());" type="submit" name="submit" value="Login" /></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="registration.php">Register new user</a></td>
        </tr>
        </tbody>
    </table>
</form>
