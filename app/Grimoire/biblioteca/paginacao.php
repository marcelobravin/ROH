<?php
/**
 * Construção de paginação e gerenciamento de parametros
 * @package grimoire/bibliotecas
*/

/**
 * Cria links com parametros para definir ordenação via GET
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
*/
function criarLinkOrdenacao ($atributo, $nomeCampo)
{ ?>
	<a class="ordenacao" href="<?php echo ordenarPor($atributo) ?>" title="Clique aqui para ordenar os registros dessa tabela por <?php echo $nomeCampo ?>">
		<?php echo ucwords($nomeCampo) ?>
		<?php echo ordenado($atributo) ?>
	</a>
<?php
}

/**
 * Monta where para query de paginação
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	27/07/2021 15:56:49
 *
 * @param	array
 *
 * @return	string
*/
function defineCriteriosBusca ($get)
{
	# parametros fixos
	$criterios_busca = array();

	if ( isset($get['paginacao']['filtroPaginacao']) ) {
		$c = $get['paginacao']['campo'];
		$o = $get['paginacao']['operador'];
		$f = addslashes($get['paginacao']['filtroPaginacao']);

		switch ( $o ) {
			case 'contem':
				$criterios_busca[] = $c ." LIKE '%{$f}%'";
				break;
			case 'comeca':
				$criterios_busca[] = $c ." LIKE '{$f}%'";
				break;
			case 'termina':
				$criterios_busca[] = $c ." LIKE '%{$f}'";
				break;
			case 'igual':
				$criterios_busca[] = $c ." = '{$f}'";
				break;
			case 'diferente':
				$criterios_busca[] = $c ." != '{$f}'";
				break;
			default:
				break;
		}
	}

	if ( isset($get['ativado']) && $get['ativado']!="" ) {
		$criterios_busca[] = "ativo = '{$get['ativado']}'";
	}

	if ( isset($get['id']) && $get['id']!="" ) {
		$criterios_busca[] = "id = '{$get['id']}'";
	}

	# parametros flexíveis
	if ( EXCLUSAO_LOGICA ) {
		$criterios_busca[] = "`excluido_em` IS NULL";
	}

	if ( empty($criterios_busca) ) {
		return '';
	} else {
		return implode(" AND ", $criterios_busca);
	}
}

/**
 * Define quantos registros serão exibidos por página
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	24-06-2021
 *
 * @return	int
*/
function definirExibicao ()
{
	if ( isset($_GET['exibir']) && $_GET['exibir'] > 0 ) {
		return $_GET['exibir'];
	}

	return PAGINACAO_RPP;
}

/**
 * Define o	início e fim do resultado
 * @package grimoire/bibliotecas/paginacao.php
 * @version	05-10-2016
 *
 * @param	int
 * @return	array
 *
* @uses	paginacao.php->definirPaginaAtual()
 */
function definirLimites ($resultadosPorPagina)
{
	$paginaAtual = definirPaginaAtual();

	$array['final'] = $paginaAtual * $resultadosPorPagina;
	$array['inicio'] = $array['final'] - $resultadosPorPagina;

	return $array;
}

/**
 * Retorna	o número da página atual ou a primeira
 * @package grimoire/bibliotecas/paginacao.php
 * @version	05-10-2016
 *
 * @return	int
 *
 * @uses	$_GET
 */
function definirPaginaAtual ()
{
	if (isset($_GET['pagina']) && $_GET['pagina'] > 0) {
		return $_GET['pagina'];
	}

	return 1;
}

/**
 * Define ordenação
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	24-06-2021
 *
 * @param	string

 * @param	string	ordem
*/
function defineOrdemPaginacao ($ordenacaoDefault='id')
{
	if ( isset($_GET['chave_ordenacao']) ) {
		$ordenacao = $_GET['chave_ordenacao'];
	} else {
		$ordenacao = $ordenacaoDefault;
	}

	if ( isset($_GET['ordem']) && $_GET['ordem']=="desc" ) {
		$ordenacao .= " DESC";
	}

	return "ORDER BY {$ordenacao}";
}

function filtrarArray ($array, $filtro='char')
{
	$novaArray = array();
	foreach ($array as $v) {
		if ( contem($filtro, $v['Type']) ) {
			$novaArray[$v['Field']] = $v['Field'];
		}
	}
	return $novaArray;
}

