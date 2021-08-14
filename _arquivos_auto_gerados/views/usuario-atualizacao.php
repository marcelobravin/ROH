<!-- 14-08-2021 10:52:53 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="login">Email <span class="simbolo-obrigatorio">*</span></label>
	<span  required="required"><?php echo bloquearXSS($obj["login"]) ?></span>
</div>
<div>
	<label for="ativo">Ativo</label>
	<input type="checkbox" name="ativo" id="ativo" value="1" <?php echo checked($obj["ativo"]) ?> />
</div>
<div>
	<label for="telefone">Telefone</label>
	<input type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" maxlength="10" />
</div>
<div>
	<label for="celular">Celular <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="celular" id="celular" value="<?php echo bloquearXSS($obj["celular"]) ?>" required="required" maxlength="11" class="obrigatorio" />
</div>
<div>
	<label for="nome">Nome</label>
	<input type="text" name="nome" id="nome" value="<?php echo bloquearXSS($obj["nome"]) ?>" maxlength="255" />
</div>
<div>
	<label for="cargo">CBO <span class="simbolo-obrigatorio">*</span></label>
	<label><input type="radio" name="cargo" id="cargo[0]" value="enfermeiro" <?php echo checked($obj["cargo"], "enfermeiro") ?> /> Enfermeiro</label>
<label><input type="radio" name="cargo" id="cargo[1]" value="medico" <?php echo checked($obj["cargo"], "medico") ?> /> Medico</label>
<label><input type="radio" name="cargo" id="cargo[2]" value="administrador" <?php echo checked($obj["cargo"], "administrador") ?> /> Administrador</label>
</div>
<div>
	<label for="endereco">Endereço</label>
	<input type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" maxlength="255" />
</div>
<div>
	<label for="cpf">CPF <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cpf" id="cpf" value="<?php echo bloquearXSS($obj["cpf"]) ?>" required="required" maxlength="14" class="obrigatorio" />
</div>