<?php
include("../config.php");


$errors         = array();  	// array con los posibles errores
$data 			= array(); 		// array para enviar


// Validar las variables ======================================================
    $id_bd = $_POST['id_bd'];
    $estado = $_POST['estado'];


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
        
        $fecha= date("d-m-Y H:i:s");
        $sql = "UPDATE `incidencias` SET `estado` = $estado,  `fecha_estado` = '$fecha' WHERE `incidencias`.`id` = $id_bd";
        
        if ($conn->query($sql) == TRUE) {
             echo'ok';        
        }
        else{
            $conn->error;   
        }

        $conn->close(); 
        


		// show a message of success and provide a true success variable
		$data['success'] = true;
		$data['message'] = 'Incidencias Actualizadas!';
       
        
	// return all our data to an AJAX call
	echo json_encode($data);