# ROH
Relatório de Ocupação Hospitalar

# Migração
http://localhost/DIRETORIO/ROH/app/DbExport.php
http://localhost/DIRETORIO/ROH/app/DbImport.php


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
ponto de exportação/importação de BD


# TODO
php 8
não mudar email de usuário na tela de atualizar senha
informar alterações não salvas em formulários ao recarregar ou fechar
sincronização de dados
tempo de sessão
token de sessão
Tempo expiração de token
paginação nas listas
OK - envio de email
salvar em pdf
exclusão if not cascade
criar
	modulo categoria
	módulo elementos
	modulo metas
	front
Módulo hospital, categoria, elemento
Módulo de associação: escolhe hospital depois escolhe elementos a vincular, define metas
Módulo preencher: seleciona hospital e mês e preenche metas definidas para os elementos, preenche justificativas
Excluir usuário se e-mail não foi validado
corrigir reset de senha
	sem senha mínima
	corrigir regxep símbolos
		match(/[!@#$%&*-_]/)
criar função colocar em produção
apaga diretorios de saída
trunca banco
faz inserts básicos
apaga DbExport
[var get debug] || .env debug
	problema em produção
acessar lista de logs
