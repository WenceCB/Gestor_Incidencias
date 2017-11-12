$(document).ready(function(){ 
  var mensaje;
  var id;
  var resultado;
  var posicion=[];
  // Muestro incidencias que tenga el usuario

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
                $(this).removeClass('btn btn-primary btn-lg active').text('Ver Mi Incidencia');
                $('#contenedor_usuario >').empty();
                $('#mensaje_incidencia').removeClass('alert alert-success');
                $('#mensaje_admin').removeClass('alert alert-success');
            }
            else{
                $(".b_mensaje").removeClass('btn btn-primary btn-lg active').text('Ver Mi Incidencia');
                $(this).addClass('btn btn-primary btn-lg active').text('Ocultar Mi Incidencia'); 
            
                var id = this.id;
                
                $('#mensaje_incidencia >').remove();
                $('#mensaje_incidencia').addClass('alert alert-success').append(
                    '<h4 class="alert-heading"> Mi Incidencia</h4>'+
                    '<p>'+resultado.incidencia[posicion[id]].mensaje+'</p>'                 
                );
                $('#mensaje_admin >').remove();
                $('#mensaje_admin').addClass('alert alert-danger').append(
                    '<h4 class="alert-heading">Comentario Admin</h4>'+
                    '<p>'+resultado.incidencia[posicion[id]].mensaje_admin+'</p>'                 
                ); 
             }                         
          });         
       }); 
       
    $("#t_incidencia").on("keyup",function(){
        
        if($('#t_incidencia').val() == ''){
            $('#b_enviar_incidencia').prop("disabled",true);
            
        }
        else{
            $('#b_enviar_incidencia').prop("disabled",false);
        }        
    });
        // Recuperar incidencias y grabar  datos de sessión para el post
        $("#b_enviar_incidencia").click(function(){       
            console.log('entro');
             var datos={
                 'mensaje' 	: $('textarea[name=t_incidencia]').val()
             };        
             $.post("../clases/actualizar_incidencias.php",datos,function(data){  
                 
             });            
        });     
       
});