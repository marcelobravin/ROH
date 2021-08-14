<?php
$contents = ob_get_contents();
ob_end_flush();
echo ob_get_clean();

if ( !PRODUCAO ){
	$c1->mark();
}


# fechar conexao
# fechar stmt
# incluir js appendScripts -- appendScripts
