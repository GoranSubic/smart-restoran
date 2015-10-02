
<div class="secol admin">


            <?php
                echo "<h4>Korisnicki linkovi:</h4><br />";
                echo "<ul>";
                echo "<li>";
                if(isset($_SESSION['login'])) {
                    echo "<a href='editUser.php?id={$id}'>Mozete izmeniti korisnicke podatke</a>";
                }
                echo "</li>";
                echo "</ul><br />";
            ?>
<?php
if($is_admin == 1) {
    echo "<h4>Admin linkovi:</h4><br />";
    echo "<ul>";
    echo "<li><a href='insertUser.php'>Dodaj novog korisnika</a></li>";
    echo "<li><a href='showUsers.php'>Prikazi listu svih korisnika</a></li>";
    echo "<li><a href='insertItem.php'>Dodaj novi artikal</a></li>";
    echo "<li><a href='showItems.php'>Prikazi tabelu svih artikala</a></li>";
    echo "<li><a href='showPhotos.php'>Prikazi listu svih fotki</a></li>";
    echo "<li><a href='showPhotoUsers.php'>Prikazi listu fotki korisnika</a></li>";
    echo "<li><a href='showPhotoItems.php'>Prikazi listu fotki artikala</a></li>";
    echo "</ul>";
}
?>

</div>
