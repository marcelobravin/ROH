<?php
include '../config.php';

# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
require ROOT.'/model/database.class.php';

$db = new Database();


// echo getenv('DBNAME');
// echo('<pre>');
// print_r($env);
// echo('</pre>');

if ( $db->mapeamentoRelacional( $env['DBNAME'] ) )
	echo "Exportação de BD realizada com sucesso!";
else
	echo "Erro ao exportar BD";
