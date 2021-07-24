<?php
$contents = ob_get_contents();
// ob_end_flush();
echo ob_get_clean();

if ( !PRODUCAO ){
	// $c1->mark();
}
// echo "Mark 2: ". $c1->stop(4);


# fechar conexao
# fechar stmt
# incluir js appendScripts -- appendScripts
