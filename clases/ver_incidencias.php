<?php
session_start();
// Carlo librería de conexión
include("../lib/config.php");
// Compruebo si está seteada la variable de Sessión
if (isset($_SESSION['rol'])){ 

// Inicializo variables    
$errors         = array();  	// array con los posibles errores
$data 			= array(); 		// array para enviar


// Devolver respuesta ===========================================================

	// Si hay errores devuelvo false con el error dado
		
		$data['errors']  = $errors;

        // Creo conexión
        $conn = new mysqli("$host:$port", $user, $dbpassword, $db);
        // Compruebo si hay errores
        if ($conn->connect_error) {
            die("Problema de conexión: " . $conn->connect_error);
        } 
        // Si quién llama es admin
        if($_SESSION['rol'] == 'admin'){
            // Realizo consulta
            $sql = "SELECT id, u.usuario, mensaje, mensaje_admin, d.nombre_departamento, fecha, estado, fecha_estado FROM incidencias, users u, departamentos d WHERE incidencias.id_usuario = u.id_usuario AND u.id_departamento = d.id_departamento ORDER BY id";
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
            // Si quién llama es el admin, recupero su id            
            $id = $_SESSION['id'];
            $sql = "SELECT id,  mensaje, mensaje_admin, fecha, estado, fecha_estado FROM incidencias WHERE id_usuario ='$id' ORDER BY id";
            // Realizo consulta
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
    // Devuelvo resultado con json
echo json_encode($data);
}
// Si no está seteada la sesión lo mando al index
else{
    header("location: ../index.php");
}

	
    