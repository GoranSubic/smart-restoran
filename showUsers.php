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
include "class/UserDAO.php";
include_once "connection/DbConnection.php";

$userDao = new UserDAO();
$showUsers = $userDao->showUsers();



?>

<!--div class="main container-fluid">
    <div class="sectionShow"-->



        <!--table class="table table-hover datagrid"-->
        <table class="table table-hover datagrid">
            <tr style="background-color: chocolate">
                <th style=>I D</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Adresa</th>
                <th>Email</th>
                <!--th>Password</th-->
                <!--th>Telefon</th-->
                <th>Mob tel</th>
                <th>Radnik</th>
                <!--th>Image_url</th-->
                <th>Photo</th>
                <th>Radi u</th>
                <th>Plata</th>
                <th>Admin</th>
                <th>Izmeni</th>
                <th>Obrisi</th>
            </tr>
            <?php WHILE($row = $showUsers->fetch_assoc()){ ?>
                    <tr>
                        <!--td><!?php echo "<a href='show.php?id=".$row['id']." >". $row['id']."</a>" ?></td-->
                        <td><?php echo "<a href='showUser.php?id={$row['id']}'> ".$row['id']."</a>"; ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['secname'] ?></td>
                        <td><?php echo $row['adress'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <!--td><!--?php echo $row['passwd'] ?></td-->
                        <!--td><!--?php echo $row['phone'] ?></td-->
                        <td><?php echo $row['mphone'] ?></td>
                        <td><?php if($row['is_staff'] == TRUE) {
                                echo "Jeste";
                            }else{
                                echo "Nije";
                            } ?></td>
                        <!--td><!--?php echo $row['image_url'] ?></td-->
                        <td><?php if(isset($row['photo_id'])){
                                echo $userDao->listPhoto($row['photo_id']);
                            }else{
                                echo "No photo";
                            } ?></td>
                        <td><?php echo $row['work_place'] ?></td>
                        <td><?php echo $row['salary'] ?></td>
                        <td><?php if($row['is_admin'] == TRUE){
                                echo "Jeste";
                            }else{
                                echo "Nije";
                            } ?></td>
                        <td><?php echo "<a href='showUser.php?id={$row['id']}'>Prikazi/Izmeni</a>"; ?></td>
                        <td><?php echo "<a href='deletePage.php?delU={$row['id']}' onClick=\"return confirm('Are you 100% totally certain that you want to DELETE this appointment?')\" style='color:red'>Obrisi</a>"; ?></td>
                    </tr>
            <?php } ?>

        </table>

    <!--/div>
</div-->

<?php

    include "footer.php";

?>