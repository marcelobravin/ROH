<!DOCTYPE html>
<!-- Dá pra descartar esse arquivo e usar o user-form -->
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="">
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
		<!-- <script src='js/lib/jquery-3.3.1.js?j=$r'></script> -->
		<script>
			$(document).ready(function(){
				$("#categoria").change(function(){
					// console.log( $(this).val() )
					$( "table" ).addClass('invisivel');
					$( "#"+ $(this).val() ).removeClass('invisivel');
				})
			})
		</script>

		<style>
			.invisivel { display:none }
			table { border: 1px solid red }
			tfoot { background: #aee }

			tr:nth-child(even) { background-color: #ddd }
			/* td:nth-child(1) { text-align: right; padding-right: 5px } */

			table {
				border: 1px outset silver;
				margin-top: 10px;
				width: 100%
			}

			th {
				background: mediumturquoise;
			}

			textarea {
				width: 200px;
				height: 30px;
			}
		</style>
	</head>
<body>

<label>
	Hospital
	<br>
	<select name="hospital" id="hospital">
		<option value="slg">São Luiz Gonzaga</option>
	</select>
</label>

<br>

<label>
	Categoria
	<br>
	<select name="categoria" id="categoria">
		<option value="equipe">Equipe</option>
		<option value="internacao">Internação</option>
		<option value="ambulatorio">Ambulatório</option>
		<option value="consultas_ambulatoriais">Consultas ambulatoriais</option>
		<option value="procedimentos_e_cirurgias">Procedimentos e cirurgias ambulatoriais</option>
		<option value="sadt">SADT</option>
		<option value="atenção_domiciliar">Atenção domiciliar</option>
	</select>
</label>

<table id="equipe">
	<thead>
		<caption>Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo</caption>
	</thead>
	<tr>
		<th>Especialidade dos Leitos</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Leitos</th>
		<th>Volume de saída/mês</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Clínica médica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="text" id="text" value="102" /></td>
		<td><input type="text" name="text" id="text" value="520" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Clínica Cirúrgica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="text" id="text" value="20" /></td>
		<td><input type="text" name="text" id="text" value="190" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Pedatria</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="text" id="text" value="35" /></td>
		<td><input type="text" name="text" id="text" value="240" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Ginecologia e Obstetrícia</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="text" id="text" value="8" /></td>
		<td><input type="text" name="text" id="text" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td colspan="6">
				Critério de cálculo: número absoluto
				<br>
				Evidência Quadro de indice diário da Comurge
			</td>
		</tr>
	</tfoot>
</table>

<table id="internacao" class="invisivel">
	<thead>
		<caption>Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo</caption>
	</thead>

	<tr>
		<th>Especialidade dos Leitos</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Leitos</th>
		<th>Volume de saída/mês</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Clínica médica e cirúrgica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="102" /></td>
		<td><input type="text" name="name" id="name" value="520" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Pedatria</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="20" /></td>
		<td><input type="text" name="name" id="name" value="190" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Obstetrícia</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="35" /></td>
		<td><input type="text" name="name" id="name" value="240" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Cuidados intermediários</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="8" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>UTI Neonatal</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="6" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td colspan="6">
				Critério de cálculo: número absoluto
				<br>
				Evidência Quadro de indice diário da Comurge
			</td>
		</tr>
	</tfoot>
</table>

<table id="ambulatorio" class="invisivel">
	<thead>
		<caption>A conveniada deverá realizar no mínimo 2850 saídas hospitalares trimestrais, conforme distribuição de acordo com o número de leitos existentes</caption>
	</thead>
	<tr>
		<th>Especialidade Médicas</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Total estimado de consultas por mês</th>
		<th>Volume de primeira consulta externa por mês</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Clínica médica e cirúrgica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="102" /></td>
		<td><input type="text" name="name" id="name" value="520" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Pedatria</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="20" /></td>
		<td><input type="text" name="name" id="name" value="190" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Obstetrícia</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="35" /></td>
		<td><input type="text" name="name" id="name" value="240" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Cuidados intermediários</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="8" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>UTI Neonatal</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="6" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
</table>

<table id="consultas_ambulatoriais" class="invisivel">
	<thead>
		<caption>A conveniada deverá realizar no mínimo 2850 saídas hospitalares trimestrais, conforme distribuição de acordo com o número de leitos existentes</caption>
	</thead>
	<tr>
		<th>Especialidade Médicas</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Total estimado de consultas por mês</th>
		<th>Volume de primeira consulta externa por mês</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Clínica médica e cirúrgica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="102" /></td>
		<td><input type="text" name="name" id="name" value="520" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Pedatria</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="20" /></td>
		<td><input type="text" name="name" id="name" value="190" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Obstetrícia</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="35" /></td>
		<td><input type="text" name="name" id="name" value="240" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Cuidados intermediários</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="8" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>UTI Neonatal</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="6" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td>Total</td>
			<td>760</td>
		</tr>
		<tr>
			<td colspan="6">
				* está previsto número de vagas para realização de colposcopia de pedido externo
				Evidência das Consultas    SAI SUS e as primeiras consultas no SIGA
			</td>
		</tr>
	</tfoot>
</table>

<table id="procedimentos_e_cirurgias" class="invisivel">
	<thead>
		<caption>A conveniada deverá realizar no mínimo 2850 saídas hospitalares trimestrais, conforme distribuição de acordo com o número de leitos existentes</caption>
	</thead>
	<tr>
		<th>Especialidade Médicas</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Total estimado de consultas por mês</th>
		<th>Volume de primeira consulta externa por mês</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Clínica médica e cirúrgica</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="102" /></td>
		<td><input type="text" name="name" id="name" value="520" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Pedatria</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="20" /></td>
		<td><input type="text" name="name" id="name" value="190" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Obstetrícia</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="35" /></td>
		<td><input type="text" name="name" id="name" value="240" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Cuidados intermediários</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="8" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>UTI Neonatal</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
		<td><input type="text" name="name" id="name" value="6" /></td>
		<td><input type="text" name="name" id="name" value="0" /></td>
		<td><textarea name="textarea" id="textarea"></textarea></td>
		<td><input type="checkbox" name="checkbox" id="checkbox" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td>Total</td>
			<td>760</td>
		</tr>
		<tr>
			<td colspan="6">
				Evidência dos procedimentos e cirurgias    SAI SUS, BPA SIH e SIGA
			</td>
		</tr>
	</tfoot>
</table>

<table id="sadt" class="invisivel">
	<thead>
		<caption></caption>
	</thead>
	<tr>
		<th>Exames</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th title="Meta de atendimento para o mês corrente">Total mês de SADT Externo</th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Ultrassonografia geral</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="400" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Tomografia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="100" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Ecocardiograma</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="60" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Colonoscopia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="20" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Endoscopia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="130" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Radiologia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="snippet" id="snippet" value="50" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td>Total</td>
			<td>&nbsp;</td>
			<td>760</td>
		</tr>
		<tr>
			<td colspan="6">
				Evidência do SADT, SAI, SUS e SIGA
			</td>
		</tr>
	</tfoot>
</table>

<table id="atenção_domiciliar" class="invisivel">
	<thead>
		<caption>..</caption>
	</thead>
	<tr>
		<th>Exames</th>
		<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
		<th>Total mês de SADT Externo </th>
		<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
		<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
	</tr>

	<tr>
		<td>Ultrassonografia geral</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="400" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Tomografia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="100" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Ecocardiograma</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="60" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Colonoscopia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="20" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Endoscopia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="130" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>
	<tr>
		<td>Radiologia</td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
		<td><input type="text" name="name" id="name" value="50" /></td>
		<td><textarea name="justificativa" id="" cols="30" rows="10"></textarea></td>
		<td><input type="checkbox" name="snippet" id="snippet" value="1" /></td>
	</tr>

	<tfoot>
		<tr>
			<td>Total</td>
			<td>760</td>
		</tr>
		<tr>
			<td colspan="6">
				Evidência do SADT, SAI, SUS e SIGA
			</td>
		</tr>
	</tfoot>
</table>
