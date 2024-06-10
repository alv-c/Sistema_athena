<?php
date_default_timezone_set('America/Sao_Paulo');
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/model/pdo.model.php';

class GlobalObj
{
    private $conexao;

    public function __construct(Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function ler($sql)
    {
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function inserir($tabela, $dados)
    {
        try {
            $campos = implode(", ", array_keys($dados));
            $valores = ":" . implode(", :", array_keys($dados));
            $sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($dados);
            return $this->conexao->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($tabela, $condicoes)
    {
        try {
            $sql = "DELETE FROM $tabela WHERE $condicoes";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar($tabela, $dados, $condicoes)
    {
        try {
            $sql = "UPDATE $tabela SET ";
            foreach ($dados as $coluna => $valor) {
                $sql .= "$coluna = :$coluna, ";
            }
            $sql = rtrim($sql, ', '); // Remove a última vírgula
            $sql .= " WHERE $condicoes";
            $stmt = $this->conexao->prepare($sql);
            foreach ($dados as $coluna => $valor) {
                $stmt->bindValue(":$coluna", $valor);
            }
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function removerCaracteresEsp($string)
    {
        $regex = '/[^a-zA-Z0-9\s]/u';
        $string_sem_especiais = preg_replace($regex, '', $string);
        return $string_sem_especiais;
    }

    public function filtroDados($table, $filters)
    {
        $sql = "SELECT $table.* FROM $table WHERE ";
        $conditions = [];
        foreach ($filters as $column => $value) {
            if (is_array($value)) {
                $conditions[] = "$table.$column BETWEEN '$value[0]' AND '$value[1]'";
            } else if (is_numeric($value)) {
                $value = (int)$value;
                if ($value) $conditions[] = "$table.$column = '$value'";
            } else {
                if (empty($value)) continue;
                $conditions[] = "$table.$column LIKE '%$value%'";
            }
        }
        $sql .= implode(" AND ", $conditions);
        return $this->ler($sql);

        // **** Exemplo de uso FILTRO ****
        // Definindo os filtros
        // $filters = [
        //     'nome' => 'João',
        //     'idade' => 25,
        //     'data_nascimento' => ['2020-01-01', '2024-01-01'] // Intervalo de datas
        // ];

        // Chamando o método de filtragem
        // $resultados = $this->filtroDados('tabela', $filters);

        // Exibindo os resultados
        // foreach ($resultados as $resultado) {
        // fazer algo com os resultados
        // }
    }

    public function criarNotifFollow ()
    {
        try {
            $sql = "SELECT id FROM followup WHERE DATE(data) = CURDATE() AND status = 0";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
}

$conexaoModel = new Conexao();
$conexao = new GlobalObj($conexaoModel);

/**
 * Exemplo de uso:
 */

// Exemplo de leitura **
// $usuarios = $conexao->ler(query);
// print_r($usuarios);

// Exemplo de inserção **
// $novo_usuario_id = $conexao->inserir('sua_tabela', ['nome' => 'Fulano', 'email' => 'fulano@example.com']);
// echo "Novo usuário inserido com ID: $novo_usuario_id\n";

// Exemplo de atualização **
// $conexao->atualizar("sua_tabela", ['nome' => 'Beltrano'], "id = :id");

// Exemplo de exclusão **
// $conexao->excluir("sua_tabela", "id = :id");