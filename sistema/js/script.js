function finalizarFollow(id) {
    $.ajax({
        url: "/sistema/includes/finalizarFollow.php",
        data: { 'data_id': `${id}` },
        type: 'GET',
        success: function (result) {
            location.reload();
        }
    });
}

function redirecionar(caminho) {
    window.location.href = caminho;
}

$(document).ready(function () {
    $('.initfadeOut').fadeOut()

    // datatable-followup
    new DataTable('#table-follow-modal', {
        language: {
            info: 'Página _PAGE_ de _PAGES_',
            infoEmpty: 'Nenhum registro encontrado!',
            infoFiltered: '(_MAX_ registros encontrados.)',
            lengthMenu: '_MENU_ Número de registros',
            zeroRecords: 'Nenhum registro encontrado!',
            search: '',
            searchPlaceholder: 'Buscar',
            paginate: {
                "next": "Avançar",
                "previous": "Voltar"
            }
        },
        paging: true,
        scrollCollapse: false,
        scrollY: '400px',
        order: [],
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
            }
        ],
    });
})

$(document).on('shown.bs.modal', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
});

let confirmDel = (name, modulo, dataForm) => {
    $('#modalDelete').modal('show')
    document.getElementById('nameDel').innerHTML = name
    document.getElementById('moduloDel').innerHTML = modulo
    document.getElementById('modalDelete').setAttribute("data-form", dataForm)
}

let submitFormDelLead = () => {
    let dataForm = document.getElementById('modalDelete').getAttribute("data-form")
    document.querySelector(`form[data-form="${dataForm}"]`).submit()
}

let selectManager = (value) => {
    if (value == 1) {
        $('.contain-input-consultor').fadeIn()
    } else {
        $('.contain-input-consultor').fadeOut()
    }
}

//index
if (pagina == 'index') {
    $(document).ready(function () {
        // dataTable
        new DataTable('#tabela-leads', {
            language: {
                info: 'Página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro encontrado!',
                infoFiltered: '(_MAX_ registros encontrados.)',
                lengthMenu: '_MENU_ Número de registros',
                zeroRecords: 'Nenhum registro encontrado!',
                search: '',
                searchPlaceholder: 'Buscar',
                paginate: {
                    "next": "Avançar",
                    "previous": "Voltar"
                }
            },
            paging: true,
            scrollCollapse: false,
            scrollY: '500px',
            order: [],
            columnDefs: [
                {
                    'targets': [6],
                    'orderable': false,
                }
            ],
        });
    });
}

if (pagina == 'usuarios') {
    $(document).ready(function () {
        // dataTable
        new DataTable('#tabela-usuarios', {
            language: {
                info: 'Página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro encontrado!',
                infoFiltered: '(_MAX_ registros encontrados.)',
                lengthMenu: '_MENU_ Número de registros',
                zeroRecords: 'Nenhum registro encontrado!',
                search: '',
                searchPlaceholder: 'Buscar',
                paginate: {
                    "next": "Avançar",
                    "previous": "Voltar"
                }
            },
            paging: true,
            scrollCollapse: false,
            scrollY: '500px',
            order: [],
            columnDefs: [
                {
                    'targets': [4],
                    'orderable': false,
                }
            ],
        });
    });
}

if (pagina == 'gerente') {
    $(document).ready(function () {
        // dataTable
        new DataTable('#tabela-gerentes', {
            language: {
                info: 'Página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro encontrado!',
                infoFiltered: '(_MAX_ registros encontrados.)',
                lengthMenu: '_MENU_ Número de registros',
                zeroRecords: 'Nenhum registro encontrado!',
                search: '',
                searchPlaceholder: 'Buscar',
                paginate: {
                    "next": "Avançar",
                    "previous": "Voltar"
                }
            },
            paging: true,
            scrollCollapse: false,
            scrollY: '500px',
            order: [],
            columnDefs: [
                {
                    'targets': [3],
                    'orderable': false,
                }
            ],
        });
    });
}

if (pagina == 'exportar_lead') {
    function exportToExcel(id) {
        var table_div = document.getElementById(`${id}`);
        var blobData = new Blob(['\ufeff' + table_div.outerHTML], { type: 'application/vnd.ms-excel' });
        var url = window.URL.createObjectURL(blobData);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Meu arquivo Excel'
        a.click();
    }
}

