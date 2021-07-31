<?php
/**
 * Manipulação de imagens
 * @package grimoire/bibliotecas
*/

/**
 * Cria thumb de uma imagem
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	void
 */
function criarThumb ($nome_img, $caminho, $lar_maxima, $alt_maxima)
{
	$size = getimagesize($caminho.$nome_img);
	$tipo = $size[2];

	if ($tipo == 2) { // 2 é o JPG
		$extensao = '.jpg'; # VERIFICAR ERROS
		$img = imagecreatefromjpeg($caminho . $nome_img);
	} elseif ($tipo == 1) { // 1 é o GIF
		$img = imagecreatefromgif($caminho . $nome_img);
	} elseif ($tipo == 3) { // 3 é PNG
		$img = imagecreatefrompng($caminho . $nome_img);
	}

	// Se a imagem foi carregada com sucesso, testa o tamanho da mesma
	if ($img) {
		// Pega o tamanho da imagem e proporção de resize
		$width = imagesx($img);
		$height = imagesy($img);
		$scale = min($lar_maxima/$width, $alt_maxima/$height);
		// Se a imagem é maior que o permitido, encolhe ela!
		if ($scale < 1) {
			$new_width = floor($scale*$width);
			$new_height = floor($scale*$height);
			// Cria uma imagem temporária
			$tmp_img = imagecreatetruecolor($new_width, $new_height);
			// Copia e resize a imagem velha na nova
			imagecopyresampled($tmp_img, $img, 0, 0, 0, 0,
				$new_width, $new_height, $width, $height);
			$nome_img = explode(".", $nome_img);
			$nome_img = $nome_img[0];
			$fname = $nome_img .'_'. $lar_maxima .'x'. $alt_maxima . $extensao; # corrigir nome da imagem
			imagejpeg( $tmp_img, $caminho . $fname ); # colocar switch
		}
	}
}

/**
 * Cria uma cópia de uma imagem em tons de cinza
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
 */
function descartarCores ($imagem="mod_centro/PB.png")
{
	if (file_exists($imagem)) {
		$novaImagem = "";
		// identificar extensão
		$img = imagecreatefrompng($imagem);
		if ($img && imagefilter($img, IMG_FILTER_GRAYSCALE)) {
			$novoNome = "mod_centro/PB2.png"; // Novo nome que a imagem terá após convertida
			imagepng($img, $novoNome);
		}
		imagedestroy($img);
		$novaImagem = "<img src='$novoNome'>";
	}
	return $novaImagem;
}

/**
 * Exibe uma imagem
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	array/string
 * @param	string
 * @param	boolean
 * @return	string
 *
 * @uses		html.php->gerarAtributos()
 * @uses		imagens.php->gerarProtetor()
 * @uses		imagens.php->gerarBackground()
 */
function exibirImagem ($arquivo, $atributos=array(), $elemento="img", $proteger=true)
{
	$atributos = gerarAtributos($atributos);
	$img		= "";

	if ($proteger) {
		$estilo = gerarProtetor($arquivo); // Gera background do protetor
		$img		.= "<div>";
		$img		.= "<div $estilo></div>";
	}

	$estilo = gerarBackground($arquivo, true);	// Gera background de elementos bloco
	switch ($elemento) {
		case "input":
			$img	 .= "<input type='image' $atributos $estilo />";
			break;
		case "img":
			$estilo = gerarBackground($arquivo, false); // Define altura e largura da imagem
			$img	 .= "<img src='$arquivo' $atributos $estilo />";
			break;
		default:
			$img	 .= "<$elemento $atributos $estilo></$elemento>";
			break;
	}

	if ($proteger) {
		$img .= "</div>";
	}

	return $img;
}

/**
 * Retorna a foto caso exista ou a foto alternativa
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function foto ($foto, $fotoAlternativa="arquivos/imagens/semImagem.gif")
{
	if (!empty($foto) && file_exists($foto)) {
		return $foto;
	}

	return $fotoAlternativa;
}

/**
 * Gera os estilos css nas dimensões da imagem
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	bool
 * @return	string
 *
 * @example
 */
