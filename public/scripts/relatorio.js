$(document).ready(function(){

	$("#mes").change(function(){
		var mes = $(this).val()
		let paginaAtual = window.location.href
		let fragmentos = paginaAtual.split('?')

		fragmentos = fragmentos[0].split('/')

		// Encontra diretorio do projeto
		/* verificar compatibilidade */
		var indiceRaiz = fragmentos.findIndex(function buscarIndice (value, idx) {
			if (value == "ROH") {
				return idx;
			}
		})

		const hospitalId = findGetParameter("hospital")
		window.location.href = fragmentos[indiceRaiz+1] + "?hospital="+hospitalId+"&mes="+mes
	})

});
