<?php
/**
 * Geração automática de formulários via descrição de tabela do BD
 * @package	grimoire/bibliotecas
 */

/**
 * Cria campos conforme descrição da tabela
 * @package	grimoire/bibliotecas/formularios.php
 * @since	30-06-2021
 *
 * @param	string
 */
function montarTemplate ( $campos, $labels, $esconder=array() )
{
	$x = array();
	foreach ($campos as $indice => $c) {
		if ( in_array($indice, $esconder) ) { # remover campo em vez de esconder
			$x[] = $campos[$indice];
		} else {
			$x[] = '<div>';
			$x[] = '	'. $labels[$indice];
			$x[] = '	'. $campos[$indice];
			$x[] = '</div>';
		}
	}

	return implode("\r\n", $x);
}

/**
 * Cria elementos de entrada html conforme uma descrição de tabela
 * @package	grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
 *
 * @param	array descrição
 * @param	array um registro do BD
 * @param	array array de campos a serem sobrescritos
 * @param	array conversões a serem realizadas
 * @param	array classes a serem adicionadas aos inputs conforme padrões de valor (dinheiro, data, email, telefone, etc)
 * @return	array
 *
 * @uses	formularios.php->transformarEmInputs()
 */
function gerarInputs ($descricao, $registro=null, $sobreEscreverCampos=array(), $conversoes=array(), $padroes=array())
{
	# Adiciona os valores á matriz em caso de atualização
	if ( isset($registro) ) {
		foreach ($descricao as $vetor => $array) {
			$descricao[$vetor]['valor'] = $registro[$descricao[$vetor]['Field']];
		}
	}

	return transformarEmInputs($descricao, $sobreEscreverCampos, $conversoes, $padroes);
}

/**
 * Cria e exibe formulario
 * @package	grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 *
 * @uses	persistencia.php->executar()
 * @uses	formularios.php->codificarArray()
 * @uses	formularios.php->descreverTabela()
 * @uses	formularios.php->exibirTemplate()
 * @uses	formularios.php->gerarInputs()
 * @uses	formularios.php->gerarLabels()
 * @uses	sql.php->selecao()
 *
 * @example
		$sobreescreverLabels = array('titulo'=> 'Título');
		$sobreEscreverCampos = array();
		$remover = array();
		$esconder = array();
		$conversoes = array();
		$descricaoLabels = array('titulo'=> 'Título');
		$padroes = array();

		$form = gerarFormulario('hospital',
			$sobreescreverLabels,
			$sobreEscreverCampos,
			$remover,
			$esconder,
			$conversoes,
			$descricaoLabels,
			$padroes
		);
		echo('<pre>');
		print_r($form);
		echo('</pre>');
 */
function gerarFormulario ($MODULO, $sobreEscreverLabels=array(), $sobreEscreverCampos=array(), $remover=array(), $esconder=array(), $conversoes=array(), $descricaoLabels=array(), $padroes=array())
{
	# Gera campos
	$registro = null;
	if ( isset($_GET['codigo']) ) {
		$esconder[] = 'id'; # transforma em hidden

		$registro = selecionar($MODULO, array('id'=> $_GET['codigo']) );

		if ( empty($registro) ) {
			$registro = $registro[0];
		} else {
			return array("Código inválido", 1);
		}
	}

	$descricao = descreverTabela($MODULO);

	# REMOVE CAMPOS & LABELS
	if ( !isset($_GET['codigo']) ) {
		$remover[] = 'id';
	}

	if ( isset($remover) ) {
		foreach ($remover as $valor) {

			foreach ($descricao as $i => $v) {
				if ($valor == $v['Field']) {
					unset($descricao[$i]);
				}
			}
		}
	}

	$campos = gerarInputs($descricao, $registro, $sobreEscreverCampos, $conversoes, $padroes);
	$labels = gerarLabels($descricao, $sobreEscreverLabels, $descricaoLabels);

	return montarTemplate($campos, $labels, $esconder);
}

