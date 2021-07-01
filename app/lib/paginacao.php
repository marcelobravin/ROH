<?php
/**
 * Construção de paginação e gerenciamento de parametros
 * @package grimoire/bibliotecas
*/

/**
 * Retorna o índice de paginação atual
 * @package grimoire/bibliotecas/paginacao.php
 * @version 05-07-2015
 *
 * @param	 string
 * @return	bool
 *
 * @uses		$_GET
 */
function definirPaginaAtual ()
{
	if (isset($_GET['pagina']) && $_GET['pagina'] > 0)
		return $_GET['pagina'];

	return 1;
}

/**
 * Define o início e fim do resultado
 * @package grimoire/bibliotecas/paginacao.php
 * @version 05-07-2015
 *
 * @param	 string
 * @return	bool
 *
 * @uses		paginacao.php->definirPaginaAtual()
 */
function definirLimites ($resultadosPorPagina)
{
	$paginaAtual = definirPaginaAtual();

	// $array['inicio'] = ($paginaAtual * $resultadosPorPagina) - $resultadosPorPagina;
	// $array['final'] = $paginaAtual * $resultadosPorPagina;

	$array['final'] = $paginaAtual * $resultadosPorPagina;
	$array['inicio'] = $array['final'] - $resultadosPorPagina;

	return $array;
}

/**
 * Monta links de paginação
 * @version 05/08/2016 10:50:28
 *
 * @param	 int: quantos links a serem criados
 * @param	 int, qual link será marcado como selecionado
 * @param	 int, quantos links numéricos estarão visíveis simultaneamente
 * @return	array
 *
 * @uses		$_GET
 * @uses		$_SERVER
 * @uses		html.php->gerarElemento() @deprecated
 * @uses		html.php->a() @deprecated
 *
 * @example
	$list = $db->selecionar('hospital');
	$n = count($list);
	$x = paginar($n, $numeroRegistrosPorPagina=10, $limite=3);
 */
function paginacao ($numeroPaginas, $paginaSelecionada=1, $limite=3)
{
	$numeroPaginas = ceil($numeroPaginas);

	$paginaSelecionada = definirPaginaAtual();

	// Limita quantas páginas serão exibidas
	$minimo = $paginaSelecionada - $limite;
	$maximo = $paginaSelecionada + $limite;

	if ($minimo < 0) $maximo -= $minimo; // Corrige exibição dos primeiros indices

	// Corrige exibição dos últimos indices
	$distanciaUltimo = intval($numeroPaginas - $paginaSelecionada);
	if ($distanciaUltimo <= $limite) $minimo -= ($limite - $distanciaUltimo);

	$parametros = "";
	foreach($_GET as $key => $value){
		if ($key != "pagina")
			$parametros .= "$key=$value&"; // substituir conforme ordenarPor())
	}

	// Conserva os parametros GET
	if (empty($_GET)) {
		$link = "{$_SERVER['REQUEST_URI']}?pagina=";
	} else {

		if (empty($parametros)) {
			$link = "{$_SERVER['PHP_SELF']}?pagina="; // Se não tiver critérios de busca
		} else {
			$link = "{$_SERVER['PHP_SELF']}?{$parametros}pagina="; // Se tiver critérios de busca
		}
	}

	$vetorPaginas = array();

		// Anterior
	if ($paginaSelecionada <= 1) {
		$vetorPaginas['primeira'] = "<span class='primeira'>|<</span>";
		$vetorPaginas['anterior'] = "<span class='anterior'><</span>";
	} else {
		$temp = $paginaSelecionada - 1;
		if ($temp < 1) $temp = 1;
		$vetorPaginas['primeira'] = "<a class='primeira' href='".$link . 1 ."' title='Primeira página'>|<</a>";
		$vetorPaginas['anterior'] = "<a class='anterior' href='".$link . $temp."' title='Página anterior (". $temp.")'><</a>";
	}

	// Números
	for ($i=$minimo; $i<=$maximo; $i++) {
		if ($i < $numeroPaginas+1 && $i > 0) {
			if ($i == $paginaSelecionada) {
				$vetorPaginas[] = "<span class='numero'>$i</span>";
			} else {
				$vetorPaginas[] = "<a href='{$link}{$i}' title='Página {$i}'>$i</a>";
			}
		}
	}

	// Correção para resultSets vazios
	if (!isset($vetorPaginas[0])) $vetorPaginas[] = "<span class='numero'>1</span>";

	// Próxima
	if ($paginaSelecionada >= $numeroPaginas) {
		$vetorPaginas['proxima'] = "<span class='proxima'>></span>";
		$vetorPaginas['ultima'] = "<span class='ultima'>>|</span>";
	} else {
		$temp = $paginaSelecionada + 1;
		$vetorPaginas['proxima'] = "<a class='proxima' href='".$link . $temp."' title='Próxima página (". $temp.")'>></a>";
		$vetorPaginas['ultima'] = "<a class='ultima' href='".$link . $numeroPaginas."' title='Última página (".$numeroPaginas.")'>>|</a>";
	}

	return $vetorPaginas;
}

