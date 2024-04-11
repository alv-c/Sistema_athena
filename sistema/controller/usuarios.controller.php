<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/pdo.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/usuarios.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/usuarios.service.php';

// if (!empty($_POST['acao']) && $_POST['acao'] == 'inserir') {
// 	isset($_POST['gerenteConsultor']) ? $_POST['gerenteConsultor'] : null;
// 	if (validateForm($_POST)) {
// 		$usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel'], $_POST['gerenteConsultor'], $_POST['creci'], $_POST['status']);
// 		$conexao = new Conexao();
// 		$usuarioService = new UsuarioService($conexao, $usuario);
// 		$idInsert = $usuarioService->inserir();
// 		header('Location: /sistema/view/usuarios.php');
// 	}
// }

// if (!empty($_POST['acao']) && $_POST['acao'] == 'filtrar') {
// 	$usuario = new Usuario();
// 	$conexao = new Conexao();
// 	$usuarioService = new UsuarioService($conexao, $usuario);
// 	unset($_POST['acao']);
// 	$query = "SELECT * FROM usuarios WHERE ";
// 	foreach ($_POST as $key => $filtro) {
// 		if (!empty($filtro)) {
// 			if ($key == 'nivel' || $key == 'status' || $key == 'gerente') $query .= "$key = '$filtro'^";
// 			else $query .= "$key LIKE '%$filtro%'^";
// 		}
// 	}
// 	$query = str_replace('^', ' AND ', $query);
// 	$query = substr($query, 0, -4);
// 	$arrayUsuarios = $usuarioService->recuperarFiltro($query);
// }

// if (!empty($_POST['acao']) && $_POST['acao'] == 'atualizar' && !empty($_POST['id'])) {
// 	if (validateForm($_POST)) {
// 		$usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel'], $_POST['gerenteConsultor'], $_POST['creci'], $_POST['status']);
// 		$conexao = new Conexao();
// 		$usuarioService = new UsuarioService($conexao, $usuario);
// 		$usuarioService->atualizar($_POST['id']);
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

else if (strripos($_SERVER['PHP_SELF'], 'sistema')) { //OK
	$usuario = new Usuario();
	$usuarioService = new UsuarioService($conexao, $usuario);
	$arrayUsuarios = $usuarioService->recuperar();
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
