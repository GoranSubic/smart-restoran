<?php
include "header.php";
//include "connection/DbConnection.php";

        if(isset($_GET['url'])) {
            $url = $_GET['url'];
        }else{
            echo "Problem sa get metodom!";
        }

?>

    <div class="row">
        <div class="col-md-4">

            <img src="<?php echo $url; ?>" alt="Pulpit Rock" style="width:500px;height:500px">

        </div>
    </div>


<?php include "footer.php"; ?>