$(document).ready(function(){
    var resultado;
    var posicion=[];
    var nombre_estado;
    var s_estado;
    var estado_a_cambiar;
  
    $("#b_actualizar").click(function(){        

        $('#mensaje_incidencia').removeClass('alert alert-success')
        $('#mensaje_incidencia >').remove();

        $('#tabla_incidencias > tr').remove(); 
       $.get("../clases/ver_incidencias.php", function(data, status, dataType){           
        
          resultado = JSON.parse(data);          
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
               '<td>'+resultado.incidencia[i].id_usuario+'</td>'+
               '<td>'+resultado.incidencia[i].departamento+'</td>'+
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
                '<h4 class="alert-heading">Incidencia</h4>'+
                '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'+
                '<select class="s_estado" id="id_s_estado" name="estado"><option value="0">No realizada</option><option value="1">En progreso</option><option value="2">Realizada</option></select>'+
                '<button class="b_cambiar_estado">Cambiar Estado</button>'   
            ),  
            $(".b_cambiar_estado").click(function(){                
                console.log('el id',id);
              
                
                console.log('lo que tiene que haber en la BD es',resultado.incidencia[posicion[id]].estado);
                console.log('lo que yo quiero poner', id_s_estado.value);
                if (id_s_estado.value != resultado.incidencia[posicion[id]].estado){
                    
                    $.post("../clases/actualizar_incidencias.php", {"id_bd" : id,"estado" : id_s_estado.value},function(data){  
                        // Refrescar para volver a actualizar
                    });                                    
                } 
                               
                });                        
          });
          
       });       
       event.preventDefault();
  }); 
 
});