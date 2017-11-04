$(document).ready(function(){
    var resultado;
    var posicion=[];
  
    $("#b_actualizar").click(function(){  

        $('#mensaje_incidencia').removeClass('alert alert-success')
        $('#mensaje_incidencia >').remove();

        $('#tabla_incidencias > tr').remove(); 
       $.get("../clases/ver_incidencias.php", function(data, status, dataType){           
        
          resultado = JSON.parse(data);          
          for (i=0;i<resultado.incidencia.length;i++){
           $('#tabla_incidencias').append(             
               '<tr>'+
               '<th scope ="row">'+resultado.incidencia[i].id+'</th>'+
               '<td>'+resultado.incidencia[i].id_usuario+'</td>'+
               '<td>'+resultado.incidencia[i].departamento+'</td>'+
               '<td>'+resultado.incidencia[i].fecha+'</td>'+               
               '<td><button class="b_mensaje" id='+resultado.incidencia[i].id+'> Ver incidencia </button></td>'+               
               '</tr>'          
         
            ),  posicion[resultado.incidencia[i].id] = i};           

           $(".b_mensaje").click(function(){              
            $(".b_mensaje").removeClass('btn btn-primary btn-lg active').text('Ver Incidencia');;  
            $(this).addClass('btn btn-primary btn-lg active').text('Ocultar Incidencia'); 
           
            var id = this.id;
            $('#mensaje_incidencia >').remove();
            $('#mensaje_incidencia').addClass('alert alert-success').append(
                '<h4 class="alert-heading">Incidencia</h4>'+
                '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'               
            )            
          });
       });       
       event.preventDefault();
  });
  
});