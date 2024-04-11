<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/gerente.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/gerente.service.php';

// if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir') {
// 	isset($_POST['gerenteConsultor']) ? $_POST['gerenteConsultor'] : null;
// 	if (validateForm($_POST)) {
// 		$usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel'], $_POST['gerenteConsultor'], $_POST['status']);
// 		$conexao = new Conexao();
// 		$usuarioService = new UsuarioService($conexao, $usuario);
// 		$idInsert = $usuarioService->inserir();
// 		header('Location: /sistema/view/usuariosEdit.php?editId=' . $idInsert);
// 	}
// }

// if (!empty($_POST['acao']) && $_POST['acao'] == 'filtrar' && isset($_GET['idUser'])) {
// 	$gerente = new Gerente();
// 	$conexao = new Conexao();
// 	$gerenteService = new GerenteService($conexao, $gerente);
// 	unset($_POST['acao']);
// 	$query = "SELECT * FROM leads WHERE ";
// 	foreach ($_POST as $key => $filtro) {
// 		if ($key == 'filter_data_de' && !empty($filtro)) {
// 			$dataDe = date('Y-m-d', strtotime($_POST['filter_data_de']));
// 			$dataAte = date('Y-m-d', strtotime("+1 days", strtotime($_POST['filter_data_ate'])));
// 			$query .= "data BETWEEN '$dataDe' AND '$dataAte'^";
// 		} else if (!empty($filtro) && ($key != 'filter_data_de ' && $key != 'filter_data_ate')) {
// 			if ($key == 'status') $query .= "$key = '$filtro'^";
// 			else $query .= "$key LIKE '%$filtro%'^";
// 		}
// 	}
// 	$query = str_replace('^', ' AND ', $query);
// 	$query = substr($query, 0, -4);
// 	$query .= " AND id_usuario_consultor = {$_GET['idUser']}";
// 	$arrayFiltro = $gerenteService->recuperarFiltro($query);
// }

// if (!empty($_POST['acao']) && $_POST['acao'] == 'atualizar' && !empty($_POST['id'])) {
// 	if (validateForm($_POST)) {
// 		$usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel'], $_POST['gerenteConsultor'], $_POST['status']);
// 		$conexao = new Conexao();
// 		$usuarioService = new UsuarioService($conexao, $usuario);
// 		$usuarioService->atualizar($_POST['id'], $log);
// 		header('Location: /sistema/view/usuariosEdit.php?editId=' . $_POST['id']);
// 	}
// }

if (!empty($_POST['acao']) && $_POST['acao'] == 'deletar' && !empty($_POST['id'])) {
	if (validateForm($_POST)) {
		$usuario = new Usuario();
		$conexao = new Conexao();
		$usuarioService = new UsuarioService($conexao, $usuario);
		$usuarioService->deletar($_POST['id']);
		header('Location: /sistema/view/usuarios.php?usuarioDeletado=true');
	}
} 

else if (strripos($_SERVER['PHP_SELF'], 'sistema')) {
	$gerente = new Gerente();
	$gerenteService = new GerenteService($conexao, $gerente);
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
