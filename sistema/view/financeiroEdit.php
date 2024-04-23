<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/financeiro.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'usuariosEdit';
if ((!empty($_POST['editId']) && !is_null($_POST['editId'])) || (!empty($_GET['editId']) && !is_null($_GET['editId']))) :
    $id = empty($_POST['editId']) ? $_GET['editId'] : $_POST['editId'];

    function retornarStatus($stts)
    {
        switch ($stts) {
            case 1:
                return array("status" => "Ativo", "cor" => "#32CD32");
                break;

            case 0:
                return array("status" => "Inativo", "cor" => "#A52A2A");
                break;
        }
    }
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

        <!-- ESTILO -->
        <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

        <!-- SCRIPT -->
        <script>
            var pagina = '<?= $pagina ?>';
        </script>
        <script src="/sistema/js/script.js"></script>

        <!-- FONT AWEASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Página incial | Sistema Athena</title>
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
                        <fieldset>
                            <form method="post" action="/sistema/controller/financeiro.controller.php">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="nome_pagador">Nome do pagador</label>
                                        <input type="text" name="nome_pagador" id="nome_pagador" placeholder="Nome do pagador" required value="<?= $financeiroService->recuperar($id)[0]->nome_pagador ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="nome_recebedor">Nome do recebedor</label>
                                        <input type="text" name="nome_recebedor" id="nome_recebedor" placeholder="Nome do recebedor" required value="<?= $financeiroService->recuperar($id)[0]->nome_recebedor ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="tipo_pagamento">Tipo de pagamento</label>
                                        <select name="tipo_pagamento" id="tipo_pagamento" required>
                                            <?php foreach ($tipos_pagamento as $tipo_pag) : ?>
                                                <option <?= $tipo_pag == $financeiroService->recuperar($id)[0]->tipo_pagamento ? 'selected' : ''; ?> value="<?= $tipo_pag ?>"><?= $tipo_pag ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="preco">Preço</label>
                                        <input type="text" name="preco" id="preco" placeholder="000,000,000" required value="<?= $financeiroService->recuperar($id)[0]->preco ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="valor_entrada">Valor de entrada</label>
                                        <input type="text" name="valor_entrada" id="valor_entrada" placeholder="Valor de entrada" required value="<?= $financeiroService->recuperar($id)[0]->valor_entrada ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="num_parcelas">Número de parcelas</label>
                                        <input type="number" name="num_parcelas" id="num_parcelas" placeholder="Número de parcelas" required value="<?= $financeiroService->recuperar($id)[0]->num_parcelas ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="val_parcela">Valor da parcela</label>
                                        <input type="text" name="val_parcela" id="val_parcela" placeholder="Valor da parcela" required value="<?= $financeiroService->recuperar($id)[0]->val_parcela ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="val_juros">Juros (%)</label>
                                        <input type="text" name="val_juros" id="val_juros" placeholder="0.1" required value="<?= $financeiroService->recuperar($id)[0]->val_juros ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="data">Data</label>
                                        <input type="text" name="data" id="data" placeholder="Data" disabled value="<?= $financeiroService->recuperar($id)[0]->data ?>">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <input type="hidden" name="acao" value="atualizar">
                                    <input type="hidden" name="id" value="<?= $financeiroService->recuperar($id)[0]->id ?>">
                                    <button type="submit" class="btn btn-dark btn-block btn-sm">Salvar</button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </section>
                <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>

            </div>
        </div>
    </body>

    </html>

    <script>
        $(document).ready(function() {
            verificaConsultor()
        })

        function verificaConsultor() {
            if ('<?= $usuarioService->recuperar($id)[0]->nivel ?>' != 1) {
                document.getElementById('contain-gerentes').style.display = 'none'
            }
        }
    </script>
<?php endif; ?>