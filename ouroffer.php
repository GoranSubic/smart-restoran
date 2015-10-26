<?php

include "header.php";
include "connection/DbConnection.php";
include "class/OrderDAO.php";
include_once "connection/db_config.php";
//require_once "connection/Log.php";

$dbConn = new DbConnection();
$connection = $dbConn->connectToDB();

//$logger = new Log();

if(isset($_POST['submit'])){
    if(isset($_SESSION['login'])){
        $item_arr = array();

        for($i=1; $i<100; $i++){
            $ordered_id = "id".$i;
            $price = "price".$i;
            $col = "col".$i;
            $title = "title".$i;

            if((isset($_POST[$ordered_id])) && ($_POST[$ordered_id] == $i)){
                $item_arr[$i][$ordered_id] = $_POST[$ordered_id];
                $item_arr[$i][$price] = $_POST[$price];
                $item_arr[$i][$col] = $_POST[$col];
                $item_arr[$i][$title] = $_POST[$title];
            }
        }
        //print_r($item_arr);
        //$lenght = count($item_arr);
        //echo "Ukupno ima {$lenght} zapisa u porudzbini";
    }else{
        echo "<h3 style='color:#8b0000'>Poštovani, ulogujte se da bi mogli da izvršite porudžbinu.</h3>";
    }
}

if(isset($_GET['CO'])){

    $orderco = new OrderDAO();
    $confirmorder = $orderco->confirmOrder($_GET['CO']);
    echo $confirmorder;

}

if(isset($_GET['DO'])){

    $orderdo = new OrderDAO();
    $confirmorder = $orderdo->disableOrder($_GET['DO']);
    echo $confirmorder;

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

                /****** Upis porudzbine u bazu ******/
                $o = 0;
                foreach ($new_array as $new_array_row) {
                    if ($new_array_row[2] <> 0) {
                        $id_item[$o] = $new_array_row[0];
                        $price_uo[$o] = $new_array_row[1];
                        $col_write[$o] = $new_array_row[2];

                        $id_uo[$o] = $_SESSION['id'];

                        //$order = new OrderDAO();
                        $order_array[$o] = array($id_item[$o], $price_uo[$o], $col_write[$o], $id_uo[$o]);
                        //$order->writeOrder($id_item[$o], $col_write[$o], $id_uo, $price_uo[$o]);
                        $o++;
                    }
                }
                if(isset($order_array)) {
                    $order = new OrderDAO();
                    $order_results = $order->writeOrder($order_array);
                    //print_r($order_array);

                    echo "<br /><h5 style='color: #8b0000'>Kreirana porudzbina broj {$order_results[0]}</h5>";
                }

                /***** Prikaz porudzbine na ekran  ******/

                $foremail = "<html><head>
                            <title>Porudzbina korisnika {$_SESSION['name']} - {$_SESSION['email']} sadrzi sledece podatke:</title>
                            </head>
                            <body>";
                $foremail .= "<table class='table datagrid'>";
                $foremail .= "<tr style='background-color: chocolate'>";
                $foremail .= "<th>ID Artikla</th>";
                $foremail .= "<th>Naziv Artikla</th>";
                $foremail .= "<th>Cena</th>";
                $foremail .= "<th>Količina</th>";
                $foremail .= "</tr>";

                //$foremail .= "<br />Porudzbina korisnika {$_SESSION['name']} - {$_SESSION['email']} sadrzi sledece podatke: <br />";
                $value_all = 0;
                foreach ($new_array as $new_array_row) {
                    echo "<tr>";
                    if ($new_array_row[2] <> 0) {
                        echo "<td>";
                        echo $new_array_row[0];
                        echo "</td><td>";
                        echo $new_array_row[3];
                        echo "</td><td>";
                        echo $new_array_row[1];
                        echo "</td><td>";
                        echo $new_array_row[2];
                        echo "</td><td>";
                        echo $valu_one = $new_array_row[1] * $new_array_row[2];
                        echo "</td>";

                        //$foremail .=  "<br />ID artikla ". $new_array_row[0] ." - ". $new_array_row[3] ." - ". $new_array_row[1] ." din. - ". $new_array_row[2] ."kom <br /> ";

                        $foremail .= "<tr>";
                        $foremail .= "<td>{$new_array_row[0]}</td>";
                        $foremail .= "<td>{$new_array_row[3]}</td>";
                        $foremail .= "<td>{$new_array_row[1]}</td>";
                        $foremail .= "<td>{$new_array_row[2]}</td>";
                        $foremail .= "</tr>";

                        echo "</tr>";
                        if(isset($valu_one)) {
                            $value_all = $value_all + $valu_one;
                        }
                    }
                }

                $url_project = URL_PROJECT;

                $foremail .= "</table>";
                $foremail .= "<br /><h4 style='color:#8b0000'>Poručili ste hranu u vrednosti: {$value_all},00 din.</h4><br /><br />";

                $foremail .= "Porudžbina je poslata restoranu kao i na Vaš email!<br />";
                $foremail .= "Proverite i <a href='{$url_project}/ouroffer.php?CO={$order_results[1]}' style='color: #8b0000'>klikom na ovaj link POTVRDITE</a> porudžbinu!<br />";
                $foremail .= ROK."min od momenta potvrde možete očekivati isporuku.<br /><br />";
                $foremail .= "Ako ste se pogrešno poručili i želite da odustanete,<br />";
                $foremail .= "molimo Vas da <a href='{$url_project}/ouroffer.php?DO={$order_results[1]}' style='color: #8b0000'>klikom na ovaj link OTKAŽETE</a> porudžbinu.";

                if ((isset($value_all)) && ($value_all > 0)) {

                    //Write to screen
                    echo "<br /><h4 style='color:#8b0000'>Poručili ste hranu u vrednosti: {$value_all},00 din.</h4>";
                    $foremail .= "</body></html>";

                    $to_email = $_SESSION['email'];
                    $subject = "Smart-Restoran - Kreirana porudzbina";
                    //Send email's
                    $order->sendEmail($foremail, $order_results[1], $to_email, $subject);
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

    <!--form method="post" action="<!--?php echo $_SERVER['PHP_SELF']; ?>"-->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"-->
        <input type="submit" name="submit" value="Odaberite količine i potvrdite porudžbinu ovde" class="btn btn-default btn-lg btn-block">

        <div class="main container-fluid" style="margin-top: 10px">

        <?php WHILE ($row = $results->fetch_assoc()){ ?>
            <div class="secolPhoto" style="border-color: #d2691e;">
                <table class="table datagrid" style="width: 30%; float: left;">

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
                    <td style="width: 130px" colspan = "2">
                        <input type="hidden" name="id<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                        <span style="color:#8b0000">Količina: <input style="width: 50px" type="number" name="col<?php echo $row['id']; ?>" min="0" max="10" value="0"></span>

                        <?php if($is_admin == 1){
                            echo "<a href='<?php echo {$_SERVER['PHP_SELF']}; ?>?del={$row['id']}' style='color: #8b0000'>Del</a>";
                        } ?>
                    </td>


                    </tfoot>

                </table>
            </div>
        <?php } ?>

        </div>
    </form>
</div>


<?php

    $connection->close();

    include "footer.php";

?>
