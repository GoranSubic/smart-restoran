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

    /*
     * Provera da li je photo setovan
     * ako nije onda pomocu upita provera da li
     * je u bazi upisan photo_id
     * ako nije onda setuje photo 1 kao photo korisnika
     */
    if(isset($_POST['photo'])){
        $photo = new Photo();

        /*
         * Setujem photo file-name dok ne resim upis fajla
         * i iscitavanje naziva fajla         *
         */
        $photo->setTitle('file_name');

        $sql = "INSERT INTO photo SET title = '".$photo->getTitle()."';";
        if (!$results = $connection->query($sql)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $photo_id = mysqli_insert_id($connection);
    } else {
        $sqlphoto = "SELECT photo_id FROM user WHERE id = {$_POST['id']}; ";
        if(!$results = $connection->query($sqlphoto)){
            die( $photo_id = '1' );
        }
        //WHILE ($row = $results->fetch_assoc()) {
        $row = $results->fetch_assoc();
        $photo_id = $row['photo_id'];
        //}
    }

    /*
     * Provera da li je setovan podatak image_url u formi
     * ako nije iscitava da li je u bazi upisan naziv fotke
     * pod photo_id i taj naziv fotke belezi u image_url
     */
    $staff = new Staff();

    if(isset($_POST['image_url'])){
        $image_url = $_POST['image_url'];
    }else{
        $sqlurl = "SELECT title FROM photo WHERE photo.id={$photo_id}";
        if (!$results = $connection->query($sqlurl)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $rowurl = $results->fetch_assoc();
        $photo_title = $rowurl['title'];
        $image_url = "/photo/user/{$photo_title}";
    }

    if(isset($_POST['is_admin'])){ $is_admin = '1'; } else { $is_admin = '0'; }

    if(isset($_POST['is_staff'])){ $is_staff = '1'; } else { $is_staff = '0'; }

    $staff->setId($_POST['id']);
    $staff->setName($_POST['name']);
    $staff->setSecName($_POST['secondname']);
    $staff->setJbg($_POST['jbg']);
    $staff->setEmail($_POST['email']);
    $staff->setPasswd($_POST['passwd']);
    $staff->setPhone($_POST['phone']);
    $staff->setMphone($_POST['mphone']);
    $staff->setIsStaff($is_staff);
    $staff->setImageUrl($_POST['image_url']);
    $staff->setPhotoId($photo_id);
    $staff->setWorkPlace($_POST['work_place']);
    $staff->setSalary($_POST['salary']);
    $staff->setIsAdmin($is_admin);

    $id = $userDao->editStafs(
        $staff->getId(),
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
            <img src="<?php echo "http://localhost/smart2015/restoran/img/Indian_Spices.jpg"; ?>" alt="User Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
                Ime: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br />
                Prezime: <input type="text" name="secondname" value="<?php echo $row['secname']; ?>"><br />
                Br. dok: <input type="text" name="jbg" value="<?php echo $row['jbg']; ?>"><br />
                E-mail: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br />
                Sifra: <input type="text" name="passwd" value="<?php echo $row['passwd']; ?>"><br />
                Telefon: <input type="tel" name="phone" value="<?php echo $row['phone']; ?>"><br />
                Mob tel: <input type="tel" name="mphone" value="<?php echo $row['mphone']; ?>"><br />
                Radnik: <input type="checkbox" name="is_staff" value="" <?php if($row['is_staff'] == true) echo "checked"; ?> ><br />
                Image url: <input type="text" name="image_url" value="<?php echo $row['image_url']; ?>"><br />
                Change Photo: <input type="file" name="photo" value="<!--?php echo $row['photo']; ?-->"><br />

                Radi u: <input type="text" name="work_place" value="<?php echo $row['work_place']; ?>"><br />
                Plata: <input type="text" name="salary" value="<?php echo $row['salary']; ?>"><br />
                Admin: <input type="checkbox" name="is_admin" value="" <?php if($row['is_admin'] == true) echo "checked"; ?> ><br />
                <br />

                <input type="submit" name="submit" value="Upisi"><br /><br />
                <a href="showUsers.php">Vrati se na listu korisnika</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>