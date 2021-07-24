<?php
# TODO: testar com .json e .js

/*
$termos = retornarTermoNOVO("sigla", "sp", "secretaria/map.json");
$termos = retornarTermoNOVO("numero", "2", "secretaria/map.json");
echo "<pre>";
print_r($termos);
*/
function retornarTermoNOVO($atributoDesejado="id", $valorDesejado=1, $mapaTermos="termos/character_map.json") {

	$termos = converterJson($mapaTermos);
	if ( $termos == "Arquivo não existe" )
		return $termos;

	# Itera pelos colunas para identificar o número da coluna desejada
	foreach ($termos['colunas'] as $indice => $coluna) {
		if ($atributoDesejado === $coluna)
			$numeroColuna = $indice;
	}

	# Itera pelos registros
	foreach ($termos['registros'] as $registro) {
		if ($registro[$numeroColuna] == $valorDesejado)
			return $registro;
	}
}

/*
function mjson_decode($json) {
	return json_decode(removeTrailingCommas(utf8_encode($json)));
}

function removeTrailingCommas($json) {
	$json=preg_replace('/,\s*([\]}])/m', '$1', $json);
	return $json;
}
*/

/*If your on a version of PHP before 5.2, this might help:*/
if (!function_exists('json_encode')) {
		function json_encode($data) {
				switch ($type = gettype($data)) {
						case 'NULL':
								return 'null';
						case 'boolean':
								return ($data ? 'true' : 'false');
						case 'integer':
						case 'double':
						case 'float':
								return $data;
						case 'string':
								return '"' . addslashes($data) . '"';
						case 'object':
								$data = get_object_vars($data);
						case 'array':
								$output_index_count = 0;
								$output_indexed = array();
								$output_associative = array();
								foreach ($data as $key => $value) {
										$output_indexed[] = json_encode($value);
										$output_associative[] = json_encode($key) . ':' . json_encode($value);
										if ($output_index_count !== NULL && $output_index_count++ !== $key) {
												$output_index_count = NULL;
										}
								}
								if ($output_index_count !== NULL) {
										return '[' . implode(',', $output_indexed) . ']';
								} else {
										return '{' . implode(',', $output_associative) . '}';
								}
						default:
								return ''; // Not supported
				}
		}
}