/**
 * Cria paginação
 * @package grimoire/bibliotecas/paginacao.php
 * @version 05-07-2015
 *
 * @param	 int
 * @param	 int
 * @param	 int
 * @return	array
 *
 * @uses		paginacao.php->definirPaginaAtual()
 * @uses		paginacao.php->paginacao()
 */
function paginar($numeroRegistros, $numeroRegistrosPorPagina=10, $limite=3) {
	$paginaAtual = definirPaginaAtual(); // Define página atual
	$numeroPaginas = $numeroRegistros / $numeroRegistrosPorPagina; // Calcula número de páginas
	return paginacao($numeroPaginas, $paginaAtual, $limite);
}

/**
 * Cria elemento para visualização de campo de ordenação atual
 * @package grimoire/bibliotecas/paginacao.php
 * @since 05-07-2015
 * @version 08/09/2016 12:04:17
 *
 * @param	 string campo: campo que será checada se está sendo usado como chave de ordenação
 * @param	 string símbolo que será utilizado para "chave de ordenação não é esse campo"
 * @param	 string simbolo que será utilizado para diretriz ASC
 * @param	 string símbolo que será utilizado para diretriz DESC
 * @return	string símbolo indicando se chave de ordenação é esse campo e qual ordem
 *
 * @example
		<a href="<?php echo ordenarPor("data") ? >">Data</a>
		echo ordenado("nome", "<i class='icon-sort'>b</i>", "<i class='icon-sort-up'>u</i>", "<i class='icon-sort-down'>d</i>");
 */
function ordenado($campo="", $both="&#8597;", $asc="&#8595;", $desc="&#8593;") {
	if (isset($_GET['chave_ordenacao']) && $_GET['chave_ordenacao'] == $campo) {
		if ( isset($_GET['ordem']) && $_GET['ordem'] == "desc") {
			return $desc;
		} else {
			return $asc;
		}
	} else {
		return $both;
	}
}

/**
 * Cria URL para seleção de chave de ordenação em itens paginados
 * @package grimoire/bibliotecas/paginacao.php
 * @version 05-07-2015
 *
 * @param	 string campo: qual campo será usado na diretriz ORDER BY
 * @return	string
 *
 * @example
		<a href="<?php echo ordenarPor("modulo") ?>">
			Módulo <?php echo ordenado("modulo") ?>
		</a>
 */
function ordenarPor($chave_ordenacao="data") {
	if (empty($_GET)) {
			return "{$_SERVER['REQUEST_URI']}?chave_ordenacao={$chave_ordenacao}"; // Se não houver parametros de busca
	} else {

		// Conserva parametros
		foreach($_GET as $key => $value){
			if ($key != "ordem" && $key != "chave_ordenacao"){
				$parametros[] = "$key=$value";
			}
		}

		// Substitui "chave_ordenacao"
		//if (isset($_GET['chave_ordenacao'])) {
		$parametros[] = "chave_ordenacao=$chave_ordenacao";
		//}

		// Substitui "ordem"
		if (isset($_GET['ordem']) && $_GET['ordem'] != "asc") {
			$parametros[] = "ordem=asc";
		} else {
			$parametros[] = "ordem=desc";
		}

		$parametros = implode("&", $parametros);
		return "{$_SERVER['PHP_SELF']}?{$parametros}"; // Se tiver critérios de busca
	}
}

