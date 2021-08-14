<!-- 14-08-2021 16:11:00 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="titulo" title="Descrição do Título">Título <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="titulo" id="titulo" value="<?php echo bloquearXSS($obj["titulo"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<input checked="checked" type="checkbox" name="ativo" id="ativo" value="1" />
</div>
<div>
	<label for="cnes">Cnes <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="7" type="text" name="cnes" id="cnes" value="<?php echo bloquearXSS($obj["cnes"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cnpj">Cnpj <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="14" type="text" name="cnpj" id="cnpj" value="<?php echo bloquearXSS($obj["cnpj"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="diretor">Diretor <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="diretor" id="diretor" value="<?php echo bloquearXSS($obj["diretor"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="segundo_responsavel">Segundo_responsavel <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="segundo_responsavel" id="segundo_responsavel" value="<?php echo bloquearXSS($obj["segundo_responsavel"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="endereco">Endereco <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cep">Cep <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="8" type="text" name="cep" id="cep" value="<?php echo bloquearXSS($obj["cep"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="telefone">Telefone <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="email">Email <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="email" id="email" value="<?php echo bloquearXSS($obj["email"]) ?>" class="obrigatorio" />
</div>