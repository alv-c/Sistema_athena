<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/financeiro.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'novoFinanceiro';

$numero_parcelas = array(1, 2, 3, 4, 5);
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

    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- SELECT 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- ESTILO -->
    <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

    <!-- SCRIPT -->
    <script>
        var pagina = '<?= $pagina ?>';
    </script>
    <script src="/sistema/js/script.js"></script>

    <!-- FONT AWEASOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Inserir usuário | Sistema Athena</title>
</head>

<body>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
    <div class="wrapper">
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
        <div id="content">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>
            <!-- SESSÕES -->
            <section class="view-lead">
                <div class="contain">
                    <?php if (isset($_GET['idLeadFinan'])) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Redirecionamento bem sucedido!</strong>
                            <br> <strong>Atenção!</strong> Ao finalizar a venda, você foi redirecionado para a geração do registro financeiro do mesmo.
                        </div>
                    <?php endif; ?>
                    <fieldset>
                        <form method="post" action="/sistema/controller/financeiro.controller.php">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="id_pagador">Nome do pagador</label>
                                    <select name="id_pagador" id="id_pagador" required>
                                        <option hidden value="">Selecione o pagador</option>
                                        <?php foreach ($financeiroService->recuperarPagadores(['id' => $usuarioSessao->id, 'nivel' => $usuarioSessao->nivel]) as $pagador) : ?>
                                            <?php if(isset($_GET['idLeadFinan']) && $_GET['idLeadFinan'] != $pagador->id) continue; ?>
                                            <option value="<?= $pagador->id ?>" <?= (isset($_GET['idLeadFinan']) && $_GET['idLeadFinan'] == $pagador->id) ? 'selected' : ''; ?>>
                                                <?= $pagador->nome ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="id_recebedor">Nome do recebedor</label>
                                    <select name="id_recebedor" id="id_recebedor" required>
                                        <option hidden value="">Selecione o recebedor</option>
                                        <?php foreach ($financeiroService->recuperarRecebedores(['id' => $usuarioSessao->id, 'nivel' => $usuarioSessao->nivel]) as $recebedor) : ?>
                                            <option value="<?= $recebedor->id ?>"><?= $recebedor->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tipo_pagamento">Pagamento de intermediação</label>
                                    <select name="tipo_pagamento" id="tipo_pagamento" required onchange="ajustarParcela(this), calcularParcela()">
                                        <?php foreach ($tipos_pagamento as $tipo_pag) : ?>
                                            <option value="<?= $tipo_pag ?>"><?= $tipo_pag ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="preco">Valor geral de venda</label>
                                    <input type="text" name="preco" id="preco" placeholder="000,000,000" required onkeyup="calcularParcela()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="valor_entrada">Valor de comissão</label>
                                    <input type="text" name="valor_entrada" id="valor_entrada" placeholder="Valor de entrada" required readonly>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="num_parcelas">Número de parcelas</label>
                                    <select name="num_parcelas" id="num_parcelas" required onchange="calcularParcela()">
                                        <?php foreach ($numero_parcelas as $parcelas) : ?>
                                            <option value="<?= $parcelas ?>"><?= $parcelas ?> <?= $parcelas == 1 ? 'Parcela' : 'Parcelas'; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="val_parcela">
                                        Valor da parcela
                                        <span class="badge badge-warning" style="font-size: 11px;">(Comissão)</span>
                                    </label>
                                    <input type="text" name="val_parcela" id="val_parcela" placeholder="Valor da parcela" required readonly>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="data">Data do registro</label>
                                    <input type="text" name="data" class="input_data_hora input_filtro_data" id="data" placeholder="Data do registro" value="<?= date('d/m/Y',  strtotime(date('Y-m-d'))) ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="dia_vencimento">Dia do vencimento</label>
                                    <input type="number" min="1" max="31" name="dia_vencimento" id="dia_vencimento" placeholder="Dia do vencimento" value="1" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="comentario">Comentário</label>
                                    <textarea name="comentario" id="comentario" placeholder="Comentário"></textarea>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="hidden" name="acao" value="inserir">
                                <button type="submit" class="btn btn-dark btn-block btn-sm">Salvar</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </section>
            <script>
                $(document).ready(function() {
                    /**
                     * SELECT 2 (SELECT COM BUSCA)
                     */
                    $("#id_recebedor").select2();
                })
            </script>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>
        </div>
    </div>
</body>
</html>