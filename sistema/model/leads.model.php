<?php

    class Lead {
        private $nome = null;
        private $telefone = null;
        private $telefone2 = null;
        private $email = null;
        private $profissao = null;
        private $data_nascimento = null;
        private $id_usuario_consultor = null;
        private $anotacao = null;
        private $midia = null;
        private $cpf = null;
        private $status = null;

        public function __construct (array $post = []) {
            foreach ($post as $index => $attr) {
                $this->$index = $attr;
            }
        }

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $valor) {
            $this->$attr = $valor;
        }
    }