/**
 * @since	28/07/2021 11:12:15
*/
function filtroPaginacao ()
{
	include_once "app/Model/Paginacao-". $_GET['modulo'] .".php";
	$campos = retornarCampos();
	?>
		<p>
			<select name="paginacao[campo]">
				<?php foreach ($campos as $v) : ?>
					<option value="<?php echo $v ?>" <?php echo selecionadoSubindice("paginacao", "campo", $v) ?>><?php echo $v ?></option>
				<?php endforeach ?>

			</select>
			<select name="paginacao[operador]" id="">
				<option value="contem" <?php echo selecionadoSubindice("paginacao", "operador", "contem") ?>>contém</option>
				<option value="igual" <?php echo selecionadoSubindice("paginacao", "operador", "igual") ?>>é igual a</option>
				<option value="diferente" <?php echo selecionadoSubindice("paginacao", "operador", "diferente") ?>>é diferente de</option>
				<option value="comeca" <?php echo selecionadoSubindice("paginacao", "operador", "comeca") ?>>começa com</option>
				<option value="termina" <?php echo selecionadoSubindice("paginacao", "operador", "termina") ?>>termina com</option>
			</select>

			<input type="text" name="paginacao[filtroPaginacao]" id="filtroPaginacao" value="<?php echo bloquearXSS(exibirSubIndice("paginacao", "filtroPaginacao")) ?>" placeholder="Digite algo" />
		</p>
	<?php
}

/**
 * Cria elemento para visualização de campo de ordenação atual
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	08/09/2016 12:04:17
 *
 * @param	string campo: campo que será checada se está sendo usado como chave de ordenação
 * @param	string símbolo que será utilizado para "chave de ordenação não é esse campo"
 * @param	string simbolo que será utilizado para diretriz ASC
 * @param	string símbolo que será utilizado para diretriz DESC
 *
 * @return	string símbolo indicando se chave de ordenação é esse campo e qual ordem
 *
 * @example
		<a href="<?php echo ordenarPor("data") ? >">Data</a>
		echo ordenado("nome", "<i class='icon-sort'>b</i>", "<i class='icon-sort-up'>u</i>", "<i class='icon-sort-down'>d</i>");
 */
