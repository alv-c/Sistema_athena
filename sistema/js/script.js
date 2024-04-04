
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