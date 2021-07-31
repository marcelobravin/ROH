<?php
/**
 * Criação de javascripts
 * @package grimoire/bibliotecas
*/

/**
 * Inclue scripts solicitados ao longo da página
 *
 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	echo escrever("arquivo.txt", "pan");
*/
function adicionarListaScripts ($LISTA_SCRIPTS)
{
	$LISTA_SCRIPTS = array_unique($LISTA_SCRIPTS);
	foreach ($LISTA_SCRIPTS as $value) {
		echo script($value);
	}
}

/**
 * Cria script do Google Analytics
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function analytics($id="UA-47877077-1") {
	return "
		<script type='text/javascript'>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '$id']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
		</script>
	";
}

/**
 * Gera carregamento assincrono de scripts de forma crossbrowser
 * @package	grimoire/bibliotecas/javascript.php
 * @version	05-07-2015
 *
 * @param	array<strings>: urls dos scripts a carregar
 * @return	string
 * @example
		echo appendScripts(array("http://code.jquery.com/jquery-latest.js", "http://code.jquery.com/jquery-latest2.js"));
 */
function appendScripts ($filaScripts=array("https://code.jquery.com/jquery-latest.js"))
{
	$arquivo = "";
	if ( is_array($filaScripts) ) {
		foreach ($filaScripts as $script) {
			$arquivo .= "
				var script = document.createElement('script');
				script.src = '{$script}';
				script.async = true;
				script.type = 'text/javascript';
				pai.appendChild(script);
			";
		}
	}

	return "
		<script type='text/javascript'>
			function downloadJSAtOnload ()
			{
				// var pai = document.getElementsByTagName('head')[0];
				var pai = document.body;
				$arquivo
			}

			if (window.addEventListener)
				window.addEventListener('load', downloadJSAtOnload, false);
			else if (window.attachEvent)
				window.attachEvent('onload', downloadJSAtOnload);
			else
				window.onload = downloadJSAtOnload;
		</script>
	";
}

/**
 * Gera importação de javascript com fallback opcional
 * @package	grimoire/bibliotecas/javascript.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	string
 * @return	string
 *
 * @example
		echo script("http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js", "jquery-1.4.3.min.js");
		echo script("http://code.jquery.com/jquery-latest.js");
		echo script("jquery-1.4.3.min.js");
 */
function script ($arquivo="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js", $fallback=NULL)
{
	$script = "<script async src='$arquivo' type='text/javascript'></script>";

	if (!empty($fallback)) {
		$script .= '
			<script>
				!window.jQuery && document.write(\'<script async src="'. $fallback .'"><\/script>\');
			</script>';
	}
	return $script;
}

function contagem ($tempo=5, $id="c")
{
	echo "
		<script>
			var numero = {$tempo};
			var myVar = setInterval(contagem, 1000);

			function contagem() {
				if (numero > 0) {
					numero--;
					document.getElementById('{$id}').innerHTML = numero;
				}
			}
		</script>
	";
}

/**
 * Gera noscript
 *
 * @param	string
 * @return  string
 *
 * @example
    echo noscript("Meu Site");
 */
function noscript($conteudo="<p class='center'>Esse site necessita que o JavaScript esteja ativado para funcionar corretamente.</p>") {
	return gerarElemento("noscript", $conteudo);
  }