/**
 * Cria e exibe formulario
 * @package	grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 * @param	array
 *
 * @uses	persistencia.php->executar()
 * @uses	formularios.php->descreverTabela()
 * @uses	formularios.php->gerarInputs()
 * @uses	formularios.php->gerarLabels()
 * @uses	textos.php->comecaCom()
 * @uses	formularios.php->montarTemplate()
		$sobreescreverLabels = array('titulo'=> 'Título');
		$sobreEscreverCampos = array();
		$remover = array();
		$esconder = array();
		$conversoes = array();
		$descricaoLabels = array('titulo'=> 'Título');
		$padroes = array();

		$form = gerarFormulario('hospital',
			$sobreescreverLabels,
			$sobreEscreverCampos,
			$remover,
			$esconder,
			$conversoes,
			$descricaoLabels,
			$padroes
		);
		echo('<pre>');
		print_r($form);
		echo('</pre>');
 */
function gerarFormularioAtualizacao ($MODULO, $sobreEscreverLabels=array(), $sobreEscreverCampos=array(), $remover=array(), $esconder=array(), $conversoes=array(), $descricaoLabels=array(), $padroes=array())
{
	$esconder[] = 'id';

	$descricao = descreverTabela($MODULO);

	if ( isset($remover) ) {
		foreach ($remover as $valor) {

			foreach ($descricao as $i => $v) {
				if ($valor == $v['Field']) {
					unset($descricao[$i]);
				}
			}
		}
	}

	foreach ($descricao as $value) {
		if ( $value['Type'] == "tinyint(1)" ) {
			$registro[ $value['Field'] ] = 1;
		} else {
			$registro[ $value['Field'] ] = '<?php echo bloquearXSS([&quot;'. $value['Field'] .'&quot;]) ?&gt;';
		}
	}

	$campos = gerarInputs($descricao, $registro, $sobreEscreverCampos, $conversoes, $padroes);
	$labels = gerarLabels($descricao, $sobreEscreverLabels, $descricaoLabels);

	$d = array_values($descricao);
	$y = 0;

	foreach ($campos as $i => $v) {

		if ( contem('<input type="checkbox"', $v) ) {
			$campos[$i] = str_replace('checked="checked"', '<?php echo checked($obj["'.$i.'"]) ?&gt;', $v);
		} else
		if ( contem('<input type="radio"', $v) ) {

			$z = str_replace('set(', '', $d[$y]['Type']);
			$z = str_replace(')', '', $z);
			$z = str_replace("'", '', $z);
			$x = explode(",", $z);

			$campos[$i] = str_replace('   />', ' <?php echo checked($obj["'.$i.'"], "xxx") ?&gt; />', $v);

			foreach ($x as $p) {
				$campos[$i] = substituirOcorrencia ('xxx', $p, $campos[$i]);
			}
		}
		$y++;
	}

	return montarTemplate($campos, $labels, $esconder);
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
 */
function criarFormularioAtualizacao ($MODULO, $sobreEscreverLabels=array(), $sobreEscreverCampos=array(), $remover=array(), $esconder=array(), $conversoes=array(), $descricaoLabels=array(), $padroes=array())
{
	$form = gerarFormularioAtualizacao($MODULO,
		$sobreEscreverLabels,
		$sobreEscreverCampos,
		$remover,
		$esconder,
		$conversoes,
		$descricaoLabels,
		$padroes
	);

	$form = html_entity_decode($form);
	$conteudo = "<!-- ". agora( IDIOMA=='pt-BR' ) . "-->\n" .$form;
	escrever(ARQUIVOS_EFEMEROS."/views/{$MODULO}-atualizacao.php", $conteudo, true);

	if ( !empty($conteudo) ) {
		return $conteudo;
	}
	return false;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
 */
function criarFormularioInsercao ($MODULO, $sobreEscreverLabels=array(), $sobreEscreverCampos=array(), $remover=array(), $esconder=array(), $conversoes=array(), $descricaoLabels=array(), $padroes=array())
{
	$form = gerarFormulario($MODULO,
		$sobreEscreverLabels,
		$sobreEscreverCampos,
		$remover,
		$esconder,
		$conversoes,
		$descricaoLabels,
		$padroes
	);

	$conteudo = "<!-- ". agora( IDIOMA=='pt-BR' ) . "-->\n" .$form;
	escrever(ARQUIVOS_EFEMEROS."/views/{$MODULO}-insercao.html", $conteudo, true);

	return $form;
}

/**
 * Cria labels conforme descrição de tabelas
 * @package	grimoire/bibliotecas/formularios.php
 * @since	05-07-2015
 * @version	16/07/2021 11:09:43
 *
 * @param	string
 * @param	array
 * @param	array
 * @return	string
 *
 * @uses	vetores.php->existeIndice()
 * @uses	html.php->label()
 */
function gerarLabels ($descricao, $sobreEscreverLabels=array(), $descricaoLabels=array())
{
	$labels = array();
	$atributos = array();

	foreach ($descricao as $array) {
		$rotulo = ucwords($array['Field']); # Usa nome do campo capitalizado como label

		# Sobreescreve labels
		foreach ($sobreEscreverLabels as $key => $value) {
			if ($key == $array['Field']) {
				$rotulo = $sobreEscreverLabels[$key];
				unset($sobreEscreverLabels[$key]); # remove da lista de sobrescrição
			}
		}

		# Adiciona descrição das labels caso tenha sido definida
		foreach ($descricaoLabels as $key => $value) {
			if ($key == $array['Field']) {
				$atributos['title'] = $descricaoLabels[$array['Field']];
				unset($descricaoLabels[$array['Field']]); // remove da lista de sobrescrição
			}
		}

		# adiciona span
		if ( $array['Null'] == 'NO' ) {
			$rotulo .= ' <span class="simbolo-obrigatorio">*</span>';
		}

		# Cria as labels
		$labels[$array['Field']] = label($rotulo, $array['Field'], $atributos);
	}

	return $labels;
}

/**
 * Transforma uma descrição de tabela em inputs
 * @package	grimoire/bibliotecas/formularios.phpgerarInputs
 * @since	21/07/2021 10:58:43
 *
 * @param	array	Resultado do comando 'show columns from table'
 * @param	array	Par de chave/valor indicando que campo deve ter outro tipo de campo
 * @param	array	Realiza conversão no valor do campo
 * @param	array	Acrescenta classes para uso via js
 *
 * @return	array	Inputs de formulário  html
 *
 * @see padrão de nomenclatura de FK's <----------------------------------------
 * @uses	VARIOS
 */
function transformarEmInputs ($descricao, $sobreEscreverCampos=array(), $conversoes=array(), $padroes=array())
{
	$resposta = array();

	foreach ($descricao as $campo) {

		# Em 'alterar' adiciona valor
		$valor = isset($campo['valor']) ? $campo['valor'] : "";

		# Se for obrigatorio
		$atributos = array();
		if ($campo['Null'] == "NO") {
			$atributos[0] = 'obrigatorio';
			$atributos['required'] = 'required';
		}

		// CAMPOS DEFAULT
		$tipo = "text";

		# date
		if ($campo['Type'] == "date") {
			$atributos['maxlength'] = 10;
			$atributos[0] .= " padraoData";
		# datetime & timestamp
		} else if ($campo['Type'] == "datetime" || $campo['Type'] == "timestamp") {
			$atributos['maxlength'] = 19;
		# enum
		} else if ( comecaCom("enum", $campo['Type']) || comecaCom("set", $campo['Type']) ) {
			$tipo = 'radio';
		# bit
		} else if ( comecaCom("bit", $campo['Type']) || comecaCom("tinyint(1)", $campo['Type']) ) {
			$tipo = 'checkbox';
		# text
		} else if ($campo['Type'] == "text") {
			$tipo = 'textarea';
		# campos q definem tamanho maximo [int, varchar, tinyint, decimal]
		} else {
			$pos1 = stripos($campo['Type'], "(");
			$maxlength = substr($campo['Type'], $pos1+1, -1);

			// Corrige maxlength de decimais
			if ( !is_numeric($maxlength) ) {
				$maxlength = explode(",", $maxlength);
				$maxlength = (int) $maxlength[0] + $maxlength[1];
			}
			$atributos['maxlength'] = $maxlength;

			// PRIMARY KEY
			if ($campo['Key'] == "PRI") {
				$tipo = "hidden";
			}

			# Se campo for chave estrangeira
			if (comecaCom("id_", $campo['Field'])) {
				$tipo = "foreignKey";
			}
		}

		foreach ($sobreEscreverCampos as $key => $value) {
			if ($key == $campo['Field']) {
				$tipo = $sobreEscreverCampos[$key];
				unset($sobreEscreverCampos[$key]); // remove da lista de sobrescrição
			}
		}

		// REALIZA CONVERSÂO DE VALOR EM CASO DE ATUALIZAÇÃO
		if ( !empty($valor) ) {

			$indice = existeIndice($campo['Field'], $conversoes);
			if ( $indice != -1 ) {
				switch ($conversoes[$indice]) {
					case "dinheiro":
						$valor = converterDinheiro($valor);
						break;

					case "data":
						$valor = converterData($valor);
						break;
					default:
				}
				unset($conversoes[$indice]); // remove campo
			}
		}

		// Constrói o elemento
		switch ($tipo) {

			case "foreignKey":
				// Identifica a tabela
				$tabela = str_replace("Id", "", $campo['Field']);
				$tabela .= "s"; # <------------------------------------------Modificar regra
				$listaObjetos = selecionar($tabela);

				$valores = array();
				foreach ($listaObjetos as $objeto) {
					$valores[$objeto['id']] = $objeto['nome']; # adicionar opção para que seja selecionado o campo a exibir
				}
				$valores = gerarSelect($campo['Field'], $valores, $valor); # PODE DAR ERRO? colocar um if (!empty valor)
				$resposta[$campo['Field']] = $valores;
				break;

			case "password":
				$resposta[$campo['Field']] = password($campo['Field'], $valor, $atributos);
				break;

			case "span":
				unset($atributos['maxlength']);
				unset($atributos[0]);
				if ($valor == 0) {
					$valor = (string) " 0"; // corrige spans com valor 0
				}
				$resposta[$campo['Field']] = span($valor, $atributos);
				break;

			case "text":
				# aqui adiciona padrões
				$indice = existeIndice($campo['Field'], $padroes);
				if ( $indice != -1) {
					$atributos[0] .= ' padrao'. ucwords($padroes[$indice]);
				}

				# aqui adiciona padrões
				$resposta[$campo['Field']] = text($campo['Field'], $valor, $atributos);
				break;

			case "hidden":
				$resposta[$campo['Field']] = hidden($campo['Field'], $valor);
				break;

			case "file":
				$resposta[$campo['Field']] = file2($campo['Field'], null);
				break;

			case "textarea":
				$resposta[$campo['Field']] = textarea($campo['Field'], $valor, $atributos);
				break;

			case "checkbox":
				$resposta[$campo['Field']] = checkbox($campo['Field'], 1, $valor, $atributos, '');
				break;

			case "radio":
				$pos1 = stripos($campo['Type'], "(");
				$lista = substr($campo['Type'], $pos1+1, -1); // Pega só o conteúdo entre paranteses
				$lista = str_replace("'", "", $lista); // Retira aspas
				$valores = explode(",", $lista);

				// Se tiver mais que 4 valores converte para select
				if ( count($valores) > 4 ) {
					// ! não testado
					$resposta[$campo['Field']] = gerarSelect($campo['Field'], $valores, $valor);

				} else {
					$x = gerarRadio($campo['Field'], $valores, $valor);
					$resposta[$campo['Field']] = implode ("\n", $x);
				}
				break;

			case "select":
				$pos1 = stripos($campo['Type'], "(");
				$lista = substr($campo['Type'], $pos1+1, -1); // Pega só o conteúdo entre paranteses
				$lista = str_replace("'", "", $lista); // Retira aspas
				$valores = explode(",", $lista);

				foreach ($valores as $indice=>$val) {
					$valoresX[$val] = $val;
				}
				$valores = $valoresX;

				$valores = gerarSelect($campo['Field'], $valores, $valor); # PODE DAR ERRO? colocar um if (!empty valor)
				$resposta[$campo['Field']] = $valores;
				break;

			case "textEditor":
				$resposta[$campo['Field']] = textarea($campo['Field'], $valor, $atributos);
				break;
			default;
		}
	}
	return $resposta;
}
