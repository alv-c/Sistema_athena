
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
        var location = 'data:application/vnd.ms-excel;base64,';
        var excelTemplate = '<html> ' +
            '<head> ' +
            '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
            '</head> ' +
            '<body> ' +
            document.getElementById(`${id}`).innerHTML +
            '</body> ' +
            '</html>'
        window.location.href = location + window.btoa(excelTemplate);
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
        console.log(inputs)
        if (btn.checked == true) {
            containFllw.style.display = 'flex'
            aviso.style.display = 'block'
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute("required", "true");
            }
        } else {
            containFllw.style.display = 'none';
            aviso.style.display = 'none'
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute("required", "false");
            }
        }
    }
}