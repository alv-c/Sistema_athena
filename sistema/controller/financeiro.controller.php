<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/pdo.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/financeiro.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/financeiro.service.php';
$tipos_pagamento = ['A vista', 'Parcelamento'];

if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir') {
	if (validateForm($_POST)) {
		$_POST['data'] = str_replace('/', '-', $_POST['data']);
		$_POST['data'] = date('Y-m-d',  strtotime($_POST['data']));
		$financeiro = new Financeiro($_POST);
		$financeiroService = new FinanceiroService($conexao, $financeiro);
		$idInsert = $financeiroService->inserir();
		$array_parc = [
			'id_financeiro' => $idInsert,
			'valor_comissao' => $_POST['valor_entrada'],
			'num_parcelas' => $_POST['num_parcelas'],
			'val_parcela' => $_POST['val_parcela'],
			'data_vencimento' => $_POST['dia_vencimento']
		];
		$financeiroService->gerarParcelas($array_parc);
		header('Location: /sistema/view/financeiro.php');
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'atualizar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$_POST['data'] = str_replace('/', '-', $_POST['data']);
		$_POST['data'] = date('Y-m-d',  strtotime($_POST['data']));
		$financeiro = new Financeiro($_POST);
		$financeiroService = new FinanceiroService($conexao, $financeiro);
		$financeiroService->atualizar($_POST['id']);
		header('Location: /sistema/view/financeiroEdit.php?editId=' . $_POST['id']);
	}
}

if (!empty($_POST['acao']) && $_POST['acao'] == 'deletar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$financeiro = new Financeiro();
		$financeiroService = new FinanceiroService($conexao, $financeiro);
		$financeiroService->deletar($_POST['id']);
		header('Location: /sistema/view/financeiro.php?usuarioDeletado=true');
	}
} 

if (!empty($_POST['acao']) && $_POST['acao'] == 'pprc' && !empty($_POST['idpr'])) {
	if (validateForm($_POST)) {
		$conexao->atualizar("parcelas_financeiro", [
            'quitacao' => 1,
        ], "id = {$_POST['idpr']}");
		header('Location: /sistema/view/financeiroEdit.php?editId=' . $_POST['editId']);
	}
} else {
	header('Content-Type: text/html; charset=utf-8');
	$financeiro = new Financeiro();
	$financeiroService = new FinanceiroService($conexao, $financeiro);
	$arrayFinanceiro = $financeiroService->recuperar();
}

function validateForm($post)
{
	foreach ($post as $item) {
		if (empty($item)) {
			if (is_null($item)) {
				return false;
			}
		}
	}
	return true;
}
