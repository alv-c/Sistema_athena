<!-- Modal -->
<div class="modal fade" id="modal_confirm_pag" tabindex="-1" role="dialog" aria-labelledby="modal_confirm_pagTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="alert alert-warning alert-dismissible fade show w-100" role="alert">
                    <strong>Confirmação de pagamento</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja <strong>confirmar o pagamento</strong> da <strong>parcela de número</strong> <span id="num_parc"></span>
                no valor de <strong>R$</strong><span id="val_parcel"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-warning" id="btn-submit-pagar-parcel" onclick="">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal_confirm_pag').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let form = button.data('form')
        let numParcela = button.data('num-titulo')
        let valParcela = button.data('val-parc')
        $("#btn-submit-pagar-parcel").attr('onclick', `submitFormPagarParcela(${form})`);
        $("#num_parc").html(`<strong>${numParcela}</strong>`);
        $("#val_parcel").html(`<strong>${valParcela}</strong>`);
    });
</script>