<?php

class FinanceiroService
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
        $data_atual = date('Y-m-d H:i:s');
        return $this->conexao->inserir('financeiro', [
            'nome_pagador' => $this->usuario->__get('nome_pagador'),
            'nome_recebedor' => $this->usuario->__get('nome_recebedor'),
            'tipo_pagamento' => $this->usuario->__get('tipo_pagamento'),
            'preco' => $this->usuario->__get('preco'),
            'valor_entrada' => $this->usuario->__get('valor_entrada'),
            'num_parcelas' => $this->usuario->__get('num_parcelas'),
            'val_parcela' => $this->usuario->__get('val_parcela'),
            'val_juros' => $this->usuario->__get('val_juros'),
            'data' => $data_atual,
        ]);
    }

    public function recuperar($id = null)
    { //read
        $query = null;
        if (is_null($id)) {
            $query = "SELECT * FROM financeiro";
        } else {
            $query = "SELECT * FROM financeiro WHERE id = $id";
        }
        return $this->conexao->ler($query);
    }

    public function atualizar($id)
    {
        $this->conexao->atualizar("financeiro", [
            'nome_pagador' => $this->usuario->__get('nome_pagador'),
            'nome_recebedor' => $this->usuario->__get('nome_recebedor'),
            'tipo_pagamento' => $this->usuario->__get('tipo_pagamento'),
            'preco' => $this->usuario->__get('preco'),
            'valor_entrada' => $this->usuario->__get('valor_entrada'),
            'num_parcelas' => $this->usuario->__get('num_parcelas'),
            'val_parcela' => $this->usuario->__get('val_parcela'),
            'val_juros' => $this->usuario->__get('val_juros'),
        ], "id = $id");
    }

    public function deletar($id)
    {
        $this->conexao->excluir("financeiro", "id = $id");
    }
}
