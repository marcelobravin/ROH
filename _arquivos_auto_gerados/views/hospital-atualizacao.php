<!-- 09-07-2021 14:37:05-->
<input type="hidden" name="id" id="id" value="<?php echo $obj["id"] ?>" />
<div>
	<label for="titulo"title="Descrição do Título">Título</label>
	<input type="text" name="titulo" id="titulo" value="<?php echo $obj["titulo"] ?>"class="obrigatorio" required="required" maxlength="255" />
</div>
<div>
	<label for="ativo"title="Descrição do Título">ativo</label>
	<label><input type="checkbox" name="ativo" id="ativo" value="1" class="obrigatorio" required="required" checked="checked" checked="checked" />Ativo</label>
</div>