function ordenado ($campo="", $both="&#8597;", $asc="&#8595;", $desc="&#8593;")
{
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
 * Cria URL	para seleção de chave de ordenação em itens paginados
 * @package grimoire/bibliotecas/paginacao.php
 * @version	05-10-2016
 *
 * @param	string campo: qual campo será usado na diretriz ORDER BY
 * @return	string
 *
 * @example
		<a href="<?php echo ordenarPor("modulo") ?>">
			Módulo <?php echo ordenado("modulo") ?>
		</a>
 */
function ordenarPor ($chave_ordenacao="data")
{
	if ( empty($_GET) ) {
		return "{$_SERVER['REQUEST_URI']}?chave_ordenacao={$chave_ordenacao}"; // Se não houver parametros de busca
	} else {

		// Conserva parametros
		foreach ($_GET as $key => $value) {
			if ( !is_array($value) && $key != "ordem" && $key != "chave_ordenacao") {
				$parametros[] = "$key=$value";
			}
		}

		// Substitui "chave_ordenacao"
		$parametros[] = "chave_ordenacao=$chave_ordenacao";

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

/** Monta links de paginação
 * @version	05/08/2016 10:50:28
 *
 * @param	int		quantos links a serem criados
 * @param	int		qual link será marcado como selecionado
 * @param	int		quantos links numéricos estarão visíveis simultaneamente
 * @return	array
 *
 * @uses	$_GET
 * @uses	$_SERVER
 */
function paginacao ($numeroPaginas, $paginaSelecionada=1, $limite=3)
{
	$numeroPaginas = ceil($numeroPaginas);

	// Limita quantas páginas serão exibidas
	$minimo = $paginaSelecionada - $limite;
	$maximo = $paginaSelecionada + $limite;

	if ($minimo < 0) {
		$maximo -= $minimo; // Corrige exibição dos primeiros indices
	}

	// Corrige exibição dos últimos indices
	$distanciaUltimo = intval($numeroPaginas - $paginaSelecionada);
	if ($distanciaUltimo <= $limite) {
		$minimo -= ($limite - $distanciaUltimo);
	}

	$parametros = "";
	foreach ($_GET as $key => $value) {

		if ( is_array($value)) {
			foreach ($value as $k => $v) {
				$parametros .= "$k=$v&";
			}

		} else {
			if ( $key != "pagina" ) {
				$parametros .= "$key=$value&"; // substituir conforme ordenarPor())
			}
		}
	}

	// Conserva os parametros GET
	if ( empty($_GET) ) {
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
		$vetorPaginas['primeira'] = "<span class='primeira'><i class='fas fa-angle-double-left'></i></span>";
		$vetorPaginas['anterior'] = "<span class='anterior'><i class='fas fa-angle-left'></i></span>";
	} else {
		$temp = $paginaSelecionada - 1;
		if ($temp < 1) {
			$temp = 1;
		}
		$vetorPaginas['primeira'] = "<a class='primeira' href='".$link . 1 ."' title='Primeira página'><i class='fas fa-angle-double-left'></i></a>";
		$vetorPaginas['anterior'] = "<a class='anterior' href='".$link . $temp."' title='Página anterior (". $temp.")'><i class='fas fa-angle-left'></i></a>";
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
	if ( !isset($vetorPaginas[0]) ) {
		$vetorPaginas[] = "<span class='numero'>1</span>";
	}

	// Próxima
	if ($paginaSelecionada >= $numeroPaginas) {
		$vetorPaginas['proxima'] = "<span class='proxima'><i class='fas fa-angle-right'></i></span>";
		$vetorPaginas['ultima'] = "<span class='ultima'><i class='fas fa-angle-double-right'></i></span>";
	} else {
		$temp = $paginaSelecionada + 1;
		$vetorPaginas['proxima'] = "<a class='proxima' href='".$link . $temp."' title='Próxima página (". $temp.")'><i class='fas fa-angle-right'></i></a>";
		$vetorPaginas['ultima'] = "<a class='ultima' href='".$link . $numeroPaginas."' title='Última página (".$numeroPaginas.")'><i class='fas fa-angle-double-right'></i></a>";
	}

	return $vetorPaginas;
}

/**
 * Cria paginação	 * @package grimoire/bibliotecas/paginacao.php
 * @version	05-10-2016
 *
 * @param	int
 * @param	int
 * @param	int
 * @return	array
 *
 * @uses	paginacao.php->definirPaginaAtual()
 * @uses	paginacao.php->paginacao()
 */
function paginar ($numeroRegistros, $numeroRegistrosPorPagina=10, $limite=3)
{
	$paginaAtual = definirPaginaAtual();
	$numeroPaginas = $numeroRegistros / $numeroRegistrosPorPagina; // Calcula número de páginas
	return paginacao($numeroPaginas, $paginaAtual, $limite);
}

/**
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	24-06-2021
 *
 * @param	string
 * @param	int
 *
 * @return	array
*/
function paginationCore ($tabela, $linksPaginasExibir=PAGINACAO_PAE)
{
	$numeroRegistrosPorPagina = definirExibicao();

	$where = defineCriteriosBusca($_GET);

	$list = selecionar($tabela, $where, '', 'count(*)');

	$numeroRegistros = $list[0]['count(*)'];
	$linksPaginacao = paginar($numeroRegistros, $numeroRegistrosPorPagina, $linksPaginasExibir);

	$limites = definirLimites($numeroRegistrosPorPagina);

	$limite = " LIMIT {$limites['inicio']}, {$numeroRegistrosPorPagina}";

	$orderBy = defineOrdemPaginacao();
	$list = selecionar($tabela, $where, $orderBy.$limite);

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

/**
 *
 * @package	grimoire/bibliotecas/paginacao.php
 * @since	05-10-2016
 * @version	24-06-2021
 *
 * @param	string
*/
function paginacaoHeader ($n)
{
	echo '<p class="contadorRegistros">';
	echo $n;

	if ( $n > 1 ) {
		echo " resultados encontrados";
	} else {
		echo " resultado encontrado";
	}
	echo'</p>';
}

/**
 *
*/
function selecaoResultadosPorPagina ($vetorPaginacao)
{
	$ultimoRegistroExibido = $vetorPaginacao['limites']['inicio'] + count($vetorPaginacao['listaPaginada']);
	?>
		<p class="contadorRegistros">
			<form style="text-align: right" method="get">
				<?php
					foreach ($_GET as $key => $value) {
						if ( !is_array($value) && $key != 'exibir' ) {
							$key = htmlspecialchars($key);
							$value = htmlspecialchars($value);
							echo "<input type='hidden' name='{$key}' value='{$value}' />";
						}
					}
				?>
				<select name="exibir" id="exibir">
					<option <?php echo selecionado("exibir", 10) ?> value="10">10 resultados por página</option>
					<option <?php echo selecionado("exibir", 25) ?> value="25">25 resultados por página</option>
					<option <?php echo selecionado("exibir", 50) ?> value="50">50 resultados por página</option>
					<option <?php echo selecionado("exibir", 100) ?> value="100">100 resultados por página</option>
					<option <?php echo selecionado("exibir", 500) ?> value="500">500 resultados por página</option>
				</select>
				<input type="submit" class="btn btn-success" value="Exibir" title="Alterar quantidade de resultados a exibir a cada página"/>
				<p>
					Exibindo de <?php echo $vetorPaginacao['limites']['inicio']+1 ?>
					a <?php echo $ultimoRegistroExibido ?>
				</p>

				<?php filtroPaginacao() ?>

			</form>
		</p>
	<?php
}
