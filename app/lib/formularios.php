<?php
/**
 * Geração automática de formulários via descrição de tabela do BD
 * @package grimoire/bibliotecas
*/

/**
 * Exibe campos conforme layout desse admin
 * @package grimoire/bibliotecas/formularios.php
 * @since	05-07-2015
 * @version	30-06-2021
 *
 * @param	string
 */
function exibirTemplate ($campos, $labels, $esconder=array(), $registro=null)
{
	#include_once "master/componentes/campoStatus.php";// ??????????????????????????????????????
	foreach ($campos as $indice => $c) {
		if (!in_array($indice, $esconder)) { ?>
			<div class="control-group">
	 		<?php echo $labels[$indice] ?>

	 		<div class="controls">

			<?php if (!is_array($c) && strpos($c, "type='file'") !== FALSE) { // Pode dar erro se VALOR contiver file !!!!!!!!!!!!!!!!!!! ?>
				<span class="btn black fileinput-button">
					<i class="icon-plus icon-white"></i>
					<span>Selecione a Foto</span>
			<?php } ?>

			<?php echo $campos[$indice] ?>
			<?php if (!is_array($c) && strpos($c, "type='file'") !== FALSE) { // Pode dar erro se VALOR contiver file !!!!!!!!!!!!!!!!!!!
					if (!empty($_GET['codigo']) && !empty($registro['foto'])) { ?>
						</span>
						</div>
						</div>
						<div class="control-group">
						<label class="control-label">Arquivo</label>
						<div class="controls"><?php

						$dados = getimagesize(IMAGENS. "/{$_GET['modulo']}/{$registro['foto']}");
						echo img(IMAGENS."/{$_GET['modulo']}/{$registro['foto']}", array('style' => "max-height: 200px; border: 1px dashed silver", "title"=>$dados['mime']), false);
						echo $dados[1] .'px';

						echo '<br>'. $dados[0] .'px';
					}
				} ?>
			</div>
		</div>
		<?php } else { ?>
			<?php echo $campos[$indice] ?>
			<?php
		}
	}
}

/**
 * Cria campos conforme descrição da tabela
 * @package grimoire/bibliotecas/formularios.php
 * @since	30-06-2021
 *
 * @param	string
 */
function montarTemplate ($campos, $labels, $esconder=array(), $registro=null)
{
	$x = array();
	foreach ($campos as $indice => $c) {
		if ( !in_array($indice, $esconder) ) { # remover campo em vez de esconder
			$x[] = '<div>';
	 		$x[] = '	'. $labels[$indice];
			$x[] = '	'. $campos[$indice];
			$x[] = '</div>';
		} else {
			$x[] = $campos[$indice];
		}
	}

	// return $x;
	return implode("\r\n", $x);
}

/**
 * Cria elementos html de input conforme uma descrição
 * @package grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
 *
 * @param	array descrição
 * @param	array um registro do BD
 * @param	array array de campos a serem sobrescritos
 * @param	array conversões a serem realizadas
 * @param	array classes a serem adicionadas aos inputs conforme padrões de valor (dinheiro, data, email, telefone, etc)
 * @return	string
 *
 * @uses	formularios.php->transformarEmInputs()
 * @todo	opção html5
 */
function gerarCampos ($descricao, $registro=null, $sobreEscreverCampos=array(), $conversoes=array(), $padroes=array())
{
	// Adiciona os valores á matriz em caso de atualização
	// if ( isset($registro) )
	if ( isset($registro) )
		foreach ($descricao as $vetor => $array) {
			$descricao[$vetor]['valor'] = $registro[$descricao[$vetor]['Field']];
		}

	return transformarEmInputs($descricao, $sobreEscreverCampos, $conversoes, $padroes);
}

/**
 * Cria e exibe formulario
 * @package grimoire/bibliotecas/formularios.php
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
 * @uses	formularios.php->gerarCampos()
 * @uses	formularios.php->gerarLabels()
 * @uses	sql.php->selecao()
 * @todo
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
 *
 */
