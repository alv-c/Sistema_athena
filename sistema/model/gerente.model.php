<?php
    class Gerente {
        private $id = null;
        private $consultores = array();

        public function __construct ($id = null) {
            $this->id = $id;
        }

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $valor) {
            $this->$attr = $valor;
        }
    }
