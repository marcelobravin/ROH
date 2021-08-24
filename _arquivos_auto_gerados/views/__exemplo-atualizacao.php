<!-- 24/08/2021 15:44:59 -->
<input type="hidden" name="id" id="id" value="<?php echo bloquearXSS($obj["id"]) ?>" />
<div>
	<label for="acao">Acao <span class="simbolo-obrigatorio">*</span></label>
	<label><input type="radio" name="acao" id="acao[0]" value="I" <?php echo checked($obj["acao"], "I") ?> /> I</label>
<label><input type="radio" name="acao" id="acao[1]" value="U" <?php echo checked($obj["acao"], "U") ?> /> U</label>
<label><input type="radio" name="acao" id="acao[2]" value="D" <?php echo checked($obj["acao"], "D") ?> /> D</label>
<label><input type="radio" name="acao" id="acao[3]" value="X" <?php echo checked($obj["acao"], "X") ?> /> X</label>
</div>
<div>
	<label for="ano">Ano <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="4" type="text" name="ano" id="ano" value="<?php echo bloquearXSS($obj["ano"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="ativo">Ativo</label>
	<input <?php echo checked($obj["ativo"]) ?> type="checkbox" name="ativo" id="ativo" value="1" />
</div>
<div>
	<label for="bairro">Bairro <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="bairro" id="bairro" value="<?php echo bloquearXSS($obj["bairro"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cargo">Cargo <span class="simbolo-obrigatorio">*</span></label>
	<label><input type="radio" name="cargo" id="cargo[0]" value="enfermeiro" <?php echo checked($obj["cargo"], "enfermeiro") ?> /> Enfermeiro</label>
<label><input type="radio" name="cargo" id="cargo[1]" value="medico" <?php echo checked($obj["cargo"], "medico") ?> /> Medico</label>
<label><input type="radio" name="cargo" id="cargo[2]" value="administrador" <?php echo checked($obj["cargo"], "administrador") ?> /> Administrador</label>
</div>
<div>
	<label for="celular">Celular <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="celular" id="celular" value="<?php echo bloquearXSS($obj["celular"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cep">Cep <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="8" type="text" name="cep" id="cep" value="<?php echo bloquearXSS($obj["cep"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cidade">Cidade <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="cidade" id="cidade" value="<?php echo bloquearXSS($obj["cidade"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cnes">Cnes <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="7" type="text" name="cnes" id="cnes" value="<?php echo bloquearXSS($obj["cnes"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="cnpj">Cnpj</label>
	<input maxlength="14" type="text" name="cnpj" id="cnpj" value="<?php echo bloquearXSS($obj["cnpj"]) ?>" />
</div>
<div>
	<label for="cpf">Cpf <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="14" type="text" name="cpf" id="cpf" value="<?php echo bloquearXSS($obj["cpf"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="data">Data <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="10" type="date" name="data" id="data" value="<?php echo bloquearXSS($obj["data"]) ?>" class="obrigatorio padraoData" />
</div>
<div>
	<label for="datahora">Datahora <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="19" type="datetime" name="datahora" id="datahora" value="<?php echo bloquearXSS($obj["datahora"]) ?>" class="obrigatorio padraoTimestamp" />
</div>
<div>
	<label for="dinheiro">Dinheiro <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="dinheiro" id="dinheiro" value="<?php echo bloquearXSS($obj["dinheiro"]) ?>" class="obrigatorio padraoFloat" />
</div>
<div>
	<label for="email_confirmado">Email_confirmado <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" <?php echo checked($obj["email_confirmado"]) ?> type="checkbox" name="email_confirmado" id="email_confirmado" value="1" class="obrigatorio" />
</div>
<div>
	<label for="endereco">Endereco <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="endereco" id="endereco" value="<?php echo bloquearXSS($obj["endereco"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="ip">Ip <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="15" type="text" name="ip" id="ip" value="<?php echo bloquearXSS($obj["ip"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="justificativa_aceita">Justificativa_aceita <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" <?php echo checked($obj["justificativa_aceita"]) ?> type="checkbox" name="justificativa_aceita" id="justificativa_aceita" value="1" class="obrigatorio" />
</div>
<div>
	<label for="justificativa">Justificativa</label>
	<textarea name='justificativa' id='justificativa'  /><?php echo bloquearXSS($obj["justificativa"]) ?></textarea>
</div>
<div>
	<label for="login">Login <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="60" type="text" name="login" id="login" value="<?php echo bloquearXSS($obj["login"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="mes">Mes <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="2" type="text" name="mes" id="mes" value="<?php echo bloquearXSS($obj["mes"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="navegador">Navegador <span class="simbolo-obrigatorio">*</span></label>
	<textarea name='navegador' id='navegador'  required="required" class="obrigatorio" /><?php echo bloquearXSS($obj["navegador"]) ?></textarea>
</div>
<div>
	<label for="objetoId">ObjetoId <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="objetoId" id="objetoId" value="<?php echo bloquearXSS($obj["objetoId"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="quantidade">Quantidade <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="3" type="text" name="quantidade" id="quantidade" value="<?php echo bloquearXSS($obj["quantidade"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="reset">Reset</label>
	<input maxlength="50" type="text" name="reset" id="reset" value="<?php echo bloquearXSS($obj["reset"]) ?>" />
</div>
<div>
	<label for="resultado">Resultado <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="3" type="text" name="resultado" id="resultado" value="<?php echo bloquearXSS($obj["resultado"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="senha">Senha <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="60" type="text" name="senha" id="senha" value="<?php echo bloquearXSS($obj["senha"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="sucesso">Sucesso <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" <?php echo checked($obj["sucesso"]) ?> type="checkbox" name="sucesso" id="sucesso" value="1" class="obrigatorio" />
</div>
<div>
	<label for="tabela">Tabela <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="50" type="text" name="tabela" id="tabela" value="<?php echo bloquearXSS($obj["tabela"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="telefone">Telefone</label>
	<input maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo bloquearXSS($obj["telefone"]) ?>" />
</div>
<div>
	<label for="tempo">Tempo <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" type="time" name="tempo" id="tempo" value="<?php echo bloquearXSS($obj["tempo"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="titulo">Titulo <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="255" type="text" name="titulo" id="titulo" value="<?php echo bloquearXSS($obj["titulo"]) ?>" class="obrigatorio" />
</div>
<div>
	<label for="uf">Uf</label>
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
	<label for="criado_por">Criado_por <span class="simbolo-obrigatorio">*</span></label>
	<input required="required" maxlength="11" type="text" name="criado_por" id="criado_por" value="<?php echo bloquearXSS($obj["criado_por"]) ?>" class="obrigatorio" />
</div>