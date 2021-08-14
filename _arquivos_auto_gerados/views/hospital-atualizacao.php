<!-- 14-08-2021 10:52:53 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="titulo" title="Descrição do Título">Título <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="titulo" id="titulo" value="<?php echo bloquearXSS($obj["titulo"]) ?>" required="required" maxlength="255" class="obrigatorio" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<input type="checkbox" name="ativo" id="ativo" value="1" <?php echo checked($obj["ativo"]) ?> />
</div>
<div>
	<label for="cnes">Cnes <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cnes" id="cnes" value="<?php echo bloquearXSS($obj["cnes"]) ?>" required="required" maxlength="7" class="obrigatorio" />
</div>
<div>
	<label for="cnpj">Cnpj <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cnpj" id="cnpj" value="<?php echo bloquearXSS($obj["cnpj"]) ?>" required="required" maxlength="14" class="obrigatorio" />
</div>
<div>
	<label for="diretor">Diretor <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="diretor" id="diretor" value="<?php echo bloquearXSS($obj["diretor"]) ?>" required="required" maxlength="255" class="obrigatorio" />
</div>
<div>
	<label for="segundo_responsavel">Segundo_responsavel <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="segundo_responsavel" id="segundo_responsavel" value="<?php echo bloquearXSS($obj["segundo_responsavel"]) ?>" required="required" maxlength="255" class="obrigatorio" />
</div>
<div>
	<label for="endereco">Endereco <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" required="required" maxlength="255" class="obrigatorio" />
</div>
<div>
	<label for="cep">Cep <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="cep" id="cep" value="<?php echo bloquearXSS($obj["cep"]) ?>" required="required" maxlength="8" class="obrigatorio" />
</div>
<div>
	<label for="telefone">Telefone <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" required="required" maxlength="15" class="obrigatorio" />
</div>
<div>
	<label for="email">Email <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="email" id="email" value="<?php echo bloquearXSS($obj["email"]) ?>" required="required" maxlength="255" class="obrigatorio" />
</div>