<?php
include "header.php";
include "connection/DbConnection.php";
include "class/UserDAO.php";
include "class/Staff.php";
include "class/Photo.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

$userDao = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['photo'])){
        $photo = new Photo();

        $photo->setTitle('file_name');

        $sql = "INSERT INTO photo SET title = '".$photo->getTitle()."';";

        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $photo_id = mysqli_insert_id($connection);
        echo "Photo ID posle inserta iznosi: {$photo_id}";
    }else{
        $photo_id = '1';
        echo "Setovani na 1 Photo ID iznosi: {$photo_id}";
    }

    $staff = new Staff();

    if($_POST['image_url'] != ''){
        $image_url = $_POST['image_url'];
        echo "<br />Postovani Image url of photo: $image_url";
    }else{
        $sqlurl = "SELECT title FROM photo WHERE photo.id={$photo_id}";
        if (!$results = $connection->query($sqlurl)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $rowurl = $results->fetch_assoc();
        $photo_title = $rowurl['title'];
        $image_url = "http://localhost/photo/user/{$photo_title}";
        echo "<br />Prilikom inserta Title of photo: $photo_title";
        echo "<br />Prilikom inserta Image url of photo: $image_url";
    }

    if(isset($_POST['is_admin'])){ $is_admin = '1'; } else { $is_admin = '0'; }
    if(isset($_POST['is_staff'])){ $is_staff = '1'; } else { $is_staff = '0'; }

    $staff->setName($_POST['name']);
    $staff->setSecName($_POST['secondname']);
    $staff->setJbg($_POST['jbg']);
    $staff->setEmail($_POST['email']);
    $staff->setPasswd($_POST['passwd']);
    $staff->setPhone($_POST['phone']);
    $staff->setMphone($_POST['mphone']);
    $staff->setIsStaff($is_staff);
    $staff->setImageUrl($image_url);
    $staff->setPhotoId($photo_id);
    $staff->setWorkPlace($_POST['work_place']);
    $staff->setSalary($_POST['salary']);
    $staff->setIsAdmin($is_admin);

    $id = $userDao->createStafs(
        $staff->getName(),
        $staff->getSecName(),
        $staff->getJbg(),
        $staff->getEmail(),
        $staff->getPasswd(),
        $staff->getPhone(),
        $staff->getMphone(),
        $staff->getIsStaff(),
        $staff->getImageUrl(),
        $staff->getPhotoId(),
        $staff->getWorkPlace(),
        $staff->getSalary(),
        $staff->getIsAdmin()
    );

}




if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
/*else{
        echo "Problem sa get metodom!";
    }*/

$sql = "SELECT * FROM user JOIN staff ON staff.user_id = user.id WHERE user.id = ".$id;

if (!$results = $connection->query($sql)){
        die('Ne mogu da izvrsim upit zbog ['. $connection->error
            . "]");
    }

    $row = $results->fetch_assoc();

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo $row['image_url']; ?>" alt="User Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">
            <ul class="ulindex">
                <li><?php echo "<h1>". $row['name'] ."</h1>" ?></li>
                <li><?php echo "<h4>". $row['secname'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['jbg'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['email'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['passwd'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['phone'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['mphone'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['is_staff'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['image_url'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['photo_id'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['work_place'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['salary'] ."</h4>" ?></li>
                <li><?php echo "<h4>". $row['is_admin'] ."</h4>" ?></li>
                <br />
                <br />
                <li><?php
                        if(isset($login)) {
                            echo "<a href='editUser.php'>Izmeni podatke korisnika</a>";
                        }else{
                            echo "<a href='editUser.php?id={$id}'>Nemate</a> pravo izmene podataka korisnika!";
                        }
                    ?></li>
                <li><a href="showUsers.php"><?php htmlspecialchars("< - ");?>Vrati se na listu svih korisnika</a> </li>
            </ul>
        </div>
    </div>
</div>

<?php

    $connection->close();

    include "footer.php";

?>