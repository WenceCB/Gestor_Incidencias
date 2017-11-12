<?php
session_start();
if(!isset($_SESSION['rol']) || (($_SESSION['rol'])!= 'admin' )){
    header("location: ../index.php");
}
else{
    include('../html/header-admin.html');
    ?>

   
    <form class="form-signin" id="form1" method="GET" action="">     
       
        <button name="actualizar" id="b_actualizar" class="btn btn-lg btn-primary btn-block" type="submit">Ver Incidencias</button>
	    <!-- <a href="alta.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create nuevo usuario</a> -->

    </form>
    <table class="table table-hover" >
  
  <thead>
    
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Departamento</th>
      <th scope="col">Fecha</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha Cambio Estado</th>

    </tr>
  </thead>  

<tbody id="tabla_incidencias">

</tbody>  
</table>
<div id="contenedor_admin">
  <div id="mensaje_incidencia"> 
  </div>
  <div id="mensaje_admin">  
  </div>
  <div id="controles">    
  </div> 
</div>


<?php
include('../html/footer.html');
}
?>