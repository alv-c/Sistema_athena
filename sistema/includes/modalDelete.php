<!-- MODAL DELETE LEAD-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="titulomodalDelete" aria-hidden="true" data-form="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulomodalDelete">Operação de exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                TEM CERTEZA QUE DELEJA EXCLUIR O <span id="moduloDel"></span> <span id="nameDel"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="submitFormDelLead()">Sim</button>
            </div>
        </div>
    </div>
</div>