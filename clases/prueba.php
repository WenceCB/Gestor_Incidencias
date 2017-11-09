<?php   
session_start();
$a;
if ($_POST['mensaje']==''){
    echo 'no hay nada escrito';
    echo $_POST['mensaje'];
}
else{
    echo 'si hay ';
    echo $_POST['mensaje'];
    


}


?>