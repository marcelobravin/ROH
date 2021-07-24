<?php
/**
 * http://localhost/roh/index.php?action=dbExport
 * @todo proteger esse endpoint
 */
if ( isset($_REQUEST['action']) ) {

	switch ( $_REQUEST['action'] ) {

		case 'popularTabela' :  #-------------------------------------------
			if ( isset($_REQUEST['tabela']) )
				$tabela = $_REQUEST['tabela'];
			else
				die("Forneça o nome da tabela desejada");

			$quantidade = isset($_REQUEST['tabela']) ? $_REQUEST['quantidade'] : 30;
			popularTabela($tabela, $quantidade);
			break;

		case 'insercaoMatricial' :  #---------------------------------------
			// ! TODO realizar insercao do diretorio de inserts obrigatorios
			if ( isset($_REQUEST['tabela']) )
				$tabela = $_REQUEST['tabela'];
			else
				die("Forneça o nome da tabela desejada");

			/* substituir por pegar os inserts básicos ------------------ */
			switch ( $tabela ) {
				case 'categoria':
					$matriz = array(
						array ("criado_por"=> 1, "titulo" => "Equipe"),
						array ("criado_por"=> 1, "titulo" => "Internação"),
						array ("criado_por"=> 1, "titulo" => "Ambulatório"),
						array ("criado_por"=> 1, "titulo" => "Consultas ambulatoriais"),
						array ("criado_por"=> 1, "titulo" => "Procedimentos e cirurgias ambulatoriais"),
						array ("criado_por"=> 1, "titulo" => "SADT"),
						array ("criado_por"=> 1, "titulo" => "Atenção domiciliar")
					);
					break;

				case 'elemento':
					$matriz = array(
						array("criado_por" => 1, "categoria_id" => 1,"titulo" => "Clínica médica"),
						array("criado_por" => 1, "categoria_id" => 1,"titulo" => "Clínica Cirúrgica"),
						array("criado_por" => 1, "categoria_id" => 1,"titulo" => "Pedatria"),
						array("criado_por" => 1, "categoria_id" => 1,"titulo" => "Ginecologia e Obstetrícia"),

						array("criado_por" => 1, "categoria_id" => 2,"titulo" => "Clínica médica e cirúrgica"),
						array("criado_por" => 1, "categoria_id" => 2,"titulo" => "Pedatria"),
						array("criado_por" => 1, "categoria_id" => 2,"titulo" => "Obstetrícia"),
						array("criado_por" => 1, "categoria_id" => 2,"titulo" => "Cuidados intermediários"),
						array("criado_por" => 1, "categoria_id" => 2,"titulo" => "UTI Neonatal"),

						array("criado_por" => 1, "categoria_id" => 3,"titulo" => "Clínica médica e cirúrgica"),
						array("criado_por" => 1, "categoria_id" => 3,"titulo" => "Pedatria"),
						array("criado_por" => 1, "categoria_id" => 3,"titulo" => "Obstetrícia"),
						array("criado_por" => 1, "categoria_id" => 3,"titulo" => "Cuidados intermediários"),
						array("criado_por" => 1, "categoria_id" => 3,"titulo" => "UTI Neonatal"),

						array("criado_por" => 1, "categoria_id" => 4,"titulo" => "Clínica médica e cirúrgica"),
						array("criado_por" => 1, "categoria_id" => 4,"titulo" => "Pedatria"),
						array("criado_por" => 1, "categoria_id" => 4,"titulo" => "Obstetrícia"),
						array("criado_por" => 1, "categoria_id" => 4,"titulo" => "Cuidados intermediários"),
						array("criado_por" => 1, "categoria_id" => 4,"titulo" => "UTI Neonatal"),

						array("criado_por" => 1, "categoria_id" => 5,"titulo" => "Clínica médica e cirúrgica"),
						array("criado_por" => 1, "categoria_id" => 5,"titulo" => "Pedatria"),
						array("criado_por" => 1, "categoria_id" => 5,"titulo" => "Obstetrícia"),
						array("criado_por" => 1, "categoria_id" => 5,"titulo" => "Cuidados intermediários"),
						array("criado_por" => 1, "categoria_id" => 5,"titulo" => "UTI Neonatal"),

						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Ultrassonografia geral"),
						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Tomografia"),
						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Ecocardiograma"),
						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Colonoscopia"),
						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Endoscopia"),
						array("criado_por" => 1, "categoria_id" => 6,"titulo" => "Radiologia"),

						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Ultrassonografia geral"),
						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Tomografia"),
						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Ecocardiograma"),
						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Colonoscopia"),
						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Endoscopia"),
						array("criado_por" => 1, "categoria_id" => 7,"titulo" => "Radiologia")
					);
					break;

			}
			insercaoMatricial($tabela, $matriz);
			break;

		case 'criacaoTabela' :
			if ( isset($_REQUEST['tabela']) )
				$tabela = $_REQUEST['tabela'];
			else
				$tabela = "NOVA_TABELA";

			$sql = criacaoTemplateTabela($tabela);

			if ( isset($_REQUEST['executar']) ) {
				executar($sql);
				echo "Criação da tabela {$tabela} executada!";
			}

			echo('<pre>');
			print_r( $sql );
			echo('</pre>');
			break;

		case 'criacaoFk' :
			if ( isset($_REQUEST['tabela']) )
				$tabela = $_REQUEST['tabela'];
			else
				$tabela = "NOVA_TABELA";

			$sql = "ALTER TABLE `{$tabela}` ENGINE = InnoDB;";

			if ( isset($_REQUEST['executar']) ) {
				executar($sql);
				echo "Alteração de tabela {$tabela} executada!";
			}

			echo('<pre>');
			print_r( $sql );
			echo('</pre>');

			if ( isset($_REQUEST['tabela']) ) {

				$sql2 = array();
				$t = descreverTabela($tabela);
				foreach ($t as $v) {

					if ( terminaCom($v['Field'], '_id',) ) {
						$tab = explode('_', $v['Field']);
						$sql2[] = criacaoFK($tabela, $tab[0]);
					}
				}

				echo('<pre>');
				print_r( $sql2 );
				echo('</pre>');
			}

			break;

		case 'dbImport' :
			if ( importarBD() )
				echo "Importação de BD realizada com sucesso!";
			else
				echo "Erro ao importar BD";
			break;

		case 'dbExport' :
			if ( exportarBD() )
				echo "Exportação de BD realizada com sucesso!";
			else
				echo "Erro ao exportar BD";
			break;

		case 'gerar-formulario' :

			foreach ($MODULOS as $key => $value) {
				# default
				$sobreEscreverCampos	= array();
				$esconder				= array();
				$conversoes				= array();
				$padroes				= array();
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
					$sobreEscreverLabels	= array('titulo'=> 'Título');
					$descricaoLabels		= array('titulo'=> 'Descrição do Título');
				} else if ($value == 'usuario') {
					$sobreEscreverLabels = array(
						'login'		=> 'Email',
						'endereco'	=> 'Endereço',
						'cpf'		=> 'CPF'
					);
					$descricaoLabels = array('titulo'=> 'Descrição do Título');

					$remover[] = 'reset';
					$remover[] = 'token';
					$remover[] = 'senha';
					$remover[] = 'email_confirmado';
				}

				$x = criarFormularioInsercao($value, $sobreEscreverLabels, $sobreEscreverCampos, $remover, $esconder, $conversoes, $descricaoLabels, $padroes);
				if ( $x ) {
					echo "Gerado formulário de inserção: {$value}!";
					echo('<pre>');
					print_r($x);
					echo('</pre>');
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
						$sobreEscreverLabels	= array('titulo'=> 'Título');
						$descricaoLabels 		= array('titulo'=> 'Descrição do Título');
						break;
					case 'usuario':
						$sobreEscreverLabels = array(
							'login'		=> 'Email',
							'endereco'	=> 'Endereço',
							'cpf'		=> 'CPF',
						);
						$sobreEscreverCampos = array(
							'login'		=> 'span'
						);
						$descricaoLabels = array('titulo'=> 'Descrição do Título');

						$remover[] = 'token';
						$remover[] = 'reset';
						$remover[] = 'email_confirmado';
						$remover[] = 'senha';

						break;
				}

				$x = criarFormularioAtualizacao($value, $sobreEscreverLabels, $sobreEscreverCampos, $remover, $esconder, $conversoes, $descricaoLabels, $padroes);
				if ( $x ) {
					echo "Gerado formulário de atualização: {$value}!";
					echo('<pre>');
					print_r( htmlspecialchars($x));
					echo('</pre>');
				} else {
					echo "Erro...";
				}
				echo "<hr>";
			}
			break;

		case 'generateSiteMap':
			echo('<pre>');
			print_r( generateSiteMap() );
			echo('</pre>');
			break;

		case 'registerProjectFiles':
			registerProjectFiles();
			break;

		case 'getDirectorySize':
			echo formatBytes( getDirectorySize(ROOT), 3 );
			break;

		case 'minify':
			$x = assetPipeline(true, true, false);
			if ( $x ) {
				echo "Gerados arquivos css e js minimizados!";
			} else {
				echo "Erro ao minimizar os arquivos css e js!";
			}
			break;

		case 'gerarHtaccess'	: die( gerarHtaccess() ); break;
		case 'gerarEnv'			: die( gerarEnv () ); break;

		case 'exportConstraints':
			$c =  exportarConstaints();
			echo('<pre>');
			print_r($c);
			echo('</pre>');
			break;

		// case 'gerarBuildProducao		: die(gerarHtaccess ('$SITE')); //break;
		// clonar projeto em modo produção[retirados arquivos de debug, autogerados, inicializado o DB {truncar todas tabelas, realizar inserts básicos}]

		// contabilizar caracteres e arquivos
		// criar grafico de tipos de arquivos
		// case 'gerar_spritemap'		: die(gerarSpritemap(IMAGENS."/icones"));
		// case 'gerar_modelos'			: die(assetPipeline()); //break;
		// case 'criarTabelaLog'		: die(criarTabelaLog()); //break;
		//case 'criarEstruturaDiretorio': die(criarTabelaLog()); //break;
		// case 'logoff'				: if (CONTROLE_ACESSO) registraLogOff(); die(generateSiteMap()); //break;

		# default: echo "Ação inválida!";
		default:
			echo '<ul>';
			echo '<li><a href="index.php?action=dbExport">dbExport</a></li>';
			echo '<li><a href="index.php?action=dbImport">dbImport</a></li>';
			echo '<li><a href="index.php?action=popularTabela">popularTabela</a></li>';
			echo '<li><a href="index.php?action=insercaoMatricial&tabela=categoria">insercaoMatricial</a></li>';
			echo '<li><a href="index.php?action=criacaoTabela&tabela=">criacaoTabela</a></li>';
			echo '<li><a href="index.php?action=gerar-formulario">gerar-formulario</a></li>';
			echo '<li><a href="index.php?action=gerar-formulario-atualizacao&tabela=usuario">gerar-formulario-atualizacao</a></li>';
			echo '<li><a href="index.php?action=generateSiteMap">generateSiteMap</a></li>';
			echo '<li><a href="index.php?action=registerProjectFiles">registerProjectFiles</a></li>';
			echo '<li><a href="index.php?action=getDirectorySize">getDirectorySize</a></li>';
			echo '<li><a href="index.php?action=minify">minify</a></li>';
			echo '<li><a href="index.php?action=exportConstraints">exportConstraints</a></li>';
			echo '<li><a href="index.php?action=gerarHtaccess">gerarHtaccess</a></li>';
			echo '<li><a href="index.php?action=gerarEnv">gerarEnv</a></li>';
			echo '<li><a href="index.php?action=criacaoFk">criacaoFk</a></li>';
			echo '</ul>';
	}

	exit;
}
