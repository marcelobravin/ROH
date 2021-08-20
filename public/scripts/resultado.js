$(document).ready(function(){
	exibirLocalStorage()

	$("[type='number']:not(:disabled)").on("keyup change", function(){
		verificarMeta( $(this) )
	})

	$(".salvarTemporariamente").click(function(){
		const tableRow = $(this).parent()
		const inputs = tableRow.find("input:not(:disabled)")
		const texts = tableRow.find("textarea:not(:disabled)")

		adicionarLS (inputs)
		adicionarLS (texts)

		alert("Os dados inseridos foram salvos em caráter temporário!")
		return false

		function adicionarLS (objs)
		{
			for (let index=0; index<objs.length; index++) {
				const obj = objs[index]

				if ( obj["value"] != "" ) {
					localStorage.setItem( obj["id"], obj["value"] )
				}
			}
		}
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
			$('#ajaxLoader').remove()

			const url = new URL(window.location.href);
			const h_id = url.searchParams.get("hospital");

			window.location.href = "comprovante.php?hospital="+h_id
		}
	})
})

function exibirLocalStorage ()
{
	for (var i=0; i<localStorage.length; i++) {
		const idLS = localStorage.key(i)

		if (idLS != "") {
			const valor = localStorage.getItem(idLS)

			if ( !/^leitos-/.test(idLS) && !/^justificativa-/.test(idLS) ) {
				localStorage.clear()
				return false
			}

			$( "#"+idLS ).val( valor )

			if ( $("#"+idLS).is( "input" ) ) {
				$( "#"+idLS ).focus()
				verificarMeta( $("#"+idLS) )
			}
		}
	}
}

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

	return parametros;
}

function requisicaoAjax (parametros)
{
	return new Promise((resolve, reject)=>{
		$.ajax({
			type	: 'POST',
			url		: 'app/Controller/FillTarget.php?requisicaoAjax',
			dataType: 'json',
			data	: { form: parametros },
			beforeSend: function(xhr) {
				$("body").append('<div id="ajaxLoader"></div>')
			},
			success: data =>{
				resolve(true)
				localStorage.clear()
				document.location.reload()
			},
			error: erro =>{
				reject(erro)

				const pattern = /^\<h1 \>Sessão expirada\!\<\/h1\>/i
				const result = pattern.test( erro.responseText )

				if (result === true) {
					alert("Sessão expirada!\n\nPor gentileza, efetue login novamente.")
					document.location.reload()
				}

				$('#ajaxLoader').remove()
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
