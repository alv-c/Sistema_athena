<?php
class LoginService
{
    private $conexao = null;
    private $login = null;

    public function __construct($conexao, $login = null)
    {
        $this->conexao = $conexao;
        $this->login = $login;
    }

    public function validaLogin()
    {
        $query = "SELECT * FROM usuarios WHERE email = '{$this->login->__get("email")}' AND senha = '{$this->login->__get("senha")}'";
        return $this->conexao->ler($query);
    }

    public function iniciarSessao($idUsuario)
    {
        session_start();
        $_SESSION['login'] = $idUsuario;
    }

    public function encerrarSessao()
    {
        $_SESSION = array();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        session_destroy();
        header("Location: /sistema/view/login.php");
    }
}
