$(document).ready(function(){

	$("[type='number']:not(:disabled)").on("keyup change", function(){
		verificarMeta( $(this) )
	})

	$(".salvar").click( async function(){
		let mensagem = "Deseja realizar o registro permanente dos dados preenchidos?"
		mensagem += "\n\nAVISO"
		mensagem += "\nOs dados não poderão ser alterados após a execução desse processo!"

		if( !confirm(mensagem) ) {
			return false
		}

		const parametros = prepararParametros()
		if ( parametros == "" ) {
			alert("Nenhuma alteração!") // TODO desabilitar botão
			return false
		}

		if ( await requisicaoAjax(parametros) ) {
			$('#ajaxLoader').fadeOut(function(){
				// document.location.reload()
			})
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

	return {
		metas: parametros,
		data: {
			dia: $("#dia").val(),
			mes: $("#mes").val(),
			ano: $("#ano").val()
		}
	}
}

function requisicaoAjax (parametros)
{
	return new Promise((resolve, reject)=>{
		$.ajax({
			type	: 'POST',
			url		: 'app/Controller/AlterTarget.php?requisicaoAjax',
			dataType: 'json',
			data	: { form: parametros },
			beforeSend: function(xhr) {
				$("body").append('<div id="ajaxLoader"></div>')
			},
			success: data =>{
				resolve(true)
				console.log(parametros);
			},
			error: erro =>{
				reject(erro)

				const pattern = /^\<h1 \>Sessão expirada\!\<\/h1\>/i
				const result = pattern.test( erro.responseText )

				if (result === true) {
					alert("Sessão expirada!\n\nPor gentileza, efetue login novamente.")
					document.location.reload()
				}

				$('#ajaxLoader').fadeOut(function(){
					$('#ajaxLoader').remove()
				})
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
		$("#justificativa-" +id).attr("disabled", "disabled").val("")
		$this.parent().parent().removeClass("insuficiente")
	}
}
