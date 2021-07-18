<!-- 18-07-2021 15:42:55-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="titulo" title="Descrição do Título">Título <span class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="titulo" id="titulo" value="<?php echo $obj["titulo"] ?>" class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="ativo" title="Descrição do Título">Ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" <?php echo checked($obj["ativo"]) ?> />Ativo</label>
</div>