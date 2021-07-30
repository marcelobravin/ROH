function validar (num, status)
{
	if ( status ) {
		$("li > i")[num].classList.add("verificado");
		return 1;
	} else {
		$("li > i")[num].classList.remove("verificado");
		return 0;
	}
}

// Verificação dos caracteres da nova senha

$("#senha1").on("input", function(){
	const elemento = $(this).val();
	var nivel_forca = 0;

	nivel_forca += validar(0, elemento.match(/[A-Z]/) );
	nivel_forca += validar(1, elemento.match(/[a-z]/) );
	nivel_forca += validar(2, elemento.match(/[0-9]/) );
	nivel_forca += validar(3, elemento.match(/[-!$%^&*()@_+|~=`{}\[\]:";'< ?,.\/]/) );
	nivel_forca += validar(4, elemento.length >= 8 );

	$(".barra-prog").css({"width": $(".verificado").length * 20 + "%"});

	var cor = "";
	switch (nivel_forca){
		case 1: cor = "#e62323";
			break;

		case 2: cor = "#ffc107";
			break;

		case 3: cor = "#ff5722";
			break;

		case 4: cor = "#a2d26b";
			break;

		case 5: cor = "#4bea51";
			break;
	}

	$(".barra-prog").css("background", cor);
})

// Efeito mostrar botão de enviar

$(document).ready(function(){
	if($("#senha1").val() != "" && $("#senha2").val() != ""){
		$(":submit").removeAttr("disabled");
		$(":submit").css("opacity", "1");
	}
	else{
		$(":submit").attr("disabled", "disabled");
		$(":submit").css("opacity", ".2");
	}
})

$("input").on("input", function(){
	if($("#senha1").val() != "" && $("#senha2").val() != "" && $(".verificado").length == 5){
		$(":submit").removeAttr("disabled");
		$(":submit").css("opacity", "1");
	}
	else{
		$(":submit").attr("disabled", "disabled");
		$(":submit").css("opacity", ".2");
	}
})

// Efeito botão revelar senha

$("label + i").on("click", function(){
	$(this).toggleClass("fa-eye-slash");
	$("#senha1, #senha2").attr("type") == "password"
		? $("#senha1, #senha2").attr("type", "text")
		: $("#senha1, #senha2").attr("type", "password");
})

// Verificar se as senhas são iguais ao clicar em enviar

$(":submit").on("click", function(event){
	if($("#senha1").val() != $("#senha2").val()){
		event.preventDefault();
		Swal.fire({
			icon: 'warning',
			title: 'Aviso!',
			text: 'As senhas precisam ser iguais!',
			showConfirmButton: true
		});
	}
})
