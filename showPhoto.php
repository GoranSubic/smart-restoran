<?php

include "header2.php";
include_once "connection/DbConnection.php";
include "class/Photo.php";
include "class/PhotoDAO.php";
$photoDao = new PhotoDAO();

if(isset($_GET['photoid'])){
    $photoid = $_GET['photoid'];
    $rowphoto = $photoDao->showPhoto($photoid);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $photoObj = new Photo();

    $photoObj->setID($_POST['id']);
    $photoObj->setDescription($_POST['description']);

    $rowphoto = $photoDao->editOne(
        $photoObj->getId(),
        $photoObj->getDescription()
    );

}


$checked = "checked";
?>

<br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="id" value="<?php if(isset($photoid)) echo $photoid; ?>">
    <h3>Title: <!--input type="text" name="title" value="<!--?php echo $rowphoto['title']; ?>"-->
    <?php echo $rowphoto['title']; ?><br /><br />
    Opis:<p class="form-control-static">
    <input type="textarea" class="form-control" rows="3" name="description" value="<?php echo $rowphoto['description']; ?>">
    </p>
    <br />
    Is item: <input type="checkbox" class="checkbox-inline" name="item" value="" <?php echo $checked; ?> >
    Is user: <input type="checkbox" class="checkbox-inline" name="user" value="" <?php echo $checked; ?> >

    <input type="submit" class="btn btn-default" name="submit" value="Potvrdi">
    </h3>
</form>
<br /><br />

<a href="showPhotos.php">Vrati se na pregled svih fotki iz baze</a>

<br /><br />

<img src="/smart2015/smart-restoran/photo/item/<?php echo $rowphoto['title']; ?>" style="width:90%; height:90%; float: inherit" alt="Item Photo">