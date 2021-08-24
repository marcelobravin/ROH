/* <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> */
/* https://igorescobar.github.io/jQuery-Mask-Plugin/docs.html */
$(document).ready(function(){
	$( "#cnpj" ).keypress(function() {
		$(this).mask('00.000.000/0000-00');
	});

	$( "#cpf" ).keypress(function() {
		$(this).mask('000.000.000-00');
	});

	$( "#telefone" ).keypress(function() {
		$(this).mask('(00) 0000-0000');
	});

	$( "#cep" ).keypress(function() {
		$(this).mask('00000-000');
	});

	$( "#celular" ).keypress(function() {
		$(this).mask('(00) 0.0000-0000');
	});

	$( "#cnes" ).keypress(function() {
		$(this).mask('0000000');
	});



	$( ".padraoData" ).keypress(function() {
		$(this).mask('00/00/0000', { placeholder: "__/__/____" });
	});

	$( ".padraoTimestamp" ).keypress(function() {
		$(this).mask('00/00/0000 00:00:00');
	});

	$( ".padraoFloat" ).keypress(function() {
		$(this).mask('#.##0,00' , { reverse:true, selectOnFocus: true});
	});


	$("#cnpj, #cpf, #telefone, #cep, #celular, #cnes, .padraoData, .padraoTimestamp, .padraoFloat").trigger("keypress");
});
