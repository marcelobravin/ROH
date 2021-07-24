# ROH - Relatório de Ocupação Hospitalar



# ###################################################reunião com meire ellen
ADICIONAR CAMPOS
CBO
    cargo
        enfermeiro, médico, etc

opção de salvar como rascunho
    confirmar registro definitivo

filtro em listas

ambiente homolog


verificar quem aprova justificativas

# ###################################################reunião com meire ellen


retornar em json as respostas
colocar em ajax os acessos as controles



vazamento de mensagem de erro da sessão


instalação -> /desenvolvimento


problema ao atualizar usuário para uma UQ já usada e inativada no BD

testar
	transacao ( $sqls=array() )

# verifica se usuario tem permissão de editar esse registro
# verifica se esse registro é editável



testar em cad&up os Duplicate entry
	configurações de erro de prod


# TODO
	validação sessão
	forçar alteração de senha

	salvar em pdf
	validar email na tela de esqueci a senha
	informar alterações não salvas em formulários ao recarregar ou fechar
	sincronização de dados offline
	tempo de sessão
	token de sessão
	Tempo expiração de token
	OK - envio de email
	exclusão if not cascade
	tempo de hash no caso de usuario incorreto
	Excluir usuário se e-mail não foi validado

	reset de senha
		corrigir regxep símbolos


# Migração
	Lista de ações:
		http://localhost/roh/index.php?action=


# Features
	senha inicial cpf
	senha criptografada
	auto atendimento para reset de senha
		atualizar cadastro de usuário no painel de administração não atualiza senha
		medidor de força de senha
	botão visualizar senha em login e alterar senha
	exclusão lógica (desativar usuário)
		excluir decide e realiza exclusão lógica ou permanente conforme existência de vínculos
	confirmação de email
		colocar em insert de usuário
	reenviar email de confirmação em atualizar usuário
	mensagem de confirmação de operações é auto excluída
	lista de usuários não permite excluir o próprio usuário logado
		adicionar ao desativar
	credenciais de DB em arquivo .env
	bloqueio temporario de usuário após 3 tentativas de login com senha incorreta
		log acesso
	log operações
	paginação real nas listas
	bloqueio de usuarios não logados em páginas internas
	não mudar email de usuário na tela de atualizar senha
	Módulo categoria, elemento
