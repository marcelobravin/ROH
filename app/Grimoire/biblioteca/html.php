<?php
/**
 * Criação de elementos html
 * @package	grimoire/bibliotecas
*/

/**
 * Retorna o navegador do usuário
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 */
function breadCrumb ($paginas, $separador=" > ")
{
	if (isset($paginas) && is_array($paginas)) {
		$links = gerarBreadCrumb($paginas);
		return implode($separador, $links);
	}
}

/**
 * Retorna o navegador do usuário
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	array
 * @return	array
 */
function gerarBreadCrumb ($paginas)
{
	$total = count($paginas) -1;
	foreach ($paginas as $key => $v) {
		if ($key < $total) {
			$resposta[] = "<a href='{$v['endereco']}'>{$v['titulo']}</a>";
		} else {
			$resposta[] = "<span>{$v['titulo']}</span>";
		}
	}

	return $resposta;
}

/**
 * Gera input checkbox ou radio
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string: checkbox/radio
 * @param	string
 * @param	string
 * @param	boolean
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	echo box("checkbox", "", "positivo", false, ["data-atributo"=>1, "classe"]);
 */
function box ($tipo="checkbox", $nome="", $valor="", $selecionado=false, $atributos=array())
{
	if ( !is_array($atributos) ) {
		$atributos = array($atributos);
	}

	if ( $selecionado ) {
		$atributos['checked'] = 'checked';
	}

	return gerarInput($tipo, $nome, $valor, $atributos);
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/html.php
 * @since	05-07-2015
 * @version	07/07/2021 11:34:44
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 */
function checked ($parametro, $alvo=1)
{
	return marcado($parametro, $alvo, true);
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/html.php
 * @since	05-07-2015
 * @version	07/07/2021 11:34:44
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 */
function selected ($parametro, $alvo=1)
{
	return marcado($parametro, $alvo, false);
}

/**
 * Gera uma lista com itens simples
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo criarLista(array("a", "b", "c"), false);
 */
function criarLista ($itens=array(), $ordenada=false, $atributos=array())
{
	$atributo = gerarAtributos($atributos);
	$lista = concatenar($itens, "<li>", "</li>");
	$ordenada
		? $tag = "ol"
		: $tag = "ul";
	return "<$tag $atributo>$lista</$tag>";
}

/**
 * Inclui o arquivo gerador de css
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @return	string
 *
 * @example
	echo gerarCss();
	echo "</head><body>Olá Mundo!";
 */
function gerarCss ()
{
	return '<link rel="stylesheet" href="css.php" type="text/css" />';
}

/**
 * Gera atributos para os elementos html
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string/array
 * @return	string
 *
 * @example
	echo gerarAtributos("classe"); // só classe
	echo gerarAtributos(array("width" => "300px")); // só atributo
	echo gerarAtributos(array(1, "b"=>"BB")); // classe e atributo
 */
function gerarAtributos ($atributos=array())
{
	if ( empty($atributos) ) {
		return "";
	}

	if ( !is_array($atributos) ) {
		return ' class="'.$atributos.'"';
	}

	$array = array();
	foreach ($atributos as $indice => $valor) {
		if ( !is_numeric($indice) ) {
			$array[] = $indice.'="'.$valor.'"';
			unset($atributos[$indice]);
		}
	}

	$classes = array();
	foreach ($atributos as $valor) {
		$classes[] = $valor;
	}

	if ( !empty($classes) ) {
		$c = implode(" ", $classes);
		$array[] = 'class="'.$c.'"';
	}

	$string = implode(" ", $array);
	return " ".$string;
}

/**
 * Gera um vetor com o tag de abertura e fechamento de qualquer elemento
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string elemento a ser criado
 * @param	array: atributos que o elemento terá
 * @return	array: array com dois índices, sendo 0 a abertura do elemento e 1 o fechamento
 *
 * @uses	html.php->gerarAtributos()
 * @example
 */
function gerarBloco ($elemento, $atributos=array())
{
	$atributo = gerarAtributos($atributos);
	$input[] = "<$elemento $atributo>";
	$input[] = "</$elemento>";
	return $input;
}

/**
 * Gera qualquer elemento com fechamento e conteudo inline
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @uses	html.php->gerarBloco()
 * @example
		echo gerarElemento("a", "ola!", array("href"=>"#", "disabled"=>"disabled"));
 */
function gerarElemento ($elemento, $conteudo="", $atributos=array())
{
	if ( empty($conteudo) ) {
		return gerarBloco($elemento, $atributos);
	}
	$atributo = gerarAtributos($atributos);
	return "<$elemento $atributo>$conteudo</$elemento>";
}

/**
 * Gera inputs text, password e hidden
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	echo gerarInput("text", "campo", "valor", "classe");
	echo gerarInput("text", "campo", "valor", array("classe", "classe2", "data-exemplo" => "data-valor"));
 */
function gerarInput ($tipo="text", $nome="campo", $valor="", $atributos=array(), $id=null)
{
	$atributos['type']	= $tipo;
	$atributos['name']	= $nome;

	if ( empty($id) ) {
		$atributos['id'] = $nome;
	} else {
		$atributos['id'] = $id;
	}

	if ( !empty($valor) ) {
		$atributos['value']	= $valor;
	}

	$atributos = gerarAtributos($atributos);
	return '<input'.$atributos.' />';
}

/**
 * @deprecated
 * Gera referências a múltiplas folhas de estilos
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo incluirCss("style.css");
		$listaFolhas = incluirCss(array("style.css", "css.css"));
		echo $listaFolhas[0] . $listaFolhas[1];
 */
function incluirCss ($arquivo=array(), $midia="all")
{
	$links = array();

	if (is_array($arquivo)) {
		foreach ($arquivo as $valor) {
			if (file_exists($valor) && identificarTipo($valor) == "css") {
				$links[] = '<link href="' . $valor . '" rel="stylesheet" type="text/css" media="' . $midia . '" />';
			}
		}
	} else {
		if (identificarTipo($arquivo) == "css") {
			$links[] = '<link href="' . $arquivo . '" rel="stylesheet" type="text/css" media="' . $midia . '" />';
		}
	}
	return $links;
}

/**
 * Retorna a definição de diversos tipos de favicons
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @return	array
 */
function incluirFavicons ()
{
	$favicon	 = array();
	//<link href="../favicon.ico" rel="shortcut icon">
	$favicon[] = '<!-- Opera Speed Dial Favicon -->';
	$favicon[] = '<link rel="icon" type="image/png" href="/speeddial-160px.png" />';
	$favicon[] = '<!-- Standard Favicon -->';
	$favicon[] = '<link rel="icon" type="image/x-icon" href="/favicon.ico" />';
	$favicon[] = '<!-- For iPhone 4 Retina display: -->';
	$favicon[] = '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">';
	$favicon[] = '<!-- For iPad: -->';
	$favicon[] = '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">';
	$favicon[] = '<!-- For iPhone: -->';
	$favicon[] = '<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-57x57-precomposed.png">';
	return $favicon;
}

/**
 * Gera múltiplas referências de script
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	array
 * @return	string
 *
 * @example
	echo incluirJs("js.js"); // Gera um item
	$listaScripts = incluirJs(array("js.js", "jQuery.js")); // Gera multiplos itens
	exibir($listaScripts);
 */
function incluirJs ($arquivo=array())
{
	$script = array();
	if (is_array($arquivo)) {
		foreach ($arquivo as $valor) {
			if (file_exists($valor) && identificarTipo($valor) == "script") {
				$script[] = '<script href="' . $valor . '" type="text/javascript"></script>';
			}
		}
	} else {
		if (identificarTipo($arquivo) == "script") {
			$script[] = '<script href="' . $arquivo . '" type="text/javascript"></script>';
		}
	}
	return $script;
}

/**
 * Gera título e outros metas
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @uses	config.php->CARACTERES
 * @example
		exibir(gerarMetas("Página2"));
 */
function gerarMetas ($titulo="Página")
{
	$metas	= array();
	$metas[] = '<meta http-equiv="Content-type" content="text/html; charset="'. CARACTERES .'" />';
	$metas[] = '<meta charset="'. CARACTERES .'">';
	$metas[] = gerarElemento("title", $titulo);
	$metas[] = '<meta content="'. $titulo .'" property="og:title">';
	$metas[] = '<meta content="Texto" property="og:description">';
	$metas[] = favicon("arquivos/imagens/icones/favicon.ico");
	$metas[] = '<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">';
	$metas[] = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	$metas[] = '<meta name="author" content="Marcelo de Souza Bravin">';
	//<link rel=”author” href=”https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]“/>
	//<link rel=”publisher” href=”https://plus.google.com/[YOUR BUSINESS G+ PROFILE HERE]“/>
	//<link rel=”publisher” href=”https://plus.google.com/[YOUR BUSINESS G+ PROFILE HERE]“/>
	$metas[] = '<meta name="generator" content="Notepad++">';
	$metas[] = '<meta name="copyright" content="&copy; 2013 Acme Corp.">';
	$metas[] = '<meta name="keywords" content="css3, web design, programação">';
	$metas[] = '<meta name="description" content="Portfólio de desenvolvimento de sistemas">';
	$metas[] = '<meta name="date" content="2013-05-28T09:49:37+00:00">';
	$metas[] = '<META NAME="rating" CONTENT="General">';
	$metas[] = '<META NAME="expires" CONTENT="never">';
	$metas[] = '<META NAME="language" CONTENT="portuguese">';
	$metas[] = '<META NAME="distribution" CONTENT="Global">';
	$metas[] = '<META NAME="revisit-after" CONTENT="7 Days">';
	$metas[] = '<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
				<!--[if lt IE 9]>
					<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
				<![endif]-->';

	return $metas;
}

/**
 * Monta página inteira
 * @package	grimoire/bibliotecas/html.php
 * @since05-07-2015
 * @version	06/07/2021 14:06:13
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	$metas = gerarMetas("oloco, meu!", array("robots"=>"no-cache", "description"=>'My site', "keywords"=>"palavras", "author"=>"autor"));
	$scriptsJs = array(incluirJs("js.js"), incluirJs("jQuery.js"));
	//$folhaEstilo = incluirCss("css.css");
	$folhaEstilo = array(incluirCss("css.css"), incluirCss("style.css"));
	$favicon = incluirFavicon();
	//gerarPagina2($metas, array("!!!"), $folhaEstilo, $scriptsJs, $favicon); // Gera página com metas
	gerarPagina2(null, array("!!!"), $folhaEstilo, $scriptsJs); // Gera página com metas
 */
function gerarPagina ($conteudoHead=array(), $conteudoBody=array(), $folhaEstilo=array(), $scriptsJs=array(), $favicon=array())
{
	// Se tiver scripts
	if ( !empty($scriptsJs) ) {
		$conteudoAlternativo = '<p>Javascript desligado acesse <a href="http://someplace.com/data">link</a>.<p>';
		$conteudoBody[]	= gerarElemento("noscript", $conteudoAlternativo); // incluir noscript
		$conteudoHead[]	= '<meta http-equiv="Content-Script-Type" content="type">';
	}
	// Se parametros forem arrays identa
	$identacao		= "		";
	$conteudoHead	= concatenar($conteudoHead	, $identacao, "\n");
	$conteudoBody	= concatenar($conteudoBody	, $identacao, "\n");
	$favicon		= concatenar($favicon		, $identacao, "\n");
	$scriptsJs		= concatenar($scriptsJs		, $identacao, "\n");
	$folhaEstilo	= concatenar($folhaEstilo	, $identacao, "\n");

	$html = html();
	$head = head();
	$body = body();

	return array(
		$html[0],
			$head[0],
				$conteudoHead . $favicon . $folhaEstilo,
			$head[1],
			$body[0],
				$conteudoBody . $scriptsJs,
			$body[1],
		$html[1],
	);
}

/**
 * Gera select com options simples
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	echo gerarSelect("Estado", array(1=>"SP", 2=>"RJ", 3=>"RR"), 2, "aha");
	echo gerarSelect("Estado", array("SP", "RJ", "RR"), 2, "aha");
 */
function gerarSelect ($nome, $valores=array(), $valorSelecionado=null, $atributos=array())
{
	$select = select($nome, $atributos);
	$input	= $select[0];
	$input .= gerarOptions($valores, $valorSelecionado);
	$input .= $select[1];
	return $input;
}

/**
 * Gera options baseado em array associativa
 * @package	grimoire/bibliotecas/html.php
 * @since05-07-2015
 * @version	06/07/2021 12:29:46
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	echo gerarOptions(array("SP", "RJ", "MT"), 2);
	echo gerarOptions(array(1=>"SP", 3=>"RJ", 2=>"MT"), 2);
	echo gerarOptions ($categorias, 3);
 */
function gerarOptionsAA ($valores=array(), $indiceSelecionado=null, $atributos=array(), $indiceDoValue='id', $indiceDoTexto='titulo')
{
	$options = "";
	if ( is_array($valores) ) {

		$atributos = gerarAtributos($atributos);
		foreach ($valores as $valor) {
			if ($valor[$indiceDoValue] == $indiceSelecionado) {
				$options .= option($valor[$indiceDoTexto], $valor[$indiceDoValue], true, $atributos);
			} else {
				$options .= option($valor[$indiceDoTexto], $valor[$indiceDoValue], false, $atributos);
			}
		}
	}

	return $options;
}

/**
 * Gera options baseado em array numerada ou objeto
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	echo gerarOptions(array("SP", "RJ", "MT"), 2);
	echo gerarOptions(array(1=>"SP", 3=>"RJ", 2=>"MT"), 2);
 */
function gerarOptions ($valores=array(), $indiceSelecionado=null, $atributos=array())
{
	$options = "";
	if ( is_array($valores) || is_object($valores) ) {

		$atributos = gerarAtributos($atributos);
		foreach ($valores as $indice => $valor) {
			$options .= "\n";
			if ($indice == $indiceSelecionado || $valor == $indiceSelecionado) {
				$options .= option($valor, $indice, true, $atributos);
			} else {
				$options .= option($valor, $indice, false, $atributos);
			}
		}
		$options .= "\n";
	}

	return $options;
}

/**
 * Gera inputs radio
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	array
 *
 * @uses	html.php->gerarAtributos()
 * @example
	$campos = gerarRadio("uf", array("SP", "RJ"), "RJ");
	$campos = gerarRadio("sexo", array("Masc"=>"M", "Fem"=>"F"), "F");
	echo implode("<br>", $campos);
 */
function gerarRadio ($nome, $valores=array(), $valorSelecionado=-1, $atributos=array())
{
	if ( !is_array($atributos) ) {
		$atributos = array($atributos);
	}

	$inputs = array();
	foreach ($valores as $indice => $valor) {

		if ($valor == $valorSelecionado) {
			$atributos['checked'] = "checked";
		} else {
			unset($atributos['checked']);
		}

		$input = "<label>";
		$input .= gerarInput("radio", $nome, $valor, $atributos, $nome.'['.$indice.']');

		if ( is_numeric($indice) ) {
			$input .= " ".ucfirst($valor);
		} else {
			$input .= " ".ucfirst($indice);
		}
		$input .= "</label>";
		$inputs[] = $input;
	}

	return $inputs;
}

/**
 * Gera inputs checkbox
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	exibir( gerarCheckbox("termos", array("Esporte", "Cinema", "Teatro"), array(2, 0)));
	exibir(gerarCheckbox("termos", array("Esporte", "Cinema", "Teatro"), 1));
 */
function gerarCheckbox ($nome, $valores=array(), $valoresSelecionados=array(), $atributos=array())
{
	$atributos = gerarAtributos($atributos);
	if (is_array($valores)) {
		$inputs = array();
		foreach ($valores as $indice => $valor) {
			if (is_array($valoresSelecionados)) {
				$inputs[] = checkbox($valor, $indice, in_array($indice, $valoresSelecionados));
			} else {
				$inputs[] = checkbox($valor, $indice, $valoresSelecionados == $indice);
			}
		}
	} else {
		$boolean = ($valoresSelecionados) ? true : false;
		$inputs = checkbox($nome, $valores, $boolean);
	}
	return $inputs;
}

/**
 * Verifica se o parametro enviado é igual ao alvo
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string
 * @param	boolean
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
 */
function marcado ($parametro, $alvo, $check=true)
{
	if ($parametro == $alvo) {

		if ($check) {
			return 'checked="checked"';
		} else {
			return 'selected="selected"';
		}
	}
}

/**
 * Gera tabela
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
	$headers = array("nome", "email", "profissao");
	$matriz = array();
	$matriz[] = array("zé", "ze@ze.com", "pedreiro");
	$matriz[] = array("zé2", "zemane@ze.com", "carpidor");
	echo montarTabela($headers, $matriz, "", "Funcionarios");
	echo montarTabela($headers, $matriz, "", "Funcionarios", "Detalhes sobre os funcionários");
 */
function montarTabela ($headers=array(), $matriz=array(array()), $atributos=array(), $titulo="", $descricao="")
{
	$atributos = gerarAtributos($atributos);
	// colspan && rowspan??
	// col group??
	if (!empty($descricao)) {
		$tabela = "<table border='1' $atributos summary='$descricao'>";
	} else {
		$tabela = "<table border='1' $atributos>";
	}

	if (!empty($titulo)) {
		$tabela .= "<caption>$titulo</caption>";
	}

	if (!empty($headers)) {
		$tabela .= "<thead>";
		$tabela .= "<tr>";
		foreach ($headers as $header) {
			$tabela .= "<th scope='col' headers='$header' id='$header'>$header</th>";
		}
		$tabela .= "</tr>";
		$tabela .= "</thead>";
	}

	$i = 0;
	$tabela .= "<tbody>";
	// Itera pelos vetores da matriz
	foreach ($matriz as $vetor) {
		// Adiciona zebramento a linha
		$classe = "";
		if ($i % 2 == 1) {
			$classe = "class='linhaPar'";
		}
		$tabela .= "<tr $classe>";
		// Itera pelos dados do vetor
		foreach ($vetor as $dado) {
			//if ($dado == $vetor[0]) scope="row"
			//$tabela .= "<td headers='$headers[$i]'>$dado</td>";
			$tabela .= "<td>$dado</td>";
		}
		$tabela .= "</tr>";
		$i++;
	}
	$tabela .= "</tbody>";
	$tabela .= "</table>";
	return $tabela;
}

/**
 * Cria meta refresh
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 */
function refresh ($url="", $tempo="0")
{
	if ( empty($url) ) {
		return "<meta http-equiv='refresh' content='$tempo'>";
	} else {
		return "<meta http-equiv='refresh' content='$tempo; url=$url'>";
	}
}

/**
 * Retorna atributo html se indice GET existir e for igual ao valor
 *
 * @package	grimoire/bibliotecas/html.php
 * @since	05-07-2015
 * @version	31-07-2015 16:43
 *
 * @param	string
 * @param	string
 * @param	string
 *
 * @return	string
 *
 * @example
	<option value="Ativas" <?php echo selecionado("status", "Ativas") ?>>Ativas</option>
*/
function selecionado ($indice, $valor, $atributo='selected')
{
	if ( isset($_GET) && isset($_GET[$indice]) && $_GET[$indice] ==$valor ) {
		return $atributo.'="'. $atributo .'"';
	}
}

/**
 * Retorna atributo html se subindice GET existir e for igual ao valor
 *
 * @package	grimoire/bibliotecas/html.php
 * @since	28/07/2021 10:50:44
 *
 * @param	string
 * @param	string
 * @param	string
 *
 * @return	string
 *
 * @example
	<option value="Ativas" <?php echo selecionado("status", "Ativas") ?>>Ativas</option>
*/
function selecionadoSubindice ($indice, $subindice, $valor, $atributo='selected')
{
	if ( isset($_GET) && isset($_GET[$indice])  && isset($_GET[$indice][$subindice]) && $_GET[$indice][$subindice]==$valor ) {
		return $atributo.'="'. $atributo .'"';
	}
}

/**
 * Retorna atributo html se ambos valores existirem e forem iguais
 *
 * @package	grimoire/bibliotecas/html.php
 * @since	05-07-2015
 * @version	04/08/2016 11:27:05
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	<option value="Ativas" <?php echo selecionado2("status", "Ativas") ?>>Ativas</option>
*/
function selecionado2 ($valor1, $valor2, $atributo='selected')
{
	if ( isset($valor1) && isset($valor2) && $valor1==$valor2 ) {
		return $atributo.'="'. $atributo .'"';
	}
}

/**
 * Cria um link para uma janela popup
 * @package	grimoire/bibliotecas/html.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 */
function popup ($pagina)
{
	return "
	<a onclick=\"Popup=window.open(this.href,'Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=720,height=600,left=430,top=23'); return false;\" href=\"{$pagina}\">
		pop up
	</a>";
}

/**
 * Cria regra css para sublinhar links que contenham a url da página atual
 * @package grimoire/bibliotecas/html.php
 * @since	04/08/2021 11:43:46
 *
 * @param	string
 * @return	string
 */
function sublinharPaginaAtual ()
{
	return 'nav a[href*="'. paginaAtual() .'"] { text-decoration: underline }';
}

/**
 * Gera noscript
 *
 * @param	string
 * @return  string
 *
 * @example
    echo noscript("Meu Site");
 */
function noscript ($conteudo="<p class='center'>Esse site necessita que o JavaScript esteja ativado para funcionar corretamente.</p>")
{
	return gerarElemento("noscript", $conteudo);
}

/**
 * @since	06/08/2021 10:40:38
 */
function montarTituloPagina ($PAGINA)
{
	$titulo	= $PAGINA['titulo'];
	if ( !empty($PAGINA['titulo']) && !empty($PAGINA['subtitulo']) ) {
		$titulo .=  SEPARADOR_TITULO;
		$titulo .= $PAGINA['subtitulo'];
	}

	return $titulo;
}
