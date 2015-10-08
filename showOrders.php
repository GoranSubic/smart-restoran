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
}else{
    header("Location:ouroffer.php");
}

include "headeradmin.php";
include "class/OrderDAO.php";
include_once "connection/DbConnection.php";

$order = new OrderDAO();
$orderList = $order->orderList();

?>

<table class="table table-hover datagrid">

    <tr style="background-color: chocolate">
        <th>ID</th>
        <th>Vreme</th>
        <th>Status</th>
        <th>Startovana</th>
        <th>Zavrsena</th>
        <th>Ime/Prezime</th>
        <th>Adresa</th>
        <th>City</th>
    </tr>

    <?php WHILE($rowlist = $orderList->fetch_assoc()){ ?>

    <tr>

        <td><?php echo $rowlist['oid']; ?></td>
        <td><?php echo $rowlist['odate']; ?></td>
        <td><?php echo $rowlist['ostatus']; ?></td>
        <td><?php echo $rowlist['ostarted']; ?></td>
        <td><?php echo $rowlist['ofinished']; ?></td>
        <td><?php echo $rowlist['uemail']; ?></td>
        <td><?php echo $rowlist['uadress']; ?></td>
        <td><?php echo $rowlist['ucity']; ?></td>

    </tr>

    <?php } ?>

</table>

<?php
    include "footer.php";
?>
