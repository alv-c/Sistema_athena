<?php
    class LeadsService {
        private $conexao = null;
        private $lead = null;

        public function __construct ($conexao, $lead) {
            $this->conexao = $conexao->conectar();
            $this->lead = $lead;
        }

        public function inserir() {
            $query = '';
            if (empty($this->lead->__get('consultor'))) {
                $query = 'INSERT INTO leads(nome, telefone, telefone2, email, profissao) values (:nome, :telefone, :telefone2, :email, :profissao)';
            } else {
                $query = 'INSERT INTO leads(nome, telefone, telefone2, email, profissao, id_usuario_consultor, midia, status) values (:nome, :telefone, :telefone2, :email, :profissao, :id_usuario_consultor, :midia, :status)';
            }
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->lead->__get('nome'));
            $stmt->bindValue(':telefone', $this->lead->__get('telefone'));
            $stmt->bindValue(':telefone2', $this->lead->__get('telefone2'));
            $stmt->bindValue(':email', $this->lead->__get('email'));
            $stmt->bindValue(':profissao', $this->lead->__get('profissao'));
            if (!empty($this->lead->__get('consultor'))) {
                $stmt->bindValue(':id_usuario_consultor', $this->lead->__get('consultor'));
                $stmt->bindValue(':midia', $this->lead->__get('midia'));
                $stmt->bindValue(':status', $this->lead->__get('status'));            
            }
            $stmt->execute();
            if (is_null($this->lead->__get('consultor')) || empty($this->lead->__get('consultor'))) {
                $this->enviarLeadConsultor($this->conexao->lastInsertId());
            }
        }

        public function recuperar($id = null) { //read
            $query = '';
            if(is_null($id)) {
                $query = "SELECT leads.*, usuarios.nome AS nome_corretor, midias.nome AS nome_midia FROM leads LEFT JOIN usuarios ON (usuarios.id = leads.id_usuario_consultor) LEFT JOIN midias ON (midias.id = leads.midia)";
            } else {
                $query = "SELECT leads.*, midias.id AS id_midia, midias.nome AS nome_midia FROM leads LEFT JOIN midias ON (midias.id = leads.midia) WHERE leads.id = $id";
            }
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function recuperarLogsLead ($id) {
            $query = "SELECT HL.id, HL.anotacao, DATE_FORMAT(HL.data, '%d/%m/%Y %H:%i') AS data, SL.status, SL.cor, US.nome AS nomeUsuarioAnotacao
                FROM historico_lead AS HL 
                INNER JOIN status_lead AS SL 
                ON (HL.idStatus = SL.id) 
                LEFT JOIN usuarios AS US
                ON (HL.idUsuario = US.id)
                WHERE HL.idLead = $id
                ORDER BY HL.data DESC
            ";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar($id, $log = false, $usuario) {
            $statusAtual = $this->recuperar($id);
            if($statusAtual[0]->status != $this->lead->__get('status')) $log = true;

            $query = 'UPDATE leads SET 
                nome = :nome, 
                telefone = :telefone, 
                telefone2 = :telefone2, 
                email = :email, 
                profissao = :profissao, 
                id_usuario_consultor = :consultor, 
                midia = :midia, 
                status = :status 
                WHERE id = :id;
            ';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->lead->__get('nome'));
            $stmt->bindValue(':telefone', $this->lead->__get('telefone'));
            $stmt->bindValue(':telefone2', $this->lead->__get('telefone2'));
            $stmt->bindValue(':email', $this->lead->__get('email'));
            $stmt->bindValue(':profissao', $this->lead->__get('profissao'));
            $stmt->bindValue(':consultor', $this->lead->__get('consultor'));
            $stmt->bindValue(':midia', $this->lead->__get('midia'));
            $stmt->bindValue(':status', $this->lead->__get('status'));
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($log) {
                $queryLog = 'INSERT INTO historico_lead(idLead, idUsuario, idStatus, anotacao) values (:id, :idUsuario, :idStatus, :anotacao)';
                $stmtLog = $this->conexao->prepare($queryLog);
                $stmtLog->bindValue(':id', $id);
                $stmtLog->bindValue(':idUsuario', $usuario);
                $stmtLog->bindValue(':idStatus', $this->lead->__get('status'));
                $stmtLog->bindValue(':anotacao', $this->lead->__get('anotacao'));
                $stmtLog->execute();
            }
        }

        public function deletar($id) {
            $query = 'DELETE FROM leads WHERE id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function retornarStatus () {
            $query = "SELECT * FROM status_lead";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function retornarGerenteConsultor ($id) {
            $query = "SELECT gerente FROM usuarios WHERE id = $id";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function retornarConsultores($id, $nivel) {
            $query = "SELECT id, nome FROM usuarios ";
            switch($nivel) {
                case 1:
                    $query .= "WHERE id = $id AND nivel = 1";
                    break;

                case 2:
                    $query .= "WHERE gerente = $id AND nivel = 1";
                    break;

                case 3:
                    $query .= "WHERE nivel = 1";
                    break;
            }
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function retornarMidias() {
            $query = "SELECT * FROM midias";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        private function enviarLeadConsultor($idLead) {
            $queryConsultores = "SELECT id FROM usuarios WHERE nivel = 1 AND status = 1 ORDER BY id ASC";
            $stmtConsultores = $this->conexao->prepare($queryConsultores);
            $stmtConsultores->execute();
            $arrayConsultores = $stmtConsultores->fetchAll(PDO::FETCH_ASSOC);
            $consultores = array();

            foreach($arrayConsultores as $consultor) {
                foreach($consultor as $indice) {
                    array_push($consultores, $indice);
                }
            }

            $queryLeads = "SELECT id_usuario_consultor FROM leads WHERE id != $idLead ORDER BY id DESC LIMIT 1";
            $stmtLeads = $this->conexao->prepare($queryLeads);
            $stmtLeads->execute();
            $idConsLeadAnt = $stmtLeads->fetchAll(PDO::FETCH_OBJ)[0]->id_usuario_consultor;
            $key = array_search($idConsLeadAnt, $consultores);

            if($key != false || $key === 0) {
                $key += 1;
                if(array_key_exists($key, $consultores)) {
                    $query = 'UPDATE leads SET id_usuario_consultor = :id_usuario_consultor WHERE id = :id;';
                    $stmt = $this->conexao->prepare($query);
                    $stmt->bindValue(':id_usuario_consultor', $consultores[$key]);
                    $stmt->bindValue(':id', $idLead);
                    $stmt->execute();
                } else {
                    $key = min($consultores);
                    $query = 'UPDATE leads SET id_usuario_consultor = :id_usuario_consultor WHERE id = :id;';
                    $stmt = $this->conexao->prepare($query);
                    $stmt->bindValue(':id_usuario_consultor', $key);
                    $stmt->bindValue(':id', $idLead);
                    $stmt->execute();
                }
            } else {
                $query = 'UPDATE leads SET id_usuario_consultor = :id_usuario_consultor WHERE id = :id;';
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':id_usuario_consultor', $consultores[0]);
                $stmt->bindValue(':id', $idLead);
                $stmt->execute();
            }
        }

        public function esfriarLead () {
            $query = "SELECT leads.id FROM leads WHERE leads.data < DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND status != 7 AND status != 8";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            $ids = $stmt->fetchAll(PDO::FETCH_OBJ);
            // return $ids;
            
            foreach($ids as $id) {
                $queryUpdate = "UPDATE leads SET status = 3 WHERE id = {$id->id};";
                $stmtUpdate = $this->conexao->prepare($queryUpdate);
                $stmtUpdate->execute();
            }
        }
    }