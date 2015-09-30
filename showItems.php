<?php

include "header.php";
include "connection/DbConnection.php";
//require_once "connection/Log.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

//$logger = new Log();

if(isset($_GET['del'])) {
    $del = $_GET['del'];
    $sqldel = "DELETE FROM item WHERE id = ".$del;
    $connection->query($sqldel);
}

$sql = "SELECT * FROM item WHERE menu = 1 ORDER BY id ASC ";

if (!$results = $connection->query($sql)){
    //$logger->dataToLog .= 'Ne mogu da izvrsim upit zbog ['. $connection->error
    //    . ']';
    die('Ne mogu da izvrsim upit zbog ['. $connection->error
        . "]");
}

echo "<h1>Ukupno u ponudi imamo ". $results->num_rows ." artikala!</h1>";

if(isset($login)) {
    echo "<a href='editItem.php'>Izmeni podatke</a>";
}else{
    echo "<a href='insertItem.php'>Nemate</a> pravo dodavanja podataka!";
}

?>

<table class="table table-hover datagrid">
    <tr>
        <th>R B</th>
        <th>Naziv artikla</th>
        <th>Detaljniji opis</th>
        <th>Cena artikla</th>
        <th>Fotka artikla</th>
        <th>Obrisi</th>
    </tr>
    <?php WHILE ($row = $results->fetch_assoc()){ ?>
    <tr>
        <!--td><!?php echo "<a href='show.php?id=".$row['id']." >". $row['id']."</a>" ?></td-->
        <td><?php echo "<a href='showItem.php?id={$row['id']}'> ".$row['id']."</a>"; ?></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo $row['description'] ?></td>
        <td><?php echo $row['price'] ?></td>
        <!--td><!--?php echo "<a href='picture.php?url=".urlencode($row['image_url'])."' ><img src=".$row['image_url']." style="width=30px;height=30px"></a>" ?></td-->
        <td><?php echo "<a href='showItem.php?id={$row['id']}' ><img src={$row['image_url']} style='width:50px;height:50px'></a>"; ?></td>
        <td><?php echo "<a href='{$_SERVER['PHP_SELF']}?del={$row['id']}' style='color:red'>Obrisi</a>"; ?></td>
    </tr>
    <?php } ?>

</table>

<?php
include "footer.php";
//$logger->WriteLog($logger->dataToLog);
?>

