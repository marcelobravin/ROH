<!-- 05/09/2021 11:03:16 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="titulo" title="Nome do estabelecimento">Estabelecimento <span class="simbolo-obrigatorio">*</span></label>
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
	<label for="segundo_responsavel">Técnico Responsável <span class="simbolo-obrigatorio">*</span></label>
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
	<label for="numero">Número <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="numero" id="numero" value="<?php echo bloquearXSS($obj["numero"]) ?>" class="obrigatorio" />
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
	<select name="uf" id="uf" >
<option <?php echo selected($obj["uf"], "AC") ?> value="AC" >Acre</option>
<option <?php echo selected($obj["uf"], "AL") ?> value="AL" >Alagoas</option>
<option <?php echo selected($obj["uf"], "AP") ?> value="AP" >Amapá</option>
<option <?php echo selected($obj["uf"], "AM") ?> value="AM" >Amazonas</option>
<option <?php echo selected($obj["uf"], "BA") ?> value="BA" >Bahia</option>
<option <?php echo selected($obj["uf"], "CE") ?> value="CE" >Ceará</option>
<option <?php echo selected($obj["uf"], "ES") ?> value="ES" >Espírito Santo</option>
<option <?php echo selected($obj["uf"], "GO") ?> value="GO" >Goiás</option>
<option <?php echo selected($obj["uf"], "MA") ?> value="MA" >Maranhão</option>
<option <?php echo selected($obj["uf"], "MT") ?> value="MT" >Mato Grosso</option>
<option <?php echo selected($obj["uf"], "MS") ?> value="MS" >Mato Grosso do Sul</option>
<option <?php echo selected($obj["uf"], "MG") ?> value="MG" >Minas Gerais</option>
<option <?php echo selected($obj["uf"], "PA") ?> value="PA" >Pará</option>
<option <?php echo selected($obj["uf"], "PB") ?> value="PB" >Paraíba</option>
<option <?php echo selected($obj["uf"], "PR") ?> value="PR" >Paraná</option>
<option <?php echo selected($obj["uf"], "PE") ?> value="PE" >Pernambuco</option>
<option <?php echo selected($obj["uf"], "PI") ?> value="PI" >Piauí</option>
<option <?php echo selected($obj["uf"], "RJ") ?> value="RJ" >Rio de Janeiro</option>
<option <?php echo selected($obj["uf"], "RN") ?> value="RN" >Rio Grande do Norte</option>
<option <?php echo selected($obj["uf"], "RS") ?> value="RS" >Rio Grande do Sul</option>
<option <?php echo selected($obj["uf"], "RO") ?> value="RO" >Rondônia</option>
<option <?php echo selected($obj["uf"], "RR") ?> value="RR" >Roraima</option>
<option <?php echo selected($obj["uf"], "SC") ?> value="SC" >Santa Catarina</option>
<option <?php echo selected($obj["uf"], "SP") ?> value="SP" >São Paulo</option>
<option <?php echo selected($obj["uf"], "SE") ?> value="SE" >Sergipe</option>
<option <?php echo selected($obj["uf"], "TO") ?> value="TO" >Tocantins</option>
<option <?php echo selected($obj["uf"], "DF") ?> value="DF" >Distrito Federal</option>
</select>
</div>
<div>
	<label for="telefone">Telefone</label>
	<input maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" />
</div>
<div>
	<label for="email">Email</label>
	<input maxlength="255" type="text" name="email" id="email" value="<?php echo bloquearXSS($obj["email"]) ?>" />
</div>