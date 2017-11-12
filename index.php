<?php
require("lib/config.php");
session_start();
// No hay variable de sesión
if (!isset($_SESSION['rol'])){  
  
  // No hay Post
  if(!isset ($_POST['login'])){
    
  }
  // Si hay Post
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
    // Establezco consulta
    $sql = "SELECT id_usuario , usuario, password, rol FROM users WHERE usuario = '$usuario' and password = '$password'";
    $result = $conn->query($sql);
    // Si el contador de la consulta devuelve 1, es que hay usuario y password en la DB
    if ($result->num_rows > 0) {

        // Inserto el resultado en $row
        while($row = $result->fetch_assoc()) {
            // Compruebo el tipo de rol que tiene el usuario devuelto
            if($row["rol"] == 0){
                // Guardo en las variables de sesión los datos que necesitaré más adelante
                $_SESSION['rol'] = 'admin';               
                $_SESSION['usuario'] = $row['usuario'];
               // Lo redirecciono a su perfil
                header('Location: /perfiles/admin.php'); 
            }
            else{
                // Guardo en las variables de sesión los datos que necesitaré más adelante
                $_SESSION['rol'] = 'usuario';
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['id'] = $row['id_usuario'];
                // Lo redirecciono a su perfil
                header('Location: /perfiles/usuario.php');
            }
        }
    } else {
        $error = 'Usuario/Contraseña incorrecta';
    }
    $conn->close(); 
  }
  // LLamo a los includes
    include('html/header.html');
    include('html/login.html');  
    include('html/footer.html');

  // Si hay variable de sesión porque se ha creado previamente, redirecciono a su perfil
  }
  else{
    
    if(($_SESSION['rol'] == 'admin')){
        
         header('Location: /perfiles/admin.php');     
     }
     else if(($_SESSION['rol'] == 'usuario')){       
        
         header('Location: /perfiles/usuario.php');
     }
     else{        
         header('Location:./index.php');
     }   
  } 
  ?>
  