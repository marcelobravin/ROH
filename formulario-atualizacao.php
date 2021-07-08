<?php
	include 'app/Grimoire/core_inc.php';

	#bloquear não logados

	$PAGINA['titulo']		= "Atualização";
	$PAGINA['subtitulo']	= "Hospitais";
	// $PAGINA['endereco']		= "home.php";

	if ( isset($_GET['modulo']) )
		define('MODULO', $_GET['modulo']);

	if ( isset($_GET['codigo']) ) {

		$condicoes = array(
			'id' => $_GET['codigo']
		);
		$obj = selecionar(MODULO, $condicoes);
		if ( sizeof($obj) > 0 )
			$obj = $obj[0];

	}
?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
</head>
<body>
	<?php include "public/views/frames/header.php" ?>

	<a href="app/Controller/LogoutController.php">Logout</a>

	<p>
		<a href="FormGenerate.php">Gerar formulário conforme definição do BD</a>
	</p>

	<form action="app/Controller/RegisterController-<?php echo MODULO ?>.php" method="post">
		<div>
			<label for="titulo"title="Descrição do Título">Título</label>
			<input type="text" name="titulo" id="titulo" value="<?php echo $obj['titulo'] ?>" class="obrigatorio" required="required" maxlength="255" />
		</div>
		<div>
			<label for="ativo" title="Descrição do Título">ativo</label>
			<label><input type="checkbox" name="ativo" id="ativo" value="1" class="obrigatorio" required="required" <?php echo checked ($obj['ativo'], 1) ?> />Ativo</label>
		</div>

		<input type="submit" value="ATUALIZAR" />
	</form>
</body>
</html>
