<div class="container">
	<h2>Cadastro</h2>

	<form action="app/Controller/RegisterController-<?php echo MODULO ?>.php" method="post">

		<?php
			if ( PRODUCAO ) {
				require 'public/views/forms/'.MODULO.'-insercao.html'; #---------- prod
			} else {
				require '_arquivos_auto_gerados/views/'.MODULO.'-insercao.html'; #  dev
			}
		?>

		<input type="submit" value="CADASTRAR" />
	</form>
</div>

<script src="public/vendors/jquery.mask.min.js"></script>
<script src="public/scripts/definicoes-jmask.js"></script>

<style>
	.obrigatorio:before { content: "*"; display: block }
	label {
		display: block;
	}
	label[for] {
		margin-top: 15px;
	}

	form {
		display: block;
		margin: 0 auto;
	}
	h2 { text-align: center;}
	[type="checkbox"],
	[type="radio"] { margin-left: 10px; }

	input:focus {
		box-shadow: none;
		outline: 0;

		/* border: 1px solid black; */
	}
</style>
