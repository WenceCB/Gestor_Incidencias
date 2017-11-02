<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'admin' )){
    header("location: ../index.php");
}
else{
    include('../header.html');
    ?>


    <?php 
    echo "hola ADMIN";
    ?>




<?php
include('../footer.html');
}
?>