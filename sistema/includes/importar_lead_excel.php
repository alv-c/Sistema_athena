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
    
        foreach($array_itens as $item) {
    
            $item['data_aux'] = date('Y-m-d');
            // print_r($item);
            // print_r($leadService);        
    
            $leadService->balanceador_leads($item);
    
            // try {
            //     $conexao->inserir('leads', $item);
            // } catch (Error $e) {
            //     return $e->getMessage();
            // }
        }
    }
?>