function gerarFormulario ($MODULO, $sobreEscreverLabels=array(), $sobreEscreverCampos=array(), $remover=array(), $esconder=array(), $conversoes=array(), $descricaoLabels=array(), $padroes=array())
{
	// $remover[] = 'status'; # Remove campo status nesse projeto
	$db = new Database();

	# Gera campos
	$registro = null;
	if ( isset($_GET['codigo']) ) {
		$esconder[] = 'id'; # tansforma em hidden

		$registro = $db->selecionar($MODULO, array('id'=> $_GET['codigo']) );

		if ( count($registro) > 0 )
			$registro = $registro[0];
		else
			throw new Exception("Código inválido", 1);
	}

	$descricao = $db->descreverTabela($MODULO);
	$campos = gerarCampos($descricao, $registro, $sobreEscreverCampos, $conversoes, $padroes);
	$labels = gerarLabels($descricao, $sobreEscreverLabels, $descricaoLabels);

	# REMOVE CAMPOS & LABELS
	!isset($_GET['codigo']) ? $remover[] = 'id' : "" ;
	if ( isset($remover) )
		foreach ($remover as $indice=>$valor) {
			unset($campos[$valor]);
			unset($labels[$valor]);
		}

	// exibirTemplate($campos, $labels, $esconder, $registro);
	return montarTemplate($campos, $labels, $esconder, $registro);
}

/**
 * Cria labels
 * @package grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
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

	foreach ($descricao as $vetor => $array) {
		#$atributos = array("control-label"); /* ESPECIFICO DESSE PROJETO */
		// $atributos = array("control-label"); /* ESPECIFICO DESSE PROJETO */
		$rotulo = $array['Field']; # Usa nome do campo como label

		# Sobreescreve labels
		foreach ($sobreEscreverLabels as $key => $value) {
			if ($key == $rotulo) {
				$rotulo = $sobreEscreverLabels[$key];
				unset($sobreEscreverLabels[$key]); # remove da lista de sobrescrição
			}
		}

		# Adiciona descrição das labels
		if ( existeIndice($array['Field'], $descricaoLabels) != -1 ) {
			$atributos['title'] = $descricaoLabels[$array['Field']];
			unset($descricaoLabels[$array['Field']]); // remove da lista de sobrescrição
		}

		# Cria as labels
		$labels[$array['Field']] = label($rotulo, $array['Field'], $atributos);
	}

	return $labels;
}

/**
 * Transforma uma descrição de tabela em inputs
 * @package grimoire/bibliotecas/formularios.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
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
		} else if ( comecaoCom($campo['Type'], "enum") ) {
			$tipo = 'radio';
		# bit
		} else if ( comecaoCom($campo['Type'],"bit") || comecaoCom($campo['Type'], "tinyint(1)") ) {
			$tipo = 'checkbox';
			if ( $valor == 1 )
				$atributos['checked'] = 'checked';
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
			if ($campo['Key'] == "PRI")
				$tipo = "hidden";

			// Se campo for chave estrangeira
			if (terminaCom($campo['Field'], "Id"))
				$tipo = "foreignKey";
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
				if ($valor == 0)
					$valor = (string) " 0"; // corrige spans com valor 0
				$resposta[$campo['Field']] = span($valor, $atributos);
				break;

			case "text":
				# aqui adiciona padrões
				$indice = existeIndice($campo['Field'], $padroes);
				if ( $indice != -1)
					$atributos[0] .= ' padrao'. ucwords($padroes[$indice]);

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
				$resposta[$campo['Field']] = checkbox($campo['Field'], 1, $valor, $atributos);
				break;

			case "radio":
				$pos1 = stripos($campo['Type'], "(");
				$lista = substr($campo['Type'], $pos1+1, -1); // Pega só o conteúdo entre paranteses
				$lista = str_replace("'", "", $lista); // Retira aspas
				$valores = explode(",", $lista);

				// Se tiver mais que 4 valores converte para select
				if (count($valores) <= 4) {
					$x = gerarRadio($campo['Field'], $valores, $valor);
					$resposta[$campo['Field']] = implode ("\n", $x);
					break;
				} else {
					$tipo = "select";
				}

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
				$atributos[0] .= " span12 ckeditor m-wrap";
				$atributos["rows"] = 6;
				$resposta[$campo['Field']] = textarea($campo['Field'], $valor, $atributos);
				break;
		}
	}
	return $resposta;
}

/**
 * Verifica se a string contém o trecho solicitado no começo
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function comecaoCom ($haystack, $needle)
{
	return $needle === "" || strpos($haystack, $needle) === 0;
}

/**
 * Verifica se a string contém o trecho solicitado no final
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function terminaCom ($haystack, $needle)
{
	return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}
