$(document).ready(function(){
	$("#categoria").change(function(){
		$( ".aba" ).addClass("invisivel")
		$( "#bloco-"+ $(this).val() ).fadeIn()
		$( "#bloco-"+ $(this).val() ).removeClass("invisivel")
	})

	$("#hospital").change(function(){
		const queryParams = substituirParametro ('hospital', $(this).val())
		encaminhar(queryParams)
	})

	if ( $("#hospital").val() != "" ) {
		$("#categoria").trigger("change")
	}
})
