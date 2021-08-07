<?php
/**
 * Manipulação de arquivos
 * @package	grimoire/bibliotecas
*/

/**
 * Adiciona arquivo de $_FILES a array
 * @package	grimoire/bibliotecas/vetores.php
 * @version	05-07-2015
 *
 * @param	array
 * @param	string
 * @return	array
 *
 * @uses	arquivos.php->fazerUpload()
 */
function anexarArquivo ($vetor, $caminho)
{
	if ( !empty($_FILES['foto']['tmp_name'])) {
		$resposta = fazerUpload($_FILES['foto'], true, $caminho);
		$resposta = explode("/", $resposta);
		$resposta = end($resposta);
		$vetor['foto'] = $resposta;
	}
	return $vetor;
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
function array_para_csv (array &$array)
{
	if ( empty($array) ) {
		return null;
	}

	ob_start();
	$df = fopen("php://output", 'w');

	fputcsv($df, array_keys( reset($array) ) );

	foreach ($array as $row) {
		fputcsv($df, $row);
	}
	fclose($df);
	return ob_get_clean();
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
	// http://pt.stackoverflow.com/questions/9596/como-exportar-uma-tabela-para-csv-usando-php
	// Pra fazer o download do arquivo gerado:
*/
function cabecalho_download_csv ($filename="relatorio")
{
	// desabilitar cache
	$now = gmdate("D, d M Y H:i:s");
	header('Content-Encoding: UTF-8');
	header('Content-type: text/csv; charset=UTF-8');

	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	header("Last-Modified: {$now} GMT");

	// forçar download
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");

	// disposição do texto / codificação
	header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Transfer-Encoding: binary");
	// echo "\xEF\xBB\xBF"; // UTF-8 BOM
}

/**
 * Cria um diretório
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @throws	Exception
 * @example
	createDir("ZZZX");
 */
function createDir ($dir, $octal=0777)
{
	if ( !is_dir($dir) && !mkdir($dir, $octal, true) ) {
		$mssg = "The follow directory could not be made, please create it: {$dir}";
		die($mssg);
	}

	return true;
}

/**
 * Corrige endereço de vídeo do youtube para visualização via iframe
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
	$video = "http://www.youtube.com/watch?v=7hBJkAd6iPo&fe";
	echo '<center><iframe width="560" height="315" src="'. $video .'" frameborder="0" allowfullscreen></iframe><center>';
 * @internal youtu.be - usar em caso de mais problemas
 */
function corrigirEnderecoVideoYoutube ($url)
{
	if (!empty($url)) {
		$url = str_replace("watch?v=", "embed/", $url);
		$posicao = strpos($url, '&feature');

		if ($posicao > 0) {
			$url = substr($url, 0, $posicao);
		}

			// Correção Odorite
		$pos1 = stripos($url, "&");
		if ($pos1 > 0) {
			$url = substr($url, 0, $pos1);
		}
	}

	return $url;
}

/**
 * Abre janela para dowload do arquivo no endereço solicitado
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @example
	download(); // Retorna próprio arquivo
	download("css.php"); // Retorna arquivo solicitado
 */
function download ($arquivo)
{
	// File doesn't exist, output error
	if ( !file_exists($arquivo) ) {
		die('file not found');
	} else {
		// Set headers
		header("Cache-Control: public");
		header("Content-Description: File Transfer");

		// disable caching
		$now = gmdate("D, d M Y H:i(worry)");
		header("Expires: Tue, 03 Jul 2013 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
		// force download
		header("Content-Type: application/force-download");
		header("Content-Type: application/download");
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$arquivo}");
		header("Content-Transfer-Encoding: binary");
		// Read the file from disk
		$tipo = strtolower(substr(strrchr(basename($arquivo),"."),1));
		switch ($tipo) { // verifica a extensão do arquivo para pegar o tipo
			case "pdf": $tipo="application/pdf"; break;
			case "exe": $tipo="application/octet-stream"; break;
			case "zip": $tipo="application/zip"; break;
			case "doc": $tipo="application/msword"; break;
			case "xls": $tipo="application/vnd.ms-excel"; break;
			case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
			case "gif": $tipo="image/gif"; break;
			case "png": $tipo="image/png"; break;
			case "jpg": $tipo="image/jpg"; break;
			case "mp3": $tipo="audio/mpeg"; break;
			case "php": // deixar vazio por segurança
			case "htm": // deixar vazio por segurança
			case "html": // deixar vazio por segurança
			default: // deixar vazio por segurança
		}
		header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
		header("Content-Length: ". filesize($arquivo)); // informa o tamanho do arquivo ao navegador
		//header("Content-Disposition: attachment; filename=".basename($arquivo)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
		readfile($arquivo);
		exit;
	}
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
 * @param	bool	flaga para definir se conteudo deve ser acrescentado ou sobrescrito
 *
 * @param	bool	Sucesso no registro do conteúdo
 *
 * @example
	echo escrever("arquivo.txt", "pan");
*/
function escrever ($arquivo, $conteudo, $sobreescrever=false)
{
	if ( !$sobreescrever && file_exists($arquivo) ) {
		$conteudo = file_get_contents($arquivo) . $conteudo;
	}

	file_put_contents($arquivo, $conteudo);
	return true;
}

/**
 * Gera o arquivo em formato Excell para exibição no navegador
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	29/10/2016 22:13:34
 * @version	22/07/2021 14:53:20
 *
 * @param	string	nome do arquivo que será gerado
 * @param	array	matriz contendo o resultado da query
 * @param	array	cabeçalho da tabela, se não for enviado o sistema utiliza o nome das colunas
 *
 * @uses	arquivos.php->headersExcell()
 * @warning	campos em ALL_CAPS causa um warning ao abrir o arquivo
 * @example
	<a href="app/Controller/ExportController.php?hospital=<?php echo $_GET['hospital'] ?>&mes=<?php echo $mesSelecionado ?>&ano=<?php echo $anoSelecionado ?>">Exportar</a>

	$sql = "
		SELECT
			c.id					categoria_id,
			c.titulo				categoria_nome,
			c.legenda				categoria_legenda,
			c.ativo					categoria_ativo,

			e.categoria_id			elemento_categoria_id,
			e.titulo				elemento_nome,
			e.id					elemento_id,

			m.elemento_id			meta_elemento_id,
			m.quantidade			meta_quantidade,
			m.ativo					meta_ativo,
			m.hospital_id			meta_hospital_id,
			m.id					meta_id,

			r.meta_id				resultado_meta_id,
			r.resultado				resultado,
			r.mes					mes,
			r.justificativa			justificativa,
			r.justificativa_aceita	justificativa_aceita,
			r.id					resultado_id,
			r.criado_em				criacao,
			r.criado_por			autor_id,

			u.login					autor

		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.elemento_id		= e.id
				AND m.hospital_id		= ?
			LEFT OUTER JOIN (resultado r)
				ON r.meta_id			= m.id
				AND r.mes				= ?
				AND r.ano				= ?

			LEFT OUTER JOIN (usuario u)
				ON r.criado_por			= u.id

		WHERE
			e.categoria_id = c.id

		ORDER BY
			c.titulo,
			e.titulo
	";

	$condicoes = array(
		$_GET['hospital'],
		$_GET['mes'],
		$_GET['ano']
	);

	$matriz = executarStmt($sql, $condicoes, 'S');

	$titulo = 'ROH '. $_GET['ano'] .'-'. $_GET['mes'];
	excell($titulo, $matriz);
 */
function excell ($titulo, $matriz, $campos=array())
{
	if ( empty($campos) ) {
		$campos = array_keys($matriz[0]);
	}

	headersExcell($titulo);
	$out = fopen("php://output", 'w');

	# Monta títulos das colunas
	fputcsv($out, $campos,"\t");

	# Monta dados das colunas
	foreach ($matriz as $data) {
		fputcsv($out, $data,"\t");
	}

	# Finaliza
	fclose($out);
}

/**
 * Exclui um arquivo caso ele exista
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function excluirArquivo ($arquivo)
{
	$retorno = false;
	if (file_exists($arquivo)) {
		$retorno = unlink($arquivo);
	}

	return $retorno;
}

/**
 * Exclui todos arquivos que se encaixarem no critério de exclusão
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string: arquivos a serem excluido
 *
 * @example
	excluirArquivos("modulo_centro/*.jpg");
 */
function excluirArquivos ($criterio)
{
	array_map("unlink", glob($criterio));
}

/**
 * Faz upload
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	arquivos.php->identificarTipo()
 * @uses	arquivos.php->retornarExtensao()
 * @example
	if (!empty($_FILES)) {
		echo fazerUpload($_FILES['foto'], true, "", 1024, array('imagem', 'audio', 'texto'));
		echo fazerUpload($_FILES['foto'], true, "", 1024, array("imagem"));
		echo fazerUpload($_FILES['foto'], null, "", 1024, array("imagem"));
	}
	//echo fazerUpload($_FILES['arquivo'], true, "../../img/fotos/"); // IMPORTANTE ADICIONAR BARRA NO FINAL
*/
function fazerUpload ($arquivo, $nome="upload", $caminho="", $tamanhoMax=0, $tiposAceitados=null, $sobrescrever=false)
{
	// Se nome for true utiliza timestamp como nome
	if ( $nome ) {
		$nome = Date('Y-m-d_H-i-s');
	}

	// Verifica se há erros no arquivo
	if ( !$arquivo['error'] == UPLOAD_ERR_OK ) {
		$resposta = "Erro no arquivo!";
	} else {
		// Verifica extensao e tipo do arquivo
		$tipo = identificarTipo($arquivo['type']);
		if (!empty($tiposAceitados) && !in_array($tipo, $tiposAceitados)) {
			$resposta = 'Tipo de arquivo inválido!';
		} else {
			$tamanho = round($arquivo['size'] / 1024); // Converte o tamanho para KB
			// Se arquivo for menor que o tamanho máximo envia
			//if ($tamanho > $tamanhoMax && $tamanhoMax > 0) {
			if ($tamanhoMax > 0 && $tamanho > $tamanhoMax) {
				$resposta = "Arquivo muito grande!";
			} else {
				$extensao = retornarExtensao($arquivo['name']);
				// Define caminho e novo nome do arquivo
				$fileName = $nome . "." . $extensao;
				$novoArquivo = $caminho . "" . $fileName;
				// Verifica se arquivo existe
				if (file_exists($novoArquivo) && !$sobrescrever) {
					$resposta = "O arquivo '$novoArquivo' já existe!";
				} else {
					// Realiza upload
					if (move_uploaded_file($arquivo["tmp_name"], $novoArquivo)) {
						$resposta = $fileName;
					} else {
						$resposta = "Erro ao enviar arquivo..."; // Permissão de acesso
					}
				}
			}
		}
	}

	return $resposta;
}

/**
 * Monta headers para exibição de planilhas,
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	29/10/2016 22:10:43
 *
 * @param	string
 * @return	void
 */
function headersExcell ($arquivo)
{
	header("Expires: 0");

	header("Content-type: application/x-msexcel");

	header("Last-Modified: " . gmdate("D,d M YH:i(worry)") . " GMT");
	header("Pragma: no-cache");
	header("Content-Description: PHP Generated Data");

	header("Pragma: public");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$arquivo.".xls");
	header("Content-Transfer-Encoding: binary ");
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
}

/**
 * Realiza a inclusão de um arquivo concatenando a raiz do projeto
 *
 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
*/
function incluir ($caminho = "frames/metas.php")
{
	if ( file_exists(BASE . $caminho) ) {
		include BASE . $caminho;
		return true;
	} else {
		die($caminho ." não encontrado");
	}
}

/**
 * Identifica o tipo de um arquivo baseado em sua extensão ou tipo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	arquivos.php->retornarExtensao()
 * @example
	echo identificarTipo("css.css"); // extensão
	echo identificarTipo("image/png"); // tipo
 */
function identificarTipo ($arquivo)
{
	$extensao = retornarExtensao($arquivo);
	if ( !strpos($arquivo, "/") ) {// Se tiver barra identifica por tipo
		$extensao = substr(strrchr($extensao, "/"), 1); // GAMB ???
	}

	$extensao = strtolower($extensao);
	// Corrige extensoes no IE
	if ($extensao == 'x-png') {
		$extensao = "png";
	} else if ($extensao == 'pjpeg') {
		$extensao = "jpg";
	}

	// 'asp' 'doc' 'htm' 'html' 'mdb' 'mov' 'ppt''vbs' 'xls' 'zip' 'jso' 'php'
	// Tipos de arquivo
	// Matriz de extensões e tipos
	$matriz	= array(
		"aplicativo"	=> array('exe'),
		"audio"			=> array('mp3', 'wav', 'mid', 'midi'),
		"css"			=> array('css'),
		"flash"			=> array('swf'),
		"imagem"		=> array('jpg', 'jpeg','gif','png','bmp'),
		"script"		=> array('js'),
		"texto"			=> array('txt', 'doc', 'pdf', 'csv'),
		"video"			=> array('avi', 'wmv', 'mpg', 'mpeg', 'wma', 'mid', 'mp4')
	);
	$resposta = "outro($extensao)";

	// Se encontrar altera a resposta
	foreach ($matriz as $indice => $valor) {
		if (in_array($extensao, $valor)) {
			$resposta = $indice;
		}
	}
	return $resposta;
}

/**
 * Retorna o nome de uma página sem a extensão
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 * @version	05/07/2021 10:32:07
 *
 * @param	string
 * @return	string
	# function limparNomeArquivo ($arquivo, $separador="/") # linux
	// function limparNomeArquivo ($arquivo, $separador="\\") # windows
 */
function limparNomeArquivo ($arquivo)
{
	$arquivo = explode(DIRECTORY_SEPARATOR, $arquivo);
	$arquivo = end($arquivo);
	$arquivo = str_replace(".php", "", $arquivo);
	return $arquivo;
}

/**
 * Retorna a extensão de um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
	echo retornarExtensao("a.jpg");
 */
function retornarExtensao ($arquivo)
{
	$extensao = explode(".", $arquivo);
	$extensao = end($extensao);
	return $extensao;
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
	$termos = retornarJson("secretaria/map.json");
	echo "<pre>";
	print_r($termos);
	echo "</pre>";
*/
function retornarJson ($mapaTermos="termos/character_map.json")
{
	$termos = converterJson($mapaTermos);
	if ( $termos == "Arquivo não existe" ) {
		return $termos;
	}

	$resposta = array();
	foreach ($termos['registros'] as $index => $value) {
		foreach ($value as $index2 => $value2) {
			$resposta[$index][ $termos['colunas'][$index2] ] = $value2;
		}
	}
	return $resposta;
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
function converterJson ($json)
{
	if ( !file_exists($json) ) {
		return "Arquivo não existe";
	}

	$contents = file_get_contents($json);
	$contents = utf8_encode($contents);

	$termos = json_decode($contents, true);

	//do something with $json. It's ready to use
	if (json_last_error() === JSON_ERROR_NONE) {
		return $termos;
	}

	return "Arquivo não é um json válido". json_last_error();
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	08/07/2021 10:01:55
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	$diasSemana = getJson('app/Grimoire/biblioteca/opcionais/listas/dias_da_semana.json');
	$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
*/
function getJson ($jsonPath = 'assets\lists\temp\_projectSize.json')
{
	$content = file_get_contents($jsonPath);
	return json_decode($content, true); # segundo parametro traz em array associativa em detrimento de stdClass
}
