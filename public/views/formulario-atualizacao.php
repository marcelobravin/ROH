<div class="container">
	<h2>Atualização</h2>

	<form action="app/Controller/UpdateController-<?php echo MODULO ?>.php" method="post">
		<?php #require 'public/views/forms/'.MODULO.'-atualizacao.php'  #--- prod ?>
		<?php require '_arquivos_auto_gerados/views/'.MODULO.'-atualizacao.php' #  dev ?>

		<input type="submit" value="ATUALIZAR" />
	</form>
</div>

<script src="public/vendors/jquery.mask.min.js"></script>
<style>
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
</style>
