<?php

    class Financeiro {
        // private $nome = null;
        // private $email = null;
        // private $senha = null;
        // private $nivel = null;
        // private $gerenteConsultor = null;
        // private $creci = null;
        // private $status = null;

        public function __construct (array $post = []) {
            foreach($post as $index => $attr) {
                $this->$index = $attr;
            }
            // $this->nome = $nome;
            // $this->email = $email;
            // $this->senha = $senha;
            // $this->nivel = $nivel;
            // $this->gerenteConsultor = $gerenteConsultor;
            // $this->creci = $creci;
            // $this->status = $status;
        }

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $valor) {
            $this->$attr = $valor;
        }
    }
