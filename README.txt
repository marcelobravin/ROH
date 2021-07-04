# ROH
Relatório de Ocupação Hospitalar


Prioridades
formularios de cadastro e atualização
definição de metas
	preenchimento mes a mes
	consulta meses anteriores

# Migração
Ponto de exportação de BD - http://localhost/roh/app/DbExport.php
Ponto de importação de BD - http://localhost/roh/app/DbImport.php
Ponto de geração de formularios - http://localhost/roh/app/FormGenerate.php


# Features
senha criptografada
atualizar cadastro de usuário no painel de administração não atualiza senha
auto atendimento para reset de senha
	medidor de força de senha
botão visualizar senha em login e alterar senha
exclusão lógica (desativar usuário)
confirmação de email
	colocar em insert de usuário
reenviar email de confirmação em atualizar usuário
mensagem de confirmação de operações é auto excluída
lista de usuários não permite excluir o próprio usuário logado
	adicionar ao desativar
credenciais de DB em arquivo .env
bloqueio temporario de usuário após 3 tentativas de login com senha incorreta
log operações
paginação nas listas
bloquear usuarios não logados



# TODO
Módulo de definição de metas (associação): escolhe hospital depois escolhe elementos a vincular, define metas
Módulo preencher metas: seleciona hospital e mês e preenche metas definidas para os elementos, preenche justificativas
validar email na tela de esqueci a senha
não mudar email de usuário na tela de atualizar senha
informar alterações não salvas em formulários ao recarregar ou fechar
sincronização de dados offline
tempo de sessão
token de sessão
Tempo expiração de token
OK - envio de email
salvar em pdf
exclusão if not cascade
tempo de hash no caso de usuario incorreto

Módulo categoria, elemento
Excluir usuário se e-mail não foi validado

reset de senha
	sem senha mímina
	corrigir regxep símbolos

testar envio de email
registrar exclusão lógica
