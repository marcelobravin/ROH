$(document).ready(function(){

	$("#mes").change(function(){
		var mes = $(this).val()
		let paginaAtual = window.location.href
		let fragmentos = paginaAtual.split('?')

		fragmentos = fragmentos[0].split('/')

		var indiceRaiz = localizarIndiceRaiz(fragmentos)

		const hospitalId = findGetParameter("hospital")
		window.location.href = fragmentos[indiceRaiz+1] + "?hospital="+hospitalId+"&mes="+mes
	})


	$("#hospital").change(function(){
		const hospitalSelecionado = $(this).val()
		const paginaAtual = window.location.href
		let fragmentos = paginaAtual.split('?')

		fragmentos = fragmentos[0].split('/')

		const indiceRaiz = localizarIndiceRaiz(fragmentos)

		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const uri = fragmentos[indiceRaiz+1] + "?hospital="+hospitalSelecionado

		console.log(urlParams);
		var x = ""
		urlParams.delete('hospital')
		urlParams.forEach(function(v, i){
			x += "&"+ i +"="+ v
		})

		window.location.href = uri+x
	})

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
