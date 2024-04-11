<?php

class UsuarioService
{
    private $conexao = null;
    private $usuario = null;

    public function __construct($conexao, $usuario)
    {
        $this->conexao = $conexao;
        $this->usuario = $usuario;
    }

    public function inserir()
    {
        return $this->conexao->inserir('usuarios', [
            'nome' => $this->usuario->__get('nome'),
            'email' => $this->usuario->__get('email'),
            'senha' => $this->usuario->__get('senha'),
            'nivel' => $this->usuario->__get('nivel'),
            'gerente' => $this->usuario->__get('gerenteConsultor'),
            'creci' => $this->usuario->__get('creci'),
            'status' => $this->usuario->__get('status')
        ]);
    }

    public function recuperar($id = null)
    { //read
        $query = null;
        if (is_null($id)) {
            $query = "SELECT * FROM usuarios";
        } else {
            $query = "SELECT * FROM usuarios WHERE id = $id";
        }
        return $this->conexao->ler($query);
    }

    public function atualizar($id)
    {
        $this->conexao->atualizar("usuarios", [
            'nome' => $this->usuario->__get('nome'),
            'email' => $this->usuario->__get('email'),
            'senha' => $this->usuario->__get('senha'),
            'nivel' => $this->usuario->__get('nivel'),
            'gerente' => $this->usuario->__get('gerenteConsultor'),
            'creci' => $this->usuario->__get('creci'),
            'status' => $this->usuario->__get('status'),
        ], "id = $id");
    }

    public function deletar($id)
    {
        $this->conexao->excluir("usuarios", "id = $id");
    }

    public function retornarNivel()
    {
        $query = "SELECT * FROM niveis";
        return $this->conexao->ler($query);
    }

    public function recuperarGerentes()
    {
        $query = "SELECT id, nome FROM usuarios WHERE nivel = 2 AND status = 1";
        return $this->conexao->ler($query);
    }
}
