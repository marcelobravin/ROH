anotações giovani
	edição ultimo relatório
	distinção de usuário
	log alterações
	OK - comprovante de visita mostrar
		Responsável técnico médico
		De enfermagem
		Ti




redimensionar imagens
retirar select * das listas
	[id] => 32
    [login] => mesnovaes@prefeitura.sp.gov.br
    [senha] => $2y$12$V6IPH1Q/Nrv./iBP6lf2pu9b91c67uAEsw0P0m/QuCoSygyHKKOrq
    [email_confirmado] => 0
    [token] =>
    [ativo] => 0
    [reset] =>
    [telefone] =>
    [celular] => 0
    [nome] => Meire Ellen
    [cargo] =>
    [endereco] =>
    [cpf] => 338.059.850-02
    [criado_em] => 2021-08-09 14:08:05
    [atualizado_em] =>
    [excluido_em] =>
    [criado_por] => 1
    [atualizado_por] =>
    [excluido_por] =>



verificar ano selecionado em todas queries




<!-- tem que baixar as webfonts -->

# interessados
	mesnovaes@prefeitura.sp.gov.br
	giovanifranco@prefeitura.sp.gov.br


Ajax verifica sessão ativa

colocar códigos corretamente
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created


Percentagem
Checar erro caracteres no xls
	Remover ids
receber Logos
alterar Cores nas listas
cor do usuário logado



BUGs conhecidos ################################################################
email pode ter numeros

vazamento de mensagem de erro da sessão

duas pessoas logadas com o mesmo usuário

delete ou alterar parametros de busca
	sem voltar uma página
navegar por
	página maior que o limite

!!!
	const pattern = /^Você será redirecionado/i; // TODO verificar

testar novamente ajax com tempo expirado

colocar confirmação de email de volta no form de usuário

queda de sessão em telas de controles
	definir metas
	gerar relatórios



# ############################################################################## reunião com meire ellen

meire ellen vai confirmar necessidade de upload de arquivos

verificar quem aprova justificativas

ambiente homolog
	meire ellen testar (disponibilizar ip da minha máquina resolve)

OK - filtro em listas

OK - opção de salvar como rascunho
	OK - confirmar registro definitivo

OK ADICIONAR CAMPO
	CBO	(cargo)
		enfermeiro, médico, etc

# ############################################################################## reunião com meire ellen


# TODO
	sincronização de dados offline
	Salvar resultado como rascunho & sincronizar
	verificar SILENT
	verificar sessão antes de executar operações
	colocar em ajax os acessos as controles
		retornar em json as respostas
			jsonEncode($resultado, JSON_UNESCAPED_UNICODE)
	problema ao atualizar usuário para uma UQ já usada e inativada no BD
		vai ser resolvido com ajax
	testar em cad&up os Duplicate entry
		configurações de erro de prod
	forçar alteração de senha
		if senha == cpf força
	salvar em pdf
	validar email js na tela de esqueci a senha
		não precisa [colocar mensagem "se endereço existe email foi enviado"]
	informar alterações não salvas em formulários ao recarregar ou fechar
	Token de sessão com expiração
	Excluir automaticamente usuário se e-mail não foi validado
	reset de senha corrigir regxep símbolos [já está?]
	Criar manual de software
	Diagrama das controles
	Responsividade
	Máscara nos formulários
	Permissão de acesso para atualizar
		Separar papéis
		administração(ver logs, cadastrar usuários e hospitais)
		auditor (cadastrar metas e resultados)
		fiscal(aprovar justificativas, emitir relatórios)
	Retirar admin e colocar start de pk mais alto
	Alerta de confirmação\erro operações
	Bloqueio temporário de usuário ou IP ao realizar x erros de login
	Campos índice
	Banco comentado
	Diferenciação de names em inputs HTML e colunas do banco
	Xss
	Transação em operações com log para garantir atomicidade de dados
	Backup de bd
	certificado Https no ambiente de produção
	Sanitização de inputs (tem que colocar em tudo que pega de get ou post)
	Log de operações adicionar SO


