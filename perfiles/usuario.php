<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'usuario' )){
    header("location: ../index.php");
}
else{
    include('../html/header-user.html');
    ?>     
    <form  id="form1" method="GET" action="">  
      <div class="form-group">
        <br>
        <textarea class="form-control" id="t_incidencia" name ="t_incidencia" rows="5" placeholder="Aquí tu incidencia ..." autofocus></textarea>    
        <br>      
        <button name="Submit" id="b_enviar_incidencia" class="btn btn-lg btn-primary btn-block" disabled type="submit">Enviar Incidencia</button>
      </div>
      <div id="message"></div>
    </form> 

    <div class="card-header text-center">
      <h2>Mis Incidencias</h2>
    </div>
      <!-- Formateo de tabla -->
    <table class="table table-hover text-center" >    
      <thead>      
        <tr>
          <th scope="col">Id Tarea</th>      
          <th scope="col">Fecha de Envío</th>
          <th scope="col">Estado</th>
          <th scope="col">Fecha Cambio Estado</th>  
        </tr>
      </thead> 
      <tbody id="tabla_incidencias">  
      </tbody>  
  </table>
  <!-- Div para mostrar los mensajes de la incidencias -->
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