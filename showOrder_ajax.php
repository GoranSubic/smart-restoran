<?php

include "class/OrderDAO.php";
include_once "connection/DbConnection.php";

if(isset($_GET['uoid'])){
    $uoid = $_GET['uoid'];
}

$order = new OrderDAO();
$orderItems = $order->orderItems($uoid);

$rb = 0;

?>

<table class="table table-hover datagrid">

    <tr style="background-color: chocolate">
        <th>RB</th>
        <th>Broj Porudžbine</th>
        <th>Artikal</th>
        <th>Količina</th>
        <th>Cena</th>
        <th>Iznos</th>
    </tr>

    <?php WHILE($rowItem = $orderItems->fetch_assoc()){

        $acc = $rowItem['quantity'] * $rowItem['price'];
        $rb++;

        ?>

        <tr>

            <td><?php echo $rb; ?></td>
            <td><?php echo $uoid; ?></td>
            <td><?php echo $rowItem['title']; ?></td>
            <td><?php echo $rowItem['quantity']; ?></td>
            <td><?php echo $rowItem['price']; ?></td>
            <td><?php echo $acc; ?></td>

        </tr>

    <?php } ?>

</table>

