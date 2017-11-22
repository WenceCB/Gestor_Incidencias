<?php
session_start();
// Carlo librería de conexión
require("../lib/config.php");
// Compruebo si está seteada la variable de Sessión
if (isset($_SESSION['rol']) &&  $_SESSION['rol'] == 'admin'){ 

// Inicializo variables

    $errors         = array();  	// array con los posibles errores
    $data 			= array(); 		// array para enviar


// Establizco las variables ======================================================

    $id_bd = $_POST['id_bd'];   
    


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
 
            // Realizo actualización de la consulta
           
            $sql = "DELETE FROM `incidencias` WHERE `incidencias`.`id` = $id_bd";
            
            if ($conn->query($sql) == TRUE) {
                $data['message'] = 'Incidencia Eliminada con Exito!';        
            }
            else{
                $conn->error;  
                $data['message'] = 'Problema con la Eliminación de la incidencia!'; 
            }

            $conn->close(); 

            // show a message of success and provide a true success variable
            $data['success'] = true;
		
        
           
    
    // Devuelvo json con el resultado
    echo json_encode($data);
}
// Si no está seteada la sesión lo mando al index
else{
    header("location: ../index.php");
}


?>
        
	