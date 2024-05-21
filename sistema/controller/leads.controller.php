<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/leads.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.service.php';

if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir') {
	if (validateForm($_POST)) {
		$_POST['telefone'] = $conexao->removerCaracteresEsp($_POST['telefone']);
		$lead = new Lead($_POST);
		$leadService = new LeadsService($conexao, $lead);
		$leadService->inserir();
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'atualizar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$log = empty($_POST['anotacao']) ? false : true;
		$_POST['telefone'] = $conexao->removerCaracteresEsp($_POST['telefone']);
		$_POST['telefone2'] = $conexao->removerCaracteresEsp($_POST['telefone2']);
		$_POST['data_nascimento'] = str_replace('/', '-', $_POST['data_nascimento']);
		$_POST['data_nascimento'] = date('Y-m-d',  strtotime($_POST['data_nascimento']));
		$dados_follow = [
			'data_follow' => $_POST['data_follow'],
			'hora_follow' => $_POST['hora_follow'],
			'criar_follow' => $_POST['criar_follow'],
			'anotacao' => $_POST['anotacao'],
		];
		unset($_POST['data_follow']);
		unset($_POST['hora_follow']);
		unset($_POST['criar_follow']);
		$lead = new Lead($_POST);
		$leadService = new LeadsService($conexao, $lead);
		$id_insercao_log = $leadService->atualizar($_POST['id'], $log, $_POST['user']);
		if(
			!is_null($dados_follow['data_follow']) && 
			!is_null($dados_follow['hora_follow']) && 
			isset($dados_follow['criar_follow']) && 
			!empty($dados_follow['anotacao']) &&
			(bool)$id_insercao_log
		) {
			$data_follow = $dados_follow['data_follow'] . ' ' . $dados_follow['hora_follow'];
			$campos = [
				'descricao' => $dados_follow['anotacao'],
				'data' => $data_follow,
				'id_usuario' => $_POST['user'],
				'id_lead' => $_POST['id'],
				'id_anotacao' => $id_insercao_log
			];
			$leadService->criar_followup($campos);
		}
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
	$_POST['telefone'] = $conexao->removerCaracteresEsp($_POST['telefone']);
	$_POST['telefone2'] = $conexao->removerCaracteresEsp($_POST['telefone2']);
	$_POST['data_nascimento'] = str_replace('/', '-', $_POST['data_nascimento']);
	$_POST['data_nascimento'] = date('Y-m-d',  strtotime($_POST['data_nascimento']));
	$lead = new Lead($_POST);
	$leadService = new LeadsService($conexao, $lead);
	$leadService->inserir();
	header('Location: /sistema/view/index.php');
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'filtrarLead') {
	if (validateForm($_POST)) {
		header('Content-Type: text/html; charset=utf-8');
		$lead = new Lead();
		$leadService = new LeadsService($conexao, $lead);
		$array_post = $_POST;
		$array_post['telefone'] = $conexao->removerCaracteresEsp($array_post['telefone']);
		$array_post['telefone2'] = $conexao->removerCaracteresEsp($array_post['telefone2']);
		$array_post['data_nascimento'] = str_replace('/', '-', $array_post['data_nascimento']);
		$array_post['data_nascimento'] = date('Y-m-d',  strtotime($array_post['data_nascimento']));
		$array_post['data_aux'] = [$_POST['data_ini'], $_POST['data_fim']];
		unset($array_post['data_ini']);
		unset($array_post['data_fim']);
		unset($array_post['acao']);
		$arrayLeads = $leadService->filtroDados('leads', $array_post);
		$filtro = true;
	}
} else if (strripos($_SERVER['PHP_SELF'], 'sistema')) {
	header('Content-Type: text/html; charset=utf-8');
	$lead = new Lead();
	$leadService = new LeadsService($conexao, $lead);
	$arrayLeads = $leadService->recuperar();
	// $leadService->esfriarLead();
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
