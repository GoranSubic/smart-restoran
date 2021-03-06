<?php
include "header.php";

if(isset($_GET['id'])) {
    if($_SESSION['is_admin'] == 1){
        $id = $_GET['id'];
    }elseif(($_SESSION['id']) == ($_GET['id'])){
        $id = $_SESSION['id'];
    }else{
        //header("Location:ouroffer.php");
        echo "<h4 style='color:red'>Sta to radite?! Nemate pristup - editovanju drugih korisnika!!!</h4>";
    }
}
/*else{
        echo "Problem sa get metodom!";
    }*/

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
        //echo "File name je sada: " . $file_name;

        if (!$results = $connection->query($sql)) {
            die('Ne mogu da izvrsim upit zbog [' . $connection->error
                . "]");
        }
        $photo_id = mysqli_insert_id($connection);
        //echo "Photo ID posle inserta iznosi: {$photo_id}";
    }else{
        //echo "Nije upisan fajl za upload. <br />";
        $sqlprovera = "SELECT photo_id, title FROM user JOIN photo ON user.photo_id = photo.id WHERE user.id = {$_POST['id']} ";
        if (!$results = $connection->query($sqlprovera)){
            die('<br />Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $rowprovera = $results->fetch_assoc();
        $photo_id = $rowprovera['photo_id'];
        $photo_title = $rowprovera['title'];

        if($photo_id != ''){
            //echo "<br />Zadrzavam podatak o fotki koji je vec zabelezen u bazi!<br />";
            $target_file_url = URL_PROJECT.$upload_dir_url."/".$photo_title;
        }else {
            $photo_id = '1';
            $target_file_url = URL_PROJECT.$upload_dir_url."/Indian_Spices.jpg";
            //echo "<br />Setovani na 1 Photo ID iznosi: {$photo_id}";
        }
    }






    /*
     * Provera da li je setovan podatak image_url u formi
     * ako nije iscitava da li je u bazi upisan naziv fotke
     * pod photo_id i taj naziv fotke belezi u image_url
     */
    $staff = new Staff();

    if(!empty($_POST['image_url'])){
        $image_url = $_POST['image_url'];
    }else{
        $sqlurl = "SELECT title FROM photo WHERE photo.id={$photo_id}";
        if (!$results = $connection->query($sqlurl)){
            die('Ne mogu da izvrsim upit zbog ['. $connection->error
                . "]");
        }
        $rowurl = $results->fetch_assoc();
        $photo_title = $rowurl['title'];
        $image_url = $target_file_url;
    }

    if(isset($_POST['is_admin'])){ $is_admin = '1'; } else { $is_admin = '0'; }

    if(isset($_POST['is_staff'])){ $is_staff = '1'; } else { $is_staff = '0'; }

    if(isset($_POST['enabled'])){ $enabled = '1'; } else { $enabled = '0'; }

    if(isset($_POST['work_place'])){ $work_place = $_POST['work_place']; } else { $work_place = ''; }

    if(isset($_POST['salary'])){ $salary = $_POST['salary']; } else { $salary = ''; }


    $staff->setId($_POST['id']);
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
    $staff->setWorkPlace($work_place);
    $staff->setSalary($salary);
    $staff->setIsAdmin($is_admin);
    $staff->setEnabled($enabled);

    $id = $userDao->editStafs(
        $staff->getId(),
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
        $staff->getIsAdmin(),
        $staff->getIsAdmin(),
        $staff->getEnabled()
    );

}




/*$sql = "SELECT * FROM user JOIN staff ON staff.user_id = user.id WHERE user.id = ".$id;

if (!$results = $connection->query($sql)){
    die('Ne mogu da izvrsim upit zbog ['. $connection->error
        . "]");
}

$row = $results->fetch_assoc();*/

$resultsshow = $userDao->showUser($id);
$row = $resultsshow->fetch_assoc();

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo $row['image_url']; ?>" alt="User Photo" style="width:300px;height:200px">
        </div>
        <div class="secol">

            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
                Ime: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br />
                Prezime: <input type="text" name="secondname" value="<?php echo $row['secname']; ?>"><br />
                Adresa: <input type="text" name="adress" value="<?php echo $row['adress']; ?>"><br />
                Grad: <input type="text" name="city" value="<?php echo $row['city']; ?>"><br />
                Br. dok: <input type="text" name="jbg" value="<?php echo $row['jbg']; ?>"><br />
                E-mail: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br />
                Sifra: <input type="text" name="passwd" value="" placeholder="Ako zelite unesite novu..."><br /> <!--placeholder="Ako zelite unesite novu..."-->
                Telefon: <input type="tel" name="phone" value="<?php echo $row['phone']; ?>"><br />
                Mob tel: <input type="tel" name="mphone" value="<?php echo $row['mphone']; ?>"><br />
                <?php if($_SESSION['is_admin'] == 1){ ?>
                    Radnik: <input type="checkbox" name="is_staff" value="" <?php if($row['is_staff'] == true) echo "checked"; ?> ><br />
                <?php } ?>
                Image url: <input type="text" name="image_url" value="<?php echo $row['image_url']; ?>"><br />
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <!-- Name of input element determines name in $_FILES array -->
                Change Photo: <input name="pic_1" type="file"><br />

                <?php if($_SESSION['is_admin'] == 1){ ?>
                    Radi u: <input type="text" name="work_place" value="<?php echo $row['work_place']; ?>"><br />
                    Plata: <input type="text" name="salary" value="<?php echo $row['salary']; ?>"><br />
                    Admin: <input type="checkbox" name="is_admin" value="" <?php if($row['is_admin'] == true) echo "checked"; ?> ><br />
                <?php } ?>

                Enabled: <input type="checkbox" name="enabled" value="" <?php if($row['enabled'] == true) echo "checked"; ?> ><br />
                <br />

                <input type="submit" name="submit" value="Upisi"><br /><br />

                    <a href="showUser.php?=<?php echo $row['id']; ?>">Vrati se na prikaz podataka</a><br /><br />

                <?php
                    if($is_admin == 1) {
                        echo "<a href='showUsers.php'>Vrati se na listu korisnika</a>";
                    }
                ?>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>