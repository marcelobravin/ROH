<?php
// include 'config.php';
include 'app/Grimoire/core_inc.php';


# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#require ROOT.'app/model/database.class.php'; # linux
// require 'app/model/database.class.php';


// $env = parse_ini_file(ROOT.".env");


# pegar dinamicamente
#define( "DIRETORIO", "/opt/lampp/htdocs/roh/_arquivos_auto_gerados" ); # linux
// define( "DIRETORIO", ROOT."_arquivos_auto_gerados" );

// echo('<pre>');
// print_r($_SERVER);
// echo('</pre>');

if ( importarBD() )
	echo "Importação de BD realizada com sucesso!";
else
	echo "Erro ao importar BD";
