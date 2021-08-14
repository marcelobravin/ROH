function encaminhar (queryParams)
{
	const server = window.location.origin // http://localhost
	const path = window.location.pathname // /PROJETOS/roh/relatorio.php
	window.location.href = server + path +'?'+ queryParams
}

function substituirParametro (nome, valor)
{
	const queryString = window.location.search // "?hospital=3&mes=3"
	const urlParams = new URLSearchParams(queryString);

	urlParams.delete(nome)

	var queryParams = nome+"="+valor
	urlParams.forEach(function(v, i){
		queryParams += "&"+ i +"="+ v
	})
	return queryParams
}
