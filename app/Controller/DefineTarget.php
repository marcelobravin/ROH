<?php
include '../../app/Grimoire/core_inc.php';


# ------------------------------------------------------------------------------ insercao de novas especialidades
foreach ($_POST['leitos'] as $key => $value) { #renomear para elemento id
	$values = array(
		'hospital_id'	=> $_POST['hospital'],
		'elemento_id'	=> $key,
		'quantidade'	=> $value,
		'criado_por'	=> $_SESSION['user']['id'],
		'ativo'			=> isset($_POST['checkbox-'. $key]) ? 1 : 0
	);

	$id = inserir('meta', $values);

	if ( is_numeric($id) )
		unset($_POST['leitos'][$key]);
}


# ------------------------------------------------------------------------------ atualização de especialidades
foreach ($_POST['leitos'] as $key => $value) { #renomear para elemento id
	$values = array(
		'hospital_id'	=> $_POST['hospital'],
		'quantidade'	=> $value,
		'atualizado_por'=> $_SESSION['user']['id'],
		'ativo'			=> isset($_POST['checkbox-'. $key]) ? 1 : 0
	);

	$where = array(
		'elemento_id'	=> $key
	);

	$sql = atualizar("meta", $values, $where);
}


$_SESSION['mensagem'] = "Atualizadas as metas do hospital ". $_POST['hospital'];
$_SESSION['mensagemClasse'] = "sucesso";
header('Location: ../../metas.php');
