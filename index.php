<?php
session_start();
// NO HAY VARIABLE SESSION
if (!isset($_SESSION['usuario'])){  
  // NO HAY POST
  if(!isset ($_POST['login'])){
 
  }
  // SI HAY POST
  else {  
    if($_POST['password'] == '1234'){
       // Variable SESSION usuario
       $_SESSION['usuario'] = 'admin';      
      header('Location: /perfiles/admin.php');      
    }
    elseif($_POST['password'] == '1'){
      // Variable SESSION usuario  
      $_SESSION['usuario'] = 'usuario';          
      header('Location: /perfiles/usuario.php');   
    } 
    else {
      // Variable SESSION usuario        
    } 
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

      <form class="form-signin" name="form1" method="post" action="">
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
        
         header('Location: /perfiles/usuario.php');
     }
     else{        
         header('Location:./error.php');
     }
   
  }
  
  
  ?>
  