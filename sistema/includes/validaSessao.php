<?php
    session_start();
    function validaSessao(array $sessao, $conexao) {
        if(empty($sessao['login']) || is_null($sessao['login'])) {
            echo '<h1>Perereca 1</h1>';
            session_destroy();
            header("Location: /sistema/view/login.php");
        } else {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $sessao['login']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ)[0];
echo '<h1>Perereca</h1>';

        }
    }
    $usuarioSessao = validaSessao($_SESSION, $conexao->conectar());
?>