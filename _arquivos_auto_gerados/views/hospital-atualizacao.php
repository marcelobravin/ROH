<!-- 07-08-2021 16:57:43-->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="titulo" title="Descrição do Título">Título <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="titulo" id="titulo" value="<?php echo bloquearXSS($obj["titulo"]) ?>" class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="ativo" title="Descrição do Título">Ativo</label>
	<input type="checkbox" name="ativo" id="ativo" value="1" <?php echo checked($obj["ativo"]) ?> />
</div>