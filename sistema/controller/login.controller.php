<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/pdo.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/login.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/login.service.php';

if (!empty($_POST['email']) && validateForm($_POST)) {
    $login = new Login($_POST['email'], $_POST['senha']);
    $conexao = new Conexao();
    $loginService = new LoginService($conexao, $login);

    if ((bool)count($loginService->validaLogin())) {
        $loginService->iniciarSessao($loginService->validaLogin()[0]->id);
        header('Location: /sistema/index.php');
    } else {
        header('Location: /sistema/view/login.php?failLogin=true');
    }
}

if (isset($_POST['endSession'])) {
    $conexao = new Conexao();
    $loginService = new LoginService($conexao);
    $loginService->encerrarSessao();
}

function validateForm($post)
{
    foreach ($post as $item) {
        if (empty($item) || is_null($item)) {
            if (is_null($item)) {
                return false;
            }
        }
    }
    return true;
}
