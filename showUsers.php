<?php
include "header.php";
include "class/UserDAO.php";
include_once "connection/DbConnection.php";

$userDao = new UserDAO();
$showUsers = $userDao->showUsers();

?>

<div class="main container-fluid">
    <div class="sectionShow">



        <table class="table">
            <tr style="background-color: chocolate">
                <th style="width: 50px">I D</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>JBG</th>
                <th>Email</th>
                <th>Password</th>
                <th>Telefon</th>
                <th>Mob tel</th>
                <th>Radnik</th>
                <th>Image_url</th>
                <th>PhotoID</th>
                <th>Radi u</th>
                <th>Plata</th>
                <th>Je Admin</th>
                <th>Izmeni</th>
            </tr>
            <?php WHILE($row = $showUsers->fetch_assoc()){ ?>
                    <tr>
                        <!--td><!?php echo "<a href='show.php?id=".$row['id']." >". $row['id']."</a>" ?></td-->
                        <td><?php echo "<a href='showUser.php?id={$row['id']}'> ".$row['id']."</a>"; ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['secname'] ?></td>
                        <td><?php echo $row['jbg'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['passwd'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['mphone'] ?></td>
                        <td><?php echo $row['is_staff'] ?></td>
                        <td><?php echo $row['image_url'] ?></td>
                        <td><?php echo $row['photo_id'] ?></td>
                        <td><?php echo $row['work_place'] ?></td>
                        <td><?php echo $row['salary'] ?></td>
                        <td><?php echo $row['is_admin'] ?></td>
                        <td><?php echo "<a href='showUser.php?id={$row['id']}' style='color:red'>Izmeni {$row['id']}</a>"; ?></td>
                    </tr>
            <?php } ?>

        </table>

    </div>
</div>

<?php

    include "footer.php";

?>