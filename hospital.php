<?php
	include 'config.php';

	require 'model/database.class.php'; // para teste
	require 'app/Controller/paginacao.php';

	$db  = new Database();

	$condicoes = array(
		// 'login' => $_POST['login']
	);
	// $list = $db->selecionar('hospital', $condicoes);
	// $list = $db->selecionar('hospital');




	/**
	 * @since 28/06/2021 09:50:48
	 * @todo
	 * criar relacionamento com tabela usuario, parametrizavel
	 * parametrizar drop table if exists
	 * adicionar comentarios nas colunos
	 * @example
	 	echo criacaoTemplateTabela("hospital");
		echo "<pre>". criacaoTemplateTabela("hospital");
	 */
	function criacaoTemplateTabela ($nomeTabela="nova_tabela")
	{
		$sql = "
			SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
			START TRANSACTION;
			SET time_zone = \"+00:00\";

			DROP TABLE IF EXISTS `{$nomeTabela}`;
			CREATE TABLE `{$nomeTabela}` (
				`id`				int(11)			NOT NULL,

				`titulo`			char(255)		NOT NULL,
				`ativo`				tinyint(1)		NOT NULL,

				`criado_em`			timestamp		NOT NULL	DEFAULT current_timestamp(),
				`atualizado_em`		timestamp 		NULL		DEFAULT NULL	ON UPDATE current_timestamp(),
				`excluido_em`		timestamp		NULL		DEFAULT NULL,

				`criado_por`		int(11)			NOT NULL,
				`atualizado_por`	int(11)			NULL		DEFAULT NULL,
				`excluido_por`		int(11)			NULL		DEFAULT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			-- Índices para tabela `{$nomeTabela}`
			ALTER TABLE `{$nomeTabela}`
			ADD PRIMARY KEY (`id`),
			ADD KEY `id` (`id`);

			-- AUTO_INCREMENT de tabela `{$nomeTabela}`
			ALTER TABLE `{$nomeTabela}`
			MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
			COMMIT;
		";
		return $sql;
	}

	/**
	 * Realiza multiplas inserções
	 * Gera dummy data
	 * @since 28/06/2021 11:52:15
	 * @todo
	 * 		inserir matriz
	 * @example
		popularTabela('hospital', 3);
	*/
	function popularTabela($tabela, $insercoes=3)
	{
		$objeto = [
			'titulo'		=> 'São Luiz Gonzaga'
			, 'ativo'		=> '1'
			, 'criado_por'	=> '1'
		];

		$db		= new Database();

		for ($i=0; $i<$insercoes; $i++) {
			$id = $db->inserir($tabela, $objeto);

			// echo $id;
			// echo "<br>";
		}
	}

	// $x = paginar($numeroRegistros, $numeroRegistrosPorPagina=10, $limite=3);
	$paginacao = paginationCore ('hospital', 5, 3);

	echo('<pre>');
	print_r($paginacao);
	echo('</pre>');




function paginationCore ($tabela, $numeroRegistrosPorPagina=5, $linksPaginasExibir=3)
{
	$db = new Database();

	$list = $db->selecionar($tabela, array(), '', 'count(*)');

	// echo $numeroRegistros = count($list);
	$numeroRegistros = $list[0]['count(*)'];
	$linksPaginacao = paginar($numeroRegistros, $numeroRegistrosPorPagina, $linksPaginasExibir);

	$limites = definirLimites($numeroRegistrosPorPagina);
	/*
	for ($i=0; $i<$numeroRegistros; $i++) {
		if ($i < $limites['inicio'] || $i >= $limites['final'])
		unset( $list[$i] );
	}
	*/


	$list = $db->selecionar($tabela, array(), "LIMIT {$limites['inicio']}, {$numeroRegistrosPorPagina}");

	return [
		'registros'			=> $numeroRegistros,
		'registrosPorPag'	=> $numeroRegistrosPorPagina,
		'paginaAtual'		=> definirPaginaAtual(),
		'totalPaginas'		=> ceil($numeroRegistros / $numeroRegistrosPorPagina),
		'limites'			=> $limites,
		'links'				=> $linksPaginacao,
		'listaPaginada'		=> $list
	];
}

function paginacaoHeader ($n)
{
	echo'<p class="contadorRegistros">';
	echo $n;

	if ( $n > 1 )
		echo " resultados encontrados";
	else
		echo " resultado encontrado";
	echo'</p>';
}


/* 31-07-2015 16:43 */
/* Retorna atributo html se indice GET existir e for igual ao valor */
/* <option value="Ativas" <?php echo selecionado("status", "Ativas") ?>>Ativas</option> */
function selecionado($indice, $valor, $atributo='selected') {
	if ( isset($_GET) && isset($_GET[$indice]) && $_GET[$indice]==$valor )
	  return $atributo.'="'. $atributo .'"';
  }


function resultadosPorPagina ()
{
	//if ( count($matriz) > 0 ): ?>
		<p class="contadorRegistros">
			<form style="text-align: right">
				<select name="exibir" id="exibir">
					<option <?php echo selecionado("exibir", 25) ?> value="25">25 resultados por página</option>
					<option <?php echo selecionado("exibir", 50) ?> value="50">50 resultados por página</option>
					<option <?php echo selecionado("exibir", 100) ?> value="100">100 resultados por página</option>
					<option <?php echo selecionado("exibir", 500) ?> value="500">500 resultados por página</option>
				</select>
				<input type="submit" class="btn btn-success" value="Exibir" title="Filtrar Treinandos"/>
				<p>
					Exibindo de <?php echo $fronteiras['inicio']+1 ?>
					a <?php echo $ultimoExibido ?>
				</p>
			</form>
		</p>
	<?php //endif;
}

function paginacaoConfig ()
{
	$numeroRegistros = count($matriz); # IMPORTANTE: vetor deve ser chamado $matriz
	$paginas = 5; # Número máximo de links de páginação a exibir á esquerda e direita da página atual

	# Define quantos registros serão exibidos por página
	if (isset($_GET['exibir']) && $_GET['exibir'] > 0) {
		$numeroRegistrosPorPagina = $_GET['exibir']; # Parâmetro configurável [antes do include nessa página]
	} else {
		$numeroRegistrosPorPagina = 25;
	}

	$vetorPaginas = paginar($numeroRegistros, $numeroRegistrosPorPagina, $paginas);// Monta links
	$fronteiras = definirLimites($numeroRegistrosPorPagina); // Define fronteiras de registros a exibir

	# contadores
	$i = 0;
	$ultimoExibido = 0;
}


	// echo "<pre>". criacaoTemplateTabela("hospital");
// exit;

	// include ROOT.'app/Controller/ListController.php';
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />

		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">
		<link rel="stylesheet" type="text/css" href="public/css/topo.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

		<script>
			$(document).ready(function(){
				$(".excluir").click(function(){
					return confirm("Tem certeza que deseja excluir esse usuário?")
				})
			})
		</script>
	</head>
<body>

<div class="container-tabelas">

	<a href="app/Controller/LogoutController.php">Logout</a>

	<div>
		<?php echo esvaziarMensagem() ?>
	</div>


	<button>
		<a href="register.html">
			Adicionar Novo Hospital
		</a>
	</button>

	<?php paginacaoHeader ($paginacao['registros']) ?>

	<?php resultadosPorPagina() ?>

	<table>
		<tr>
			<th>Id</th>
			<th>Hospital</th>
			<th>Opções</th>
		</tr>

		<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>

			<tr>
				<td><?php echo $obj['id'] ?></td>
				<td><?php echo $obj['titulo'] ?></td>
				<td>
					<button>
						<a href="user-form.php?id=<?php echo $obj['id'] ?>">Editar</a>
					</button>

					<button>
						<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>" class="excluir">Excluir</a>
					</button>

					<button>
						<?php if ( $obj['ativo'] ): ?>
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=0" class="desativar">Desativar</a>
						<?php else: ?>
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=1" class="desativar">Ativar</a>
						<?php endif ?>
					</button>
				</td>
			</tr>
		<?php endforeach ?>

	</table>

	<div>
		<?php echo implode(' ', $paginacao['links']) ?>
	</div>

						</div>
</body>
</html>
