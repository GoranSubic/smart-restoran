<?php
include "header.php";
include "connection/DbConnection.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. prepraed SQL statement
    $sqlup = $connection->prepare("INSERT INTO item (title, description, price, image_url, menu, today_menu) VALUES (?, ?, ?, ?, ?, ?)");

    //2. binding params
    $sqlup->bind_param('ssdsii', $title, $desc, $price, $image_url, $menu, $today_menu);

    // 3. params
    //$id = $_POST['id'];
    //$id = mysql_insert_id();
    //echo "Id iznosi: ".$_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    //$menu = $_POST['menu'];
    if(isset($_POST['menu'])){ $menu = 1; }else{ $menu = 0; }
    //$today_menu = $_POST['today_menu'];
    if(isset($_POST['today_menu'])){ $today_menu = 1; }else{ $today_menu = 0; }

    //4.  execute statement
    $sqlup->execute();

    // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
    $sqlup->close();

    printf ("Novi artikal <b>" . $title . " </b>je uspesno upisan u bazu podataka.");

    /* Kreiranje sql upita bez bind:
    $sqlup = "INSERT INTO item SET title = '".$title."', description = '".$desc."', price = '".$price."', image_url = '".$image_url."', menu = '".$menu."', today_menu = '".$today_menu."'";

    if (!$resultsup = $connection->query($sqlup)){
        die('Ne mogu da izvrsim upit zbog ['. $connection->error
            . "]");
    }
    */

    $id = mysqli_insert_id($connection);

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
            <ul class="ulindex">
                <li><?php echo "<h1>". $row['title'] ."</h1>" ?></li>
                <li><?php echo "<h4>". $row['description'] ."</h4>" ?></li>
                <li><?php echo "<h3>". $row['price'] ." din</h3>" ?></li>
                <br />
                <br />
                <li><a href="">Poruci</a><input type="number" min="1" max="10" value="1"></li>
                <br />
                <br />
                <li><a href="ouroffer.php">Vrati se na ponudu.</a></li>
                <?php

                        if($is_admin == 1) {
                            //echo "<li>";
                            echo "<a href='editItem.php?id={$id}'>Izmeni</a> prikazani artikal!";
                            //echo "</li>";
                        }
                    ?>
            </ul>



        </div>
    </div>
    <div class="sectionShow">
        <?php
        if(isset($_SESSION['login'])) {
            include "adminLinks.php";
        }
        ?>
    </div>
</div>

<?php

    $connection->close();

    include "footer.php";

?>