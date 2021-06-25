<?php
include '../config.php';

# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
require ROOT.'/model/database.class.php';

$db = new Database();

if ( $db->mapeamentoRelacional( getenv('DBNAME') ) )
	echo "Exportação de BD realizada com sucesso!";
else {
	echo "Erro ao exportar BD";
}
