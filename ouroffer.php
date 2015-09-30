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

<div class="main container-fluid">
    <?php WHILE ($row = $results->fetch_assoc()){ ?>
        <div class="secolPhoto">
            <table class="table datagrid" style="width: 100%">

                <tr style="background-color: chocolate">
                    <th style="width: 50%">ID: <?php echo "<a style='color:darkred' href='showItem.php?id={$row['id']}'> ".$row['id']."</a>"; ?></th>
                    <th style="width: 150px"><?php echo $row['title'] ?></th>
                </tr>

                <tr>
                    <!--td><!?php echo "<a href='show.php?id=".$row['id']." >". $row['id']."</a>" ?></td-->
                    <td style="width: 50%"><?php echo $row['description'] ?></td>
                    <td style="width: 150px"><?php echo "<a href='showItem.php?id={$row['id']}' ><img src={$row['image_url']} style='width:100px;height:100px'></a>"; ?></td>
                    <!--td><!--?php echo "<a href='picture.php?url=".urlencode($row['image_url'])."' ><img src=".$row['image_url']." style="width=30px;height=30px"></a>" ?></td-->
                </tr>
                <tfoot>
                    <td><?php echo $row['price'] ?></td>
                    <td><a href="">Poruci</a><input type="number" min="1" max="10" value="1"></td>
                </tfoot>

            </table>
        </div>
    <?php } ?>
</div>

<?php
include "footer.php";
//$logger->WriteLog($logger->dataToLog);
?>

