<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'admin' )){
    header("location: ../index.php");
}
else{
    //include('../html/header.html');
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jquery via CDN -->
   <script src="../clases/ajax.js"></script>
</head>

  <body>
    <div class="container">
    <h1>Bienvenido <?php  echo $_SESSION['usuario'] ?></h1>
   
    <form class="form-signin" id="form1" method="GET" action="">
        
       
        <button name="actualizar" id="b_actualizar" class="btn btn-lg btn-primary btn-block" type="submit">Actualizar</button>
	    <!-- <a href="alta.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create nuevo usuario</a> -->

        <div id="message"><?php echo $error?></div>
      </form>
    




<?php
include('../html/footer.html');
}
?>