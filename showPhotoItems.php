<?php
include "header.php";
include "connection/DbConnection.php";
include "class/PhotoDAO.php";
include "class/Photo.php";

$photoDao = new PhotoDAO();
$showPhotos = $photoDao->showPhotoItems();

?>

<div class="main container-fluid">
    <!--div class="section"-->
        <?php WHILE($row = $showPhotos->fetch_assoc()){ ?>
            <div class="secolPhoto">
                <table class="table datagrid" style="width: 25%">
                    <tr style="background-color: chocolate">
                        <th style="width: 25%"><?php echo "<a style='color:darkred' href='showPhoto.php?photoid={$row['id']}'> ".$row['id']."</a>"; ?></th>
                        <th style="width: 75%"><?php echo $row['title'] ?></th>
                        <th></th>
                    </tr>
                     <tr>
                         <td style="width: 50%"><?php echo $row['description'] ?></td>
                         <td style="width: 50%"><a href="<?php echo "showPhoto.php?photoid={$row['id']}";  ?>"><img src="/smart2015/smart-restoran/photo/user/<?php echo $row['title']; ?>" alt="Photo"></a> </td>
                    </tr>
                    <tfoot>
                        <td style="width: 25%">Prikazi:</td>
                        <td style="width: 75%"><a href="showPhoto.php?photoid=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>

                    </tfoot>
                </table>
            </div>
        <?php } ?>
    </div>
    <!--/div-->
</div>

<?php

    include "footer.php";

?>