<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/metas.php" ?>
	</head>
	<body>
		<?php include "public/views/frames/header.php" ?>

		<?php include "public/views/components/mensagemSaida.php" ?>

		<?php include "public/views/{$PAGINA['endereco']}" ?>

		<?php #include "public/views/frames/footer.php" ?>
	</body>
</html>
