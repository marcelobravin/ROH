<?php
include '../../app/Grimoire/core_inc.php';

# ------------------------------------------------------------------------------ insercao de novas especialidades
foreach ($_POST['leitos'] as $key => $value) {
	$values = array(
		'hospital_id'	=> $_POST['hospital'],
		'elemento_id'	=> $key,
		'quantidade'	=> $value,
		'ativo'			=> isset($_POST['checkbox-'. $key]) ? 1 : 0,
		'criado_por'	=> $_SESSION['user']['id'],
	);

	$id = inserir('meta', $values);

	if ( is_numeric($id) )
		unset($_POST['leitos'][$key]);
}

# ------------------------------------------------------------------------------ atualização de especialidades
foreach ($_POST['leitos'] as $key => $value) {
	$values = array(
		'quantidade'	=> $value,
		'ativo'			=> isset($_POST['checkbox-'. $key]) ? 1 : 0,
		'atualizado_por'=> $_SESSION['user']['id']
	);

	$where = array(
		'hospital_id'	=> $_POST['hospital'],
		'elemento_id'	=> $key
	);

	$sql = atualizar("meta", $values, $where);
}

$_SESSION['mensagem'] = "Atualizadas as metas do hospital ". $_POST['hospital'];
$_SESSION['mensagemClasse'] = "sucesso";
voltar();
