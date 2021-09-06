melhor exibir na lista as ultimas alterações justificativas e responsavel
visitas
	incluir nova
	alterar ultima
		anteriores ficam imutaveis


upload - depende de infra

remover campos de id do excell

tela de log de alterações
	exibir ultima pessoa que alterou o registro de resultados

relatorio conter alterações de cada visita

	Módulo Preencher	Formulário	O sistema não permite preencher novo formulário para o caso de novas visitas.	Implementar botão nova visita.
	Ao ser acionado o sistema deve exibir um formulário em branco.
	Módulo Preencher	Formulário	O sistema só permite a alteração dentro do mês vigente;	O sistema deve permitir a alteração do formulário referente a última visita realizada.

	Estabelecer regra: Permitir a alteração do último formulário preenchido no período de até 30 dias. Após este período, o sistema não deve permitir a alteração.
	Módulo Preencher	Gerar comprovante	Faltam os logos oficiais	Exibir os logos oficiais da SMS/DTIC, Cidade de São Paulo e SUS

	Módulo usuários	Validação do usuário	Não foi possível testar. O sistema não está realizando o envio do link para o e-mail cadastrado	Habilitar esta funcionalidade para testes prévios
	Módulo usuários	Reenviar confirmação de e-mail	Ao acionar a funcionalidade o sistema exibe tela de erro para este ambiente	Habilitar esta funcionalidade para testes prévios


--------------------------------------------------------------------------------


# todo separar conteudo email
	colocar em diretorios e pegar conteudo

email remetente constar endereço do servidor
nome remetente

redimensionar imagens
retirar select * das listas

verificar ano selecionado em todas queries

tem que baixar as webfonts

# interessados
	mesnovaes@prefeitura.sp.gov.br
	giovanifranco@prefeitura.sp.gov.br

	Meire Ellen -
		CPF: 166.304.770-73
		E-mail: meiresama@gmail.com
		WA 97434-8255



ctrl +f e colocar códigos corretamente
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created

Remover ids no xls



BUGs conhecidos ################################################################
duas pessoas logadas com o mesmo usuário

delete ou alterar parametros de busca
	sem voltar uma página
navegar por
	página maior que o limite

testar novamente ajax com tempo expirado e alteração de fingerprint
queda de sessão em telas de controles
	definir metas
	gerar relatórios



# TODO
	sincronização de dados offline
	Salvar resultado como rascunho & sincronizar
	verificar SILENT
	colocar em ajax os acessos as controles
		retornar em json as respostas
			jsonEncode($resultado, JSON_UNESCAPED_UNICODE)
	problema ao atualizar usuário para uma UQ já usada e inativada no BD
		vai ser resolvido com ajax
	testar em cad&up os Duplicate entry
		configurações de erro de prod
	forçar alteração de senha
		if senha == cpf força
	validar email js na tela de esqueci a senha
		não precisa [colocar mensagem "se endereço existe email foi enviado"]
	informar alterações não salvas em formulários ao recarregar ou fechar
	Excluir automaticamente usuário se e-mail não foi validado
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
