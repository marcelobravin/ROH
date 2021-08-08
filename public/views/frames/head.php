<meta charset="<?php echo CARACTERES ?>">
<title>
	<?php echo montarTituloPagina($PAGINA) ?>
</title>
<meta name="description" content="<?php echo DESCRICAO_SITE ?>">
<meta name="keywords" content="<?php echo PALAVRAS_CHAVE ?>">

<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if ( !INDEXAR ): ?>
	<meta name="robots" content="noindex, nofollow">
<?php endif ?>

<meta name="author" content="Marcelo de Souza Bravin">
<link rel="author" href="https://www.linkedin.com/mwlite/in/marcelo-de-souza-bravin-3109b722">

<meta name="copyright" content="© 2021 Mark Corp.">
<meta name="date" content="2021-07-03T09:49:37+00:00">
<meta name="generator" content="VSC">
<meta name="expires" content="never">
<meta name="language" content="portuguese">
<meta name="rating" content="general">

<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
<link rel="stylesheet" type="text/css" href="public/css/resets.css">
<link rel="stylesheet" type="text/css" href="public/css/topo.css">
<link rel="stylesheet" type="text/css" href="public/css/universal.css">

<!-- TODO baixar arquivo abaixo -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<script src="public/vendors/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
	if (typeof jQuery == 'undefined') {
		document.write(unescape("%3Cscript src='public/vendors/jquery-3.6.0.slim.min.js' %3E%3C/script%3E"));
	}
</script>

<script src="public/vendors/sweet-alert.js"></script>

<style type="text/css">
	<?php echo sublinharPaginaAtual() ?>
</style>
