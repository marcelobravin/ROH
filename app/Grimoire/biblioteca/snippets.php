<?php
/**
 * Atalhos para criação de elementos html
 * @package	grimoire/bibliotecas
*/

/**
 * Gera links
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @uses	texto.php->startsWith()
 * @example
		echo a("link", null);
		echo a("link");
 */
function a ($conteudo="", $href="#", $atributos=array())
{
	if ( is_null($href) ) {
		$href = "javascript:void(0)";
	}

	$atributos = gerarAtributos($atributos);

	if (comecaCom("http", $href) || comecaCom("www", $href)) {
		return '<a href="'.$href.'" '.$atributos.' target="_blank">'.$conteudo.'</a>';
	} else {
		return '<a href="'.$href.'" $atributos>'.$conteudo.'</a>';
	}
}

/**
 * Gera elemento body
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
 */
function body ($atributos=array())
{
	return gerarBloco("body", $atributos);
}

/**
 * Adiciona uma quebra de linha html
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	void
 */
function br ()
{
	echo "<br>";
}

/**
 * Gera input checkbox
 * @package	grimoire/bibliotecas/snippets.php
 * @since	05-07-2015
 * @version	19/07/2021 11:37:16
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo checkbox("termos", "1", true);
 */
function checkbox ($nome, $valor="", $selecionado=false, $atributos=array(), $rotulo="")
{
	if ( empty($rotulo) ) {
		return box("checkbox", $nome, $valor, $selecionado, $atributos);
	}

	$input = is_numeric($valor) ? $rotulo : ucfirst($valor);
	$input .= box("checkbox", $nome, $valor, $selecionado, $atributos);
	return label($input);
}

/**
 * Gera uma lista de definição
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$lista = dl("menu");
		exibir($lista);
 */
function dl2 ($atributos=array())
{
	return gerarBloco("dl", $atributos);
}

/**
 * Gera um termo de lista de definição
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$lista = dt("menu");
		exibir($lista);
 */
function dt ($atributos=array())
{
	return gerarBloco("dt", $atributos);
}

/**
 * Gera uma descrição de lista de definição
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$lista = dd("menu");
		exibir($lista);
 */
function dd ($atributos=array())
{
	return gerarBloco("dd", $atributos);
}

/**
 * Gera elemento div
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		exibir(div("active"));
		exibir(div(array("border", "width"=>"200")));
 */
function div ($atributos=array())
{
	return gerarBloco("div", $atributos);
}

