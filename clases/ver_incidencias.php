<?php
include("../config.php");


$errors         = array();  	// array con los posibles errores
$data 			= array(); 		// array para enviar

// Validar las variables ======================================================
	


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
        
        
        $sql = "SELECT id, id_usuario, mensaje, departamento, fecha, estado FROM incidencias";
        $result = $conn->query($sql);
        // Si el contador de la consulta devuelve 1, es que hay incidencias
        if ($result->num_rows > 0) {
            // Inserto el resultado en $row
           
            while($row = $result->fetch_assoc()) {                 
                
                $data['incidencia'][]= $row;
               
                
            }
        } else {
            $error = 'No hay incidencias';
        }
        $conn->close(); 
        


		// show a message of success and provide a true success variable
		$data['success'] = true;
		$data['message'] = 'Incidencias Actualizadas!';
	

	// return all our data to an AJAX call
	echo json_encode($data);