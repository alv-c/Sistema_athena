<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
if (isset($_GET['data_id'])) {
    try {
        $conexao->atualizar("followup", [
            'status' => 1,
        ], "id = {$_GET['data_id']}");
        return true;
    } catch (Error $e) {
        return $e->getMessage();
    }
}