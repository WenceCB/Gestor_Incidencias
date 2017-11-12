$(document).ready(function(){
    var resultado;
    var posicion=[];
    var nombre_estado;
    var s_estado;
    var estado_a_cambiar;
    var parametros_post_ajax;
    var mensaje_alert;
  
     
    
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
               '<td>'+resultado.incidencia[i].usuario+'</td>'+
               '<td>'+resultado.incidencia[i].nombre_departamento+'</td>'+
               '<td>'+resultado.incidencia[i].fecha+'</td>'+
               '<td>'+nombre_estado+'</td>'+ 
               '<td>'+resultado.incidencia[i].fecha_estado+'</td>'+            
               '<td><button class="b_mensaje" id='+resultado.incidencia[i].id+'> Ver incidencia </button></td>'+               
               '</tr>'          
         
            ),            
            posicion[resultado.incidencia[i].id] = i;           
            
        };           
    
           $(".b_mensaje").click(function(){ 
               
              if($(this).hasClass('btn btn-primary btn-lg active')) {
                $(this).removeClass('btn btn-primary btn-lg active').text('Ver Incidencia');
                $('#contenedor_admin >').empty();
                $('#mensaje_incidencia').removeClass('alert alert-success');
                $('#mensaje_admin').removeClass('alert alert-success');
                
              
              }   
              else{
                $(".b_mensaje").removeClass('btn btn-primary btn-lg active').text('Ver Incidencia');
                $(this).addClass('btn btn-primary btn-lg active').text('Ocultar Incidencia'); 
                
                var id = this.id;
                
               
                $('#mensaje_incidencia >').remove();
                $('#mensaje_incidencia').addClass('alert alert-success').append(
                    '<h4 class="alert-heading">Incidencia</h4>'+
                    '<hr>'+
                    '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'+
                    
                    '<select class="s_estado custom-select" id="id_s_estado" name="estado"><option value="0">No realizada</option><option value="1">En progreso</option><option value="2">Realizada</option></select>'                            
                ),  
                $('#mensaje_admin >').remove();
                $('#mensaje_admin').addClass('alert alert-info').append(
                    '<h4 class="alert-heading">Comentario Admin</h4>'+
                    '<hr>'+
                    '<textarea class="form-control" rows="5" id="t_area_admin">'+resultado.incidencia[posicion[id]].mensaje_admin+'</textarea>'                 
                ),
                
                $('#controles >').remove();
                $('#controles').append(                   
                    '<button class="b_cambiar_estado btn btn-danger ">Cambiar Estado</button>'+
                    '<span id="mensaje_bd"></span>'
                    
                ),                          
                $(".b_cambiar_estado").click(function(){ 
                   // Comprobar si el estado que se va a pasar a la BD es el mismo que ya existía.
                    if (id_s_estado.value != resultado.incidencia[posicion[id]].estado || t_area_admin.value != resultado.incidencia[posicion[id]].mensaje_admin){
                        // Comprobar si el mensaje que le voy a pasar a la BD es el mismo o no, y en función creo una variable con unos parámetros u otros.
                       if (t_area_admin.text != resultado.incidencia[posicion[id]].mensaje_admin){
                           
                            parametros_post_ajax = {"id_bd" : id,"estado" : id_s_estado.value, "mensaje_admin" : t_area_admin.value};
                       }
                       else{
                            parametros_post_ajax = {"id_bd" : id,"estado" : id_s_estado.value}
                       }
                       
                        $.post("../clases/actualizar_incidencias.php", parametros_post_ajax,function(data){
                            
                            mensaje_alert = JSON.parse(data);

                            alert('El resultado de la operación es : '+ mensaje_alert.message);
                            $('#b_actualizar').trigger('click');                       
                            
                        });                                    
                    }
                    else{
                        alert('No voy a acceder a la BD para no cambiar NADA');                        
                    } 
                               
                    });  
              }                                    
          });
          
       });       
       event.preventDefault();
  }); 
 
