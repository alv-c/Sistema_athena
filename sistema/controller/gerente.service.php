<?php
class GerenteService
{
    private $conexao = null;
    private $gerente = null;

    public function __construct($conexao, $gerente)
    {
        $this->conexao = $conexao;
        $this->gerente = $gerente;
    }

    // public function inserir() {
    //     $query = 'INSERT INTO usuarios(nome, email, senha, nivel, gerente, status)values(:nome, :email, :senha, :nivel, :gerenteConsultor, :status)';
    //     $stmt = $this->conexao->prepare($query);
    //     $stmt->bindValue(':nome', $this->usuario->__get('nome'));
    //     $stmt->bindValue(':email', $this->usuario->__get('email'));
    //     $stmt->bindValue(':senha', $this->usuario->__get('senha'));
    //     $stmt->bindValue(':nivel', $this->usuario->__get('nivel'));
    //     $stmt->bindValue(':gerenteConsultor', $this->usuario->__get('gerenteConsultor'));
    //     $stmt->bindValue(':status', $this->usuario->__get('status'));
    //     $stmt->execute();
    //     return $this->conexao->lastInsertId();
    // }

    public function recuperar($idUsuario, $idConsultor = null)
    { //read
        $query = null;
        if (is_null($idConsultor)) {
            $queryNivel = "SELECT nivel FROM usuarios WHERE id = $idUsuario";
            $nivel = $this->conexao->ler($queryNivel)[0];
            if ($nivel->nivel == 2) {
                $query = "SELECT * FROM usuarios WHERE gerente = $idUsuario AND status = 1";
            } else if ($nivel->nivel == 3) {
                $query = "SELECT * FROM usuarios WHERE nivel = 2 AND status = 1";
            }
        } else {
            $query =
                "SELECT usuarios.id, leads.*, status_lead.cor, status_lead.status AS nome_stts_lead
                        FROM leads 
                            LEFT JOIN usuarios 
                            ON (usuarios.id = leads.id_usuario_consultor)
                            LEFT JOIN status_lead
                            ON (status_lead.id = leads.status)
                        WHERE usuarios.id = $idConsultor
                        ORDER BY leads.data DESC";
        }
        return $this->conexao->ler($query);
    }

    // public function atualizar($id, $log = false) {
    //     $query = 'UPDATE usuarios SET 
    //         nome = :nome, 
    //         email = :email, 
    //         senha = :senha, 
    //         nivel = :nivel, 
    //         gerente = :gerenteConsultor, 
    //         status = :status 
    //         WHERE id = :id;
    //     ';

    //     $stmt = $this->conexao->prepare($query);
    //     $stmt->bindValue(':nome', $this->usuario->__get('nome'));
    //     $stmt->bindValue(':email', $this->usuario->__get('email'));
    //     $stmt->bindValue(':senha', $this->usuario->__get('senha'));
    //     $stmt->bindValue(':nivel', $this->usuario->__get('nivel'));
    //     $stmt->bindValue(':gerenteConsultor', $this->usuario->__get('gerenteConsultor'));
    //     $stmt->bindValue(':status', $this->usuario->__get('status'));
    //     $stmt->bindValue(':id', $id);
    //     $stmt->execute();

    // }

    // public function deletar($id) {
    //     $query = 'DELETE FROM usuarios WHERE id = :id;';
    //     $stmt = $this->conexao->prepare($query);
    //     $stmt->bindValue(':id', $id);
    //     $stmt->execute();
    // }

    // public function retornarNivel () {
    //     $query = "SELECT * FROM niveis";
    //     $stmt = $this->conexao->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    // // public function recuperarGerente ($id) {            
    // //     $query = "SELECT id, nome FROM usuarios WHERE nivel = 2 AND status = 1 $where";
    // //     $stmt = $this->conexao->prepare($query);
    // //     $stmt->execute();
    // //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // // }

    public function retornarStatus () {
        $query = "SELECT * FROM status_lead";
        return $this->conexao->ler($query);
    }
    

    // public function recuperarFiltro($query) { //filtro
    //     $stmt = $this->conexao->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }
}
