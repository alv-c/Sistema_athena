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

        .dataTables_scrollHeadInner {
            width: 100% !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active')
            });

            $("#telefone").mask('(00)00000-0000');
            $("#telefone2").mask('(00)00000-0000');
            $(".col-fone").mask('(00)00000-0000');
            $(".input_filtro_data").mask('00/00/0000');
            $(".input_hora").mask('00:00');
            // $('#preco').mask('000,000,000,000,000.00', {reverse: true});
            $('#valor_entrada').mask('000,000,000,000,000.00', {reverse: true});
            $('#val_parcela').mask('000,000,000,000,000.00', {reverse: true});
        });


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
    </script>
</footer>