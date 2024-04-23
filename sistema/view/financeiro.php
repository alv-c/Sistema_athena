<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/financeiro.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'financeiro';
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

    <!-- JS -->
    <script>
        var pagina = '<?= $pagina ?>';
    </script>
    <script src="/sistema/js/script.js"></script>

    <!-- FONT AWEASOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <title>Financeiro | Sistema Athena</title>
</head>

<body>
    <?php //require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalDelete.php' 
    ?>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
    <div class="wrapper">
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
        <div id="content">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>

            <!-- FILTROS -->
            <div class="filtros pb-2" id="filtros">
                <?php if ($usuarioSessao->nivel >= 2) : ?>
                    <a href="novoFinanceiro.php" class="btn btn-dark btn-sm text-white">Novo registro</a>
                <?php endif; ?>
            </div>

            <!-- SESSÕES -->
            <section class="sessao-tabela pt-4">
                <div class="contain">
                    <div id="scroll">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tabela-usuarios">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome pagador</th>
                                        <th scope="col">Nome recebedor</th>
                                        <th scope="col">Tipo de pagamento</th>
                                        <?php if ($usuarioSessao->nivel == 3) : ?>
                                            <th scope="col">Operações</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arrayFinanceiro as $key => $financeiro) : ?>
                                        <tr>
                                            <td><?= $key ?></td>
                                            <td>
                                                <form method="post" action="/sistema/view/financeiroEdit.php">
                                                    <input type="hidden" name="editId" value="<?= $financeiro->id ?>">
                                                    <button type="submit" class="btn btn-success"><?= $financeiro->nome_pagador ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="/sistema/view/financeiroEdit.php">
                                                    <input type="hidden" name="editId" value="<?= $financeiro->id ?>">
                                                    <button type="submit" class="btn btn-success"><?= $financeiro->nome_recebedor ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="/sistema/view/financeiroEdit.php">
                                                    <input type="hidden" name="editId" value="<?= $financeiro->id ?>">
                                                    <button type="submit" class="btn btn-success"><?= $financeiro->tipo_pagamento ?></button>
                                                </form>
                                            </td>
                                            <?php if ($usuarioSessao->nivel == 3) : ?>
                                                <td>
                                                    <div class="d-flex flex-nowrap" style="gap: 10px;">
                                                        <form method="post" action="/sistema/controller/financeiro.controller.php" id="formDel" data-form="form-<?= $financeiro->id ?>">
                                                            <input type="hidden" name="id" value="<?= $financeiro->id ?>">
                                                            <input type="hidden" name="acao" value="deletar">
                                                            <button type="submit" class="excluir btn btn-danger" onclick="confirmDel('<?= $financeiro->id ?>', 'financeiro', 'form-<?= $financeiro->id ?>')">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>

                                                        <form method="post" action="./financeiroEdit.php">
                                                            <input type="hidden" name="editId" value="<?= $financeiro->id ?>">
                                                            <button type="submit" class="editar btn btn-warning">
                                                                <i class="fas fa-edit text-white"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>
        </div>
    </div>
</body>

</html>