$(document).ready(function() {

	function limpa_formulário_cep() {
		$("#rua").val("");
		$("#bairro").val("");
		$("#cidade").val("");
		$("#uf").val("");
		$("#ibge").val("");
	}

	$("#cep").keyup(function() {

		var cep = $(this).val().replace(/\D/g, ''); // remove caracteres não numéricos

		if (cep == "") {
			limpa_formulário_cep();

		} else {

			if ( /^[0-9]{8}$/.test(cep) ) {

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
						$("#ibge").val(dados.ibge);
					} else {
						limpa_formulário_cep();
						alert("CEP não encontrado.");
					}
				});
			} else {
				limpa_formulário_cep();
			}
		}
	});
});
