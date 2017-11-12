<?php
session_start();
// Carlo librería de conexión
require("../lib/config.php");
// Compruebo si está seteada la variable de Sessión
if (isset($_SESSION['rol'])){ 

    // Inicializo variables

    $errors         = array();  	// array con los posibles errores
    $data 			= array(); 		// array para enviar


// Establizco las variables ======================================================

    $id_bd = $_POST['id_bd'];
    $estado = $_POST['estado'];
    $mensaje_admin = $_POST['mensaje_admin'];
    


// Devolver respuesta ===========================================================

	// Si hay errores devuelvo false con el error dado
		$data['success'] = false;
		$data['errors']  = $errors;	

        // Creo conexión
        $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
        // Compruebo si hay errores
        if ($conn->connect_error) {
            die("Problema de conexión: " . $conn->connect_error);
        } 
        // Si quíen llama actualizar es admin
        if($_SESSION['rol'] == 'admin'){
            // Realizo actualización de la consulta
            $fecha= date("d-m-Y H:i:s");
            $sql = "UPDATE `incidencias` SET `estado` = $estado, `mensaje_admin`= '$mensaje_admin',  `fecha_estado` = '$fecha' WHERE `incidencias`.`id` = $id_bd";
            
            if ($conn->query($sql) == TRUE) {
                $data['message'] = 'Actualizacion de la Incidencia con Exito!';        
            }
            else{
                $conn->error;  
                $data['message'] = 'Problema con la Actualizacion de la incidencia!'; 
            }

            $conn->close(); 

            // show a message of success and provide a true success variable
            $data['success'] = true;
		
    }
    else{          
            // Si quién llama es el usuario recojo id de la sesión
            $id = $_SESSION['id'];            
            $mensaje = $_POST['mensaje'];
            // Realizo una nueva inserción
            $sql = "INSERT INTO `incidencias` (`id`, `id_usuario`, `mensaje`,  `fecha`, `estado`) VALUES (NULL, '$id', '$mensaje', CURRENT_TIMESTAMP, '0');";
            
            $result = $conn->query($sql);
            // Si el contador de la consulta devuelve 1, es que hay incidencias
            if ($result->num_rows > 0) {

                // Inserto el resultado en $row
            
                while($row = $result->fetch_assoc()) {    
                    
                    $data['incidencia'][]= $row;                    
                }
                $data['message']= 'Error, No se ha insertado la incidencia!'; 
            } else {
                $data['message']= 'Incidencia, insertada correctamente !';
            }
            $conn->close();  
        
        }    
    
    // Devuelvo json con el resultado
    echo json_encode($data);

}
// Si no está seteada la sesión lo mando al index
else{
    header("location: ../index.php");
}


?>
        
	