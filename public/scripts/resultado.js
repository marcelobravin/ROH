$(document).ready(function(){
	exibirLocalStorage()

	// $(".sucesso, .erro").click(function(){
	// 	$(this).slideToggle('slow')
	// })

	$("[type='text']:not(:disabled)").on("keyup change", function(){
		verificarMeta( $(this) )
	})

	$(".salvarTemporariamente").click(function(){
		const x = $(this).parent()
		const inputs = x.find("input:not(:disabled)")
		const texts = x.find("textarea:not(:disabled)")

		for (let index=0; index<inputs.length; index++) {
			const t = texts[index];
			const i = inputs[index];

			if ( i["value"] != "" ) {
				localStorage.setItem( i["id"], i["value"] )

				if ( typeof t != 'undefined' && t["value"] != "" ) {
					localStorage.setItem( t["id"], t["value"] )
				}
			}
		}

		alert("Os dados inseridos foram salvos em caráter temporário!")
		return false
	})


	$(".salvar").click( async function(){
		let mensagem = "Deseja realizar o registro permanente dos dados preenchidos?";
		mensagem += "\n\nAVISO";
		mensagem += "\nOs dados não poderão ser alterados após a execução desse processo!";

		if( !confirm(mensagem) ) {
			return false;
		}

		const parametros = prepararParametros()
		console.log(parametros);

		if ( await requisicaoAjax(parametros) ) {
			$('#ajaxLoader').remove()
		}
	})

})

function exibirLocalStorage ()
{
	// for (var i=localStorage.length; i>0; i--) {
		// console.log(i-1);
	for (var i=0; i<localStorage.length; i++) {
		const idLS = localStorage.key(i)

		if (idLS != "") {
			const valor = localStorage.getItem(idLS)

			// console.log(idLS);
			// console.log(valor);
			// console.log("ffffff");
			$( "#"+idLS ).val( valor )
			$( "#"+idLS ).focus()

			console.log( $("#"+idLS).is( "input" ));
			if ( $("#"+idLS).is( "input" ) ) {
				verificarMeta( $("#"+idLS) )
			}
		}
	}
}

function prepararParametros ()
{
	const inputs = $("form").find("input:not(:disabled)")

	var parametros = []
	for ( const [index] of inputs.entries() ) {
	// for (let index = 0; index < inputs.length; index++) {
		const i = inputs[index];

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

function requisicaoAjax(parametros)
{
	return new Promise((resolve, reject)=>{
		$.ajax({
			type	: 'POST',
			url		: 'app/Controller/FillTarget.php',
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

				const pattern = /^Você será redirecionado/i; // TODO verificar
				const result = pattern.test( erro.responseText );

				if (result === true) {
					alert("Sessão expirada!\n\nPor gentileza, efetue login novamente.");
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
