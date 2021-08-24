<!-- 23/08/2021 16:27:00 -->
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
	<label for="cnes">CNES <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="7" type="text" name="cnes" id="cnes" value="<?php echo bloquearXSS($obj["cnes"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cnpj">CNPJ</label>
	<input maxlength="14" type="text" name="cnpj" id="cnpj" value="<?php echo bloquearXSS($obj["cnpj"]) ?>" />
</div>
<div>
	<label for="diretor">Diretor <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="diretor" id="diretor" value="<?php echo bloquearXSS($obj["diretor"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="segundo_responsavel">Segundo Responsável <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="segundo_responsavel" id="segundo_responsavel" value="<?php echo bloquearXSS($obj["segundo_responsavel"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cep">CEP <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="8" type="text" name="cep" id="cep" value="<?php echo bloquearXSS($obj["cep"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="endereco">Endereco</label>
	<input maxlength="255" type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" />
</div>
<div>
	<label for="bairro">Bairro</label>
	<input maxlength="255" type="text" name="bairro" id="bairro" value="<?php echo bloquearXSS($obj["bairro"]) ?>" />
</div>
<div>
	<label for="cidade">Cidade</label>
	<input maxlength="255" type="text" name="cidade" id="cidade" value="<?php echo bloquearXSS($obj["cidade"]) ?>" />
</div>
<div>
	<label for="uf">UF</label>
	<select name="uf" id="uf" ><option value="AC" >Acre</option><option value="AL" >Alagoas</option><option value="AP" >Amapá</option><option value="AM" >Amazonas</option><option value="BA" >Bahia</option><option value="CE" >Ceará</option><option value="ES" >Espírito Santo</option><option value="GO" >Goiás</option><option value="MA" >Maranhão</option><option value="MT" >Mato Grosso</option><option value="MS" >Mato Grosso do Sul</option><option value="MG" >Minas Gerais</option><option value="PA" >Pará</option><option value="PB" >Paraíba</option><option value="PR" >Paraná</option><option value="PE" >Pernambuco</option><option value="PI" >Piauí</option><option value="RJ" >Rio de Janeiro</option><option value="RN" >Rio Grande do Norte</option><option value="RS" >Rio Grande do Sul</option><option value="RO" >Rondônia</option><option value="RR" >Roraima</option><option value="SC" >Santa Catarina</option><option value="SP" >São Paulo</option><option value="SE" >Sergipe</option><option value="TO" >Tocantins</option><option value="DF" >Distrito Federal</option></select>
</div>
<div>
	<label for="telefone">Telefone</label>
	<input maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" />
</div>
<div>
	<label for="email">Email</label>
	<input maxlength="255" type="text" name="email" id="email" value="<?php echo bloquearXSS($obj["email"]) ?>" />
</div>
<div>
	<label for="dinheiro">Dinheiro <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="13" type="text" name="dinheiro" id="dinheiro" value="<?php echo bloquearXSS($obj["dinheiro"]) ?>" class="obrigatorio padraoFloat" />
</div>