function gerarBackground ($arquivo, $block=true)
{
	$unidade = "px";
	$dimensoes	= getimagesize($arquivo);
	$largura	= $dimensoes[0] . $unidade;
	$altura		= $dimensoes[1] . $unidade;

	if ($block) {
		return "style='background: url($arquivo); width: $largura; height: $altura; display: block;'";
	} else {
		return "style='width: $largura; height: $altura;'";
	}
}

/**
 * Pega a imagem de um video de youtube
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string: url do video
 * @param	bool
 * @return	string
 */
function gerarImagemVideoYoutube ($url="https://www.youtube.com/watch?v=jo1PvY5pr1A", $grande=true)
{
	$imagem = str_replace("watch?v=", "vi/", $url);
	$imagem = str_replace("www.youtube", "img.youtube", $imagem);

	// link do video gerado por embed
	$imagem = str_replace("youtu.be", "img.youtube.com/vi", $imagem);

	if ($grande) {
		$tamanho = "/0.jpg";
	} else {
		$tamanho = "/2.jpg";
	}

	return $imagem .= $tamanho;
}

/**
 * Cria uma imagem .png com fundo transparente
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	int
 * @param	int
 * @param	string
 *
 * @return	GdImage
 */
function gerarPNG ($l=1198, $a=548, $novoNome="png.png")
{
	// Gera, salva e referencia bg
	$photo1 = imagecreatetruecolor($l, $a);
	imagesavealpha($photo1, true);
	$trans_colour = imagecolorallocatealpha($photo1, 0, 0, 0, 127);
	imagefill($photo1, 0, 0, $trans_colour);

	// Nomeia e salva imagem resultado
	imagepng($photo1, $novoNome);
	imagealphablending($photo1,true);

	return $photo1;
}

/**
 * Gera o estilo de uma imagem vazia para proteger a imagem original contra botão direito->salvar
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
 */
function gerarProtetor ($arquivo)
{
	$unidade = "px";
	$dimensoes = getimagesize($arquivo);
	$largura	 = $dimensoes[0] . $unidade;
	$altura		= $dimensoes[1] . $unidade;

	return "style='background-image:url(imagens/protetor.png); position:absolute; width:$largura; height:$altura; border:1px dashed gray; margin-top:0; margin-left:0'";
}

/**
 * Cria arquivo spritemap.png contendo todas imagens de um diretorio
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string Diretorio
 * @uses	 imagens.php->gerarPNG()
 * @example
		gerarSpritemap("arquivos/imagens");
		<img src="arquivos/imagens/spritemap.png" height="32" width="16">
 */
