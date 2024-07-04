<?php

class FinanceiroService
{
    private $conexao = null;
    private $financeiro = null;

    public function __construct($conexao, $financeiro)
    {
        $this->conexao = $conexao;
        $this->financeiro = $financeiro;
    }

    public function inserir()
    {
        $hora_atual = date('H:i:s');
        return $this->conexao->inserir('financeiro', [
            'id_pagador' => $this->financeiro->__get('id_pagador'),
            'id_recebedor' => $this->financeiro->__get('id_recebedor'),
            'tipo_pagamento' => $this->financeiro->__get('tipo_pagamento'),
            'preco' => $this->financeiro->__get('preco'),
            'valor_entrada' => $this->financeiro->__get('valor_entrada'),
            'num_parcelas' => $this->financeiro->__get('num_parcelas'),
            'val_parcela' => $this->financeiro->__get('val_parcela'),
            'comentario' => $this->financeiro->__get('comentario'),
            'dia_vencimento' => $this->financeiro->__get('dia_vencimento'),
            'data' => $this->financeiro->__get('data'),
            'hora' => $hora_atual,
        ]);
    }

    public function gerarParcelas(array $post = [])
    {
        $diaDoMes = $post['data_vencimento'];
        $numeroParcelas = $post['num_parcelas'];
        if ($diaDoMes < 1 || $diaDoMes > 31) {
            throw new InvalidArgumentException("O dia do mês deve estar entre 1 e 31.");
        }
        $dataVencimento = date('Y-m', strtotime('now')) . '-' . sprintf('%02d', $diaDoMes);
        for ($i = 0; $i < $numeroParcelas; $i++) {
            $dataVencimento = date('Y-m-d', strtotime("$dataVencimento +1 month"));
            $post['sequencia_parcela'] = $i + 1;
            $post['data_vencimento'] = $dataVencimento;
            $post['data'] = date('Y-m-d H:i:s');
            $this->conexao->inserir('parcelas_financeiro', [
                'id_financeiro' => $post['id_financeiro'],
                'valor_comissao' => $post['valor_comissao'],
                'num_parcelas' => $post['num_parcelas'],
                'val_parcela' => $post['val_parcela'],
                'sequencia_parcela' => $post['sequencia_parcela'],
                'data_vencimento' => $post['data_vencimento'],
                'data' => $post['data'],
            ]);
        }
        return true;
    }

    public function recuperar($id = null)
    { //read
        $query = null;
        if (is_null($id)) {
            $query = "SELECT FINAN.*, LEADS.nome AS nome_pagador, USUARIOS.nome AS nome_recebedor
                FROM financeiro FINAN
                    LEFT JOIN leads LEADS
                        ON (LEADS.id = FINAN.id_pagador)
                    LEFT JOIN usuarios USUARIOS
                        ON (USUARIOS.id = FINAN.id_recebedor)
                ORDER BY FINAN.id DESC
            ";
        } else {
            $query = "SELECT FINAN.*, LEADS.nome AS nome_pagador, USUARIOS.nome AS nome_recebedor
                        FROM financeiro FINAN
                            LEFT JOIN leads LEADS
                                ON (LEADS.id = FINAN.id_pagador)
                            LEFT JOIN usuarios USUARIOS
                                ON (USUARIOS.id = FINAN.id_recebedor)
                        WHERE FINAN.id = $id
                    ORDER BY FINAN.id DESC";
        }
        return $this->conexao->ler($query);
    }

    public function atualizar($id)
    {
        $hora_atual = date('H:i:s');
        $this->conexao->atualizar("financeiro", [
            'id_pagador' => $this->financeiro->__get('id_pagador'),
            'id_recebedor' => $this->financeiro->__get('id_recebedor'),
            'tipo_pagamento' => $this->financeiro->__get('tipo_pagamento'),
            'preco' => $this->financeiro->__get('preco'),
            'valor_entrada' => $this->financeiro->__get('valor_entrada'),
            'num_parcelas' => $this->financeiro->__get('num_parcelas'),
            'val_parcela' => $this->financeiro->__get('val_parcela'),
            'comentario' => $this->financeiro->__get('comentario'),
            'dia_vencimento' => $this->financeiro->__get('dia_vencimento'),
            'data' => $this->financeiro->__get('data'),
            'hora' => $hora_atual,
        ], "id = $id");
    }

    public function deletar($id)
    {
        $this->conexao->excluir("financeiro", "id = $id");
    }

    public function recuperarPagadores($data)
    { //read
        $query = null;
        switch ($data) {
            case $data['nivel'] == 1:
                $query = "SELECT id, nome FROM leads WHERE id_usuario_consultor = {$data['id']} ORDER BY nome ASC";
                break;

            case $data['nivel'] == 2:
                $query = "SELECT id, nome 
                            FROM leads 
                                WHERE id_usuario_consultor IN (
                                    SELECT id FROM usuarios WHERE gerente = {$data['id']}
                                ) 
                        ORDER BY nome ASC";
                break;

            case $data['nivel'] == 3:
                $query = "SELECT id, nome FROM leads ORDER BY nome DESC";
                break;
        }
        return $this->conexao->ler($query);
    }

    public function recuperarRecebedores($data)
    { //read
        $query = null;
        switch ($data) {
            case $data['nivel'] == 1:
                $query = "SELECT id, nome FROM usuarios WHERE id = {$data['id']} ORDER BY nome ASC";
                break;

            case $data['nivel'] == 2:
                $query = "SELECT id, nome FROM usuarios WHERE id = {$data['id']} OR gerente = {$data['id']} ORDER BY nome ASC";
                break;

            case $data['nivel'] == 3:
                $query = "SELECT id, nome FROM usuarios ORDER BY nome DESC";
                break;
        }
        return $this->conexao->ler($query);
    }
}
