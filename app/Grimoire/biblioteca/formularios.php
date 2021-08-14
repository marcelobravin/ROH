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
function gerarInputs ($descricao, $registro=null, $sobreEscreverCampos=array(), $padroes=array())
{
	# Adiciona os valores á matriz em caso de atualização
	if ( isset($registro) ) {
		foreach ($descricao as $vetor => $array) {
			$descricao[$vetor]['valor'] = $registro[$descricao[$vetor]['Field']];
		}
	}

	return transformarEmInputs($descricao, $sobreEscreverCampos, $padroes);
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

	foreach ($descricao as $array) {
		$atributos = array();

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
function transformarEmInputs ($descricao, $sobreEscreverCampos=array(), $padroes=array())
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
			$atributos[] = "padraoData";
			# datetime & timestamp
		} else if ($campo['Type'] == "datetime" || $campo['Type'] == "timestamp") {
			$atributos['maxlength'] = 19;
			$atributos[] = "padraoTimestamp";
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

		$resposta[$campo['Field']] = construirElemento($tipo, $campo, $valor, $atributos, $padroes);
	}

	return $resposta;
}

function construirElemento ($tipo, $campo, $valor, $atributos, $padroes)
{
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
			$resposta = $valores;
			break;

		case "password":
			$resposta = password($campo['Field'], $valor, $atributos);
			break;

		case "span":
			unset($atributos['maxlength']);
			unset($atributos[0]);
			if ($valor == 0) {
				$valor = (string) " 0"; // corrige spans com valor 0
			}
			$resposta = span($valor, $atributos);
			break;

		case "text":
			# aqui adiciona padrões
			$indice = existeIndice($campo['Field'], $padroes);

			if ( $indice > 0) {
				$atributos[0] .= ' padrao'. ucwords($padroes[$campo['Field']]);
			}

			# aqui adiciona padrões
			$resposta = text($campo['Field'], $valor, $atributos);
			break;

		case "hidden":
			$resposta = hidden($campo['Field'], $valor);
			break;

		case "file":
			$resposta = file2($campo['Field'], null);
			break;

		case "textarea":
			$resposta = textarea($campo['Field'], $valor, $atributos);
			break;

		case "checkbox":
			$resposta = checkbox($campo['Field'], 1, $valor, $atributos, '');
			break;

		case "radio":
			$pos1 = stripos($campo['Type'], "(");
			$lista = substr($campo['Type'], $pos1+1, -1); // Pega só o conteúdo entre paranteses
			$lista = str_replace("'", "", $lista); // Retira aspas
			$valores = explode(",", $lista);

			if ( count($valores) > 4 ) { # Se tiver mais que 4 valores converte para select
				$resposta = gerarSelect($campo['Field'], $valores, $valor);
			} else {
				$x = gerarRadio($campo['Field'], $valores, $valor);
				$resposta = implode ("\n", $x);
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
			$resposta = $valores;
			break;

		case "textEditor":
			$resposta = textarea($campo['Field'], $valor, $atributos);
			break;
		default;
	}

	return $resposta;
}
