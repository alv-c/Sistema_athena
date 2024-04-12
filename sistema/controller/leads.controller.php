<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/leads.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.service.php';

if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir') {
	if (validateForm($_POST)) {
		$_POST['telefone'] = str_replace("(", "", $_POST['telefone']);
		$_POST['telefone'] = str_replace(")", "", $_POST['telefone']);
		$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
		$lead = new Lead($_POST['nome'], $_POST['telefone'], null, $_POST['email']);
		$leadService = new LeadsService($conexao, $lead);
		$leadService->inserir();
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'atualizar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$log = empty($_POST['anotacao']) ? false : true;
		$_POST['telefone'] = str_replace("(", "", $_POST['telefone']);
		$_POST['telefone'] = str_replace(")", "", $_POST['telefone']);
		$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
		$_POST['telefone2'] = str_replace("(", "", $_POST['telefone2']);
		$_POST['telefone2'] = str_replace(")", "", $_POST['telefone2']);
		$_POST['telefone2'] = str_replace("-", "", $_POST['telefone2']);
		$lead = new Lead($_POST['nome'], $_POST['telefone'], $_POST['telefone2'], $_POST['email'], $_POST['profissao'], $_POST['consultor'], $_POST['anotacao'], $_POST['midia'], $_POST['status']);
		$leadService = new LeadsService($conexao, $lead);
		$leadService->atualizar($_POST['id'], $log, $_POST['user']);
		header('Location: /sistema/view/edit.php?editId=' . $_POST['id']);
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'deletar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$lead = new Lead();
		$leadService = new LeadsService($conexao, $lead);
		$leadService->deletar($_POST['id']);
		header('Location: /sistema/view/index.php?leadDeletado=true');
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir_lead_manual') {
	$_POST['telefone'] = str_replace("(", "", $_POST['telefone']);
	$_POST['telefone'] = str_replace(")", "", $_POST['telefone']);
	$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
	$_POST['telefone2'] = str_replace("(", "", $_POST['telefone2']);
	$_POST['telefone2'] = str_replace(")", "", $_POST['telefone2']);
	$_POST['telefone2'] = str_replace("-", "", $_POST['telefone2']);
	$lead = new Lead($_POST['nome'], $_POST['telefone'], $_POST['telefone2'], $_POST['email'], $_POST['profissao'], $_POST['id_usuario_consultor'], null, $_POST['midia'], $_POST['status']);
	$leadService = new LeadsService($conexao, $lead);
	$leadService->inserir();
	header('Location: /sistema/view/index.php');
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'filtrarLead') {
	if (validateForm($_POST)) {
		$lead = new Lead();
		$leadService = new LeadsService($conexao, $lead);
		$array_post = $_POST;
		$array_post['data_aux'] = [$_POST['data_ini'], $_POST['data_fim']];
		unset($array_post['data_ini']);
		unset($array_post['data_fim']);
		unset($array_post['acao']);
		$arrayLeads = $leadService->filtroDados('leads', $array_post);
		$filtro = true;
	}
} else if (strripos($_SERVER['PHP_SELF'], 'sistema')) {
	$lead = new Lead();
	$leadService = new LeadsService($conexao, $lead);
	$arrayLeads = $leadService->recuperar();
	$leadService->esfriarLead();
}

function validateForm($post)
{
	foreach ($post as $item) {
		if (is_null($item)) {
			return false;
		}
	}
	return true;
}
