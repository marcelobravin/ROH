<!-- 15-07-2021 14:17:37-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="login">Login</label>
	<input type="text" name="login" id="login" value="<?php echo $obj["login"] ?>"class="obrigatorio" required="required" maxlength="60" />
</div>
<div>
	<label for="senha">Senha</label>
	<input type="text" name="senha" id="senha" value="<?php echo $obj["senha"] ?>"class="obrigatorio" required="required" maxlength="60" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" class="obrigatorio" required="required" checked="checked" />Ativo</label>
</div>
<div>
	<label for="telefone">Telefone</label>
	<input type="text" name="telefone" id="telefone" value="<?php echo $obj["telefone"] ?>"class="obrigatorio" required="required" maxlength="15" />
</div>
<div>
	<label for="nome">Nome</label>
	<input type="text" name="nome" id="nome" value="<?php echo $obj["nome"] ?>"class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="endereco">Endereco</label>
	<input type="text" name="endereco" id="endereco" value="<?php echo $obj["endereco"] ?>"class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="cpf">Cpf</label>
	<input type="text" name="cpf" id="cpf" value="<?php echo $obj["cpf"] ?>"class="obrigatorio" required="required" maxlength="14" />
</div>
