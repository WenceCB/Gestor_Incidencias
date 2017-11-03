<?php
include("config.php");
session_start();
// NO HAY VARIABLE SESSION
if (!isset($_SESSION['rol'])){  
  
  // NO HAY POST
  if(!isset ($_POST['login'])){
    
  }
  // SI HAY POST
  else {       

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $error = ''; 
    
    // Creo conexión
    $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
    // Compruebo si hay errores
    if ($conn->connect_error) {
        die("Problema de conexión: " . $conn->connect_error);
    } 
    
    
    $sql = "SELECT rol, usuario FROM users WHERE usuario = '$usuario' and password = '$password'";
    $result = $conn->query($sql);
    // Si el contador de la consulta devuelve 1, es que hay usuario y password en la DB
    if ($result->num_rows > 0) {
        // Inserto el resultado en $row
        while($row = $result->fetch_assoc()) {

            if($row["rol"] == 1){
                $_SESSION['rol'] = 'admin';               
                $_SESSION['usuario'] = $row['usuario'];
               
                header('Location: /perfiles/admin.php'); 
            }
            else{
                $_SESSION['rol'] = 'usuario';
                $_SESSION['usuario'] = $row['usuario'];
                header('Location: /perfiles/usuario.php');
            }
        }
    } else {
        $error = 'Usuario/Contraseña incorrecta';
    }
    $conn->close(); 
  }
  include('html/header.html');
?>

      <form class="form-signin" name="form1" method="post" action="/">
        <h2 class="form-signin-heading">Incidencias | FOC</h2>
        <input name="usuario" id="u_nombre" type="text" class="form-control" placeholder="Usuario" autofocus>
        <input name="password" id="u_pass" type="password" class="form-control" placeholder="Password">
       
        <button name="login" id="b_login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	    <!-- <a href="alta.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create nuevo usuario</a> -->

        <div id="message"><?php echo $error?></div>
      </form>

  

  <?php
  include('html/footer.html');
  // SI HAY VARIABLE SESSION
  }
  else{
    
    if(($_SESSION['rol'] == 'admin')){
        
         header('Location: /perfiles/admin.php');     
     }
     else if(($_SESSION['rol'] == 'usuario')){       
        
         header('Location: /perfiles/usuario.php');
     }
     else{        
         header('Location:./error.php');
     }
   
  }
  
  
  ?>
  