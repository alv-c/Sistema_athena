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
                    <label for="tipo_filtro" style="font-size: 12px; margin-bottom: 3px;">
                        <strong>Tipo de filtro:</strong>
                    </label>
                    <div class="input-group mb-3">
                        <select id="tipo_filtro" class="form-control" onchange="tipoCampoFiltroFollow(this.value)">
                            <option value="1" selected>Dia/Mês/Ano</option>
                            <option value="2">Dia</option>
                            <option value="3">Mês</option>
                            <option value="4">Ano</option>
                        </select>
                    </div>

                    <label for="filtro-follow-data" style="font-size: 12px; margin-bottom: 3px;">
                        <strong>Filtro por data:</strong>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" id="input-follow-data_1" class="form-control input_filtro_data" aria-describedby="filtro-follow-data" placeholder="00/00/0000">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" id="filtro-follow-data" onclick="filterFollowUp(document.getElementById('input-follow-data_1').value)">Filtrar</button>
                            <button class="btn btn-danger" type="button" onclick="filterFollowUp(null)">Limpar</button>
                        </div>
                    </div>

                </div>
                <div id="itens_followup" style="height: 100%; max-height: 300px; overflow-y: auto; padding: 30px 15px 5px;"></div>
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