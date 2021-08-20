// Efeito mostrar botão de enviar
$(document).ready(function(){
	verificarLogin()

	$("input").on("input", function(){
		verificarLogin()
	})
})

function verificarLogin ()
{
	if($("#login").val() != "" && $("#senha").val() != ""){
		$(":submit").removeAttr("disabled");
		$(":submit").css("opacity", "1");
	} else {
		$(":submit").attr("disabled", "disabled");
		$(":submit").css("opacity", "0");
	}
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
