<?php

    class UsuarioService {
        private $conexao = null;
        private $usuario = null;

        public function __construct ($conexao, $usuario) {
            $this->conexao = $conexao->conectar();
            $this->usuario = $usuario;
        }

        public function inserir() {
            $query = 'INSERT INTO usuarios(nome, email, senha, nivel, gerente, creci, status)values(:nome, :email, :senha, :nivel, :gerenteConsultor, :creci, :status)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->usuario->__get('nome'));
            $stmt->bindValue(':email', $this->usuario->__get('email'));
            $stmt->bindValue(':senha', $this->usuario->__get('senha'));
            $stmt->bindValue(':nivel', $this->usuario->__get('nivel'));
            $stmt->bindValue(':gerenteConsultor', $this->usuario->__get('gerenteConsultor'));
            $stmt->bindValue(':creci', $this->usuario->__get('creci'));
            $stmt->bindValue(':status', $this->usuario->__get('status'));
            $stmt->execute();

            return $this->conexao->lastInsertId();
        }

        public function recuperar($id = null) { //read
            $query;
            if(is_null($id)) {
                $query = "SELECT * FROM usuarios";
            } else {
                $query = "SELECT * FROM usuarios WHERE id = $id";
            }
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function recuperarFiltro($query) { //filtro
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar($id) {
            $query = 'UPDATE usuarios SET 
                nome = :nome, 
                email = :email, 
                senha = :senha, 
                nivel = :nivel, 
                gerente = :gerenteConsultor, 
                creci = :creci, 
                status = :status 
                WHERE id = :id;
            ';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->usuario->__get('nome'));
            $stmt->bindValue(':email', $this->usuario->__get('email'));
            $stmt->bindValue(':senha', $this->usuario->__get('senha'));
            $stmt->bindValue(':nivel', $this->usuario->__get('nivel'));
            $stmt->bindValue(':gerenteConsultor', $this->usuario->__get('gerenteConsultor'));
            $stmt->bindValue(':creci', $this->usuario->__get('creci'));
            $stmt->bindValue(':status', $this->usuario->__get('status'));
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function deletar($id) {
            $query = 'DELETE FROM usuarios WHERE id = :id;';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function retornarNivel () {
            $query = "SELECT * FROM niveis";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function recuperarGerentes () {
            $query = "SELECT id, nome FROM usuarios WHERE nivel = 2 AND status = 1";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }