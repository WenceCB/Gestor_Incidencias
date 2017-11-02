<?php
include("config.php");
session_start();
// NO HAY VARIABLE SESSION
if (!isset($_SESSION['usuario'])){  
  
  // NO HAY POST
  if(!isset ($_POST['login'])){
    
  }
  // SI HAY POST
  else {       

    $usuario = $_POST['usuario'];
    $password = $_POST['password']; 
    
    // Creo conexión
    $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
    // Compruebo si hay errores
    if ($conn->connect_error) {
        die("Problema de conexión: " . $conn->connect_error);
    } 
    
    
    $sql = "SELECT rol FROM users WHERE usuario = '$usuario' and password = '$password'";
    $result = $conn->query($sql);
    // Si el contador de la consulta devuelve 1, es que hay usuario y password en la DB
    if ($result->num_rows > 0) {
        // Inserto el resultado en $row
        while($row = $result->fetch_assoc()) {

            if($row["rol"] == 1){
                $_SESSION['usuario'] = 'admin';
                header('Location: /perfiles/admin.php'); 
            }
            else{
                $_SESSION['usuario'] = 'usuario';
                header('Location: /perfiles/usuario.php');
            }
        }
    } else {
        
    }
    $conn->close(); 
  }
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
  </head>

  <body>
    <div class="container">

      <form class="form-signin" name="form1" method="post" action="/">
        <h2 class="form-signin-heading">Incidencias | FOC</h2>
        <input name="usuario" id="u_nombre" type="text" class="form-control" placeholder="Usuario" autofocus>
        <input name="password" id="u_pass" type="password" class="form-control" placeholder="Password">
       
        <button name="login" id="b_login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	    <!-- <a href="alta.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create nuevo usuario</a> -->

        <div id="message"></div>
      </form>

    </div> <!-- /container -->
  
    <!-- 
    <script src="js/jquery-2.2.4.min.js"></script>
     Include all compiled plugins (below), or include individual files as needed 
    <script type="text/javascript" src="js/bootstrap.js"></script>
    The AJAX login script 
    <script src="js/login.js"></script> -->

  </body>
</html>
  <?php
  // SI HAY VARIABLE SESSION
  }
  else{
    
    if(($_SESSION['usuario'] == 'admin')){
        
         header('Location: /perfiles/admin.php');     
     }
     else if(($_SESSION['usuario'] == 'usuario')){       
        echo 'soy user';
         header('Location: /perfiles/usuario.php');
     }
     else{        
         header('Location:./error.php');
     }
   
  }
  
  
  ?>
  