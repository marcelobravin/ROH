<?php
	include 'app/Grimoire/core_inc.php';

	#bloquear não logados

	$PAGINA['titulo']		= "Atualização";
	$PAGINA['subtitulo']	= "Hospitais";
	// $PAGINA['endereco']		= "home.php";

	if ( !isset($_GET['modulo']) )
		die("modulo invalido");

	if ( !isset($_GET['codigo']) )
		die("codigo invalido");


	define('MODULO', $_GET['modulo']);
	$condicoes = array(
		'id' => $_GET['codigo']
	);
	$obj = localizar(MODULO, $condicoes);

	if ( empty($obj) )
		die("Objeto não encontrado");

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
</head>
<body>
	<?php include "public/views/frames/header.php" ?>

	<p>
		<a href="index.php?action=gerar-formulario">Gerar formulário conforme definição do BD</a>
	</p>

	<form action="app/Controller/UpdateController-<?php echo MODULO ?>.php" method="post">
		<input type="hidden" name="id" id="id" value="<?php echo $obj['id'] ?>" />

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
