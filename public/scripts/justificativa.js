$(document).ready(function(){

	$(".salvar").click( async function(){
		let mensagem = "Deseja realizar o registro permanente dos dados preenchidos?"
		mensagem += "\n\nAVISO"
		mensagem += "\nOs dados não poderão ser alterados após a execução desse processo!"

		if( !confirm(mensagem) ) {
			return false
		}

		const parametros = prepararParametros()
		console.log(parametros);

		if ( await requisicaoAjax(parametros) ) {
			$('#ajaxLoader').remove()
		}
	})

})

function prepararParametros ()
{
	const inputs = $("form").find("input:not(:disabled)")

	var parametros = []

	for (let index = 0; index < inputs.length; index++) {
		const i = inputs[index]

		let metaId = i["id"].split("-")
		metaId = metaId[1]
		const t = $("#justificativa-"+metaId)

		if ( i["value"] != "" ) {
			if ( t.val() == "" ) {
				parametros.push( {metaId: metaId, resultado: i["value"]} )
			} else {
				parametros.push( {metaId: metaId, resultado: i["value"], justificativa: t.val()} )
			}
		}
	}

	return parametros
}

function requisicaoAjax (parametros)
{
	console.log(parametros);
	return new Promise((resolve, reject)=>{
		$.ajax({
			type	: 'POST',
			url		: 'app/Controller/AcceptJustification.php',
			dataType: 'json',
			data	: { form: parametros },
			beforeSend: function(xhr) {
				$("body").append('<div id="ajaxLoader"></div>')
			},
			success: data =>{
				resolve(true)
				localStorage.clear()
				// document.location.reload()
			},
			error: erro =>{
				reject(erro)

				const pattern = /^\<h1 \>Sessão expirada\!\<\/h1\>/i
				const result = pattern.test( erro.responseText )

				if (result === true) {
					alert("Sessão expirada!\n\nPor gentileza, efetue login novamente.")
					document.location.reload()
				}
			}
		})
	})
}

function verificarMeta ($this)
{
	const id = $this.data("id")

	if ( $this.val()!="" && $this.val() < $this.data("meta") ) {
		$("#justificativa-" +id).removeAttr("disabled")
		$this.parent().parent().addClass("insuficiente")

	} else {
		$("#justificativa-" +id).attr("disabled", "disabled")
		$this.parent().parent().removeClass("insuficiente")
	}
}
