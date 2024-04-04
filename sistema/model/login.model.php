<?php

    class Login {
        private $email = null;
        private $senha = null;

        public function __construct ($email = null, $senha = null) {
            $this->email = $email;
            $this->senha = $senha;
        }

        public function __get($attr) {
            return $this->$attr;
        }
    }
