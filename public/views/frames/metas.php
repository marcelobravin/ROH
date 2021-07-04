<meta charset="UTF-8">
<title>
	<?php echo $PAGINA['titulo'] ?>
	<?php echo !empty($PAGINA['titulo']) && !empty($PAGINA['titulo']) ? $PAGINA['separador-titulo'] : "" ?>
	<?php echo $PAGINA['subtitulo'] ?>
</title>
<meta name="description" content="<?php echo DESCRICAO_SITE ?>">
<meta name="keywords" content="<?php echo PALAVRAS_CHAVE ?>">

<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if ( !INDEXAR ): ?>
	<meta name="robots" content="noindex, nofollow">
<?php endif ?>

<meta name="author" content="Marcelo de Souza Bravin">
<link rel="author" href="https://plus.google.com/[your personal g+ profile here]">
<link rel="publisher" href="https://plus.google.com/[your business g+ profile here]">

<meta name="copyright" content="&copy; 2016 Mark Corp.">
<meta name="date" content="2016-08-31T09:49:37+00:00">
<meta name="generator" content="VSC">
<meta name="expires" content="never">
<meta name="language" content="portuguese">
<meta name="rating" content="general">

<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
<link rel="stylesheet" type="text/css" href="public/css/resets.css">
<link rel="stylesheet" type="text/css" href="public/css/login.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script type="text/javascript" src="arquivos/vendor/jquery.min.js"></script>

<style type="text/css">
	.obrigatorio:before {
		content: '*';
	}
</style>
