<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'admin' )){
    header("location: ../index.php");
}
else{
    include('../header.html');
    ?>
    <h1>Bienvenido <?php  echo $_SESSION['usuario'] ?></h1>

    




<?php
include('../footer.html');
}
?>