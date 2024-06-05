<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
    if(isset($_GET['arq']) && isset($_GET['users'])) {
        $array_obj = json_decode($_GET['arq']);
        $array_usuarios = explode(',', $_GET['users']);
        $array_itens = array();
        foreach($array_obj as $index => $obj) {
            if((bool)count((array)$obj)) {
                array_push($array_itens, (array)$obj);
            }
        }
        $i = 0;
        foreach($array_itens as $item) {
            $item['data_aux'] = date('Y-m-d');
            $item['id_usuario_consultor'] = $array_usuarios[$i];
            $item['midia'] = 8; //midia lista
            $i ++;
            if(!array_key_exists($i, $array_usuarios)) $i = 0;
            try {
                $conexao->inserir('leads', $item);
            } catch (Error $e) {
                return $e->getMessage();
            }
        }
    } else {
        return false;
    }
?>