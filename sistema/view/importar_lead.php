<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'importar_lead';

$dia = date('d') - 1;
$mes = date('m');
$ano = date('Y');
$data = mktime(0, 0, 0, $mes, $dia, $ano);
$data_dia_ant = date('Y-m-d', $data);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/sistema/images/favi.png">

    <!-- BOOTSTRAP4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- xlsx full -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- ESTILO -->
    <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

    <!-- MULTISELECT JS -->
    <link rel="stylesheet" type="text/css" href="/sistema/js/multiselect_js/multi-select.css">
    <script src="/sistema/js/multiselect_js/jquery.multi-select.js"></script>

    <!-- JS -->
    <script>
        var pagina = '<?= $pagina ?>';
    </script>
    <script src="/sistema/js/script.js"></script>

    <!-- FONT AWEASOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Importar lead | Sistema Athena</title>
</head>

<body>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modal_sucesso.php' ?>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modal_erro.php' ?>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modal_preencha_corret.php' ?>
    <div class="wrapper">
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
        <div id="content">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>

            <!-- SESSÕES -->
            <section class="sessao-tabela">
                <span class="h5">Importação de leads</span>
                <div class="contain pt-4">

                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Instruções de uso:</h4>
                        <hr>
                        <span>1º Faça o <strong>download da planilha</strong> de exemplo.</span>
                        <hr>
                        <span>2º <strong>Selecione o/s consultor/s</strong> que irão receber os leads importados via Excel.</span>
                        <hr>
                        <span>
                            3º Selecione a planilha a ser importada, seguindo as regras de estrutura de colunas da planilha exemplar. <br>
                            <strong>(Colunas NOME, TELEFONE E EMAIL)</strong>
                        </span>
                    </div>

                    <label for="btn-down-plani" class="pt-3 d-block text-uppercase">Download planilha exemplar</label>
                    <a href='/sistema/files/planilha-exemplo.xlsx' id="btn-down-plani" class="btn btn-dark text-white" download="planilha-exemplo.xlsx">
                        <i class="fas fa-file-excel"></i>
                        Download
                    </a>

                    <div>
                        <label for="meu_seletor" class="pt-3 d-block text-uppercase">Selecione o corretor</label>
                        <div class="d-flex flex-nowrap pb-2" style="gap: 10px;">
                            <a href='#' class="btn btn-sm btn-success text-white" id='select-all'>Selecionar todos</a>
                            <a href='#' class="btn btn-sm btn-dark text-white" id='deselect-all'>Desfazer todos</a>
                        </div>
                        <select multiple="multiple" id="meu_seletor" name="meu_seletor[]" required>
                            <?php foreach ($leadService->retornarConsultores($usuarioSessao->id, $usuarioSessao->nivel) as $item) : ?>
                                <option value="<?= $item->id ?>"><?= $item->nome ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label for="data_file" class="label-file mt-3">SELECIONE O ARQUIVO</label> <!-- label indicadora -->
                    <label for="data_file" class="label-file custom">
                        <div class="ico">
                            <i class="fas fa-upload fa-2x"></i>
                        </div>
                        <span id="nome_arquivo">arquivo</span>
                    </label> <!-- label para formatar -->
                    <input type="file" id="data_file" accept=".xlsx" class="file-custom" required>
                    <button type="button" id="btn-importar" class="btn btn-sm btn-block btn-dark mt-4">IMPORTAR</button>
                </div>
            </section>

            <script>
                // XSLS-TO-JSON
                var XLSL_request;
                document.querySelector('#data_file').addEventListener('change', function() {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var arrayBuffer = this.result,
                            array = new Uint8Array(arrayBuffer),
                            binaryString = String.fromCharCode.apply(null, array);
                        var workbook = XLSX.read(binaryString, {
                            type: "binary"
                        });
                        var first_sheet_name = workbook.SheetNames[0];
                        var worksheet = workbook.Sheets[first_sheet_name];
                        XLSL_request = XLSX.utils.sheet_to_json(worksheet, {
                            raw: true
                        });
                    }
                    reader.readAsArrayBuffer(this.files[0]);
                });

                document.querySelector('#btn-importar').addEventListener('click', function() {
                    if (XLSL_request == undefined || !$('#meu_seletor').val().length) {
                        $('#modal_preencha_corret').modal('show');
                    } else {
                        enviarJSONParaPHP(
                            XLSL_request,
                            $('#meu_seletor').val(),
                            '/sistema/includes/importar_lead_excel.php'
                        );
                    }
                });

                /**
                 * *********************************************************************
                 */

                // MULTISELECT JS
                $('#meu_seletor').multiSelect();
                $('#select-all').click(function() {
                    $('#meu_seletor').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all').click(function() {
                    $('#meu_seletor').multiSelect('deselect_all');
                    return false;
                });

                //add nome arquivo importado no input file custom
                document.getElementById('data_file').onchange = function() {
                    document.getElementById('nome_arquivo').innerHTML = ''
                    document.getElementById('nome_arquivo').innerHTML = this.value
                };
            </script>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>
        </div>
    </div>
</body>

</html>