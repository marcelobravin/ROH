
cj-xfaYum4CR#rb


.button.disabled {
    color: #bbb!important;
    border-color: #ddd!important;
    background: #ebebeb!important;
    cursor: not-allowed!important;
    box-shadow: none!important;
}


header( "refresh:5;url=wherever.php" );
 echo 'You\'ll be redirected in about 5 secs. If not, click <a href="wherever.php">here</a>.';

header("HTTP/1.1 404 Not Found");


processos finais limpa mensagem


comentários listar valores numericos


REFERENCES `hospital` (`id`) ON UPDATE CASCADE)



informar tiago

function somenteLetrasBr ($param)
{
    return preg_match("/^[a-zA-Z]*$/", $param);
}





181

The way I've done it before is basically like what you wrote, but doesn't have any hardcoded values:

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

ou could do it with a directive and mod_rewrite on Apache:
<Location /buyCrap.php>
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}
</Location>








23/07/2021 11:48:16
pegar anotações keep
Clock -> desenvolvimento
Converter para oo

Transação oo


Grim
    fk_key
        id_
        no formgenerator

snippets sql no vsc


procedimento
    sudo chown lucas:lucas -R htdocs
    chwon
        dir 755
        file 644



BUG: transformou duas UQ em uma única?
    ALTER TABLE `usuario` ADD UNIQUE KEY `usuario_uq` (login, cpf);




    Validador Cartão Crédito
    Validador Conta Bancária
    Validador de Certidões
    Validador de CNH
    Validador de CNPJ
    Validador de CPF
    Validador de PIS/PASEP
    Validador de RENAVAM
    Validador de RG
    Validador Título de Eleitor
    Validar Inscrição Estadual





// chmod(ABSPATH ."../../arquivo.txt", octdec(0755));



    stmt executer
        parametro opcional sanitização conforme tabela do bd




auto area administrativa


problema com minify
    remove os // de endereco
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');



ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (hospital_id, elemento_id)
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (meta_id, mes, ano)



Dados do site
    colocar em .env?




mapa arvore de diretorio conter tamano, linhas de cada arquivo e somatório no final






function exportarFKs ()
{
	$sqlFks = "SELECT *
		FROM information_schema.referential_constraints
		WHERE constraint_schema = 'db_relatorio_ocupacao_hospitalar'";

	$fks = executarStmt($sqlFks, array(), "S");
}





permissões do htdocs recursivo
    ou owner eu


update & delete sem where colocar uma restrição no queryBuilder
    if  PRODUCAO

ALTER TABLE t1 COMMENT = 'New table comment';


db export perde constraints
	Use the information_schema.table_constraints table to get the names of the constraints defined on each table:
	SELECT * FROM information_schema.table_constraints
	WHERE constraint_schema = 'db_relatorio_ocupacao_hospitalar'


	Use the information_schema.key_column_usage table to get the fields in each one of those constraints:
	SELECT * FROM information_schema.key_column_usage
	WHERE constraint_schema = 'db_relatorio_ocupacao_hospitalar'


	If instead you are talking about foreign key constraints, use information_schema.referential_constraints:
	SELECT * FROM information_schema.referential_constraints
	WHERE constraint_schema = 'db_relatorio_ocupacao_hospitalar'

SELECT DISTINCT(constraint_name)
FROM information_schema.table_constraints
WHERE constraint_schema = 'db_relatorio_ocupacao_hospitalar'
ORDER BY constraint_name ASC;





colocar os comentários de banco nos forms?


require("processosIniciais.php");
#include estrutura
# q só gera e armazena
#pagina concatena o conteudo


# TODO
# verificar se usuário tem permissão de acesso para excluir
# excluir usuário logado??


