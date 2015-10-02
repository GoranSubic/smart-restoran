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



?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo "http://localhost/smart2015/restoran/img/Indian_Spices.jpg"; ?>" alt="Item Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">

            <form method="post" action="showItem.php" class="ulindex">
                <!--form method="post" action="<!--?php echo $_SERVER['PHP_SELF'] ?>"-->
                <!--input type="hidden" name="id" value="<!--?php if(isset($id)) echo $id; ?>"-->
                <input type="hidden" name="id" value="">
                Naziv artikla: <input type="text" name="title" value=""><br />
                Opis artikla: <input type="text" name="description" value=""><br />
                Cena artikla: <input type="text" name="price" value=""><br />
                Photo link:   <input type="text" name="image_url" value=""><br />
                Menu lista: <input type="checkbox" name="menu" value=""><br />
                Danasnji menu:      <input type="checkbox" name="today_menu" value=""><br /><br />

                <input type="submit" name="submit" value="Upisi"><br /><br />
                <a href="ouroffer.php">Vrati se na listu artikala</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>