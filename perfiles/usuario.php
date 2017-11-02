<?php
session_start();
if(!isset($_SESSION['usuario']) || (($_SESSION['usuario'])!= 'usuario' )){
    header("location: ../index.php");
}
else{
    include('../header.html');
    ?>


    <?php 
    echo "hola User";
    ?>




<?php
include('../footer.html');
}
?>