<!-- 15-07-2021 11:32:05-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="titulo">Título</label>
	<input type="text" name="titulo" id="titulo" value="<?php echo $obj["titulo"] ?>"class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="ativo">ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" class="obrigatorio" required="required" checked="checked" />Ativo</label>
</div>