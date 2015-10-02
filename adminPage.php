<?php

session_start();
if(isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $is_admin = $_SESSION['is_admin'];
}else{
    $is_admin = 0;
}

if($_SESSION['is_admin'] == 1){
    echo "{$_SESSION['name']}, Dobro dosli na stranicu {$_SERVER['PHP_SELF']}";
}else{
    header("Location:ouroffer.php");
}

include "headeradmin.php";
include "connection/DbConnection.php";
include "class/LoginDAO.php";
include "class/UserDAO.php";
include "class/Staff.php";
include "class/Photo.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

    $userDao = new UserDAO();
    $results = $userDao->showUser($id);
    $row = $results->fetch_assoc();

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo $row['image_url']; ?>" alt="User Photo" style="width:300px;height:200px">
        </div>
        <!--h2>Dobro dosao <?php echo $name; ?>, Vi ste administrator aplikacije.</h2-->
        <div class="secol">
            <ul class="ulindex">
                <li><?php echo "<h1>Ime ". $row['name'] ."</h1>" ?></li>
                <li><?php echo "<h4>Prezime ". $row['secname'] ."</h4>" ?></li>
                <li><?php echo "<h4>JBG ". $row['jbg'] ."</h4>" ?></li>
                <li><?php echo "<h4>Email ". $row['email'] ."</h4>" ?></li>
                <!--li><!--?php echo "<h4>Password". $row['passwd'] ."</h4>" ?></li-->
                <li><?php echo "<h4>Password * * * * *</h4>" ?></li>
                <li><?php echo "<h4>Telefon". $row['phone'] ."</h4>" ?></li>
                <li><?php echo "<h4>Mob tel". $row['mphone'] ."</h4>" ?></li>
                <li><?php echo "<h4>Radnik ". $row['is_staff'] ."</h4>" ?></li>
                <!--li><!--?php echo "<h4>Url fotke". $row['image_url'] ."</h4>" ?></li-->
                <li><?php echo "<h4>Url fotke http://...</h4>" ?></li>
                <li><?php echo "<h4>ID fotke". $row['photo_id'] ."</h4>" ?></li>
                <li><?php echo "<h4>Radi u ". $row['work_place'] ."</h4>" ?></li>
                <li><?php echo "<h4>Plata ". $row['salary'] ."</h4>" ?></li>
                <li><?php echo "<h4>Admin ". $row['is_admin'] ."</h4>" ?></li>
            </ul>

        </div>
    </div>
</div>

<?php

    $connection->close();

    include "footer.php";

?>