<?php
/**
 * Funções matemáticas
 * @package	grimoire/bibliotecas
*/

/**
 * Calcula as parcelas
 * @package	grimoire/bibliotecas/numeros.php
 * @since	 05-07-2015
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function calculaParcelas ($parcelas, $juros, $preco)
{
	$juros = ($parcelas * $juros);
	$valor = ($preco * $juros) /100;
	$valor_parcelado = $preco + $valor;
	$resultado = $valor_parcelado / $parcelas;
	return number_format($resultado, 2, ',', '.');
}

/**
 * Calcula o peso cúbico e se enviado o quarto parametro compara o peso físico e peso cúbico
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	double
 * @param	double
 * @param	double
 * @param	double
 * @return	double
 *
 * @example
		echo calcularPesoCubico(1, 1, 1);
 */
function calcularPesoCubico ($comprimento, $largura, $altura, $peso=0)
{
	// peso cúbico (C x L x A)/6.000.
	$pesoCubico = ($comprimento * $largura * $altura) / 6000;
	if ($peso <= 0)
		return $pesoCubico;
				//Se o peso cúbico da encomenda for menor ou igual a 5 kg, será atribuído o peso físico (ou real).
	if ($pesoCubico <= 5)
		return $peso;
				//Para encomendas com peso cúbico maior que 5 kg, valerá o maior resultado após a comparação dos resultados entre o peso físico e o peso cúbico
	if ($pesoCubico > $peso)
		return $pesoCubico;
	else
		return $peso;
}

/**
 * Retorna a porcentagem entre dois valores
 * @package	grimoire/bibliotecas/numeros.php
 * @since 05-07-2015
 * @version	29/10/2016 15:09:34
 *
 * @param	string
 * @return	bool
 *
 * @example
		echo calcularPorcentagem(50, 100) . "%";
 */
function calcularPorcentagem ($quantidade, $total)
{
	if ($total > 0 && $quantidade > 0)
		return ($quantidade * 100) / $total;
	else
		return -1;
		// return 0;

}

/**
 * Retorna o valor de uma porcentagem
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	double
 * @param	double
 * @return	double/-1
 *
 * @example
		echo calcularPorcentagem2(27.9, 5000);
 */
function calcularPorcentagem2 ($porcentagem, $total)
{
	if ($porcentagem > 0 && $total > 0) {
		return floatval($porcentagem * ($total / 100));
	} else {
		return -1;
	}
}

/**
 * Verifica se um número está entre dois valores
 * @package	grimoire/bibliotecas/numeros.php
 * @since	21/07/2021 12:04:59
 *
 * @param	int		Número alvo
 * @param	int		Número mínimo
 * @param	int		Número máximo
 *
 * @return	bool
 */
function entre ($numero, $piso=0, $teto=0)
{
	return $numero > $piso && $numero > $teto;
}

/**
 * Converte um número para o formato dinheiro (BR)
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	bool
 * @return	double/string
 *
 * @example
		echo converterDinheiro(15, false); // Para inserir no BD
		echo converterDinheiro(15); // Para exibir na página
 */
function converterDinheiro ($numero, $pt=true)
{
	if ( is_numeric($numero) )
		if ($pt)
			$numero = number_format($numero, 2, ",", ".");
		else
			$numero = number_format($numero, 2, ".", ",");

	return $numero;
}

/**
 * Adiciona um separador a cada três casas em um número
 * @package	grimoire/bibliotecas/numeros.php
 * @since 06/09/2016
 *
 * @param	numero
 * @return	string
 *
 * @example
		$var = 10000;
		echo formatarNumero($var);
 */
function formatarNumero ($numero/*, $pt=true*/)
{
	if ( is_numeric($numero) )
		$numero = number_format($numero, 0, ",", ".");

	return $numero;
}

/**
 * Calcula juros
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	double
 * @param	double
 * @param	int
 * @return	double
 */
function jurosComposto ($valor, $taxa, $parcelas)
{
	$taxa		= $taxa / 100;
	$valParcela = $valor * pow((1 + $taxa), $parcelas);
	$valParcela = number_format($valParcela / $parcelas, 2, ",", ".");
	return $valParcela;
}

/**
 * Calcula juros
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	double
 * @param	double
 * @param	int
 * @return	double
 */
function jurosSimples ($valor, $taxa, $parcelas)
{
	$taxa	= $taxa / 100;
	$m		= $valor * (1 + $taxa * $parcelas);
	$valParcela = number_format($m / $parcelas, 2, ",", ".");
	return $valParcela;
}

/**
 * Impede que um número esteja acima ou abaixo dos valores mínimo e máximo
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	int
 * @param	null/int
 * @param	null/int
 * @return	int
 */
function limitarNumero ($numero, $valorMinimo=null, $valorMaximo=null)
{
// Piso
	if (is_numeric($valorMinimo)) {
		if ($numero < $valorMinimo)
			$numero = $valorMinimo;
	}
// Teto
	if (is_numeric($valorMaximo)) {
		if ($numero > $valorMaximo)
			$numero = $valorMaximo;
	}
	return $numero;
}

/**
 * Calcula o valor de uma incógnita utilizando regra de três
 * @package	grimoire/bibliotecas/numeros.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function regraDeTres ($valorParcial, $valorTotal)
{
	if ($valorTotal == 0) $valorTotal = 1;
	$x = ($valorParcial * 100) / $valorTotal;
	return $x;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param   string
 * @param   string
 * @param   bool    Conservar conteúdo, append
 *
 * @return  bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function formatBytes ($size, $precision = 2)
{
	$base = log($size, 1024);
	$suffixes = array('', 'K', 'M', 'G', 'T');

	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