function paginationCore ($tabela, $linksPaginasExibir=3)
{
	$db = new Database();

	$numeroRegistrosPorPagina = definirExibicao();

	$where = defineCriteriosBusca();
	// $list = $db->selecionar($tabela, array(), '', 'count(*)');
	$list = $db->selecionar($tabela, $where, '', 'count(*)');

	// echo $numeroRegistros = count($list);
	$numeroRegistros = $list[0]['count(*)'];
	$linksPaginacao = paginar($numeroRegistros, $numeroRegistrosPorPagina, $linksPaginasExibir);

	$limites = definirLimites($numeroRegistrosPorPagina);

	$limite = " LIMIT {$limites['inicio']}, {$numeroRegistrosPorPagina}";

	$orderBy = defineOrdemPaginacao();
	$list = $db->selecionar($tabela, $where, $orderBy.$limite);

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
	echo '<p class="contadorRegistros">';
	echo $n;

	if ( $n > 1 )
		echo " resultados encontrados";
	else
		echo " resultado encontrado";
	echo'</p>';
}

function selecaoResultadosPorPagina ($vetorPaginacao)
{
	$ultimoRegistroExibido = $vetorPaginacao['limites']['inicio'] + count($vetorPaginacao['listaPaginada']);
	?>
		<p class="contadorRegistros">
			<form style="text-align: right" method="get">

				<?php
					foreach ($_GET as $key => $value) {
						$key = htmlspecialchars($key);
						$value = htmlspecialchars($value);
						echo "<input type='hidden' name='{$key}' value='{$value}' />";
					}
				?>

				<select name="exibir" id="exibir">
					<option <?php echo selecionado("exibir", 10) ?> value="10">10 resultados por página</option>
					<option <?php echo selecionado("exibir", 25) ?> value="25">25 resultados por página</option>
					<option <?php echo selecionado("exibir", 50) ?> value="50">50 resultados por página</option>
					<option <?php echo selecionado("exibir", 100) ?> value="100">100 resultados por página</option>
					<option <?php echo selecionado("exibir", 500) ?> value="500">500 resultados por página</option>
				</select>
				<input type="submit" class="btn btn-success" value="Exibir" title="Filtrar Treinandos"/>
				<p>
					Exibindo de <?php echo $vetorPaginacao['limites']['inicio']+1 ?>
					a <?php echo $ultimoRegistroExibido ?>
				</p>
			</form>
		</p>
	<?php
}

# não usada
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

# Define quantos registros serão exibidos por página
function definirExibicao ()
{
	if ( isset($_GET['exibir']) && $_GET['exibir'] > 0 )
		return $_GET['exibir'];

	return 25;
}

function criarLinkOrdenacao ($atributo, $nomeCampo)
{ ?>
	<a class="ordenacao" href="<?php echo ordenarPor($atributo) ?>" title="Clique aqui para ordenar os registros dessa tabela por <?php echo $nomeCampo ?>">
		<?php echo ucwords($nomeCampo) ?>
		<?php echo ordenado($atributo) ?>
	</a>
<?php
}

/*
Define ordenação
*/
function defineOrdemPaginacao ($ordenacaoDefault='id')
{
	if ( isset($_GET['chave_ordenacao']) )
		$ordenacao = $_GET['chave_ordenacao'];
	else
		$ordenacao = $ordenacaoDefault;
		// $_GET['chave_ordenacao'] = $ordenacaoDefault;
		// $ordenacao = "UPPER({$ordenacaoDefault})";


	if ( isset($_GET['ordem']) && $_GET['ordem']=="desc" )
		$ordenacao .= " DESC";

	return "ORDER BY {$ordenacao}";
}


/*
├─────────────────────────────────────────────────────────────────────────────── assets (9)
| Define critérios de busca
└───────────────────────────────────────────────────────────────────────────────
*/
function defineCriteriosBusca ()
{
	$criterios_busca = array();
	if ( isset($_GET['nome']) )
		$criterios_busca[] = "c.nome LIKE '{$_GET['nome']}%'";

	if ( isset($_GET['ativado']) && $_GET['ativado']!="" )
		$criterios_busca[] = "ativo = '{$_GET['ativado']}'";
		// $criterios_busca[] = "c.ativado = '{$_GET['ativado']}'";

	if ( empty($criterios_busca) )
		return '';

	return implode(" AND ", $criterios_busca);
}

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

	$db = new Database();

	for ($i=0; $i<$insercoes; $i++) {
		$id = $db->inserir($tabela, $objeto);
	}
}
