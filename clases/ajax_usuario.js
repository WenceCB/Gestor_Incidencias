$(document).ready(function(){ 
  // Declaración de variables
  var mensaje;
  var id;
  var resultado;
  var posicion=[];
  var mensaje_alert;
  // Muestro incidencias que tenga el usuario

  // Inicializo elementos a mostrar
  $('#tabla_incidencias > tr').remove(); 
    // LLamada a AJAX
  $.get("../clases/ver_incidencias.php", function(data, status, dataType){           
    // Formateo el resultado obtenido
     resultado = JSON.parse(data); 
        // Recorro elementos       
     for (i=0;i<resultado.incidencia.length;i++){    
            // Formateo en pantalla depediendo del valor obtenido en la consulta           
         if (resultado.incidencia[i].estado == '0'){
             nombre_estado = 'No realizada';                  
         }
         else if(resultado.incidencia[i].estado == '1'){
           nombre_estado = 'En progreso';
         }
         else{
           nombre_estado = 'Realizada'
         }
         // A la tabla incidencias le añado los elementos con lo obtenido en la BD
      $('#tabla_incidencias').append(             
        '<tr>'+
        '<th scope ="row">'+resultado.incidencia[i].id+'</th>'+       
        '<td>'+resultado.incidencia[i].fecha+'</td>'+
        '<td>'+nombre_estado+'</td>'+ 
        '<td>'+resultado.incidencia[i].fecha_estado+'</td>'+            
        '<td><button class="b_mensaje" id='+resultado.incidencia[i].id+'> Ver incidencia </button></td>'+               
        '</tr>'         
    
       ),
       // Guardo la posición actual en una variable para poder saber la posición cuando acceda fuera del bucle              
        posicion[resultado.incidencia[i].id] = i;   
    };           
        // Cuando se haga click compruebo en qué estado está el botón para mostrar una determinada cosa u ocultarla
           $(".b_mensaje").click(function(){
            // Alterno entre mostrar incidencia u ocultar    
            if($(this).hasClass('btn btn-primary btn-lg active')) {          
                $(this).removeClass('btn btn-primary btn-lg active').text('Ver Mi Incidencia');
                $('#contenedor_usuario >').empty();
                $('#mensaje_incidencia').removeClass('alert alert-success');
                $('#mensaje_admin').removeClass('alert alert-success');
            }
            else{
                // Si pulso en mostrar la incidencia
                $(".b_mensaje").removeClass('btn btn-primary btn-lg active').text('Ver Mi Incidencia');
                $(this).addClass('btn btn-primary btn-lg active').text('Ocultar Mi Incidencia'); 
                // Recupero id
                var id = this.id;
                // Formateo mensaje de la incidencia puesta y de los comentarios del admin
                $('#mensaje_incidencia >').remove();
                $('#mensaje_incidencia').addClass('alert alert-success').append(
                    '<h4 class="alert-heading"> Mi Incidencia</h4>'+
                    '<hr>'+
                    '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'                 
                );
                $('#mensaje_admin >').remove();
                $('#mensaje_admin').addClass('alert alert-danger').append(
                    '<h4 class="alert-heading">Comentario Admin</h4>'+
                    '<hr>'+
                    '<p>'+resultado.incidencia[posicion[id]].mensaje_admin+'</p>'                 
                ); 
             }                         
          });         
       }); 
    // Controlo que el botón de enviar incidencia se active solo cuando hay texto en él   
    $("#t_incidencia").on("keyup",function(){
        // Si no hay texto se deshabilita
        if($('#t_incidencia').val() == ''){
            $('#b_enviar_incidencia').prop("disabled",true);
            
        }
        // Si hay texto se activa
        else{
            $('#b_enviar_incidencia').prop("disabled",false);
        }        
    });
        // Recuperar incidencias y grabar  datos de sessión para el post
        $("#b_enviar_incidencia").click(function(){       
            // Creo el json con los datos a pasar
             var datos={
                 'mensaje' 	: $('textarea[name=t_incidencia]').val()
             }; 
             // LLamo a Ajax pasando unos parámetros por POST       
             $.post("../clases/actualizar_incidencias.php",datos,function(data){  
                 // Formateo el mensaje del alert
                 mensaje_alert = JSON.parse(data);
                 alert('El resultado de la operación es : '+ mensaje_alert.message);                                       
             });            
        });     
       
});