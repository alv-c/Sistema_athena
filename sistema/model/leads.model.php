<?php

    class Lead {
        private $nome = null;
        private $telefone = null;
        private $telefone2 = null;
        private $email = null;
        private $profissao = null;
        private $consultor = null;
        private $anotacao = null;
        private $midia = null;
        private $status = null;

        public function __construct ($nome = null, $telefone = null, $telefone2 = null, $email = null, $profissao = null, $consultor = null, $anotacao = null, $midia = null, $status = null) {
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->telefone2 = $telefone2;
            $this->email = $email;
            $this->profissao = $profissao;
            $this->consultor = $consultor;
            $this->anotacao = $anotacao;
            $this->midia = $midia;
            $this->status = $status;
        }

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $valor) {
            $this->$attr = $valor;
        }
    }
