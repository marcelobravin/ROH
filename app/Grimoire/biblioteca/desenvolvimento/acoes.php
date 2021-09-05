<?php
/**
 * http://localhost/roh/index.php?action
 */
if ( isset($_REQUEST['action']) ) {

	switch ( $_REQUEST['action'] ) {

		case 'popularTabela' :
			if ( isset($_REQUEST['tabela']) ) {
				$tabela = $_REQUEST['tabela'];
			} else {
				die("Forneça o nome da tabela desejada");
			}

			$quantidade = isset($_REQUEST['tabela']) ? $_REQUEST['quantidade'] : 30;
			popularTabela($tabela, $quantidade);

		break;
		case 'cargaInicial' :
			importarRegistros(BASE."app/DB/inserts obrigatorios/*.sql");

		break;
		case 'gerar-formulario' :
			foreach ($MODULOS as $key => $value) {
				# default
				$sobreEscreverCampos	= array();
				$esconder				= array();
				$padroes				= array(); # talvez dá pra tirar
				$sobreEscreverLabels	= array();
				$descricaoLabels		= array();
				$remover				= array( # campos de log
					'criado_em',
					'atualizado_em',
					'excluido_em',
					'criado_por',
					'atualizado_por',
					'excluido_por'
				);

				#personaliza
				if ($value == 'hospital') {
					$sobreEscreverLabels	= array(
						'titulo'				=> 'Estabelecimento',
						'cnes'					=> 'CNES',
						'cnpj'					=> 'CNPJ',
						'numero'				=> 'Número',
						'cep'					=> 'CEP',
						'uf'					=> 'UF',
						'endereco'				=> 'Logradouro',
						'segundo_responsavel'	=> 'Técnico Responsável'
					);
					$descricaoLabels		= array('titulo' => 'Nome do estabelecimento');
				} else if ($value == 'usuario') {
					$sobreEscreverLabels = array(
						'login'		=> 'Email',
						'endereco'	=> 'Endereço',
						'cpf'		=> 'CPF',
						'cargo'		=> 'CBO'
					);

					$remover[] = 'reset';
					$remover[] = 'token';
					$remover[] = 'senha';
					$remover[] = 'email_confirmado';
				}

				$x = criarFormularioInsercao($value, $sobreEscreverLabels, $sobreEscreverCampos, $remover, $esconder, $descricaoLabels, $padroes);
				if ( $x ) {
					echo "Gerado formulário de inserção: {$value}!";
					exibir($x);
				} else {
					echo "Erro...";
				}
				echo "<hr>";
			}

		break;
		case 'gerar-formulario-atualizacao' :

			foreach ($MODULOS as $key => $value) {

				# default
				$sobreEscreverLabels = array();
				$sobreEscreverCampos = array();
				$esconder = array();
				$conversoes = array();
				$descricaoLabels = array();
				$padroes = array();
				$remover = array(
					# campos de log
					'criado_em',
					'atualizado_em',
					'excluido_em',
					'criado_por',
					'atualizado_por',
					'excluido_por'
				);

				# especialização
				switch ( $value ) {
					case 'hospital':
						$sobreEscreverLabels	= array(
							'titulo'				=> 'Estabelecimento',
							'cnes'					=> 'CNES',
							'cnpj'					=> 'CNPJ',
							'numero'				=> 'Número',
							'cep'					=> 'CEP',
							'uf'					=> 'UF',
							'endereco'				=> 'Logradouro',
							'segundo_responsavel'	=> 'Técnico Responsável'
						);
						$descricaoLabels 		= array('titulo' => 'Nome do estabelecimento');
					break;
					case 'usuario':
						$sobreEscreverLabels = array(
							'login'		=> 'Email',
							'endereco'	=> 'Endereço',
							'cpf'		=> 'CPF',
							'cargo'		=> 'CBO'
						);
						$sobreEscreverCampos = array(
							'login'		=> 'span'
						);

						$remover[] = 'token';
						$remover[] = 'reset';
						$remover[] = 'email_confirmado';
						$remover[] = 'senha';

					break;
					default:
				}

				$x = criarFormularioAtualizacao($value, $sobreEscreverLabels, $sobreEscreverCampos, $remover, $esconder, $descricaoLabels, $padroes);
				if ( $x ) {
					echo "Gerado formulário de atualização: {$value}!";
					exibir( htmlspecialchars($x));
				} else {
					echo "Erro...";
				}
				echo "<hr>";
			}

		break;
		case 'criacaoTabela' :
			if ( isset($_REQUEST['tabela']) ) {
				$tabela = $_REQUEST['tabela'];
			} else {
				$tabela = "NOVA_TABELA";
			}

			$sql = criacaoTemplateTabela($tabela);

			if ( isset($_REQUEST['executar']) ) {
				executar($sql);
				echo "Criação da tabela {$tabela} executada!";
			}

			exibir( $sql );

		break;
		case 'gerarFk' :
			if ( isset($_REQUEST['tabela']) ) {
				$tabela = $_REQUEST['tabela'];
				$sql = gerarFKs($tabela);
			} else {
				$tabela = "NOVA_TABELA";
				$sql = criacaoFK($tabela, "TABELA_REFERENCIADA");
			}

			if ( isset($_REQUEST['executar']) ) {
				echo "Alteração de tabela {$tabela} executada!";
				$r = executar($sql['ALTER TABLE']);
				exibir($r);
				$r = executarSequencia($sql['INSERT']);
				exibir($r);
			} else {
				exibir($sql);
			}

		break;
		case 'gerarFks' :
			$tabelas = listarTabelas();
			foreach ($tabelas as $t) {
				$sql = gerarFKs($t['Tables_in_'.DBNAME]);
				exibir($sql);
			}

		break;
		case 'dbImport' :
			if ( importarBD() ) {
				echo "Importação de BD realizada com sucesso!";
			} else {
				echo "Erro ao importar BD";
			}

		break;
		case 'dbExport' :
			if ( exportarBD() ) {
				echo "Exportação de BD realizada com sucesso!";
			} else {
				echo "Erro ao exportar BD";
			}

		break;
		case 'generateSiteMap':
			exibir( generateSiteMap() );

		break;
		case 'registerProjectFiles':
			registerProjectFiles();

		break;
		case 'getDirectorySize':
			echo formatBytes( getDirectorySize(BASE), 3 );

		break;
		case 'mascaras':
			testarMascaras();

		break;
		case 'criarTabelasLog':
			criarTabelasLog();

		break;
		case 'minify':
			$x = assetPipeline(true, true, false);
			if ( $x ) {
				echo "Gerados arquivos css e js minimizados!";
			} else {
				echo "Erro ao minimizar os arquivos css e js!";
			}

		break;
		case 'exportConstraints':
			$c = exportarConstraints();
			registrartUQs($c['uqs']);

		break;
		case 'gerarHtaccess'	: die( gerarHtaccess() ); break;
		case 'gerarEnv'			: die( gerarEnv () ); break;

		default:
			echo '<a href="index.php">Página inicial</a></li>';
			echo '<ul>';
			echo '<li><a href="index.php?action=cargaInicial&tabela=categoria">cargaInicial</a></li>';
			echo '<li><a href="index.php?action=criacaoTabela&tabela=">criacaoTabela</a></li>';
			echo '<li><a href="index.php?action=criarTabelasLog">criarTabelasLog</a></li>';
			echo '<li><a href="index.php?action=dbExport">dbExport</a></li>';
			echo '<li><a href="index.php?action=dbImport">dbImport</a></li>';
			echo '<li><a href="index.php?action=exportConstraints">exportConstraints</a></li>';
			echo '<li><a href="index.php?action=generateSiteMap">generateSiteMap</a></li>';
			echo '<li><a href="index.php?action=gerar-formulario">gerar-formulario</a></li>';
			echo '<li><a href="index.php?action=gerar-formulario-atualizacao">gerar-formulario-atualizacao</a></li>';
			echo '<li><a href="index.php?action=gerarEnv">gerarArquivoEnv</a></li>';
			echo '<li><a href="index.php?action=gerarHtaccess">gerarArquivoHtaccess</a></li>';
			echo '<li><a href="index.php?action=gerarFk">gerarFk</a></li>';
			echo '<li><a href="index.php?action=gerarFks">gerarFks</a></li>';
			echo '<li><a href="index.php?action=getDirectorySize">getDirectorySize</a></li>';
			echo '<li><a href="index.php?action=mascaras">mascaras</a></li>';
			echo '<li><a href="index.php?action=minify">minify</a></li>';
			echo '<li><a href="index.php?action=popularTabela">popularTabela</a></li>';
			echo '<li><a href="index.php?action=registerProjectFiles">registerProjectFiles</a></li>';
			echo '</ul>';
	}
	exit;
}
