$(document).ready(function() {

	function limpa_formulário_cep() {
		// Limpa valores do formulário de cep.
		$("#rua").val("");
		$("#bairro").val("");
		$("#cidade").val("");
		$("#uf").val("");
		$("#ibge").val("");
	}

	//Quando o campo cep perde o foco.
	$("#cep").keyup(function() {

		var cep = $(this).val().replace(/\D/g, '');

		if (cep != "") {

			var validacep = /^[0-9]{8}$/;

			if( validacep.test(cep) ) {

				$("#endereco").val("...");
				$("#bairro").val("...");
				$("#cidade").val("...");
				$("#uf").val("...");
				$("#ibge").val("...");

				$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

					if ( !("erro" in dados) ) {
						$("#endereco").val(dados.logradouro);
						$("#bairro").val(dados.bairro);
						$("#cidade").val(dados.localidade);
						$("#uf").val(dados.uf);
						// $("#uf").find('option[text="'+ dados.uf +'"]').attr('selected','selected');
						$("#ibge").val(dados.ibge);
					} else {
						limpa_formulário_cep();
						alert("CEP não encontrado.");
					}
				});
			} else {
				limpa_formulário_cep();
				// alert("Formato de CEP inválido.");
			}
		} else {
			//cep sem valor, limpa formulário.
			limpa_formulário_cep();
		}
	});
});
