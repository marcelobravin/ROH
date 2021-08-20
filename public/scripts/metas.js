$(document).ready(function(){
	$("#categoria").change(function(){
		const $this = $(this)
		$( ".aba" ).addClass("invisivel")
		$( "#bloco-"+ $this.val() ).fadeIn()
		$( "#bloco-"+ $this.val() ).removeClass("invisivel")

		substituirParametro('categoria', $this.val())
	})

	$("#hospital").change(function(){
		const queryParams = substituirParametro('hospital', $(this).val())
		encaminhar(queryParams)
	})

	if ( $("#hospital").val() != "" ) {
		$("#categoria").trigger("change")
	}
})

function atualizarUrl (parametro, valor)
{
	const server = window.location.origin
	const path = window.location.pathname
	const queryParams = substituirParametro(parametro, valor)

	window.history.pushState("object or string", "Title", server + path +'?'+ queryParams);
}
