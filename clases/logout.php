<?php
// Establezco la sesión para destruir las variables y redirigir al index
session_start();
session_destroy();
header('Location: ../index.php');
?>