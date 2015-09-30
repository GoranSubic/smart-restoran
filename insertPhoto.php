<?php
    include "header.php";
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
                Naziv fotke: <input type="text" name="title" value=""><br />
                Opis fotke: <input type="text" name="description" value=""><br />
                
                <input type="submit" name="submit" value="Upisi"><br /><br />
                <a href="ouroffer.php">Vrati se na listu artikala</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>