css defaults
	get css.php
	span.numero {
		text-decoration: underline;
	}


    /*
    ├─────────────────────────────────────────────────────────────────────────────── assets (9)
    | Define critérios de busca
    └───────────────────────────────────────────────────────────────────────────────
     * @todo criar mecanismo para parametrizar
    */


    // /**
    //  *
    //  * Buscar comentários multi-linha
    //  * Uma forma simples de buscar e eliminar comentários multi-linha em PHP, CSS e outras linguagens:
    //  */
    // function validaBuscarComentariosMultilinha ()
    // {
    //  $string = "/* commmmment */";
    //  if (preg_match( padrao("comentários multi-linha"), $string))
    //      echo "example 7 successful.";
    // }

    // /**
    //  * Retorna atributo html para option selecionado se o parâmetro for igual ao alvo
    //  * @package  grimoire/bibliotecas/html.php
    //  * @since 05-07-2015
    //  * @version  17/09/2016 21:22:34
    //  *
    //  * @param	 string
    //  * @param	 string
    //  * @param	 boolean se função deve montar o value também
    //  * @return   string
    //  */
    // function selected ($parametro, $alvo, $montarValue=true)
    // {
    //  $resposta = "";
    //  if ( $montarValue )
    //      $resposta .= 'value="'. $alvo .'" ';

    //  $resposta .= marcado($parametro, $alvo, false);

    //  return $resposta;
    // }


    /**
     *
     * @example
     *
        $data = selecionar( 'resultado' );
        baixarPlanilhaExcell ($data, "relatorio");
    */
    //baixarPlanilhaExcell($array_resultado, "Inscrições Confirmadas com Títulos em aberto - " . $data);
    function baixarPlanilhaExcell ($data, $filename="file")
    {
        header("Pragma: public");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename.".xls");
        header("Content-Transfer-Encoding: binary ");
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        flush();
        $outstream = fopen("php://output", "w");
        function __outputXLS (&$vals, $key, $filehandler)
        {
            fputcsv($filehandler, $vals,chr(9),chr(0)); // add parameters if you want
        }
        array_walk($data, "__outputXLS", $outstream);
        fclose($outstream);
    }
    /**
     * Convert number of bytes largest unit bytes will fit into.
     * @package grimoire/bibliotecas/numeros.php
     * @version 05-07-2015
     *
     * It is easier to read 1kB than 1024 bytes and 1MB than 1048576 bytes. Converts
     * number of bytes to human readable number by taking the number of that unit
     * that the bytes will go into it. Supports TB value.
     *
     * Please note that integers in PHP are limited to 32 bits, unless they are on
     * 64 bit architecture, then they have 64 bit size. If you need to place the
     * larger size then what PHP integer type will hold, then use a string. It will
     * be converted to a double, which should always have 64 bit length.
     *
     * Technically the correct unit names for powers of 1024 are KiB, MiB etc.
     * @link http://en.wikipedia.org/wiki/Byte
     *
     * @since 2.3.0
     *
     * @param int|string $bytes Number of bytes. Note max integer size for integers.
     * @param int $decimals Precision of number of decimal places. Deprecated.
     * @return bool|string False on failure. Number string on success.
     */
    function size_format ( $bytes, $decimals = 0 )
    {
        $quant = array(
            // ========================= Origin ====
            'TB' => 1099511627776,  // pow( 1024, 4)
            'GB' => 1073741824,     // pow( 1024, 3)
            'MB' => 1048576,        // pow( 1024, 2)
            'kB' => 1024,           // pow( 1024, 1)
            'B ' => 1,              // pow( 1024, 0)
        );
        foreach ( $quant as $unit => $mag )
            if ( doubleval($bytes) >= $mag )
                return number_format_i18n( $bytes / $mag, $decimals ) . ' ' . $unit;

        return false;
    }

    /**
     * Converte o tamanho do arquivo de bytes para KB, MB ou GB
     * @package grimoire/bibliotecas/numeros.php
     * @version 05-07-2015
     *
     * @param	double
     * @return  string
     */
    function converterBytes ($bytes, $escala)
    {
        switch ($escala) {
            case "KB":
                $bytessize = bytessize($bytes) * .0009765625; // bytes to KB
                break;
            case "MB":
                $bytessize = (bytessize($bytes) * .0009765625) * .0009765625; // bytes to MB
                break;
            case "GB":
                $bytessize = ((bytessize($bytes) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
                break;
        }

        if ($bytessize <= 0)
            return $bytessize = 0;
        else
            return round($bytessize, 2);
    }

    // /**
    //  * Retorna o conteudo de um diretório
    //  *
    //  * @package grimoire/bibliotecas/arquivos.php
    //  * @version 05-07-2015
    //  *
    //  * @param	 string
    //  * @param	 bool
    //  * @return   array
    //  *
    //  * @example
    //  exibir( dirToArray($_SERVER['SCRIPT_FILENAME']));
    //  exibir( dirToArray($_SERVER['DOCUMENT_ROOT']));
    //  exibir( dirToArray('C:/xampp/htdocs/sites/Projetos/')); // Retorna a partir desse arquivo
    //  exibir( dirToArray());
    //  * @todo verificar
    //  */
    // function exibirDiretorio ($dir="/", $recursividade=false)
    // {
    //  $result = array();
    //  if (!$cdir = scandir($dir)) {
    //      return false;
    //  } else {
    //      foreach ($cdir as $key => $value) {
    //          if (!in_array($value,array(".",".."))) {
    //              if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
    //                  if ($recursividade)
    //                      $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
    //              } else {
    //                  $result[] = $value;
    //              }
    //          }
    //      }
    //      return $result;
    //  }
    // }

    // /**
    //  * Verifica se o valor se encaixa no padrão
    //  *
    //  * @param	 string
    //  * @return   bool
    //  *
    //  * @example
    //  echo demora(100, "");
    //  * @internal PERIGO
    //  */
    // function demora ($iteracoes=10, $comandos="echo 'hello world!';")
    // {
    //  $inicio = inicio(); # ???
    //  for ($i=0; $i<$iteracoes; $i++) {
    //      $start = microtime(true); # ???
    //      for ($i = 0; $i < RUNS; ++$i) {
    //          eval($comandos);
    //      }
    //  }

    //  echo "execution took: ". intervalo($inicio). " seconds.";
    // }


    // /**
    //  * Realiza inserções nas tabelas
    //  * @package grimoire/bibliotecas/acesso.php
    //  * @version 05-07-2015
    //  *
    //  * @uses	 GRIMOIRE."modelos/"
    //  * @uses	 persistencia.php->executar()
    //  */
    // //popularTabelas();
    // function popularTabelas ()
    //{
    //  $modelos = glob(GRIMOIRE."/modelos/registros/*.sql");

    //  foreach ($modelos as $modelo) {
    //      $sqls = file_get_contents($modelo);
    //      $sqls = explode(";\n", $sqls);
    //      foreach ($sqls as $key => $sql) {
    //          echo $sql. "<br>";
    //          if (!empty($sql)) {
    //              try {
    //                  executar($sql);
    //              } catch (Exception $e) {
    //                  exibir($e);
    //              }
    //          }
    //      }
    //  }
    // }

    // /**
    //  * Exibe mensagem de erro
    //  *
    //  * @param	 string
    //  *
    //  * @uses texto.php->startsWith()
    //  * @uses acesso.php->importarBD()
    //  * @uses debug.php->exibir()
    //  * @todo enviar e-mail para administrador do site em caso de erro
    //  */
    // function exibirErro ($sql="")
    // {
    //  if (AMBTST) {
    //      $mensagem = mysql_error() . ' - ' . $sql;
    //      if (startsWith($mensagem, "Unknown database")) {
    //          if (INICIALIZAR_SISTEMA)
    //          importarBD();
    //      }
    //  } else {
    //      $mensagem = "Ocorreu um erro! Tente novamente mais tarde!";
    //  }

    //  throw new ErrorException($mensagem);
    //  exibir($mensagem);
    //  die();
    // }


    // function  backtrace()
    // {

    //  $callers = debug_backtrace();
    //  $arrBacktrace = array();
    //  $callersNum = count($callers);

    //  echo('<pre>');
    //  print_r($callers);
    //  echo('</pre>');

    //  for ($i = 1; $i < $callersNum; $i++) {
    //      $arrBacktrace [] = sprintf('%s::%s(%d)', $callers[$i]['class'], $callers[$i]['function'], $callers[$i]['line'])
    // ;
    //  }

    //  return implode('->', $arrBacktrace);
    // }

    // function  lancarExcecao( $mssg )
    // {
    //  backtrace();
    //  throw new Exception($mssg);
    // }


    // /**
    //  * Verifica se o valor se encaixa no padrão
    //  *
    //  * @package grimoire/bibliotecas/arquivos.php
    //  * @version 05-07-2015
    //  *
    //  * @param	 string
    //  * @param	 int
    //  * @return   bool
    //  *
    //  * @uses expressoesRegulares.php->padrao()
    //  */
    // // Muito semelhante a blob
    // function lerArquivo ($caminho, $tamanhoLinha = 10000)
    // {
    //  $arquivo = fopen($caminho, 'r');
    //  while (!feof($arquivo)) {
    //      $linha      = fgetss($arquivo, $tamanhoLinha);
    //      $vetor_aux = explode(";", $linha);
    //      $novaLinha = null;
    //      foreach ($vetor_aux as $value) {
    //          $novaLinha[] = htmlentities($value);
    //      }
    //      $retorno[] = $novaLinha;
    //  }
    //  return $retorno;
    // }

nos forms
    <?php #require 'public/views/forms/'.MODULO.'-atualizacao.php'  #--- prod ?>
    <?php require '_arquivos_auto_gerados/views/'.MODULO.'-atualizacao.php' #  dev ?>
    colocar if producao?


colocar montar criacao para pegar descrições em json
	gerarModelo ($nome, $descricao)


    /**
     * Exibe campos conforme layout desse admin
     * @package grimoire/bibliotecas/formularios.php
     * @since   05-07-2015
     * @version 30-06-2021
     *
     * @param	string
     */
    function exibirTemplate ($campos, $labels, $esconder=array(), $registro=null)
    {
        #include_once "master/componentes/campoStatus.php";// ??????????????????????????????????????
        foreach ($campos as $indice => $c) {
            if (!in_array($indice, $esconder)) { ?>
                <div class="control-group">
                <?php echo $labels[$indice] ?>

                <div class="controls">

                <?php if (!is_array($c) && strpos($c, "type='file'") !== FALSE) { // Pode dar erro se VALOR contiver file !!!!!!!!!!!!!!!!!!! ?>
                    <span class="btn black fileinput-button">
                        <i class="icon-plus icon-white"></i>
                        <span>Selecione a Foto</span>
                <?php } ?>

                <?php echo $campos[$indice] ?>
                <?php if (!is_array($c) && strpos($c, "type='file'") !== FALSE) { // Pode dar erro se VALOR contiver file !!!!!!!!!!!!!!!!!!!
                        if (!empty($_GET['codigo']) && !empty($registro['foto'])) { ?>
                            </span>
                            </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label">Arquivo</label>
                            <div class="controls"><?php

                            $dados = getimagesize(IMAGENS. "/{$_GET['modulo']}/{$registro['foto']}");
                            echo img(IMAGENS."/{$_GET['modulo']}/{$registro['foto']}", array('style' => "max-height: 200px; border: 1px dashed silver", "title"=>$dados['mime']), false);
                            echo $dados[1] .'px';

                            echo '<br>'. $dados[0] .'px';
                        }
                    } ?>
                </div>
            </div>
            <?php } else { ?>
                <?php echo $campos[$indice] ?>
                <?php
            }
        }
    }


// session_start();
// echo "O limitador de cache esta definido agora como $cache_limiter<br />";
// echo "As sessões em cache irão expirar em $cache_expire minutos";


processosIniciais->templatePagina()
    $pagina['html'][0/1]
    $pagina['metas']
    $pagina['body']['header']
    $pagina['body']['content']
    $pagina['body']['footer']
    $pagina['scripts']
    $pagina['benchmark'][clock]


processosFinais->construirPagina()

defines htaccess


define( "VALIDADE"              , "" );

15/07/2021 16:05:15
/**
 * Verifica se o prazo de validade do sistema expirou
 * @package grimoire/bibliotecas/acesso.php
 * @version 20-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	configuracoes.php->VALIDADE
 * @uses	tempo.php->agora()
 * @uses	tempo.php->diferencaTempo()
 */
function checarValidade ()
{
    $v = diferencaTempo(VALIDADE, agora());

    if ($v < 0) {
        header( 'Status: 403 Forbidden' );
        header( 'HTTP/1.1 403 Forbidden' );
        echo "Sistema expirado!";
        exit;
    }
}


15/07/2021 15:49:52
getCSS padrão
    obrigatorio
    invisivel


gerarBuild(Producao=true)
    producao que trunca tabelas e realiza inserts básicos



    /**
     * Verifica se o valor se encaixa no padrão
     * @package grimoire/bibliotecas/tempo.php
     * @version 05-07-2015
     *
     * @param	string
     * @return	bool
     *
     * @uses	    expressoesRegulares.php->padrao()
     * @example
            tempo();
     */
    function tempo ()
    {
        session_start();
        echo session_id();
        // Insere tempo na sessão
        if (!isset($_SESSION['timeout']))
            $_SESSION['timeout'] = time() + 60; //session time is 1 minute


        exibir($_SESSION);
    // Se acabar o tempo
        echo time() - $_SESSION['timeout'];
        if ((time() - $_SESSION['timeout']) > 0) {
            session_regenerate_id();
            session_destroy();
            unset($_SESSION);
        }
    }


    # dia da semana
    # estados
    function retornaMes ($criterio, $abreviacao=false, $ptbr=true)
    {
        $meses = array();

        if ($ptbr) {
            $meses[1]   = array('abreviacao' => 'JAN', 'nome' => 'Janeiro');
            $meses[2]   = array('abreviacao' => 'FEV', 'nome' => 'Fevereiro');
            $meses[3]   = array('abreviacao' => 'MAR', 'nome' => 'Março');
            $meses[4]   = array('abreviacao' => 'ABR', 'nome' => 'Abril');
            $meses[5]   = array('abreviacao' => 'MAI', 'nome' => 'Maio');
            $meses[6]   = array('abreviacao' => 'JUN', 'nome' => 'Junho');
            $meses[7]   = array('abreviacao' => 'JUL', 'nome' => 'Julho');
            $meses[8]   = array('abreviacao' => 'AGO', 'nome' => 'Agosto');
            $meses[9]   = array('abreviacao' => 'SET', 'nome' => 'Setembro');
            $meses[10]  = array('abreviacao' => 'OUT', 'nome' => 'Outubro');
            $meses[11]  = array('abreviacao' => 'NOV', 'nome' => 'Novembro');
            $meses[12]  = array('abreviacao' => 'DEZ', 'nome' => 'Dezembro');
        } else {
            $meses[1]   = array('abreviacao' => 'JAN', 'nome' => 'January');
            $meses[2]   = array('abreviacao' => 'FEB', 'nome' => 'February');
            $meses[3]   = array('abreviacao' => 'MAR', 'nome' => 'March');
            $meses[4]   = array('abreviacao' => 'APR', 'nome' => 'April');
            $meses[5]   = array('abreviacao' => 'MAY', 'nome' => 'May');
            $meses[6]   = array('abreviacao' => 'JUN', 'nome' => 'June');
            $meses[7]   = array('abreviacao' => 'JUL', 'nome' => 'July');
            $meses[8]   = array('abreviacao' => 'AUG', 'nome' => 'August');
            $meses[9]   = array('abreviacao' => 'SEP', 'nome' => 'September');
            $meses[10]  = array('abreviacao' => 'OCT', 'nome' => 'October');
            $meses[11]  = array('abreviacao' => 'NOV', 'nome' => 'November');
            $meses[12]  = array('abreviacao' => 'DEC', 'nome' => 'December');
        }

        if ( is_int($criterio) ) {
            if ($abreviacao)
                return $meses[$criterio]['abreviacao'];
            else
                return $meses[$criterio]['nome'];

        } else {
            foreach ($meses as $indice => $value) {
                if ( $value['abreviacao'] == $criterio ) {
                    if ($indice <= 9)
                        $indice = "0".$indice;

                    return $indice;
                }
            }
        }
    }

metas controle por abas
baixar os arquivos CDN



if não tem env abrir tela de criar




case 'gerar-formulario' : retirar codigo=x
case 'gerar-formulario-atualizacao' : colocar codigo=x
	sem codigo gera inputs com echo atributo
	com codigo traz pronto [para ser utilizado de forma parametrizada]

gerarFormulario( insert/update )
	ou gera os dois?
		form_insert-MODULO.php


SIMBOLO_SETAESQUERDA = <i class='fas fa-angle-left'></i>

$vetorPaginas['primeira'] = "<span class='primeira'><i class='fas fa-angle-double-left'></i></span>";
$vetorPaginas['anterior'] = "<span class='anterior'>". SIMBOLO_SETAESQUERDA ."</span>";

$vetorPaginas['proxima'] = "<span class='proxima'><i class='fas fa-angle-right'></i></span>";
$vetorPaginas['ultima'] = "<span class='ultima'><i class='fas fa-angle-double-right'></i></span>";

function ordenado($campo="", $both="&#8597;", $asc="&#8595;", $desc="&#8593;") {





# Grimoire
 em caso de força bruta sem usuário válido
	# TODO bloquearIp(identificarIP());
۞
Ѡ

isMobile () nos logs

colocar na função de erro em DEV
	https://stackoverflow.com/search?q=constants





# TODO: colocar na sessao o navegador e ip

# centralizar bloqueio de usuario logado/deslogado conforme configuracao de página atual



<!-- <link rel="publisher" href="https://plus.google.com/[your business g+ profile here]"> -->



MFA
Captcha

PHP_EOL

return array_map('utf8_encode/utf8_decode', $value)


// $pph_strt = microtime(true);
// //The code he posted for login.php
// $end = (microtime(true) - $pph_strt);
// $wait = bcmul((1 - end), 1000000);  // usleep(250000) 1/4 of a second
// usleep ( wait );
// echo "<br>Execution time:".(microtime(true) - pph_strt)."; ";





// /**
//  * Exibe mensagem de erro
//  *
//  * @param	 string
//  *
//  * @uses		texto.php->startsWith()
//  * @uses		acesso.php->importarBD()
//  * @uses		debug.php->exibir()
//  * @todo		enviar e-mail para administrador do site em caso de erro
//  */
// function exibirErro ($sql="")
// {
// 	if ( !PRODUCAO ) {
// 		$mensagem = mysql_error() . ' - ' . $sql;
// 		// if (startsWith($mensagem, "Unknown database")) {
// 			// if ( INICIALIZAR_SISTEMA )
// 				// importarBD();
// 		// }
// 	} else {
// 		$mensagem = "Ocorreu um erro! Tente novamente mais tarde!";
// 	}

// 	throw new ErrorException($mensagem);
// 	exibir($mensagem);
// 	die();
// }






gerar arquivo de configurações como template
gerar arquivos
    htaccess
    .env


SET GLOBAL time_zone = 'Europe/Helsinki';

criar estrutura de diretório


comment nos template de tabela
ALTER TABLE supplier COMMENT 'Includes past suppliers';

ALTER TABLE supplier
    MODIFY dir VARCHAR(50)
        CHARACTER SET ascii COLLATE ascii_bin
        NOT NULL DEFAULT 'catchall' CHECK (dir > '')
        COMMENT 'Directory containing invoices';


label .obrigatorio
	after *

inserir/update/delete com log



biblioteca de botões no grimoire

transaction
	commit
	rollback


# TODO: gerarPagina() retornar conteudo em array para alteração antes de exibição


verificar gerar pagina
	retornar array associativa para adição de conteúdo e printar página inteira com benchmark
	colocar gerar metas com parametros de configuração



prepararAmbienteProducao
	if producao
		remover arquivos de debug e pastas temporarias
# TODO: apagar logs de erro deste usuário



erro no meu montar criacao de tabelas
	verificar extras on update current timestamp
	General error: 1364 Field 'ativo' doesn't have a default value


less.php
templateTabelaOperacoes() parear com definição atualizada do db
templeate roles

dbclass usar como objeto mesmo?

template das paginas com conteudo inserivel

$result = $DAO->converter_para_utf8($DAO->buscar_varios($sql,10000));
$DAO->renderXLS($data,"inadimplentes_");


if keepAlive
    begin transaction

permissão grupos


pegar mapeamento diretorio do CC
separar inserts obrigatorios em um diretorio especifico

seeder insere dummy registros
rota asset pipeline
versao no config do projeto
    tmz
    idioma
    descricao
    ambiente
    titulo
    down
        tela de manutenção

    paginas config
        acesso bl, wl
router
    valida acesso e encaminha para destino
controla master & functions
breadcrumb
blades
control chama serviço que executa 1 unica tarefa

regras validação
    required?
    null?
    numero
        max min
    letra
        maior q?
        mensagem para cada tipo de erro
lista request aceitavel, chama service?

langs
    default
    multiplas
    cria template

permissions e roles
control valida request e permissão e chama serviço



validação automática conforme bd
    antes de insert e update
uuid nos get
author insert, update e delete

só updata parametros que foram enviados


funcs return type php 7
func montar estrutura de diretorio template

grimoire pagina de apresentação e docs, EXEMPLOS
SET CONFIGS


TELA TESTAR FUNÇÕES COMO SWAGGER


queue de tarefas a realizar
    scrpts a inserir

relógio padrão em dev
    queue?
config tempo de bloqueio por força bruta
numero de tentativas

log de erros via arquivo

postgres
    json e subquery
     criar coluna status
     id
     dia da semana e horario de atendimento
dbeaver

função de criar tabelas padrão
    matriz acesso
    menu - id pai
captcha
csrf
    token on insert, postman fails

config tempo inativo cair sessão


listar encoding map directory
barra carregamento CC




duble
SIMULA RESULTADDOS do bd

php unit
sonar qube
testes


pace
xss

ver guia dde diretrizes

tzinho nos php docs
    T------------------------------





get,post,metodos
feitos de maneira universal, funciona pra qqer objeto


criar readme com instruções de instalação
    {instruir a alterar e adicionar ao gitignore}
    parametrizar
        exportação de bd
            registros em json
        exibição de erros conforme ambiente

        criar git projeto em andamento
            WiP













OO?
NS namespace?







<?php

namespace Lib\Movida;

final class Security {

    private static $st_salt_password = '$2a$07$bda7ac69d6c64931a0c53116d'; ///////// remover salt fixo
    private static $st_code_reset = '#gwrK4xcT!Tquug8';
    private static $st_hash_key = 'N^RMJ4E8iAzNP6mk05Mjz7vvL5G#YjYj';
    private static $st_hash_iv = '#gwrK4xcT!Tquug8';

    /**
     * @param $st_user
     * @return string
     */
    public static function createSessionID($st_user) {
        $st_hash = $st_user.time();
        return hash('sha256',$st_hash);
    }

    /**
     * @param $st_password
     * @return string
     */
    public static function encryptPassword($st_password) {



        //$st_password = 'rasmuslerdorf';





        $st_encodes = crypt($st_password, self::$st_salt_password); //////////////////// modificar aqui
        return hash('sha512',$st_encodes);
    }

    /**
     * @param int $qtdChar
     * @return string
     */
    public static function generatePasswordResetCode($qtdChar = 6){
        $characters = self::$st_code_reset;
        $mix_1 = str_shuffle($characters);
        $mix_2 = str_shuffle($characters);
        $mixFinal = str_shuffle($mix_1.$mix_2);
        $code = substr($mixFinal, 0, $qtdChar);
        return str_shuffle($code);
    }

}



// /**
//  * Retorna o endereço mac do servidor
//  * @package grimoire/bibliotecas/acesso.php
//  * @version 20-07-2015
//  *
//  * @return	string/bool
//  *
//  * @uses		$_SERVER
//  */
// function returnMacAddress ()
// {
// 	$location = `which arp`;
// 	$arpTable = `$location`;
// 	$arpSplitted = split("\n",$arpTable);
// 	$remoteIp = $GLOBALS['REMOTE_ADDR'];
// 	foreach ($arpSplitted as $value){
// 		$valueSplitted = split(" ",$value);
// 			foreach ($valueSplitted as $spLine) {
// 				if (preg_match("/$remoteIp/",$spLine)) {
// 					$ipFound = true;
// 				}
// 				if ($ipFound) {
// 					reset($valueSplitted);
// 					foreach ($valueSplitted as $spLine) {
// 						if (preg_match("/[0-9a-f][0-9a-f][:-]".
// 							"[0-9a-f][0-9a-f][:-]".
// 							"[0-9a-f][0-9a-f][:-]".
// 							"[0-9a-f][0-9a-f][:-]".
// 							"[0-9a-f][0-9a-f][:-]".
// 							"[0-9a-f][0-9a-f]/i",$spLine)) {
// 							return $spLine;
// 						}
// 					}
// 				}
// 			$ipFound = false;
// 		}
// 	}
// 	return false;
// }
