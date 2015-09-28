<?php
    include "header.php";
    include "connection/DbConnection.php";

    $dbConn = new DbConnection();
    $connection = $dbConn->connectToDB();

/*   if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // 1. prepared SQL statement
      $sqlup = $connection->prepare(
          "INSERT INTO item (title, description, image_url, price, today_menu, menu) VALUES (?, ?, ?, ?, ?, ?)"
      );

      //2. binding params
      $sqlup->bind_param(
          'ssssii',
          $title,
          $description,
          $image_url,
          $price,
          $today_menu,
          $menu
          );

      // 3. params
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image_url = $_POST['image_url'];
      $price = $_POST['price'];
      if(isset($_POST['menu'])){ $menu = 1; }else{ $menu = 0; }
      if(isset($_POST['today_menu'])){ $today_menu = 1; }else{ $today_menu = 0; }
      //$staff_id = $_POST['staff_id'];

      //4.  execute statement
      $sqlup->execute();

      // 5. Pre close() koraci 3. i 4. mogu ici vise puta!
      $sqlup->close();

      printf("Novi artikal <b>" . $title . " </b>je uspesno upisan u bazu podataka.");

      /* Kreiranje sql upita bez bind:
      $sqlup = "INSERT INTO item SET title = '".$title."', description = '".$desc."', price = '".$price."', image_url = '".$image_url."', menu = '".$menu."', today_menu = '".$today_menu."'";

      if (!$resultsup = $connection->query($sqlup)){
          die('Ne mogu da izvrsim upit zbog ['. $connection->error
              . "]");
      }


      $id = mysqli_insert_id($connection);
  }*/

?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo "http://localhost/smart2015/restoran/img/Indian_Spices.jpg"; ?>" alt="Item Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">

            <form method="post" action="showItem.php" class="ulindex">
                <!--form method="post" action="<!--?php echo $_SERVER['PHP_SELF'] ?>"-->
                <!--input type="hidden" name="id" value="<!--?php if(isset($id)) echo $id; ?>"-->
                <input type="hidden" name="id" value="">
                Naziv artikla: <input type="text" name="title" value=""><br />
                Opis artikla: <input type="text" name="description" value=""><br />
                Cena artikla: <input type="text" name="price" value=""><br />
                Photo link:   <input type="text" name="image_url" value=""><br />
                Menu lista: <input type="checkbox" name="menu" value=""><br />
                Danasnji menu:      <input type="checkbox" name="today_menu" value=""><br /><br />

                <input type="submit" name="submit" value="Upisi"><br /><br />
                <a href="ouroffer.php">Vrati se na listu artikala</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>