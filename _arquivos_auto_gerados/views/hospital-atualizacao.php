<!-- 16-07-2021 16:01:21-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="titulo">Titulo<span Class="simbolo-obrigatorio">*</span></label>
	<input type="text" name="titulo" id="titulo" value="<?php echo $obj["titulo"] ?>"class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" checked="checked" />Ativo</label>
</div>