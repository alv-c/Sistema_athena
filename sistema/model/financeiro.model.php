<?php

class Financeiro
{
    private $id_pagador = null;
    private $id_recebedor = null;
    private $tipo_pagamento = null;
    private $valor_entrada = null;
    private $num_parcelas = null;
    private $val_parcela = null;
    private $preco = null;
    private $comentario = null;
    private $data = null;

    public function __construct(array $post = [])
    {
        foreach ($post as $index => $attr) {
            $this->$index = $attr;
        }
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $valor)
    {
        $this->$attr = $valor;
    }
}
