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
                    switch ($usuarioSessao->nivel) {
                        case 1:
                            $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead, LEADS.telefone
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
                            $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead, LEADS.telefone
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
                            $queryFlw = "SELECT FLW.id, FLW.descricao, FLW.data, USR.nome AS nome_usuario, LEADS.nome AS nome_lead, LEADS.telefone
                                    FROM followup FLW
                                        LEFT JOIN usuarios USR
                                            ON (USR.id = FLW.id_usuario)
                                        LEFT JOIN leads LEADS
                                            ON (LEADS.id = FLW.id_lead)
                                    WHERE FLW.data >= CURDATE()
                                    ORDER BY LEADS.nome ASC";
                            break;
                    }
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-follow-modal" style="font-size: 12px; font-weight: 500;">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($conexao->ler($queryFlw) as $key => $follow) : ?>
                                    <tr>
                                        <td scope="row"><?= $follow->nome_lead ?></td>
                                        <td class="col-fone"><?= $follow->telefone ?></td>
                                        <td><?= $follow->descricao ?></td>
                                        <td><?= date('d/m/Y H:i:s',  strtotime($follow->data)) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>