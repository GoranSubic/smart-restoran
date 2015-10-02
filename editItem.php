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
    echo "Dobro dosao {$_SESSION['name']} na stranicu {$_SERVER['PHP_SELF']}";
}else{
    header("Location:ouroffer.php");
}

include "headeradmin.php";
include "connection/DbConnection.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    echo "Id iznosi: ".$_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    //$menu = $_POST['menu'];
    if(isset($_POST['menu'])){ $menu = 1; }else{ $menu = 0; }
    //$today_menu = $_POST['today_menu'];
    if(isset($_POST['today_menu'])){ $today_menu = 1; }else{ $today_menu = 0; }


    $sqlup = "UPDATE item SET title = '".$title."', description = '".$desc."', price = '".$price."', image_url = '".$image_url."', menu = '".$menu."', today_menu = '".$today_menu."' WHERE id = '$id'";

    //$connection->query($sql);

    if (!$resultsup = $connection->query($sqlup)){
        die('Ne mogu da izvrsim upit zbog ['. $connection->error
            . "]");
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
/*else{
    echo "Problem sa get metodom!";
}*/



$sql = "SELECT * FROM item WHERE id = ".$id;
if (!$results = $connection->query($sql)){
    die('Ne mogu da izvrsim upit zbog ['. $connection->error
        . "]");
}

    $row = $results->fetch_assoc();

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo $row['image_url']; ?>" alt="Item Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">

            <!-- form method="post" action="showItem.php" class="ulindex"-->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                Naziv artikla: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br />
                Opis artikla: <input type="text" name="description" value="<?php echo $row['description']; ?>"><br />
                Cena artikla: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br />
                Photo link:   <input type="text" name="image_url" value="<?php echo $row['image_url']; ?>"><br />
                Menu svih artikala: <input type="checkbox" name="menu" value="" <?php if($row['menu'] == true) echo "checked"; ?> ><br />
                Danasnji menu:      <input type="checkbox" name="today_menu" value="" <?php if($row['today_menu'] == true) echo "checked"; ?> ><br /><br />

                <input type="submit" name="submit" value="Primeni"><br /><br />
                <a href="ouroffer.php">Vrati se na listu artikala</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>