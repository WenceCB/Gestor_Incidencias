<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'usuario' )){
    header("location: ../index.php");
}
else{
    include('../html/header-user.html');
    ?>
    <h1>Bienvenido a tu zona de incidencias <?php  echo $_SESSION['usuario'] ?></h1>
    <form class="form-signin" id="form1" method="GET" action="">  
   
    
    <textarea class="form-control" id="t_incidencia" name ="t_incidencia" rows="5" placeholder="Aquí tu incidencia ..." autofocus></textarea>
    
    <br>
    
    <button name="Submit" id="b_enviar_incidencia" class="btn btn-lg btn-primary btn-block" disabled type="submit">Enviar Incidencia</button>

    <div id="message"></div>
    </form>   
    
    <h2>Mis Incidencias</h2>
    <table class="table table-hover" >
    
    <thead>
      
      <tr>
        <th scope="col">Id Tarea</th>      
        <th scope="col">Fecha</th>
        <th scope="col">Estado</th>
        <th scope="col">Fecha Cambio Estado</th>
  
      </tr>
    </thead>  
  
  <tbody id="tabla_incidencias">
  
  </tbody>  
  </table>
  <div id="contenedor_usuario">
    <div id="mensaje_incidencia"> 
    </div>
    <div id="mensaje_admin">  
    </div>
  </div>



<?php
include('../html/footer.html');
}
?>