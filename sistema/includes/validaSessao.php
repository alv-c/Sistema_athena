<?php
    session_start();
    function validaSessao(array $sessao, $conexao) {
        if(empty($sessao['login']) || is_null($sessao['login'])) {
            session_destroy();
            header("Location: /sistema/view/login.php");
        } else {
            $query = "SELECT * FROM usuarios WHERE id = {$sessao["login"]}";
            return $conexao->ler($query)[0];
        }
    }
    $usuarioSessao = validaSessao($_SESSION, $conexao);
?>