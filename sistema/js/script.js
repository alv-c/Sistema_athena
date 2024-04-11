
$(document).ready(function () {
    $('.initfadeOut').fadeOut()
})

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
                    'targets': [2],
                    'orderable': false,
                }
            ],
        });
    });
}