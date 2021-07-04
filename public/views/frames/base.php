<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
	<head>
		<?php include "public/views/frames/metas.php" ?>
	</head>
	<body>
		<!-- <header> -->
			<?php include "public/views/frames/header.php" ?>
		<!-- </header> -->

		<?php #include "componentes/mensagem_saida.php" ?>

		<!-- <section style="min-height: 750px"> -->
			<!-- <div class="container mgt_container"> -->
				<?php include "public/views/{$PAGINA['endereco']}" ?>
			<!-- </div> -->
		<!-- </section> -->

		<!-- <footer> -->
			<?php #include "public/views/frames/footer.php" ?>
		<!-- </footer> -->
	</body>
</html>

<?php require("app\Grimoire\processosFinais.php"); ?>