function gerarSpritemap ($diretorio="")
{
	$files = glob("{$diretorio}/*.{png,jpg,gif}", GLOB_BRACE); // Pega todos arquivos
	$spritemap = $diretorio . "/spritemap.png";

	# Calcula tamanho do spritemap
	$alturaTotal = 0;
	$larguraMaxima = 0;
	foreach ($files as $arquivo) {
		if ( $arquivo != $spritemap && file_exists($arquivo) ) {
			$dimensoes = getimagesize($arquivo);
			$alturaTotal = (int) $alturaTotal + $dimensoes[1];
			if ($larguraMaxima < $dimensoes[0]) {
				$larguraMaxima = $dimensoes[0];
			}
		}
	}

	// gera imagem master
	$resultado = gerarPNG($larguraMaxima, $alturaTotal, $spritemap);

	$alturaAtual = 0;
	foreach ($files as $arquivo) {
		if ($arquivo != $spritemap) { # não inclui o próprio spritemap
			$extensao = retornarExtensao($arquivo);
			switch ($extensao) {
				case 'jpg':
				case 'jpeg':
				$imgX = imagecreatefromjpeg($arquivo);
				break;
				case 'gif':
				$imgX = imagecreatefromgif($arquivo);
				break;
				case 'png':
				$imgX = imagecreatefrompng($arquivo);
				break;
				default:
				echo 'Invalid image type '. $arquivo;
			}
			$w = imagesx($imgX); // armazenar em array durante o foreach anterior
			$h = imagesy($imgX);

			imagecopy($resultado, $imgX,
				0, $alturaAtual, # coord spritemap
				0, 0, # coord imgX
				$w, $h
			);
			$alturaAtual = $alturaAtual + $h;
			imagedestroy($imgX);
		}
	}
	imagepng($resultado, $spritemap);
	imagedestroy($resultado);
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function gera_thumb ($nome_img, $lar_maxima, $alt_maxima, $qualidade=100)
{
		$size = getimagesize($nome_img);
		$tipo = $size[2];
	# Pega onde está a imagem e carrega
	if ($tipo == 2) { // 2 é o JPG
		$img = imagecreatefromjpeg($nome_img);
	} elseif ($tipo == 1) { // 1 é o GIF
		$img = imagecreatefromgif($nome_img);
	} elseif ($tipo == 3) { // 3 é PNG
		$img = imagecreatefrompng($nome_img);
	}

	// Se a imagem foi carregada com sucesso, testa o tamanho da mesma
	if ($img) {
			// Pega o tamanho da imagem e proporção de resize
		$width = imagesx($img);
		$height = imagesy($img);
		$scale = min($lar_maxima/$width, $alt_maxima/$height);
			// Se a imagem é maior que o permitido, encolhe ela!
		if ($scale < 1) {
			$new_width = floor($scale*$width);
			$new_height = floor($scale*$height);
					// Cria uma imagem temporária
			$tmp_img = imagecreatetruecolor($new_width, $new_height);
					// Copia e resize a imagem velha na nova
			imagecopyresampled ($tmp_img, $img, 0, 0, 0, 0,
				$new_width, $new_height, $width, $height);
			$img = $tmp_img;
		}
	}

	header("Content-type:image/gif");
	imagejpeg($img,'',$qualidade);
	imagedestroy($img);
}

/**
 * Copia um trecho de uma imagem para outra conservando a transparência
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function imagecopymerge_alpha ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
{
	$cut = imagecreatetruecolor($src_w, $src_h); // creating a cut resource
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); // copying relevant section from background to the cut resource
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); // copying relevant section from watermark to the cut resource
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); // insert cut resource to destination image
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function imagemStub ($altura=300, $largura=400)
{
	$estilo = "
		/* Hotspot */
		width: {$altura}px;
		height: {$largura}px;
		line-height: {$largura}px;

		/* Frozenspot */
		background: silver;
		text-align: center;
		vertical-align: middle;

		/* Estilo */
		background: #DDD;
		box-shadow: 0 0 18px #000 inset;
		color: #555;
		font-family: arial;
		font-size: 2em;
		font-weight: bold;
		text-shadow: 0 0 2px #FFF;
	";

	return "
		<div style='{$estilo}'>
			{$altura}x{$largura}
		</div>
	";
}

/**
 * Se a imagem não existir retorna uma imagem stub
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	int
 * @param	int
 * @return	string
 */
function retornarImagem ($imagem, $x=100, $y=100)
{
	if (empty($imagem)) {
	//|| !file_exists($imagem)) {
		return "https://placehold.it/{$x}x{$y}";
	}

	return $imagem;
}

/**
 * Se a imagem não existir retorna uma imagem stub
 * @package grimoire/bibliotecas/imagens.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	int
 * @param	int
 * @param	string
 * @param	string
 * @return	string
 */
