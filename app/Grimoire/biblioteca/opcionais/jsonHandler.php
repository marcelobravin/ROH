<?php
# TODO: testar com .json e .js

/**
 * @example
	$termos = retornarTermoNOVO("sigla", "sp", "secretaria/map.json");
	$termos = retornarTermoNOVO("numero", "2", "secretaria/map.json");
	echo "<pre>";
	print_r($termos);
 * */
function retornarTermoNOVO($atributoDesejado="id", $valorDesejado=1, $mapaTermos="termos/character_map.json") {

	$termos = converterJson($mapaTermos);
	if ( $termos == "Arquivo não existe" ) {
		return $termos;
	}

	# Itera pelos colunas para identificar o número da coluna desejada
	foreach ($termos['colunas'] as $indice => $coluna) {
		if ($atributoDesejado === $coluna) {
			$numeroColuna = $indice;
		}
	}

	# Itera pelos registros
	foreach ($termos['registros'] as $registro) {
		if ($registro[$numeroColuna] == $valorDesejado) {
			return $registro;
		}
	}
}
