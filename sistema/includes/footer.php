<footer>
    <!-- ESTILO DATATABLE -->
    <style>
        .dataTables_length label,
        .dataTables_info {
            font-size: 12px;
            font-family: 'Roboto', sans-serif !important;
            color: #1c1c1c;
        }

        .dataTables_length select {
            width: 50px;
            padding: 5px;
            background: #fff;
            border: none;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;
            font-size: 12px;
            outline: none;
            margin-right: 5px;
            cursor: pointer !important;
        }

        .dataTables_filter input {
            width: 180px;
            padding: 5px;
            background: #fff;
            border: none;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;
            font-size: 12px;
            outline: none;
        }

        .paginate_button {
            background: #dcdcdc !important;
            font-size: 13px !important;
            /* color: #fff !important; */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
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
            })

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active')
            });
            $('#contain-filters').css("display", "none")
            initFollow()

            $("#telefone").mask('(00)00000-0000');
            $("#telefone2").mask('(00)00000-0000');
            $(".input_filtro_data").mask('00/00/0000');
        });

        let initFollow = (id_usuario) => {
            let data = ['null'];
            $.get(`/sistema/includes/insertFollowup.php?data=${data}&id_usuario=<?= $usuarioSessao->id ?>`, function(data) {
                if (JSON.parse(data).length == 0) {
                    let contain = document.getElementById('itens_followup')
                    let spanVazio = document.createElement('span')
                    spanVazio.style.display = 'block'
                    spanVazio.style.textAlign = 'center'
                    spanVazio.style.fontSize = '18px'
                    spanVazio.style.fontWeight = '500'
                    spanVazio.style.fontFamily = 'sans-serif'
                    spanVazio.style.color = '#dcdcdc'
                    spanVazio.innerHTML = 'Nenhum registro encontrado!'
                    contain.appendChild(spanVazio)
                } else {
                    JSON.parse(data).forEach(function(item) {
                        returnItem(item)
                    })
                }
            })
        }

        let alterLabel = () => {
            let marginLeft = window.getComputedStyle(document.getElementById('sidebar'))
            let label = document.getElementById('label-navbar')
            if (marginLeft.marginLeft == '0px') {
                label.innerHTML = ''
                label.innerHTML = 'Expandir'
            } else {
                label.innerHTML = ''
                label.innerHTML = 'Esconder'
            }
        }

        let openFilters = () => {
            let display = $("#contain-filters").css("display")
            if (display == 'none') $('#contain-filters').fadeIn()
            else $('#contain-filters').fadeOut()
        }

        let insertFollowup = (id_form) => {
            let form = document.getElementById('form-followup')
            let dados = {
                "id_usuario": form.id_usuario.value,
                "nivel_usuario": form.nivel_usuario.value,
                "descricao": form.descricao.value,
                "data": form.data.value
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('descricao').value = ''
                    document.getElementById('data').value = ''
                    // contain
                    let contain = document.getElementById('itens_followup')
                    contain.innerHTML = ''
                    JSON.parse(this.responseText).forEach(function(item) {
                        returnItem(item)
                    })
                }
            }
            xhttp.open("GET", "/sistema/includes/insertFollowup.php?data=" + JSON.stringify(dados), true);
            xhttp.send();
        }

        let returnItem = (item) => {
            let contain = document.getElementById('itens_followup')
            // item
            let itemFollow = document.createElement('div')
            itemFollow.className = 'item-followUp'
            contain.appendChild(itemFollow)

            // CONTAIN BUTTON DEL
            let containDel = document.createElement('div')
            itemFollow.appendChild(containDel)

            // BUTTON DEL
            let buttonDel = document.createElement('button')
            buttonDel.className = 'btn btn-sm btn-danger'
            buttonDel.innerHTML = '<i class="fas fa-trash-alt"></i>'
            buttonDel.setAttribute("onclick", `delItemFollowup(${item['id']})`)
            containDel.appendChild(buttonDel)

            // span desc
            let spanDesc = document.createElement('span')
            spanDesc.className = 'spanDesc'
            spanDesc.innerHTML = item['descricao']
            itemFollow.appendChild(spanDesc)

            // contain span data
            let containSpanData = document.createElement('div')
            itemFollow.appendChild(containSpanData)

            // contain span icon
            let containIcon = document.createElement('div')
            containSpanData.appendChild(containIcon)

            // icon
            let icon = document.createElement('i')
            icon.className = 'far fa-calendar-alt'
            containIcon.appendChild(icon)

            // span data
            let spanData = document.createElement('span')
            spanData.className = 'spanData'
            spanData.innerHTML = item['data']
            containSpanData.appendChild(spanData)

            contain.appendChild(itemFollow)

            //estilos
            // ITEM
            itemFollow.style.position = 'relative'
            itemFollow.style.padding = '20px 12px 12px'
            itemFollow.style.marginBottom = '30px'
            itemFollow.style.borderRadius = '3px'
            itemFollow.style.boxShadow = 'rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px'
            itemFollow.setAttribute("data-filter", item['data'])

            // CONTAIN BUTTON DEL
            containDel.style.display = 'flex'
            containDel.style.justifyContent = 'flex-end'

            // BUTTON DEL
            buttonDel.style.position = 'absolute'
            buttonDel.style.top = '-15px'

            // SPAN DESC
            spanDesc.style.display = 'block'
            spanDesc.style.padding = '0 0 5px'
            spanDesc.style.fontSize = '14px'

            // CONTAIN SPAN DATA
            containSpanData.style.display = 'flex'
            containSpanData.style.flexWrap = 'nowrap'
            containSpanData.style.justifyContent = 'flex-start'
            containSpanData.style.alignItems = 'center'
            containSpanData.style.borderTop = '1px solid #dcdcdc'
            containSpanData.style.padding = '5px 0 0'

            // SPAN DATA
            spanData.style.display = 'block'
            spanData.style.fontWeight = '700'
            spanData.style.fontSize = '12px'
            spanData.style.paddingLeft = '10px'

            // CONTAIN SPAN ICON
            containIcon.style.display = 'flex'
            containIcon.style.justifyContent = 'center'
            containIcon.style.alignItems = 'center'
        }

        let tipoCampoFiltroFollow = (value) => {
            let input = document.getElementById('input-follow-data_1')
            input.value = ''
            switch (value) {
                case '1':
                    $(".input_filtro_data").mask('00/00/0000');
                    $(".input_filtro_data").attr("placeholder", "00/00/0000");
                    break

                case '2':
                    $(".input_filtro_data").mask('00');
                    $(".input_filtro_data").attr("placeholder", "Dia: 00");
                    break

                case '3':
                    $(".input_filtro_data").mask('00');
                    $(".input_filtro_data").attr("placeholder", "Mês: 00");
                    break

                case '4':
                    $(".input_filtro_data").mask('0000');
                    $(".input_filtro_data").attr("placeholder", "Ano: 0000");
                    break
            }
        }

        let filterFollowUp = (value) => {
            let data
            if (value != null) data = value
            let itens = document.getElementsByClassName('item-followUp')
            for (let i = 0; i < itens.length; i++) {
                if (value != null) {
                    if (itens[i].getAttribute("data-filter").indexOf(data) != -1) itens[i].style.display = 'block'
                    else itens[i].style.display = 'none'
                } else {
                    itens[i].style.display = 'block'
                }
            }
        }

        let delItemFollowup = (data) => {
            $.get(`/sistema/includes/insertFollowup.php?del=${data}&id_usuario=<?= $usuarioSessao->id ?>`, function(data) {
                let contain = document.getElementById('itens_followup')
                contain.innerHTML = ''
                JSON.parse(data).forEach(function(item) {
                    returnItem(item)
                })
            })
        }
    </script>
</footer>