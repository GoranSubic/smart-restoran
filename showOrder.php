<?php

session_start();
if(isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $emailsession = $_SESSION['email'];
    $is_admin = $_SESSION['is_admin'];
}else{
    $is_admin = 0;
}

if($_SESSION['is_admin'] == 1){
    echo "Dobro dosao {$_SESSION['name']} na stranicu {$_SERVER['PHP_SELF']}";

    if(isset($_GET['uoid'])){
        $uoid = $_GET['uoid'];
    }

}else{
    header("Location:ouroffer.php");
}

include "headeradmin.php";
include "class/OrderDAO.php";
include_once "connection/DbConnection.php";

$order = new OrderDAO();
$orderItems = $order->orderItems($uoid);

$rb = 0;

?>

<table class="table table-hover datagrid">

    <tr>
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

<?php
    include "footer.php";
?>
