<?php
class LeadsService
{
    private $conexao = null;
    private $lead = null;

    public function __construct($conexao, $lead)
    {
        $this->conexao = $conexao;
        $this->lead = $lead;
    }

    public function inserir()
    {
        $campos = '';
        $data = date('Y-m-d H:m:s');
        $data_aux = date('Y-m-d');
        if (empty($this->lead->__get('id_usuario_consultor'))) {
            $campos = [
                'nome' => $this->lead->__get('nome'),
                'telefone' => $this->lead->__get('telefone'),
                'telefone2' => $this->lead->__get('telefone2'),
                'email' => $this->lead->__get('email'),
                'profissao' => $this->lead->__get('profissao'),
                'data_nascimento' => $this->lead->__get('data_nascimento'),
                'data' => $data,
                'data_aux' => $data_aux
            ];
        } else {
            $campos = [
                'nome' => $this->lead->__get('nome'),
                'telefone' => $this->lead->__get('telefone'),
                'telefone2' => $this->lead->__get('telefone2'),
                'email' => $this->lead->__get('email'),
                'profissao' => $this->lead->__get('profissao'),
                'data_nascimento' => $this->lead->__get('data_nascimento'),
                'id_usuario_consultor' => $this->lead->__get('id_usuario_consultor'),
                'data' => $data,
                'data_aux' => $data_aux,
                'midia' => $this->lead->__get('midia'),
                'status' => $this->lead->__get('status')
            ];
        }
        $lastId = $this->conexao->inserir('leads', $campos);
        if (is_null($this->lead->__get('id_usuario_consultor')) || empty($this->lead->__get('id_usuario_consultor'))) {
            $this->enviarLeadConsultor($lastId);
        }
    }

    public function recuperar($id = null)
    { //read
        $query = '';
        if (is_null($id)) {
            $query = "SELECT leads.*, usuarios.nome AS nome_corretor, midias.nome AS nome_midia FROM leads LEFT JOIN usuarios ON (usuarios.id = leads.id_usuario_consultor) LEFT JOIN midias ON (midias.id = leads.midia) ORDER BY leads.id DESC";
        } else {
            $query = "SELECT leads.*, midias.id AS id_midia, midias.nome AS nome_midia FROM leads LEFT JOIN midias ON (midias.id = leads.midia) WHERE leads.id = $id ORDER BY leads.id DESC";
        }
        return $this->conexao->ler($query);
    }

    public function recuperarLogsLead($id)
    {
        $query = "SELECT FLW.id AS id_follow, HL.id, HL.anotacao, DATE_FORMAT(HL.data, '%d/%m/%Y %H:%i') AS data, SL.status, SL.cor, US.nome AS nomeUsuarioAnotacao
            FROM historico_lead AS HL 
                INNER JOIN status_lead AS SL 
                    ON (HL.idStatus = SL.id) 
                LEFT JOIN usuarios AS US
                    ON (HL.idUsuario = US.id)
                LEFT JOIN followup FLW 
                    ON (FLW.id_anotacao = HL.id)
            WHERE HL.idLead = $id
        ORDER BY HL.data DESC
            ";
        return $this->conexao->ler($query);
    }

    public function atualizar($id, $log = false, $usuario)
    {
        $data_atual = date('Y-m-d H:i:s');
        $statusAtual = $this->recuperar($id);
        if ($statusAtual[0]->status != $this->lead->__get('status')) $log = true;
        $campos = [
            'nome' => $this->lead->__get('nome'),
            'telefone' => $this->lead->__get('telefone'),
            'telefone2' => $this->lead->__get('telefone2'),
            'email' => $this->lead->__get('email'),
            'profissao' => $this->lead->__get('profissao'),
            'data_nascimento' => $this->lead->__get('data_nascimento'),
            'id_usuario_consultor' => $this->lead->__get('id_usuario_consultor'),
            'midia' => $this->lead->__get('midia'),
            'status' => $this->lead->__get('status')
        ];
        $this->conexao->atualizar('leads', $campos, "id = $id");
        if ($log) {
            $campos = [
                'idLead' => $id,
                'idUsuario' => $usuario,
                'idStatus' => $this->lead->__get('status'),
                'anotacao' => $this->lead->__get('anotacao'),
                'data' => $data_atual,
            ];
            return $this->conexao->inserir('historico_lead', $campos);
        }
    }

    public function deletar($id)
    {
        $this->conexao->excluir('leads', "id = $id");
    }

