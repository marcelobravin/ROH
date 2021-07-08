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
		window.location.href = fragmentos[4] + "?hospital="+h
		// window.location.href = "metas.php?hospital="+h
    })

	// $("#hospital").change()
    $("#categoria").change()
})
