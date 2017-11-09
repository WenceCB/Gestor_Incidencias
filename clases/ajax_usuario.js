$(document).ready(function(){ 
  var mensaje;
  var id;
  var resultado;
  var posicion=[];
  // Muestro incidencias que tenga el usuario
  console.log('Voy a entrar');
  $('#tabla_incidencias > tr').remove(); 
  $.get("../clases/ver_incidencias.php", function(data, status, dataType){           
   console.log('aqui');
     resultado = JSON.parse(data); 
     console.log(resultado);         
     for (i=0;i<resultado.incidencia.length;i++){               
         if (resultado.incidencia[i].estado == '0'){
             nombre_estado = 'No realizada';                  
         }
         else if(resultado.incidencia[i].estado == '1'){
           nombre_estado = 'En progreso';
         }
         else{
           nombre_estado = 'Realizada'
         }
      $('#tabla_incidencias').append(             
        '<tr>'+
        '<th scope ="row">'+resultado.incidencia[i].id+'</th>'+       
        '<td>'+resultado.incidencia[i].fecha+'</td>'+
        '<td>'+nombre_estado+'</td>'+ 
        '<td>'+resultado.incidencia[i].fecha_estado+'</td>'+            
        '<td><button class="b_mensaje" id='+resultado.incidencia[i].id+'> Ver incidencia </button></td>'+               
        '</tr>'         
    
       ),              
        posicion[resultado.incidencia[i].id] = i;   
    };           
    
           $(".b_mensaje").click(function(){              
            $(".b_mensaje").removeClass('btn btn-primary btn-lg active').text('Ver Incidencia');;  
            $(this).addClass('btn btn-primary btn-lg active').text('Ocultar Incidencia'); 
           
            var id = this.id;
            
            $('#mensaje_incidencia >').remove();
            $('#mensaje_incidencia').addClass('alert alert-success').append(
                '<h4 class="alert-heading"> Mi Incidencia</h4>'+
                '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'                 
            );
            $('#mensaje_admin >').remove();
            $('#mensaje_admin').addClass('alert alert-danger').append(
                '<h4 class="alert-heading">Comentario Admin</h4>'+
                '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'                 
            );                          
          });
          
       });       
       event.preventDefault();
  
 
});