    public function retornarStatus()
    {
        $query = "SELECT * FROM status_lead";
        return $this->conexao->ler($query);
    }

    public function retornarGerenteConsultor($id)
    {
        $query = "SELECT gerente FROM usuarios WHERE id = $id";
        return $this->conexao->ler($query);
    }

    public function retornarConsultores($id, $nivel)
    {
        $query = "SELECT id, nome FROM usuarios ";
        switch ($nivel) {
            case 1:
                $query .= "WHERE id = $id AND status = 1";
                break;

            case 2:
                $query .= "WHERE gerente = $id AND nivel = 1 AND status = 1";
                break;

            default:
                $query .= "WHERE nivel = 1 AND status = 1";
        }
        return $this->conexao->ler($query);
    }

    public function retornarMidias()
    {
        $query = "SELECT * FROM midias";
        return $this->conexao->ler($query);
    }

    private function enviarLeadConsultor($idLead)
    {
        $queryConsultores = "SELECT id FROM usuarios WHERE nivel = 1 AND status = 1 ORDER BY id ASC";
        $arrayConsultores = (array)$this->conexao->ler($queryConsultores);
        $consultores = array();
        foreach ($arrayConsultores as $consultor) {
            foreach ($consultor as $indice) {
                array_push($consultores, $indice);
            }
        }
        $queryLeads = "SELECT id_usuario_consultor FROM leads WHERE id != $idLead ORDER BY id DESC LIMIT 1";
        $idConsLeadAnt = null;
        $idConsLeadAnt = $this->conexao->ler($queryLeads);
        if (!count($idConsLeadAnt)) {
            $queryLeads = "SELECT id FROM usuarios WHERE nivel = 1 AND status = 1 ORDER BY id DESC LIMIT 1";
            $idConsLeadAnt = $this->conexao->ler($queryLeads)[0]->id;
        } else {
            $idConsLeadAnt = $idConsLeadAnt[0]->id_usuario_consultor;
        }
        $key = array_search($idConsLeadAnt, $consultores);
        if ($key != false || $key === 0) {
            $key += 1;
            if (array_key_exists($key, $consultores)) {
                $this->conexao->atualizar('leads', ['id_usuario_consultor' => $consultores[$key]], "id = $idLead");
            } else {
                $key = min($consultores);
                $this->conexao->atualizar('leads', ['id_usuario_consultor' => $key], "id = $idLead");
            }
        } else {
            $this->conexao->atualizar('leads', ['id_usuario_consultor' => $consultores[0]], "id = $idLead");
        }
    }

    public function esfriarLead()
    {
        $query = "SELECT leads.id FROM leads WHERE leads.data_aux < DATE_SUB(CURRENT_DATE(), INTERVAL 14 DAY) AND status != 7 AND status != 8";
        $ids = $this->conexao->ler($query);
        foreach ($ids as $id) {
            $this->conexao->atualizar('leads', ['status' => 3], "id = $id->id");
        }
    }

    public function filtroDados($table, $filters)
    {
        $sql = "SELECT 
            $table.*, midias.nome AS nome_midia, usuarios.nome AS nome_corretor
                FROM $table 
                    LEFT JOIN midias
                        ON (midias.id = $table.midia)
                    LEFT JOIN usuarios
                        ON (usuarios.id = $table.id_usuario_consultor)
            WHERE ";
        $conditions = [];
        foreach ($filters as $column => $value) {
            if (is_array($value)) {
                $conditions[] = "$table.$column BETWEEN '$value[0]' AND '$value[1]'";
            } else if (is_numeric($value)) {
                $value = (int)$value;
                if ($value) $conditions[] = "$table.$column = '$value'";
            } else {
                if (empty($value)) continue;
                $conditions[] = "$table.$column LIKE '%$value%'";
            }
        }
        $sql .= implode(" AND ", $conditions);
        return $this->conexao->ler($sql);

        // **** Exemplo de uso FILTRO ****
        // Definindo os filtros
        // $filters = [
        //     'nome' => 'João',
        //     'idade' => 25,
        //     'data_nascimento' => ['2020-01-01', '2024-01-01'] // Intervalo de datas
        // ];

        // Chamando o método de filtragem
        // $resultados = $this->filtroDados('tabela', $filters);

        // Exibindo os resultados
        // foreach ($resultados as $resultado) {
        // fazer algo com os resultados
        // }
    }

    public function criar_followup($campos = [])
    {
        if ((bool)count($campos)) {
            $this->conexao->inserir('followup', $campos);
        }
    }
}
