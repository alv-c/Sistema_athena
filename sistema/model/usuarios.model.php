<?php

class Usuario
{
    private $nome = null;
    private $email = null;
    private $senha = null;
    private $nivel = null;
    private $gerente = null;
    private $creci = null;
    private $status = null;

    public function __construct(array $post = [])
    {
        foreach ($post as $index => $attr) {
            $this->$index = $attr;
        }
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $valor)
    {
        $this->$attr = $valor;
    }
}
