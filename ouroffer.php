<?php

include "header.php";
include "connection/DbConnection.php";
//require_once "connection/Log.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

//$logger = new Log();

//$item_id_arr = array($item_id => $item_id_col);
if(isset($_GET['submit'])){
    if(isset($_SESSION['login'])){
        $item_arr = array();

        for($i=1; $i<100; $i++){
                $ordered_id = "id".$i;
                $price = "price".$i;
                $col = "col".$i;
                $title = "title".$i;

            if((isset($_GET[$ordered_id])) && ($_GET[$ordered_id] == $i)){
                $item_arr[$i][$ordered_id] = $_GET[$ordered_id];
                $item_arr[$i][$price] = $_GET[$price];
                $item_arr[$i][$col] = $_GET[$col];
                $item_arr[$i][$title] = $_GET[$title];
            }
        }
        //print_r($item_arr);
        //$lenght = count($item_arr);
        //echo "Ukupno ima {$lenght} zapisa u porudzbini";
    }else{
        echo "<h3 style='color:#8b0000'>Poštovani, ulogujte se da bi mogli da izvršite porudžbinu.</h3>";
    }
}

if(isset($_GET['del'])) {
    if($is_admin == 1) {
        $del = $_GET['del'];
        $sqldel = "DELETE FROM item WHERE id = " . $del;
        $connection->query($sqldel);
    }else{
        echo "<h4 style='color: #8b0000'>O cemu se ovde radi?!</h4>";
    }
}

$sql = "SELECT * FROM item WHERE menu = 1 ORDER BY id ASC ";

if (!$results = $connection->query($sql)){
    //$logger->dataToLog .= 'Ne mogu da izvrsim upit zbog ['. $connection->error
    //    . ']';
    die('Ne mogu da izvrsim upit zbog ['. $connection->error
        . "]");
}

?>

<div class="main container-fluid">
    <div>
        <?php
            if(isset($_SESSION['login'])) {
                echo "<h3>{$_SESSION['name']}, dobro dosli u aplikaciju! Mozete izvrsiti porudzbinu.</h3>";
            }
            echo "<h3>Trenutno u ponudi imamo ". $results->num_rows ." artikala!</h3>";

            if (isset($ordered_id)) {
                $n=0;
                foreach($item_arr as $item_arr_key=>$one_array){
                    $i=0;
                    foreach($one_array as $key=>$value) {
                        //echo "<br />Brojac iznosi {$i} - Key je: {$key} - upisana vrednost {$value}";
                        $new_array[$n][$i] = $value;
                        $i++;
                    }
                    $n++;
                }

            }

        //print_r($new_array);
        //$lenght = count($item_arr);
        //echo "<br />Ukupno ima {$lenght} zapisa u porudzbini";
        if((isset($new_array)) && (!empty($new_array))) {
            ?>

            <table class="table datagrid">
                <tr style="background-color: chocolate">
                    <th>ID</th>
                    <th>Artikal</th>
                    <th>Cena</th>
                    <th>Kolicina</th>
                    <th>Vrednost</th>
                </tr>


                <?php
                $value_all = 0;
                foreach ($new_array as $new_array_row) {
                    echo "<tr>";
                    if ($new_array_row[2] <> 0) {
                        echo "<td>";
                        echo $new_array_row[0];
                        echo "</td><td>";
                        echo $new_array_row[3];
                        echo "</td><td>";
                        echo $new_array_row[2];
                        echo "</td><td>";
                        echo $new_array_row[1];
                        echo "</td><td>";
                        echo $valu_one = $new_array_row[1] * $new_array_row[2];
                        echo "</td>";

                        echo "</tr>";
                        if(isset($valu_one)) {
                            $value_all = $value_all + $valu_one;
                        }
                    }
                }
                if ((isset($value_all)) && ($value_all > 0)) {
                    echo "<br /><h4 style='color:#8b0000'>Poručili ste hranu u vrednosti: {$value_all},00 din.</h4>";
                }

                ?>


            </table>

        <?php
        }
            if($is_admin == 1){
                echo "<a href='insertItem.php'>Dodaj</a> novi artikal";
            }
        ?>
    </div>

<form method="get" action="ouroffer.php">
    <input type="submit" name="submit" value="Odaberite količine i potvrdite porudžbinu ovde" class="btn btn-default btn-lg btn-block">
        <?php WHILE ($row = $results->fetch_assoc()){ ?>
        <div class="secolPhoto">
            <table class="table datagrid" style="width: 100%">

                <tr style="background-color: chocolate">
                    <th style="width: 40%">ID: <?php echo "<a style='color:darkred' href='showItem.php?id={$row['id']}'> ".$row['id']."</a>"; ?></th>
                    <!--th style="width: 130px"><!--?php echo $row['title'] ?></th-->
                    <th style="width: 130px"><input type="text" name="title<?php echo $row['id']; ?>" value="<?php echo $row['title']; ?>" style="background-color: #d2691e; width: 130px" readonly></th>
                </tr>

                <tr>
                    <td style="width: 40%"><?php echo $row['description'] ?></td>
                    <td style="width: 130px"><?php echo "<a href='showItem.php?id={$row['id']}' ><img src={$row['image_url']} style='width:100px;height:100px'></a>"; ?></td>
                </tr>
                <tfoot>
        <!--  Polja u formi ---------------------------------------------------->
                    <td style="width: 40%"><input style="width: 100px" type="money" name="price<?php echo $row['id']; ?>" value="<?php echo $row['price']; ?>" readonly></td>
                    <td style="width: 130px">
                        <input type="hidden" name="id<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                        <span style="color:#8b0000">Količina: <input style="width: 50px" type="number" name="col<?php echo $row['id']; ?>" min="0" max="10" value="<?php if(isset($_GET['col'])){echo $_GET['col']; }else{echo '0';} ?>"></span>
                    </td>

                    <?php if($is_admin == 1){
                        echo "<td style='width: 20%'><a href='ouroffer.php?del={$row['id']}' style='color: #8b0000'>Del</a> </td>";
                    } ?>
                </tfoot>

            </table>
        </div>
    <?php } ?>

</form>

</div>

<?php
include "footer.php";
//$logger->WriteLog($logger->dataToLog);
?>

