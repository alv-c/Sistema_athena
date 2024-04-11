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
        if (empty($this->lead->__get('consultor'))) {
            $campos = [
                'nome' => $this->lead->__get('nome'),
                'telefone' => $this->lead->__get('telefone'),
                'telefone2' => $this->lead->__get('telefone2'),
                'email' => $this->lead->__get('email'),
                'profissao' => $this->lead->__get('profissao')
            ];
        } else {
            $campos = [
                'nome' => $this->lead->__get('nome'),
                'telefone' => $this->lead->__get('telefone'),
                'telefone2' => $this->lead->__get('telefone2'),
                'email' => $this->lead->__get('email'),
                'profissao' => $this->lead->__get('profissao'),
                'id_usuario_consultor' => $this->lead->__get('consultor'),
                'midia' => $this->lead->__get('midia'),
                'status' => $this->lead->__get('status')
            ];
        }
        $lastId = $this->conexao->inserir('leads', $campos);
        if (is_null($this->lead->__get('consultor')) || empty($this->lead->__get('consultor'))) {
            $this->enviarLeadConsultor($lastId);
        }
    }

    public function recuperar($id = null)
    { //read
        $query = '';
        if (is_null($id)) {
            $query = "SELECT leads.*, usuarios.nome AS nome_corretor, midias.nome AS nome_midia FROM leads LEFT JOIN usuarios ON (usuarios.id = leads.id_usuario_consultor) LEFT JOIN midias ON (midias.id = leads.midia)";
        } else {
            $query = "SELECT leads.*, midias.id AS id_midia, midias.nome AS nome_midia FROM leads LEFT JOIN midias ON (midias.id = leads.midia) WHERE leads.id = $id";
        }
        return $this->conexao->ler($query);
    }

    public function recuperarLogsLead($id)
    {
        $query = "SELECT HL.id, HL.anotacao, DATE_FORMAT(HL.data, '%d/%m/%Y %H:%i') AS data, SL.status, SL.cor, US.nome AS nomeUsuarioAnotacao
                FROM historico_lead AS HL 
                INNER JOIN status_lead AS SL 
                ON (HL.idStatus = SL.id) 
                LEFT JOIN usuarios AS US
                ON (HL.idUsuario = US.id)
                WHERE HL.idLead = $id
                ORDER BY HL.data DESC
            ";
        return $this->conexao->ler($query);
    }

    public function atualizar($id, $log = false, $usuario)
    {
        $statusAtual = $this->recuperar($id);
        if ($statusAtual[0]->status != $this->lead->__get('status')) $log = true;
        $campos = [
            'nome' => $this->lead->__get('nome'),
            'telefone' => $this->lead->__get('telefone'),
            'telefone2' => $this->lead->__get('telefone2'),
            'email' => $this->lead->__get('email'),
            'profissao' => $this->lead->__get('profissao'),
            'id_usuario_consultor' => $this->lead->__get('consultor'),
            'midia' => $this->lead->__get('midia'),
            'status' => $this->lead->__get('status')
        ];
        $this->conexao->atualizar('leads', $campos, "id = $id");
        if ($log) {
            $campos = [
                'idLead' => $id,
                'idUsuario' => $usuario,
                'idStatus' => $this->lead->__get('status'),
                'anotacao' => $this->lead->__get('anotacao')
            ];
            $this->conexao->inserir('historico_lead', $campos);
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
                $query .= "WHERE id = $id";
                break;

            case 2:
                $query .= "WHERE gerente = $id";
                break;
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
        $query = "SELECT leads.id FROM leads WHERE leads.data > DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND status != 7 AND status != 8";
        $ids = $this->conexao->ler($query);
        foreach ($ids as $id) {
            $this->conexao->atualizar('leads', ['status' => 3], "id = $id->id");
        }
    }
}
