<?php
    require_once "/sistema/model/pdo.model.php";
    class FollowUp {
        private $dados = null;
        private $conexao = null;

        public function __construct ($dados, $conexao) {
            $this->dados = $dados;
            $this->conexao = $conexao->conectar();
        }
        public function insertFlw () {
            try {
                $query = 'INSERT INTO followup(descricao, data, id_usuario) values (:descricao, :data, :id_usuario)';
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':descricao', $this->dados['descricao']);
                $stmt->bindValue(':data', $this->dados['data']);
                $stmt->bindValue(':id_usuario', $this->dados['id_usuario']);
                $stmt->execute();
                return $this->returnFollow($this->dados['id_usuario']);
            } catch (Error $e) {
                return $e->getMessage();
            }
        }
        public function returnFollow($id_usuario) {
            $queryFollow = "SELECT followup.*, DATE_FORMAT(followup.data, '%d/%m/%Y') AS data FROM followup WHERE id_usuario = $id_usuario ORDER BY id ASC";
            $stmtFollow = $this->conexao->prepare($queryFollow);
            $stmtFollow->execute();
            return json_encode($stmtFollow->fetchAll(PDO::FETCH_OBJ));
        }
        public function delFlw($id_usuario) {
            $query = 'DELETE FROM followup WHERE id = :id;';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->dados[0]);
            $stmt->execute();
            return $this->returnFollow($id_usuario);
        }
    }

    if (isset($_GET['del'])) $data = (array) json_decode($_GET['del']);
    if (!empty($_GET['data'])) $data = (array) json_decode($_GET['data']);

    $conexao = new Conexao();
    $followUp = new FollowUp($data, $conexao);
    if (!empty($data) && !isset($_GET['del'])) echo $followUp->insertFlw();
    else if (isset($_GET['del'])) echo $followUp->delFlw($_GET['id_usuario']);
    else echo $followUp->returnFollow($_GET['id_usuario']);