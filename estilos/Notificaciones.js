Notificar=0;
$(document).ready(function(){
    Senotifica();
	setInterval(function(){ contarvisitasTerminadas(); }, 10000);
        
    $(".alertas").click(function (){
        $(".alertas").css("-webkit-animation",""); 
        Push.clear();
        visitasTerminadas();
          $(this).blur();
    });
   $("#listo").click(function (){
         var visita= $("#idvisita").val();
          notificado(visita);
          contarvisitasTerminadas();
          $("#Modaldetallevisita").modal("hide");
          Push.close(visita);
          
    });
    
});


function notificacion(titulo,cuerpo,foto,id){
    Push.create(titulo,{
        body: cuerpo,
        icon: "../imagenesVisitantes/" + foto,
  tag:id,
       requireInteraction:true,
  onClick: function () {
           $("#txtComentario").val("");
          $('#modalComentarios').modal('hide');
           MostrarDetalleVisita(id)
         $("#listo").show("fast");
        $("#Modaldetallevisita").modal('show');
    }

    });
 
};

function visitasTerminadas(){
 if (Notificar==1){
	$.ajax({
        url: "../model/Visita.php?notificar=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
     
        
            for (var i = 0; i <= datos.length - 1; i++) {
             var cuerpo="Visitado: "+datos[i].vonombre+" "+datos[i].voapellido+"\n"+"Hora Salida: "+datos[i].HoraSalida;
           
                notificacion("Visitante: "+datos[i].venombre+" "+datos[i].veapellido,cuerpo,datos[i].foto,datos[i].Id);
          
            }
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
    }

}
function contarvisitasTerminadas(){
    if (Notificar==1){
	$.ajax({
        url: "../model/Visita.php?notificar=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
     
        if(datos.length==0){
             $("#aler").html("");
             $(".alertas").css("-webkit-animation",""); 
        }
            for (var i = 0; i <= datos.length - 1; i++) {
             
                    $("#aler").html(""+(i+1));
           $(".alertas").css("-webkit-animation"," tiembla 0.1s infinite")
                 
            }
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });

    }
}

function notificado(id) {
    

    $.ajax({
        url: "../model/Visita.php?notificado=si",
        dataType: "json",data:{
           id:id,
        },
        type: "post",
        success: function(datos) {
         $("#idvisita").val("");
           
        },
        error: function() {

            console.log('Something went wrong', status, err);

        }
    });
}

function Senotifica() {
    

    $.ajax({
        url: "../model/Parametros.php?notifica=si",
        dataType: "json",data:{
           id:id,
        },
        type: "post",
        success: function(datos) {
          
            if (datos==1){
                Notificar=1;
                $(".alertas").show("fast");
            }else{
                Notificar=0;
            }
           
        },
        error: function() {

            console.log('Something went wrong', status, err);

        }
    });
}