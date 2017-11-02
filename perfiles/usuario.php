<?php
session_start();
if(!isset($_SESSION['usuario']) || (($_SESSION['usuario'])!= 'usuario' )){
    header("location: ../index.php");
}
else{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php 
    echo "hola User";
    ?>
</body>
</html>
<?php
}
?>