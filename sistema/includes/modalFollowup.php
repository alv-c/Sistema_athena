<!-- Modal -->
<div class="modal fade" id="modalFollowup" tabindex="-1" role="dialog" aria-labelledby="modalFollowupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFollowupTitleHeader">Followups</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0;">


                <div class="pt-2 pb-4" style="padding: 0 23px 0 13px;">
                    
                    <?php 
                        $queryFlw = '';
                        switch($usuarioSessao->nivel) {
                            case 1:
                                $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead
                                    FROM followup FLW
                                        LEFT JOIN usuarios USR
                                            ON (USR.id = FLW.id_usuario)
                                        LEFT JOIN leads LEADS
                                            ON (LEADS.id = FLW.id_lead)
                                    WHERE FLW.data >= CURDATE()
                                        AND FLW.id_usuario = $usuarioSessao->id
                                    ORDER BY LEADS.nome ASC";
                            break;

                            case 2:
                                $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead
                                    FROM followup FLW
                                        LEFT JOIN usuarios USR
                                            ON (USR.id = FLW.id_usuario)
                                        LEFT JOIN leads LEADS
                                            ON (LEADS.id = FLW.id_lead)
                                    WHERE FLW.data >= CURDATE()
                                        AND USR.gerente = $usuarioSessao->id 
                                        OR FLW.id_usuario = $usuarioSessao->id 
                                    ORDER BY LEADS.nome ASC";
                            break;

                            case 3:
                                $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead
                                    FROM followup FLW
                                        LEFT JOIN usuarios USR
                                            ON (USR.id = FLW.id_usuario)
                                        LEFT JOIN leads LEADS
                                            ON (LEADS.id = FLW.id_lead)
                                    WHERE FLW.data >= CURDATE()
                                    ORDER BY LEADS.nome ASC";
                            break;
                        }

                        // if ($usuarioSessao->nivel == 1) {

                        // } else if ($usuarioSessao->nivel == 2) {

                        // } else if ($usuarioSessao->nivel == 3) {

                        // }
                        echo '<pre>';
                        print_r($conexao->ler($queryFlw));
                        echo '</pre>';
                    ?>

                </div>

            
            </div>
            <div class="modal-footer d-block">
                <form id="form-followup">
                    <input type="hidden" name="id_usuario" value="<?= $usuarioSessao->id ?>">
                    <input type="hidden" name="nivel_usuario" value="<?= $usuarioSessao->nivel ?>">
                    <div class="row no-margin-padding w-100">
                        <div class="col-md-5 col-sm-12 no-margin-padding px-md-1 py-sm-2">
                            <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição followup" required></textarea>
                        </div>
                        <div class="col-md-4 col-sm-12 no-margin-padding px-md-1 py-sm-2 py-2">
                            <input type="date" name="data" id="data" class="form-control" required>
                        </div>
                        <div class="col-md-3 col-sm-12 no-margin-padding px-md-1 py-sm-2 py-2">
                            <button type="button" class="btn btn-dark btn-block" onclick="insertFollowup('form-followup')">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>