function retornarImagem2 ($imagem, $x=100, $y=100, $fundo="F9F9F9", $letra="CCCCCC")
{
	if (empty($imagem)) {
	//|| !file_exists($imagem)) {
		return "https://placehold.it/{$x}x{$y}/{$fundo}/{$letra}";
	}

	return $imagem;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 *
 * @return	object
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function imageClassifier ($images)
{
	$imagesSorted = array();

	foreach ($images as $key => $value) {
		$resource = imagecreatefrompng($value);
		$width		= imageSX( $resource );
		$height	 = imageSY( $resource );

		$index		= $width .'x'. $height;

		$imagesSorted[ $index ][$key]['source']	 = $value;
		$imagesSorted[ $index ][$key]['resource'] = $resource;
		$imagesSorted[ $index ][$key]['width']		= $width;
		$imagesSorted[ $index ][$key]['height']	 = $height;
	}
	return $imagesSorted;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function imageGrouper ($images)
{
	$imagesSorted = imageClassifier($images);
	foreach ($imagesSorted as $key => $value) {
		imageCollation($value, $key);
	}
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function imageCollation ($images, $fileName)
{
	$firstKey = array_key_first($images);

	# transforma vetor numa matriz quadrada
	$sqRt = sqrt( count($images) );
	$sqRt = ceil($sqRt);

	# pega dimensoes das imagens e calcula o tamanho da imagem final
	$width	= imageSX( $images[$firstKey]['resource'] );
	$height	= imageSY( $images[$firstKey]['resource'] );


	# create image with transparent BG
	$sumWidth	= $width	* $sqRt;
	$sumHeight = 0;
	$i = 0;
	foreach ($images as $value) {
		if ($i % $sqRt == 0) {
				$sumHeight += $height;
		}
		$i++;
	}

	$tmp = createTransparentImage($sumWidth, $sumHeight);

	# proccess individual images
	$dimensions = array(
		'width'	=> $width,
		'height' => $height
	);
	processImages($tmp, $images, $dimensions, $sqRt);
	saveImage($tmp, '../assets/images/auto-generated/', $fileName);

	# clean resources
	foreach ($images as $value) {
		imagedestroy( $value['resource'] );
	}

	# exibir no browser
	echo "<hr><img src='../assets/images/auto-generated/". $fileName .".png'>";
	header('Content-Type: image/png');
	imagepng($tmp);
	die();
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	GDImage
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function createTransparentImage ($sum_width, $sum_height)
{
	if ($sum_width == 0) {
		die('largura invalida');
	}
	if ($sum_height == 0) {
		die('altura invalida');
	}
	$tmp = imagecreatetruecolor($sum_width, $sum_height);
	imagesavealpha($tmp, true);
	$color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
	imagefill($tmp, 0, 0, $color);
	return $tmp;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function processImages ($tmp, $images, $dimensions, $sqRt)
{
	$positionX = 0;
	$positionY = 0;
	$linha = 1;
	$coluna = 0;

	$a = array();
	foreach ($images as $key => $value) {

		if ($coluna >= $sqRt) {
			$coluna = 1;
			$linha++;
		} else {
			$coluna++;
		}

		$positionX = $dimensions['width']	* ($coluna -1);
		$positionY = $dimensions['height'] * ($linha	-1);

		imagecopyresampled($tmp, $value['resource'],
			$positionX, // X onde imagem sera colocada
			$positionY, // Y onde imagem sera colocada

			0, // inicio X da imagem
			0, // inicio Y da imagem

			$dimensions['width'],	// fim X da imagem
			$dimensions['height'], // fim Y da imagem

			$dimensions['width'],	// proporção ?
			$dimensions['height']	// proporção ?
		);

		$a[$key]['source']		= $value['source'];
		$a[$key]['width']		 = $dimensions['width'];
		$a[$key]['height']		= $dimensions['height'];
		$a[$key]['positionX'] = $positionX;
		$a[$key]['positionY'] = $positionY;
	}

	$fileName = $dimensions['width'] .'x'. $dimensions['height'];
	generateSpriteAtlas($fileName, $a);
}
/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function saveImage ($tmp, $dir='assets/images/auto-generated/', $filename="_MAP")
{
	$path = $dir . $filename . ".png";
	imagepng($tmp, $path, 0, 0);
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function generateSpriteAtlas ($fileName, $array)
{
	$jsonArray = array();
	foreach ($array as $value) {

		# sanitize filename
		$source = explode('\\', $value['source']);
		$source = $source[ count($source)-1 ];
		$source = str_replace('.png', '', $source);

		$jsonArray[] = array(
			"filename" => $source,
			"frame"		=> array(
				"x" => $value['positionX'],
				"y" => $value['positionY'],
				"w" => $value['width'],
				"h" => $value['height']
			),
			"rotated"	=> false,
			"trimmed"	=> false,
			"spriteSourceSize" => array(
				"x" => 0,
				"y" => 0,
				"w" => $value['width'],
				"h" => $value['height']
			),
			"sourceSize" => array(
				"w" => $value['width'],
				"h" => $value['height']
			),
			"pivot" => array(
				"x" => 0.5,
				"y" => 0.5
			)
		);
	}

	$jsonDir = '../assets/lists/temp/_';
	file_put_contents($jsonDir. $fileName.'.json', json_encode(array('frames' => $jsonArray) ) );
}
