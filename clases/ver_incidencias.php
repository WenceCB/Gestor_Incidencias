<?php
session_start();
include("../config.php");


$errors         = array();  	// array con los posibles errores
$data 			= array(); 		// array para enviar

// Validar las variables ======================================================
	


// Devolver respuesta ===========================================================

	// Si hay errores devuelvo false con el error dado
		
		$data['errors']  = $errors;

        // Creo conexión
        $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
        // Compruebo si hay errores
        if ($conn->connect_error) {
            die("Problema de conexión: " . $conn->connect_error);
        } 
        if($_SESSION['rol'] == 'admin'){
        
            $sql = "SELECT id, u.usuario, mensaje, d.nombre_departamento, fecha, estado, fecha_estado FROM incidencias, users u, departamentos d WHERE incidencias.id_usuario = u.id_usuario AND u.id_departamento = d.id_departamento";
            $result = $conn->query($sql);
            // Si el contador de la consulta devuelve 1, es que hay incidencias
            if ($result->num_rows > 0) {
                // Inserto el resultado en $row
            
                while($row = $result->fetch_assoc()) {     
                    
                    $data['incidencia'][]= $row;                    
                }
            } else {
                $error = 'Error, no hay incidencias';
            }
            $conn->close(); 
            
        } 

        else{
         
            // Cambiar por id
            $id = $_SESSION['id'];
            $sql = "SELECT id,  mensaje,  fecha, estado, fecha_estado FROM incidencias WHERE id_usuario ='$id'";
            $result = $conn->query($sql);
            // Si el contador de la consulta devuelve 1, es que hay incidencias
            if ($result->num_rows > 0) {
                // Inserto el resultado en $row
            
                while($row = $result->fetch_assoc()) {     
                    
                    $data['incidencia'][]= $row;                    
                }
            } else {
                $error = 'Error, no hay incidencias';
            }
            $conn->close();    

        }
    // return all our data to an AJAX call
echo json_encode($data);


	
    