if (pagina == 'financeiro') {
    $(document).ready(function () {
        // dataTable
        new DataTable('#tabela-financeiro', {
            language: {
                info: 'Página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro encontrado!',
                infoFiltered: '(_MAX_ registros encontrados.)',
                lengthMenu: '_MENU_ Número de registros',
                zeroRecords: 'Nenhum registro encontrado!',
                search: '',
                searchPlaceholder: 'Buscar',
                paginate: {
                    "next": "Avançar",
                    "previous": "Voltar"
                }
            },
            paging: true,
            scrollCollapse: false,
            scrollY: '500px',
            order: [],
            columnDefs: [
                {
                    'targets': [4],
                    'orderable': false,
                }
            ],
        });
    });
}

if (pagina == 'edit') {
    function marcarFollowp(btn) {
        let containFllw = document.getElementById('contain-confirm-follow');
        let inputs = document.getElementsByClassName('required-js');
        let aviso = document.getElementById('aviso-follow');
        if (btn.checked == true) {
            containFllw.style.display = 'flex'
            aviso.style.display = 'block'
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute("required", "true");
            }
            document.getElementById('anotacao').setAttribute("required", "true")
        } else {
            containFllw.style.display = 'none';
            aviso.style.display = 'none'
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute("required", "false");
            }
            document.getElementById('anotacao').removeAttribute("required")
        }
    }
}

if (pagina == 'novoFinanceiro' || pagina == 'financeiroEdit') {
    window.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById("preco").addEventListener("input", function () {
            var valorOriginal = parseFloat(this.value);
            if (!isNaN(valorOriginal)) {
                var desconto = valorOriginal * 0.05;
                document.getElementById("valor_entrada").value = desconto.toFixed(2);
            } else {
                document.getElementById("valor_entrada").value = "";
            }
        });
    });

    function ajustarParcela(campo) {
        let inputNumParc = document.getElementById('num_parcelas');
        if (campo.value == 'Parcelamento') {
            inputNumParc.style.pointerEvents = 'auto'
        } else {
            inputNumParc.value = 1;
            inputNumParc.style.pointerEvents = 'none'
        }
    }

    function calcularParcela() {
        let numParcelas = document.getElementById('num_parcelas').value;
        let valorComissai = document.getElementById('valor_entrada').value;
        let campoValorParcela = document.getElementById('val_parcela');

        if (numParcelas != '' && valorComissai != '') {
            let valor_parcela = (valorComissai / numParcelas);
            valor_parcela = valor_parcela.toFixed(2);
            campoValorParcela.value = valor_parcela;
        } else {
            campoValorParcela.value = 0.00;
        }
    }

    if (pagina == 'financeiroEdit') {
        $(document).ready(function () {
            // dataTable
            new DataTable('#tabela-parcelas', {
                language: {
                    info: 'Página _PAGE_ de _PAGES_',
                    infoEmpty: 'Nenhum registro encontrado!',
                    infoFiltered: '(_MAX_ registros encontrados.)',
                    lengthMenu: '_MENU_ Número de registros',
                    zeroRecords: 'Nenhum registro encontrado!',
                    search: '',
                    searchPlaceholder: 'Buscar',
                    paginate: {
                        "next": "Avançar",
                        "previous": "Voltar"
                    }
                },
                paging: true,
                scrollCollapse: false,
                scrollY: '500px',
                order: [],
                columnDefs: [
                    {
                        'targets': [6],
                        'orderable': true,
                    }
                ],
            });
        });

        function submitFormPagarParcela(form) {
            if (form != null && form != undefined) {
                form.submit();
            }
        }
    }
}

if (pagina == 'importar_lead') {
    function enviarJSONParaPHP(jsonData, usuarios, url) {
        var xhr = new XMLHttpRequest();
        jsonData = JSON.stringify(jsonData);
        xhr.open("GET", `${url}?arq=${jsonData}&users=${usuarios}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (JSON.parse(xhr.responseText).retorno) {
                    $('#modal_sucesso').modal('show');
                } else {
                    $('#modal_erro').modal('show');
                }
            }
        };
        xhr.send();
    }
}

if (pagina == 'dashboard') { }

if (pagina == 'usuariosLeads') {
    $(document).ready(function () {
        // dataTable
        new DataTable('#tabela-usuarios-leads', {
            language: {
                info: 'Página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro encontrado!',
                infoFiltered: '(_MAX_ registros encontrados.)',
                lengthMenu: '_MENU_ Número de registros',
                zeroRecords: 'Nenhum registro encontrado!',
                search: '',
                searchPlaceholder: 'Buscar',
                paginate: {
                    "next": "Avançar",
                    "previous": "Voltar"
                }
            },
            paging: true,
            scrollCollapse: false,
            scrollY: '500px',
            order: [],
            columnDefs: [
                {
                    'targets': [3],
                    'orderable': false,
                }
            ],
        });
    });
}