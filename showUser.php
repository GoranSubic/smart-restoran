<?php
//session_start(); //already start in header.php
//if(isset($_SESSION['login'])){
include "header.php";

    if(isset($_GET['id'])) {
        if($_SESSION['is_admin'] == 1){
            $id = $_GET['id'];
        }elseif(($_SESSION['id']) == ($_GET['id'])){
            $id = $_SESSION['id'];
        }else{
            //header("Location:ouroffer.php");
            echo "<h4 style='color:red'>Sta to radite?! Nemate pristup - pregleda drugih korisnika!!!</h4>";
        }
    }
    /*else{
            echo "Problem sa get metodom!";
        }*/
//}


include "connection/DbConnection.php";
include "class/UserDAO.php";
include "class/Staff.php";
include "class/Photo.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

$userDao = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $upload_dir_url = "/photo/user";
    $uploaddir = DIR_LOC.$upload_dir_url."/";
    //$uploaddir = '/smart2015/smart-restoran/photo/user/';
    $uploadfile = $uploaddir . basename($_FILES['pic_1']['name']);

        //if(isset($_POST['pic_1'])){
        if (move_uploaded_file($_FILES['pic_1']['tmp_name'], $uploadfile)) {

            //echo "File is valid, and was successfully uploaded.\n";

            $target_file = basename($_FILES['pic_1']['name']);
                $file_name = $target_file;
                $target_file_url = URL_PROJECT.$upload_dir_url."/".$target_file;


                $photo = new Photo();
                $photo->setTitle($file_name);
                $sql = "INSERT INTO photo SET title = '" . $photo->getTitle() . "';";
                echo "File name je sada: " . $file_name;

                if (!$results = $connection->query($sql)) {
                    die('Ne mogu da izvrsim upit zbog [' . $connection->error
                        . "]");
                }
                $photo_id = mysqli_insert_id($connection);
                echo "Photo ID posle inserta iznosi: {$photo_id}";
            }else{
                echo "Postoji problem ili niste odabrali sliku za svoj profil.<br />";
                echo "Možete upload-ovati fotku kada to budete želeli.<br />";
            /*echo '<pre>';
            echo "Possible file upload attack!\n";
            echo 'Here is some more debugging info:';
            print_r($_FILES);

            print "</pre>";*/

                $photo_id = '1';
                $sqlphoto = "SELECT title FROM photo WHERE id={$photo_id};";
                    if(!$resultphoto = $connection->query($sqlphoto)){
                        die('Ne mogu da izvrsim upit za proveru naziva fotke 1 zbog [' . $connection->error
                            . "]");
                    }
                $rowphoto = $resultphoto->fetch_assoc();
                $target_file_url = URL_PROJECT.$upload_dir_url."/".$rowphoto['title'];
                //echo "<br />Setovani na 1 Photo ID iznosi: {$photo_id} <br />Photo title is: {$rowphoto['title']}<br />";
                //echo "And file url je: ".$target_file_url;
            }




    $staff = new Staff();

    if($_POST['image_url'] != ''){
        $image_url = $_POST['image_url'];
        //echo "<br />Postovani Image url of photo: $image_url";
    }else{
        $sqlurl = "SELECT title FROM photo WHERE photo.id={$photo_id}";
        if (!$results = $connection->query($sqlurl)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $rowurl = $results->fetch_assoc();
        $photo_title = $rowurl['title'];
        //print_r("Photo title is: ".$photo_title.", photo_id je: ".$photo_id."<br />");
        $image_url = $target_file_url;
    }

    if(isset($_POST['is_admin'])){ $is_admin = '1'; } else { $is_admin = '0'; }
    if(isset($_POST['is_staff'])){ $is_staff = '1'; } else { $is_staff = '0'; }

    $staff->setName($_POST['name']);
    $staff->setSecName($_POST['secondname']);
    $staff->setAdress($_POST['adress']);
    $staff->setCity($_POST['city']);
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
        $staff->getAdress(),
        $staff->getCity(),
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
    //print_r("ID nakon createStafs iznosi: ".$id);
    $resultsshow = $userDao->showUser($id);
    $row = $resultsshow->fetch_assoc();

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo $row['image_url']; ?>" alt="User Photo" style="width:300px;height:200px">
        </div>
        <div class="secol">
            <ul class="ulindex">
                <li><?php echo "<h1>Ime ". $row['name'] ."</h1>" ?></li>
                <li><?php echo "<h4>Prezime ". $row['secname'] ."</h4>" ?></li>
                <li><?php echo "<h4>Adresa ". $row['adress'] ."</h4>" ?></li>
                <li><?php echo "<h4>Grad ". $row['city'] ."</h4>" ?></li>
                <li><?php echo "<h4>JBG ". $row['jbg'] ."</h4>" ?></li>
                <li><?php echo "<h4>Email ". $row['email'] ."</h4>" ?></li>
                <li><?php echo "<h4>Password  * * * * *</h4>" ?></li>
                <li><?php echo "<h4>Telefon". $row['phone'] ."</h4>" ?></li>
                <li><?php echo "<h4>Mob tel". $row['mphone'] ."</h4>" ?></li>

                <?php if($_SESSION['is_admin'] == 1){ ?>
                    <li><?php echo "<h4>Radnik ". $row['is_staff'] ."</h4>" ?></li>
                <?php } ?>

                <!--li><!--?php echo "<h4>Url fotke". $row['image_url'] ."</h4>" ?></li-->
                <li><?php echo "<h4>Url fotke http:// ...</h4>" ?></li>
                <li><?php echo "<h4>ID fotke". $row['photo_id'] ."</h4>" ?></li>

                <?php if($_SESSION['is_admin'] == 1){ ?>
                    <li><?php echo "<h4>Radi u ". $row['work_place'] ."</h4>" ?></li>
                    <li><?php echo "<h4>Plata ". $row['salary'] ."</h4>" ?></li>
                    <li><?php echo "<h4>Admin ". $row['is_admin'] ."</h4>" ?></li>
                <?php } ?>

                <br />
                <br />

            </ul>
        </div>
        <?php
            include "adminLinks.php";
        ?>
    </div>
</div>

<?php

    $connection->close();

    include "footer.php";

?>