# Features (descrever para usuários leigos, mesmo as não solicitadas)
	Exclusão lógica ou permanente conforme possibilidade
	filtro em listas
	Minimização de recursos de front end
	Listagem de registros parametrizável e paginada
	Validação de formulários
	Exportar relatórios
		em excell
	Sanitização de entradas de dados
	Log de acesso
	Log de operações com ip, navegador
	Tempo de hash no caso de usuario incorreto
	Reset de senha self service via e-mail
	Fks para garantir integridade de dados
	Campos com chave uq para evitar duplicidades
	Queda de sessãopor tempo de inatividade
	Senha inicial é o cpf do usuário (com pontos?)
	Senha armazenada com criptografia one way
	Reset de senha via auto atendimento
		atualizar cadastro de usuário no painel de administração não atualiza senha
		medidor de força de senha
	Botão visualizar senha em login e alterar senha
	Exclusão lógica (desativar usuário)
		excluir decide e realiza exclusão lógica ou permanente conforme existência de vínculos
	Confirmação de email
		colocar em insert de usuário
	Reenviar email de confirmação em atualizar usuário
	Mensagem de confirmação de operações é auto excluída
	Lista de usuários não permite excluir o próprio usuário logado
	Credenciais de DB em arquivo .env
	Bloqueio temporario de usuário após 3 tentativas de login com senha incorreta
		log acesso
	Log operações para garantir rastreabilidade
		identificar quais eventos ocorreram no ambiente e, dessa forma, entender as causas de eventuais erros ou falhas
	Paginação real nas listas
	Bloqueio de usuarios não logados em páginas internas
	Não mudar email de usuário na tela de atualizar senha
	Módulo categoria, elemento







	SELECT relatorio.*,
	hospital.titulo FROM

	((SELECT
				c.id					id_categoria,
				c.titulo				categoria_nome,
				c.legenda				categoria_legenda,
				c.ativo					categoria_ativo,

				e.id_categoria			id_elemento_categoria,
				e.titulo				elemento_nome,
				e.id					id_elemento,

				m.id_elemento			id_meta_elemento,
				m.quantidade			meta_quantidade,
				m.ativo					meta_ativo,
				m.id_hospital			id_meta_hospital,
				m.id					id_meta,

				r.id_meta				id_resultado_meta,
				r.resultado				resultado,
				r.mes					mes,
				r.justificativa			justificativa,
				r.justificativa_aceita	justificativa_aceita,
				r.id					id_resultado,
				r.criado_em				resultado_criacao

				-- ,h.titulo
				-- ,h.id   id_hospital

			FROM
				categoria	c,
				elemento	e
				-- ,hospital	h

				LEFT OUTER JOIN (meta m)
					ON m.id_elemento	= e.id
					AND m.id_hospital	= 43
					-- AND m.id_hospital	= h.id
				LEFT OUTER JOIN (resultado r)
					ON r.id_meta		= m.id
					AND r.mes			= 8
					AND r.ano			= 2021

			WHERE
				e.id_categoria	= c.id
				AND m.ativo		= 1
				-- AND h.id		= {$_GET['hospital']}

			ORDER BY
				c.titulo,
				e.titulo) as relatorio)


	            INNER JOIN hospital ON hospital.id = relatorio.id_meta_hospital




	            /**
	             * Cria link para ligação de skype
	             * @package	grimoire/bibliotecas/snippets.php
	             * @since	05-07-2015
	             *
	             * @return	string
	             */
	            function skype ()
	            {
	            	return "
	            		<a href='callto://+***********'>Link will initiate Skype to call my number!</a>
	            		Skype Username:
	            		<a href='skype:********?call'>Link will initiate Skype to call my Skype username!</a>
	            	";
	            }
