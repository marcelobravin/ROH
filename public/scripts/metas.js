$(document).ready(function(){
	const hospitalId = findGetParameter("hospital")

	$("#categoria").change(function(){
		$( "form" ).addClass("invisivel")
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
		// achar roh +1
		window.location.href = fragmentos[4] + "?hospital="+h // roh
		// window.location.href = fragmentos[5] + "?hospital="+h // PROJETOS/roh
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
