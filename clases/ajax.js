$(document).ready(function(){
     $("#b_actualizar").click(function(){  
        
        $.get("../clases/ver_incidencias.php", function(data, status, dataType){     
           
           
           //console.log(JSON.parse(data));
           var resultado = JSON.parse(data);          
           for (i=0;i<resultado.incidencia.length;i++){
            $('#form1').append('<div class="alert alert-success" id="'+resultado.incidencia[i].id+'">' + resultado.incidencia[i].mensaje + '</div>');
               console.log(resultado.incidencia[i].id);
           }
        });
        event.preventDefault();
   });
});