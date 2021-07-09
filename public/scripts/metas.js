$(document).ready(function(){
	$("#categoria").change(function(){
		$( "form" ).addClass("invisivel")
		$( "#bloco-"+ $(this).val() ).removeClass("invisivel")
	})

	$("#hospital").change(function(){
		var h = $(this).val()
		let paginaAtual = window.location.href
		let fragmentos = paginaAtual.split('?')

		fragmentos = fragmentos[0].split('/')
		// achar roh +1
		// window.location.href = fragmentos[4] + "?hospital="+h // roh
		window.location.href = fragmentos[5] + "?hospital="+h // PROJETOS/roh
	})

	// $("#hospital").change()
	$("#categoria").change()
})
