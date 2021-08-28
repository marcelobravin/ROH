<?php
/**
 * Funções para debugging
 * @package	grimoire/biblioteca/desenvolvimento
*/

/**
 * Calcula o tempo de processamento de blocos de código
 *
 * @var	time
 * @example
	$c1 = new Clock(); // inicia cronometro
	$c1->mark(); // retorna tempo e número do marcador
	echo $c1->stop(); // retorna tempo
 */
class Clock {
	public $inicio = "";
	public $i = 0;

	function __construct ()
	{
		$this->inicio = microtime(true);
	}

	function stop ($precisao=4)
	{
		return round(microtime(true) - $this->inicio, $precisao);
	}

	function mark ($precision=4)
	{
		$this->i++;
		echo "<p class='debug'>";
		echo "Mark {$this->i}: ". $this->stop($precision);
		echo "</p>";
	}
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/biblioteca/desenvolvimento.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function backtrace ()
{
	$callers = debug_backtrace();
	$arrBacktrace = array();
	$callersNum = count($callers);

	for ($i = 1; $i < $callersNum; $i++) {
		$arrBacktrace[]  = sprintf('%s::%s(%d)', $callers[$i]['class'], $callers[$i]['function'], $callers[$i]['line'])
		;
	}

	return implode('->', $arrBacktrace);
}

/**
 * Print an error to STDOUT and exit with a non-zero code. For commandline scripts.
 * Default errorcode is 1.
 *
 * Very useful for perl-like error-handling:
 *
 * do_something() or mdie("Something went wrong");
 *
 * @param string	$msg		 Error message
 * @param integer $errorcode Error code to emit
 *
 */
function mdie ($msg='', $errorcode=1)
{
	trigger_error($msg);
	exit($errorcode);
}

/**
 * Exibe mensagem no log de erro informando linha e local
 * @package	grimoire/biblioteca/desenvolvimento.php
 * @version	17-07-2015
 */
function erro ()
{
	$erro = debug_backtrace();
	$erro = $erro[0];

	$conteudo = "
		Arquivo: {$erro['file']}
		Linha: {$erro['line']}
		Parametros: ";

	error_log( "ERRO: {$conteudo}". print_r($erro['args'][0] , true) );
}

/**
 * Atalho para exibir uma array
 * @version	24/07/2021 14:07:35
 * @param	string/array
 * @param	bool: define se será exibido os metadados da array
 *
 * @example
	$obj = criarObjeto(array('foo' => 'bar', 'property' => 'value', 'endereco' => array('pan' => 'pum')));
	exibir($obj);
 */
function exibir ($var, $parar=false)
{
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	if ($parar) {
		exit;
	}
}

/**
 * Lança um erro
 *
 * @param	string
 * @param	bool
 */
function erro2 ($mensagem='Erro: Alguma coisa não está certa', $pararSistema=false)
{
	if ($pararSistema) {
		$gravidade = E_USER_ERROR;
	} else {
		$gravidade = E_USER_NOTICE;
	}
	trigger_error($mensagem, $gravidade);
}

/*
    NN: category, NN: error
    0000 undefined
    0101 set base
    0201 pdo
    0202 pdo
    1045 access denied
*/

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/biblioteca/desenvolvimento.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function reportError ($error, $code='0000', $stop=false)
{
	if ( PRODUCAO ) {
		echo "Ocorreu um erro, código: " . $code;
	} else {
		echo "<pre>";
		print_r($error);
		echo "</pre>";
	}

	if ( $stop ) {
		exit;
	}
}

/**
 * Realiza multiplas inserções de dummy data
 * @since 28/06/2021 11:52:15
 * @example
	popularTabela('hospital', 3);
*/
function popularTabela ($tabela, $insercoes=3)
{
	$objeto = [
		'titulo'		=> 'São Luiz Gonzaga'
		, 'criado_por'	=> '1'
	];

	for ($i=0; $i < $insercoes; $i++) {
		echo inserir($tabela, $objeto);
		br();
	}
}
