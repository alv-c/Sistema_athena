<?php

    class Login {
        private $email = null;
        private $senha = null;

        public function __construct (array $post = []) {
            foreach ($post as $index => $attr) {
                $this->$index = $attr;
            }
        }

        public function __get($attr) {
            return $this->$attr;
        }
    }
