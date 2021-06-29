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


function plural ($n)
{
	if ( $n > 1 )
		return 's';

	return '';
}

function paginacaoHeader ()
{
	$plural = plural( count($matriz) );
	echo'<p class=\"contadorRegistros\">';

	echo count($matriz) "resultado"<?php echo count($matriz)>1 ?"s":""?> encontrado<?php echo count($matriz)>1 ?"s":""
</p>

}



// echo('<pre>');
// print_r($p['paginacao']);
// print_r($p['limites']);
// echo('</pre>');







	// echo "<pre>". criacaoTemplateTabela("hospital");
// exit;

	// include ROOT.'app/Controller/ListController.php';
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" href="public/styles/list.css">
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
		<!-- <script src='js/lib/jquery-3.3.1.js?j=$r'></script> -->
		<script>
			$(document).ready(function(){
				$(".excluir").click(function(){
					return confirm("Tem certeza que deseja excluir esse usuário?")
				})
			})
		</script>
	</head>
<body>
	<a href="app/Controller/LogoutController.php">Logout</a>

	<div>
		<?php echo esvaziarMensagem() ?>
	</div>


	<button>
		<a href="register.html">
			Adicionar Novo Hospital
		</a>
	</button>


	<table>
		<tr>
			<th>Id</th>
			<th>Hospital</th>
			<th>Opções</th>
		</tr>

		<?php #foreach ($list as $obj) : ?>
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
</body>
</html>
