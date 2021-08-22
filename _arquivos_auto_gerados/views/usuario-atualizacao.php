<!-- 22/08/2021 15:52:50 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="login">Email <span class="simbolo-obrigatorio">*</span></label>
	<span  required="required"><?php echo bloquearXSS($obj["login"]) ?></span>
</div>
<div>
	<label for="ativo">Ativo</label>
	<input <?php echo checked($obj["ativo"]) ?> type="checkbox" name="ativo" id="ativo" value="1" />
</div>
<div>
	<label for="telefone">Telefone</label>
	<input maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" />
</div>
<div>
	<label for="celular">Celular <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="celular" id="celular" value="<?php echo bloquearXSS($obj["celular"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="nome">Nome</label>
	<input maxlength="255" type="text" name="nome" id="nome" value="<?php echo bloquearXSS($obj["nome"]) ?>" />
</div>
<div>
	<label for="cargo">CBO <span class="simbolo-obrigatorio">*</span></label>
	<label><input type="radio" name="cargo" id="cargo[0]" value="enfermeiro" <?php echo checked($obj["cargo"], "enfermeiro") ?> /> Enfermeiro</label>
<label><input type="radio" name="cargo" id="cargo[1]" value="medico" <?php echo checked($obj["cargo"], "medico") ?> /> Medico</label>
<label><input type="radio" name="cargo" id="cargo[2]" value="administrador" <?php echo checked($obj["cargo"], "administrador") ?> /> Administrador</label>
</div>
<div>
	<label for="endereco">Endereço</label>
	<input maxlength="255" type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" />
</div>
<div>
	<label for="cpf">CPF <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="14" type="text" name="cpf" id="cpf" value="<?php echo bloquearXSS($obj["cpf"]) ?>" class="obrigatorio" />
</div>