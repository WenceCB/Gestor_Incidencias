<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'usuario' )){
    header("location: ../index.php");
}
else{
    include('../header.html');
    ?>
    <h1>Bienvenido a tu zona de incidencias <?php  echo $_SESSION['usuario'] ?></h1>
    <form class="form-signup" id="usersignup" name="usersignup" method="post" action="createuser.php">
   
    
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Aquí tu incidencia ..." autofocus></textarea>
    
    <br>
    
    <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

    <div id="message"></div>
    </form>




<?php
include('../footer.html');
}
?>