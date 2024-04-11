<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/pdo.model.php';

class Database
{
    private $conexao;

    public function __construct(Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function ler($sql)
    {
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function inserir($tabela, $dados)
    {
        $campos = implode(", ", array_keys($dados));
        $valores = ":" . implode(", :", array_keys($dados));
        $sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($dados);
        return $this->conexao->lastInsertId();
    }

    public function excluir($tabela, $condicoes)
    {
        $sql = "DELETE FROM $tabela WHERE " . implode(" AND ", $condicoes);
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute();
    }

    // public function atualizar($tabela, $dados, $condicoes)
    // {
    //     $valores = '';
    //     foreach ($dados as $chave => $valor) {
    //         $valores .= "$chave=:$chave, ";
    //     }
    //     $valores = rtrim($valores, ', ');
    //     $sql = "UPDATE $tabela SET $valores WHERE " . implode(" AND ", $condicoes);
    //     echo '<pre>';
    //     print_r($condicoes);
    //     echo '</pre>';
    //     echo "<h1>$sql</h1>";
    //     echo implode(" AND ", $condicoes);
    //     // $stmt = $this->conexao->prepare($sql);
    //     // return $stmt->execute($dados);
    // }

    function atualizar($tabela, $dados, $condicoes)
    {
        // Configurações do banco de dados
        // $dsn = "mysql:host=seu_host;dbname=seu_banco_de_dados;charset=utf8mb4";
        // $usuario = "seu_usuario";
        // $senha = "sua_senha";

        // Tentativa de conexão
        try {
            // $conexao = new PDO($dsn, $usuario, $senha);
            // $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Construção da consulta SQL
            $sql = "UPDATE $tabela SET ";
            foreach ($dados as $coluna => $valor) {
                $sql .= "$coluna = :$coluna, ";
            }
            $sql = rtrim($sql, ', '); // Remove a última vírgula
            $sql .= " WHERE $condicoes";

            // Preparação e execução da consulta
            $stmt = $this->conexao->prepare($sql);
            foreach ($dados as $coluna => $valor) {
                $stmt->bindValue(":$coluna", $valor);
            }
            $stmt->execute();

            // Retorna verdadeiro se a atualização for bem-sucedida
            return true;
        } catch (PDOException $e) {
            // Retorna falso em caso de erro e exibe a mensagem de erro
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
}

// Exemplo de uso:
$conexaoModel = new Conexao();
$conexao = new Database($conexaoModel);

// Exemplo de leitura **
// $usuarios = $conexao->ler(query);
// print_r($usuarios);

// Exemplo de inserção **
// $novo_usuario_id = $conexao->inserir('usuarios', ['nome' => 'Fulano', 'email' => 'fulano@example.com']);
// echo "Novo usuário inserido com ID: $novo_usuario_id\n";

// Exemplo de atualização **
// $conexao->atualizar('usuarios', ['nome' => 'Beltrano'], ['id' => 1]);

// Exemplo de exclusão **
// $conexao->excluir('usuarios', ['id' => 2]);