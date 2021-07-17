<!-- 16-07-2021 21:56:27-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="login">Login<span Class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="login" id="login" value="<?php echo $obj["login"] ?>"class="obrigatorio" required="required" maxlength="60" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" checked="checked" />Ativo</label>
</div>
<div>
	<label for="telefone">Telefone</label>
	<input type="text" name="telefone" id="telefone" value="<?php echo $obj["telefone"] ?>"maxlength="15" />
</div>
<div>
	<label for="nome">Nome</label>
	<input type="text" name="nome" id="nome" value="<?php echo $obj["nome"] ?>"maxlength="255" />
</div>
<div>
	<label for="endereco">Endereco</label>
	<input type="text" name="endereco" id="endereco" value="<?php echo $obj["endereco"] ?>"maxlength="255" />
</div>
<div>
	<label for="cpf">Cpf<span Class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cpf" id="cpf" value="<?php echo $obj["cpf"] ?>"class="obrigatorio" required="required" maxlength="14" />
</div>