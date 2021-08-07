<!-- 07-08-2021 16:50:00-->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS(["id"]) ?>" />
<div>
	<label for="login">Email <span class="simbolo-obrigatorio">*</span></label>
	<span  required="required"><?php echo bloquearXSS(["login"]) ?></span>
</div>
<div>
	<label for="ativo">Ativo</label>
	<input type="checkbox" name="ativo" id="ativo" value="1" <?php echo checked($obj["ativo"]) ?> />
</div>
<div>
	<label for="telefone">Telefone</label>
	<input type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS(["telefone"]) ?>" maxlength="15" />
</div>
<div>
	<label for="nome">Nome</label>
	<input type="text" name="nome" id="nome" value="<?php echo bloquearXSS(["nome"]) ?>" maxlength="255" />
</div>
<div>
	<label for="endereco">Endereço</label>
	<input type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS(["endereco"]) ?>" maxlength="255" />
</div>
<div>
	<label for="cpf">CPF <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cpf" id="cpf" value="<?php echo bloquearXSS(["cpf"]) ?>" class="obrigatorio" required="required" maxlength="14" />
</div>