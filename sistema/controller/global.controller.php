<?php
class Database
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function ler($tabela, $condicoes = [], $order = '')
    {
        $sql = "SELECT * FROM $tabela";
        if (!empty($condicoes)) {
            $sql .= " WHERE " . implode(" AND ", $condicoes);
        }
        if (!empty($order)) {
            $sql .= " ORDER BY $order";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir($tabela, $dados)
    {
        $campos = implode(", ", array_keys($dados));
        $valores = ":" . implode(", :", array_keys($dados));
        $sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    public function excluir($tabela, $condicoes)
    {
        $sql = "DELETE FROM $tabela WHERE " . implode(" AND ", $condicoes);
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function atualizar($tabela, $dados, $condicoes)
    {
        $valores = '';
        foreach ($dados as $chave => $valor) {
            $valores .= "$chave=:$chave, ";
        }
        $valores = rtrim($valores, ', ');
        $sql = "UPDATE $tabela SET $valores WHERE " . implode(" AND ", $condicoes);
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }
}

// Exemplo de uso:
// $host = 'localhost';
// $dbname = 'nome_do_banco';
// $username = 'usuario';
// $password = 'senha';

// $db = new Database($host, $dbname, $username, $password);

// Exemplo de leitura **
// $usuarios = $db->ler('usuarios');
// print_r($usuarios);

// Exemplo de inserção **
// $novo_usuario_id = $db->inserir('usuarios', ['nome' => 'Fulano', 'email' => 'fulano@example.com']);
// echo "Novo usuário inserido com ID: $novo_usuario_id\n";

// Exemplo de atualização **
// $db->atualizar('usuarios', ['nome' => 'Beltrano'], ['id' => 1]);

// Exemplo de exclusão **
// $db->excluir('usuarios', ['id' => 2]);