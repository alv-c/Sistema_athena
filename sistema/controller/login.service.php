<?php

    class LoginService {
        private $conexao = null;
        private $login = null;

        public function __construct ($conexao, $login = null) {
            $this->conexao = $conexao->conectar();
            $this->login = $login;
        }

        public function validaLogin() {
            $query = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':email', $this->login->__get('email'));
            $stmt->bindValue(':senha', $this->login->__get('senha'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function iniciarSessao($idUsuario) {
            session_start();
            $_SESSION['login'] = $idUsuario;
        }

        public function encerrarSessao () {
            $_SESSION = array();
            setcookie("PHPSESSID", "", time() - 3600, "/");
            session_destroy();
            header("Location: /sistema/view/login.php");
        }
    }