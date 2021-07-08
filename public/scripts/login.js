// Efeito mostrar botão de enviar

$(document).ready(function(){
    if($("#login").val() != "" && $("#senha").val() != ""){
        $(":submit").removeAttr("disabled");
        $(":submit").css("opacity", "1");
    }
    else{
        $(":submit").attr("disabled", "disabled");
        $(":submit").css("opacity", ".2");
    }
})

$("input").on("input", function(){
    if ($("#login").val() != "" && $("#senha").val() != "") {
        $(":submit").removeAttr("disabled");
        $(":submit").css("opacity", "1");
    } else {
        $(":submit").attr("disabled", "disabled");
        $(":submit").css("opacity", ".2");
    }
})

// Efeito botão revelar senha

$("label + i").on("click", function(){
    $(this).toggleClass("fa-eye-slash");
    $("#senha").attr("type") == "password"
		? $("#senha").attr("type", "text")
		: $("#senha").attr("type", "password");
})

// Efeito Parallax

$(window).mousemove(function(event){
    let posicaoX = event.pageX * 0.005;
    let posicaoY = event.pageY * 0.005;
    $("body").css({"background-position-x": posicaoX, "background-position-y": posicaoY});
})
