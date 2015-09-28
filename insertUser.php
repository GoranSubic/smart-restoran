<?php
include "header.php";



?>

<div class="main container-fluid">
    <div class="sectionShow">
        <div class="secimg">
            <img src="<?php echo "http://localhost/smart2015/restoran/img/Indian_Spices.jpg"; ?>" alt="User Photo" style="width:300px;height:300px">
        </div>
        <div class="secol">

            <form method="post" action="showUser.php" class="ulindex">
            <!--form method="post" action="<!--?php echo $_SERVER['PHP_SELF'] ?>"-->
                <!--input type="hidden" name="id" value="<!--?php if(isset($id)) echo $id; ?>"-->
                Ime: <input type="text" name="name" value=""><br />
                Prezime: <input type="text" name="secondname" value=""><br />
                Br. dok: <input type="text" name="jbg" value=""><br />
                E-mail: <input type="email" name="email" value=""><br />
                Sifra: <input type="text" name="passwd" value=""><br />
                Telefon: <input type="tel" name="phone" value=""><br />
                Mob tel: <input type="tel" name="mphone" value=""><br />
                Radnik: <input type="checkbox" name="is_staff" value=""><br />
                Image url: <input type="text" name="image_url" value=""><br />
                Photo: <input type="file" name="photo" value=""><br />

                Radi u: <input type="text" name="work_place" value=""><br />
                Plata: <input type="text" name="salary" value=""><br />
                Admin: <input type="checkbox" name="is_admin" value=""><br />
                <br />

                <input type="submit" name="submit" value="Upisi"><br /><br />
                <a href="showUsers.php">Vrati se na listu korisnika</a>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>