
$(document).ready(function(){

    //Forma de ler os IDs do DOM HTML Via JQuery
    $("#menuCarros, #menuSlides, #menuUsuario, #menuLogoff").css("visibility", "hidden");

    //Abaixo temos as configurações de MouseOver e MoudeOut para Cada Botão e Cada Div que e o DropDown
    //Oque esta abaixo controla os codigos das DIVs
    //Oque esta abaixo controla os codigos das ANCORAS OU <a>
    // MOUSE OVER - JS
     $("#menuCarros").mouseover(function(){
        $(this).css("visibility", "visible");
        $("#mostraMenuCarros").css("border-radius", "5px 5px 0px 0px");
     });
     $("#menuCarros").mouseout(function(){
        $(this).css("visibility", "hidden");
        $("#mostraMenuCarros").css("border-radius", "5px");
     });
     //
     $("#mostraMenuCarros").mouseover(function(){
        $("#menuCarros").css("visibility", "visible");
        $("#mostraMenuCarros").css("border-radius", "5px 5px 0px 0px");
     });
     $("#mostraMenuCarros").mouseout(function(){
        $("#menuCarros").css("visibility", "hidden");
        $("#mostraMenuCarros").css("border-radius", "5px");
     });
     //
     $("#menuSlides").mouseover(function(){
        $(this).css("visibility", "visible");  
        $("#mostraMenuSlides").css("border-radius", "5px 5px 0px 0px");
     });
     $("#menuSlides").mouseout(function(){
        $(this).css("visibility", "hidden");
        $("#mostraMenuSlides").css("border-radius", "5px");
     });           
     $("#mostraMenuSlides").mouseover(function(){
        $("#menuSlides").css("visibility", "visible");
        $("#mostraMenuSlides").css("border-radius", "5px 5px 0px 0px");
     });
     $("#mostraMenuSlides").mouseout(function(){
        $("#menuSlides").css("visibility", "hidden");
        $("#mostraMenuSlides").css("border-radius", "5px"); 
     });
     //
     $("#menuUsuario").mouseover(function(){
        $(this).css("visibility", "visible");  
        $("#mostraMenuUsuario").css("border-radius", "5px 5px 0px 0px");
     });
     $("#menuUsuario").mouseout(function(){
        $(this).css("visibility", "hidden");
        $("#mostraMenuUsuario").css("border-radius", "5px");
     }); 
     $("#mostraMenuUsuario").mouseover(function(){
        $("#menuUsuario").css("visibility", "visible");
        $("#mostraMenuUsuario").css("border-radius", "5px 5px 0px 0px");
     });
     $("#mostraMenuUsuario").mouseout(function(){
        $("#menuUsuario").css("visibility", "hidden");
        $("#mostraMenuUsuario").css("border-radius", "5px"); 
     });     
     //
     $("#menuLogoff").mouseover(function(){
        $(this).css("visibility", "visible");  
        $("#mostraMenuLogoff").css("border-radius", "5px 5px 0px 0px");
     });
     $("#menuLogoff").mouseout(function(){
        $(this).css("visibility", "hidden");
        $("#mostraMenuLogoff").css("border-radius", "5px");
     });

     $("#mostraMenuLogoff").mouseover(function(){
        $("#menuLogoff").css("visibility", "visible");
        $("#mostraMenuLogoff").css("border-radius", "5px 5px 0px 0px");
     });
     $("#mostraMenuLogoff").mouseout(function(){
        $("#menuLogoff").css("visibility", "hidden");
        $("#mostraMenuLogoff").css("border-radius", "5px");
     });
 });

 /*
 $(document).ready(function(){
    $("#menuCarros").css("visibility", "hidden");

    $("#mostraMenuCarros").mouseover(function(){
        $(this).css("border-radius", "5px 5px 0px 0px");
        $("#menuCarros").css("visibility","visible");
    });

    $("#mostraMenuCarros").mouseout(function(){
        $(this).css("border-radius", "5px");
        $("#menuCarros").css("visibility", "hidden");
    });

    $("#menuCarros").mouseover(function(){
        $(this).css("visibility","visible");
        $("#mostraMenuCarros").css("border-radius", "5px 5px 0px 0px");
    });

    $("#menuCarros").mouseout(function(){
        $(this).css("visibility", "hidden");
        $("#mostraMenuCarros").css("border-radius", "5px");
    });
 });
*/







