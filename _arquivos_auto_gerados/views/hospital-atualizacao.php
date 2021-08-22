<!-- 22/08/2021 10:22:02 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="titulo" title="Descrição do Título">Título <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="titulo" id="titulo" value="<?php echo bloquearXSS($obj["titulo"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<input <?php echo checked($obj["ativo"]) ?> type="checkbox" name="ativo" id="ativo" value="1" />
</div>
<div>
	<label for="cnes">Cnes</label>
	<input maxlength="7" type="text" name="cnes" id="cnes" value="<?php echo bloquearXSS($obj["cnes"]) ?>" />
</div>
<div>
	<label for="cnpj">Cnpj</label>
	<input maxlength="14" type="text" name="cnpj" id="cnpj" value="<?php echo bloquearXSS($obj["cnpj"]) ?>" />
</div>
<div>
	<label for="diretor">Diretor</label>
	<input maxlength="255" type="text" name="diretor" id="diretor" value="<?php echo bloquearXSS($obj["diretor"]) ?>" />
</div>
<div>
	<label for="segundo_responsavel">Segundo_responsavel</label>
	<input maxlength="255" type="text" name="segundo_responsavel" id="segundo_responsavel" value="<?php echo bloquearXSS($obj["segundo_responsavel"]) ?>" />
</div>
<div>
	<label for="endereco">Endereco</label>
	<input maxlength="255" type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" />
</div>
<div>
	<label for="cep">Cep</label>
	<input maxlength="8" type="text" name="cep" id="cep" value="<?php echo bloquearXSS($obj["cep"]) ?>" />
</div>
<div>
	<label for="telefone">Telefone</label>
	<input maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" />
</div>
<div>
	<label for="email">Email</label>
	<input maxlength="255" type="text" name="email" id="email" value="<?php echo bloquearXSS($obj["email"]) ?>" />
</div>