/**
 * Cria um elemento embed
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 */
function embed ($url="https://www.youtube.com/watch?v=jo1PvY5pr1A")
{
	return "<embed src='{$url}' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='100%' height='100%'></embed>";
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo favicon();
 */
function favicon ($icone="favicon.ico")
{
	return "<link rel='icon' type='image/x-icon' href='$icone' />";
}

/**
 * Gera um elemento fieldset com um legend
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string/array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		$field = criarField("Campos", "classe");
		echo $field[0] . $field[1];
 */
function fieldset ($legenda="", $atributos=array())
{
	$atributos = gerarAtributos($atributos);
	$fields		= array();
	$fields[]	= "<fieldset $atributos><legend>$legenda</legend>";
	$fields[]	= "</fieldset>";
	return $fields;
}

/**
 * Gera input file
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo file2("foro", null, "image/*", true);
 * @internal Cannot redeclare file
 */
function file2 ($nome, $atributos=array(), $formato="*", $multiplo=false)
{
	$atributos = gerarAtributos($atributos);

	if ($multiplo) {
		$input = "<input type='file' name='$nome' id='$nome' $atributos accept='$formato' multiple='multiple' />";
	} else {
		$input = "<input type='file' name='$nome' id='$nome' $atributos accept='$formato' />";
	}

	return $input;
}

/**
 * Gera formulário
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		exibir(form("#", null, true));
 */
function form ($acao="", $metodo="", $enctype=false, $atributos=array())
{
	if (!is_array($atributos)) {
			$aux = $atributos;
			$atributos = array();
			$atributos[] = $aux;
	}
	if (!empty($acao)) {
		$atributos["action"] = $acao;
	}

	if (empty($metodo)) {
		$atributos["method"] = "post";
	}
	else {
		$atributos["method"] = $metodo;
	}

	if ($enctype) {
		$atributos["enctype"] = "multipart/form-data";
	}

	return gerarBloco("form", $atributos);
}

/**
 * Gera título
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h("Welcome", 6, "ala");
 */
function h ($conteudo="", $numero=1, $atributos=array())
{
	$numero = limitarNumero($numero, 1, 6);
	return gerarElemento("h{$numero}", $conteudo, $atributos);
}

/**
 * Gera h1
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h1("Welcome", "classe");
 */
function h1 ($titulo="", $atributos=array())
{
	return h($titulo, 1, $atributos);
}

/**
 * Gera h2
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h2("Welcome", "classe");
 */
function h2 ($titulo="", $atributos=array())
{
	return h($titulo, 2, $atributos);
}

/**
 * Gera h3
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h3("Welcome", "classe");
 */
function h3 ($titulo="", $atributos=array())
{
	return h($titulo, 3, $atributos);
}

/**
 * Gera h4
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h4("Welcome", "classe");
 */
function h4 ($titulo="", $atributos=array())
{
	return h($titulo, 4, $atributos);
}

/**
 * Gera h5
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h5("Welcome", "classe");
 */
function h5 ($titulo="", $atributos=array())
{
	return h($titulo, 5, $atributos);
}

/**
 * Gera h6
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo h6("Welcome", "classe");
 */
function h6 ($titulo="", $atributos=array())
{
	return h($titulo, 6, $atributos);
}

/**
 * Gera elemento head
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
 */
function head ($atributos=array())
{
	return gerarBloco("head", $atributos);
}

/**
 * Gera inputs hidden
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarInput()
 * @example
		echo hidden("codigo", "1047");
 */
function hidden ($nome, $valor="", $atributos=array())
{
	return gerarInput("hidden", $nome, $valor, $atributos);
}

/**
 * Gera elemento html e doctype
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		exibir(html());
 */
function html ($atributos=array())
{
	$atributos = gerarAtributos($atributos);
	$elemento[0] = "<!DOCTYPE html>\n";

	if ( PRODUCAO ) {
		$elemento[0] .= '<html lang="'. IDIOMA .'">';
	} else {
		$elemento[0] .= '<html lang="'. IDIOMA .'" class="ambiente_desenvolvimento">';
	}

	$elemento[1] = "</html>";
	return $elemento;
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
 */
function iframe ($iframe="https://hastaluego1.tempsite.ws/luego_labs/ace-of-space/WebPlayer/WebPlayer.html", $atributos="")
{
	$atributos = gerarAtributos($atributos);
	return "<iframe src='$iframe' $atributos></iframe>";
}

/**
 * Cria um elemento html contendo uma imagem
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	array
 * @param	boolean
 * @return	string
 *
 * @uses	imagens.php->exibirImagem()
 * @example
		echo img("a.jpg", array("classe", "title"=>"titulo", "alt"=>"conteudo alternativo"), false);
 */
function img ($arquivo, $atributos=array(), $proteger=true)
{
	return exibirImagem($arquivo, $atributos, "img", $proteger);
}

/**
 * Gera label para o elemento html
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo label("endereço", null, true);
		exibir(label());
 */
function label ($texto, $campo=null, $atributos=array(), $obrigatorio=false)
{
	if ( is_null($campo) ) {
		return gerarBloco("label", $atributos);
	} else {
		$atributos = gerarAtributos($atributos);
		$marcador = "";
		if ( $obrigatorio ) {
			$marcador .= " *";
		}

		return '<label for="'.$campo.'"'.$atributos.'>'.$texto.''.$marcador.'</label>';
	}
}

/**
 * Gera item de lista
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$item = li("classe");
		exibir($item);
 */
function li ($conteudo="", $atributos=array())
{
	$bloco =  gerarBloco("li", $atributos);
	if ( empty($conteudo) ) {
		return $bloco;
	}

	return $bloco[0] . $conteudo . $bloco[1];
}

/**
 * Gera link de folha de estilos
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string
 * @return	string
		handheld, aural(fala), braille, projection, tty(teletipos), tv, print
 *
 * @example
		echo link2("css.css");
 */
function link2 ($arquivo="css.css", $midia="all")
{
	return "<link href='$arquivo' rel='stylesheet' type='text/css' media='$midia' />";
}

/**
 * Gera meta
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo meta("Content-type", "text/html; charset=utf-8");
 */
function meta ($tipo, $valor)
{
	return "<meta http-equiv='$tipo' content='$valor' />";
}

/**
 * Gera uma lista não-ordenada
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$lista = ol("menu");
		exibir($lista);
 */
function ol ($atributos=array())
{
	return gerarBloco("ol", $atributos);
}

/**
 * Cria um option
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo option(1, "SP", true);
 */
function option ($valor="", $indice="", $selecionado=false, $atributos=array())
{
	$atributos = gerarAtributos($atributos);
	if ($selecionado) {
		return "<option value='$indice' selected='selected' $atributos>$valor</option>";
	} else {
		return "<option value='$indice' $atributos>$valor</option>";
	}
}

/**
 * Cria um option group
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
 */
function optiongroup ($label="", $atributos=array())
{
	$optionGroup = array();
	$atributos = gerarAtributos($atributos);
	$optionGroup[] = "<optgroup label='$label' $atributos>";
	$optionGroup[] = "</optgroup>";
	return $optionGroup;
}

/**
 * Gera p
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo p("Meu paragrafo");
 */
function p ($conteudo, $atributos=array())
{
	return gerarElemento("p", $conteudo, $atributos);
}

/**
 * Escreve p
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo p("Meu paragrafo");
 */
function pp ($conteudo, $atributos=array())
{
	echo gerarElemento("p", $conteudo, $atributos);
}

/**
 * Gera inputs password
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarInput()
 * @example
		echo password("nome", "Décio Pinto", array("-data" => "1"));
 */
function password ($nome, $valor="", $atributos=array())
{
	return gerarInput("password", $nome, $valor, $atributos);
}

/**
 * Gera elemento pre
 * @package	grimoire/bibliotecas/snippets.php
 * @since 19/02/2016
 *
 * @param	string/array
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
 */
function pre ($atributos=array())
{
	return gerarBloco("pre", $atributos);
}

/**
 * Gera input radio
 * @package	grimoire/bibliotecas/snippets.php
 * @since	05-07-2015
 * @version	19/07/2021 11:38:05
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo radio("termos", "1", true);
 */
function radio ($nome, $valor="", $selecionado=false, $atributos=array(), $rotulo="")
{
	if ( empty($rotulo) ) {
		return box("radio", $nome, $valor, $selecionado, $atributos);
	}

	$input = is_numeric($valor) ? $rotulo : ucfirst($valor);
	$input .= box("radio", $nome, $valor, $selecionado, $atributos);
	return label($input);

}

/**
 * Gera input reset
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarInput()
 * @example
		echo reset2();
 * @internal	Cannot redeclare reset
 */
function reset2 ($valor="Limpar", $nome="reset", $atributos=array())
{
	return gerarInput("reset", $nome, $valor, $atributos);
}

/**
 * Gera select sem options
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		exibir(select("estado", "classe"));
 */
function select ($nome, $atributos=array(), $multiplo=false)
{
	$input		= array();
	$atributos = gerarAtributos($atributos);

	if ($multiplo) {
		$input[] = "<select name='$nome' id='$nome' $atributos multiple='multiple'>";
	} else {
		$input[] = "<select name='$nome' id='$nome' $atributos>";
	}

	$input[] = "</select>";
	return $input;
}

/**
 * Cria link para ligação de skype
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @return	string
 */
function skype ()
{
	return "
		<a href='callto://+***********'>Link will initiate Skype to call my number!</a>
		Skype Username:
		<a href='skype:********?call'>Link will initiate Skype to call my Skype username!</a>
	";
}

/**
 * Gera span
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo span("Meu span");
 */
function span ($conteudo, $atributos=array())
{
	return gerarElemento("span", $conteudo, $atributos);
}

/**
 * Gera input submit
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarInput()
 * @example
		echo submit("Enviar");
 */
function submit ($valor="Enviar", $nome="submit", $atributos=array())
{
	return gerarInput("submit", $nome, $valor, $atributos);
}

/**
 * Gera tabela
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		exibir(table("class", "titulo", "descricao"));
 */
function table ($atributos=array(), $titulo="", $descricao="")
{
	$atributos = gerarAtributos($atributos);
	$tabela = array();
	if (!empty($descricao)) {
		$tabela[] = "<table border='1' $atributos summary='$descricao'>"; // OBSOLETO summary
	} else {
		$tabela[] = "<table border='1' $atributos>";
	}

	if (!empty($titulo)) {
		$tabela[0] .= "<caption>$titulo</caption>";
	}

	$tabela[] = "</table>";
	return $tabela;
}

/**
 * Gera tbody da tabela
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	array
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		$matriz = array();
		$matriz[] = array("zé", "ze@ze.com", "pedreiro");
		$matriz[] = array("zé2", "zemane@ze.com", "carpidor");
		echo tbody($matriz);
 */
function tbody ($matriz=array(array()), $atributos=array())
{
	$atributos = gerarAtributos($atributos);

	$i = 0;
	$tabela = "<tbody $atributos>\n";
	// Itera pelos vetores da matriz
	foreach ($matriz as $vetor) {
		// Adiciona zebramento a linha
		if ($i % 2 == 1) {
			$tabela .= "<tr class='linhaPar'>\n";
		} else {
			$tabela .= "<tr>\n";
		}
		// Itera pelos dados do vetor
		foreach ($vetor as $indice => $dado) {
			if ($dado == $vetor[0]) {
				$tabela .= "<td headers='$indice' scope='row'>$dado</td>\n";
			} else {
				$tabela .= "<td headers='$indice'>$dado</td>\n";
			}
		}
		$tabela .= "</tr>\n";
		$i++;
	}
	$tabela .= "</tbody>\n";
	return $tabela;
}

/**
 * Gera inputs text
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarInput()
 * @example
		echo text("nome", "Jacinto Carvalho", array("maxlength" => "10", "clientePreferencial"));
 */
function text ($nome, $valor="", $atributos=array())
{
	return gerarInput("text", $nome, $valor, $atributos);
}

/**
 * Gera inputs textarea
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo textarea("nome", "conteudo", array("obrigatorio", "width"=> "200px"));
 */
function textarea ($nome="", $conteudo="", $atributos=array())
{
	$atributos = gerarAtributos($atributos);
	return "<textarea name='$nome' id='$nome' $atributos />$conteudo</textarea>";
}

/**
 * Gera theader de tabela
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	array
 * @param	array
 * @return	string
 *
 * @uses	html.php->gerarAtributos()
 * @example
		echo thead(array("a", "b", "c"), "classe");
 */
function thead ($headers=array(), $atributos=array())
{
	$atributos = gerarAtributos($atributos);
	$tabela = "";
	if (!empty($headers)) {
		$tabela .= "<thead $atributos>";
		$tabela .= "<tr>";
		foreach ($headers as $header) {
			$tabela .= "<th scope='col' headers='$header' id='$header'>$header</th>";
		}
		$tabela .= "</tr>";
		$tabela .= "</thead>";
	}
	return $tabela;
}

/**
 * Gera title
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo title("Meu Site");
 */
function title ($titulo)
{
	return gerarElemento("title", $titulo);
}

/**
 * Gera uma lista ordenada
 * @package	grimoire/bibliotecas/snippets.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	html.php->gerarBloco()
 * @example
		$lista = ul("menu");
		exibir($lista);
 */
function ul ($atributos=array())
{
	return gerarBloco("ul", $atributos);
}
