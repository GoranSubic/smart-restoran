<?php
session_start();
if(isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $emailsession = $_SESSION['email'];
    $is_admin = $_SESSION['is_admin'];
}else{
    $is_admin = 0;
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

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Početna - svetske kuhinje</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="style.css">

    <script>

    </script>

</head>
<body>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="img/olalogo_olala.png" alt="Food" class="itemimg">
            <!--div class="carousel-caption">
                <h1>Food around the world</h1>
                <!--p>The atmosphere in Chania has a touch of Florence and Venice.</p-->
            <!--/div-->
        </div>

        <div class="item">
            <img src="img/olalogo_krilca.png" alt="Food" class="itemimg">
            <!--div class="carousel-caption">
                <h1>Food around the world</h1>
                <!-- p>The atmosphere in Chania has a touch of Florence and Venice.</p-->
            <!--/div-->
        </div>

        <div class="item">
            <img src="img/olalogo_pizz.png" alt="Food" class="itemimg">
            <!--div class="carousel-caption">
                <h1>Food around the world</h1>
                <!--p>Beatiful flowers in Kolymbari, Crete.</p-->
            <!--/div-->
        </div>

        <div class="item">
            <img src="img/olalogo_pizzacut.png" alt="Food" class="itemimg">
            <!--div class="carousel-caption">
                <h1>Food around the world</h1>
                <!--p>Beatiful flowers in Kolymbari, Crete.</p-->
            <!--/div-->
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="wrapper" style="background-color: #fff"> <!-- wrapper class -->

    <div class="nav">
        <ul> <!--style="background-color: #D2691E"-->
            <li class="uli menu"><a href="http://localhost/olala">O nama</a></li>
            <li class="uli menu"><a href="localhost/olala/jelovnik/">Jelovnik</a></li>
            <li class="uli menu"><a href="localhost/olala/dostava">Dostava</a></li>
            <li class="uli menu"><a href="localhost/olala/galerija">Galerija</a></li>
            <li class="uli menu"><a href="ouroffer.php">OurOffffer</a></li>
            <li class="uli menu"><a href="localhost/olala/kontakt">Kontakt</a></li>
            <!--li class="uli menu"><a href="registration.php">SignUp</a></li-->
        </ul>
    </div>
    <div class="navlogin">
        <form action="login.php" method="post" name="login" class="form-inline">
            <div class="form-group">
                <label for="loginemail" class="login">Enter Email <input type="text" name="email" required="" id="loginemail" class="form-control login" style="width: 50%; height: 20px;" /></label>
            </div>
            <div class="form-group">
                <label for="loginpass" class="login">And Password <input type="password" name="password" required="" id="loginpass" class="form-control login" style="width: 50%; height: 20px;"/></label>
            </div>
            <div class="form-group">
                <input onclick="return(submitlogin());" type="submit" name="submit" value="Login" class="btn btn-default btn-xs login" />
            </div>


                <a href="registration.php" style="color: #deb887" class='login loglink'>SignUp</a>

                <?php
                    if(isset($_SESSION['login'])) {
                        echo "<a href='showUser.php?id={$_SESSION['id']}' style='color:#deb887' class='navlogin login loglink'>MojProfil</a>";
                        echo "<a href='logout.php' style='color:#deb887' class='navlogin login loglink'>SignOut</a>";
                        echo "<span style='color:darkred' class='navlogin login loglink'>{$_SESSION['name']}</span>";
                    }
                    if($is_admin == 1){
                        echo "<a href='adminPage.php' style='color:darkred' class='navlogin login loglink'>Admin</a>";
                    }
                ?>
        </form>



    </div>

    <!-- Ispisuje odgovor od login.php o tome da korisnik nije ulogovan... -->
    <?php
        if(isset($_GET['response'])){
            echo $_GET['response'];
        }

        /*if(isset($_GET['out'])){
            session_destroy(); // Is Used To Destroy All Sessions
            //Or
            //if(isset($_SESSION['id']))
            //    unset($_SESSION['id']);  //Is Used To Destroy Specified Session
        }*/
    ?>

