<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/head.php" ?>
	</head>
	<body>
		<?php
			if ( !isset($omitirMenu) ) {
				include "public/views/frames/header.php";
			}
		?>

		<?php include "public/views/components/mensagemSaida.php" ?>

		<?php include "public/views/{$PAGINA['endereco']}" #pagina de mesmo nome da pagina atual ou sobrescrita no arquivo pai desse ?>
	</body>
</html>
<?php require BASE."app/Grimoire/processosFinais.php" ?>
