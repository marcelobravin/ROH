$(document).ready(function(){
	const hospitalId = findGetParameter("hospital")

	$("#categoria").change(function(){
		// $( ".aba" ).addClass("invisivel")
		$( ".aba" ).addClass("invisivel")
		// $( "#bloco-"+ $(this).val() ).removeClass("invisivel")
		$( "#bloco-"+ $(this).val() ).fadeIn()
		$( "#bloco-"+ $(this).val() ).removeClass("invisivel")


		if ( hospitalId != null ) {
			let fragmentos = location.href.split('?')
			let endereco = fragmentos[0]

			window.history.pushState("object or string", "Title", endereco + "?hospital="+ hospitalId +"&categoria="+$(this).val() )
		}
	})

	$("#hospital").change(function(){
		var h = $(this).val()
		let paginaAtual = window.location.href
		let fragmentos = paginaAtual.split('?')

		fragmentos = fragmentos[0].split('/')

		var indiceRaiz = localizarIndiceRaiz(fragmentos)

		window.location.href = fragmentos[indiceRaiz+1] + "?hospital="+h
	})

	if ( hospitalId != null )
		$("#categoria").change()

})

function findGetParameter(parameterName) {
	var result = null,
		tmp = [];
	location.search
		.substr(1)
		.split("&")
		.forEach(function (item) {
			tmp = item.split("=");
			if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
		});
	return result;
}

// Encontra diretorio do projeto
/* TODO verificar compatibilidade */
function localizarIndiceRaiz (fragmentos)
{
	return fragmentos.findIndex(function buscarIndice (value, idx) {
		if (value == "ROH") {
			return idx
		}
	})
}
