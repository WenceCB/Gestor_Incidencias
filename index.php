<?php
include("lib/config.php");
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
    
    
    $sql = "SELECT id_usuario , usuario, password, rol FROM users WHERE usuario = '$usuario' and password = '$password'";
    $result = $conn->query($sql);
    // Si el contador de la consulta devuelve 1, es que hay usuario y password en la DB
    if ($result->num_rows > 0) {
        // Inserto el resultado en $row
        while($row = $result->fetch_assoc()) {

            if($row["rol"] == 0){
                $_SESSION['rol'] = 'admin';               
                $_SESSION['usuario'] = $row['usuario'];
               
                header('Location: /perfiles/admin.php'); 
            }
            else{
                $_SESSION['rol'] = 'usuario';
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['id'] = $row['id_usuario'];
                
                header('Location: /perfiles/usuario.php');
            }
        }
    } else {
        $error = 'Usuario/Contraseña incorrecta';
    }
    $conn->close(); 
  }
    include('html/header.html');
    include('html/login.html');  
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
  