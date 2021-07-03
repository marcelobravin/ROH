<?php
// include 'config.php';
include 'app/Grimoire/core_inc.php';

# http://localhost/roh/app/DbExport.php

# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#require ROOT.'app/model/database.class.php'; # linux
require 'app/model/database.class.php';


$db = new Database();
if ( $db->mapeamentoRelacional( DBNAME, '_arquivos_auto_gerados/modelos' ) )
	echo "Exportação de BD realizada com sucesso!";
else
	echo "Erro ao exportar BD";
