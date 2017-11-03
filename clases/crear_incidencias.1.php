<?php
include("config.php");


$errors         = array();  	// array con los posibles errores
$data 			= array(); 		// array para enviar

// Validar las variables ======================================================
	

	if (empty($_POST['texto_incidencia']))
		$errors['texto_incidencia'] = 'Tienes que indicar la incidencia.';



// Devolver respuesta ===========================================================

	// Comprobar si el array de errores está vacío
	if (!empty($errors)) {

		// Si hay errores devuelvo false con el error dado
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {

		// No hay errores

        // Creo conexión
        $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
        // Compruebo si hay errores
        if ($conn->connect_error) {
            die("Problema de conexión: " . $conn->connect_error);
        } 
        
        
        $sql = "SELECT id_usuario, incidencia, estado FROM incidencias";
        $result = $conn->query($sql);
        // Si el contador de la consulta devuelve 1, es que hay usuario y password en la DB
        if ($result->num_rows > 0) {
            // Inserto el resultado en $row
            while($row = $result->fetch_assoc()) {    
                
                
            }
        } else {
            $error = 'Usuario/Contraseña incorrecta';
        }
        $conn->close(); 
        


		// show a message of success and provide a true success variable
		$data['success'] = true;
		$data['message'] = 'La incidencia ha sido registrada correctamente!';
	}

	// return all our data to an AJAX call
	echo json_encode($data);