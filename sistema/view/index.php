<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
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

    <!-- ESTILO -->
    <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

    <!-- JS -->
    <script src="/sistema/js/script.js"></script>

    <!-- FONT AWEASOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Página incial | Sistema Athen</title>
</head>

<body>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalDelete.php' ?>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
    <div class="wrapper">
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
        <div id="content">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>

            <!-- FILTROS -->
            <div class="filtros pb-2" id="filtros">
                <button class="btn-filter btn btn-dark btn-sm" onclick="window.location.href='/sistema/view/novoLead.php'">Novo Lead</button>
            </div>

            <!-- SESSÕES -->
            <section class="sessao-tabela pt-4">
                <div class="contain">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabela-leads">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Mídia</th>
                                    <th scope="col">Profissão</th>
                                    <th scope="col">Corretor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($arrayLeads as $key => $lead) { ?>
                                    <?php if ($usuarioSessao->nivel == 1) : ?>
                                        <?php if ($lead->id_usuario_consultor != $usuarioSessao->id) continue; ?>
                                    <?php endif; ?>
                                    <?php if ($usuarioSessao->nivel == 2) : ?>
                                        <?php if ($leadService->retornarGerenteConsultor($lead->id_usuario_consultor)[0]->gerente != $usuarioSessao->id) continue; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="row"><?= date('d/m/Y',  strtotime($lead->data)) ?></th>
                                        <td>
                                            <form method="post" action="/sistema/view/edit.php">
                                                <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                <button class="d-block text-left" type="submit"><?= $lead->nome ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="/sistema/view/edit.php">
                                                <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                <button class="d-block text-left" type="submit"><?= $lead->nome_midia ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="/sistema/view/edit.php">
                                                <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                <button class="d-block text-left" type="submit"><?= empty($lead->profissao) ? 'Não informado' : $lead->profissao ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="/sistema/view/edit.php">
                                                <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                <button class="d-block text-left" type="submit"><?= $lead->nome_corretor ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($leadService->retornarStatus() as $status) {
                                                if ($status->id == $leadService->recuperar($lead->id)[0]->status) {
                                                    echo "<div style='background: $status->cor; border-radius: 3px;' class='d-inline-block pt-1 pb-1 pl-2 pr-2 text-white'>$status->status</div>";
                                                    break;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="content-btn">
                                                <form method="post" action="/sistema/view/edit.php">
                                                    <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                    <input type="hidden" name="editarLead" value="true">
                                                    <button type="submit" class="editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </form>
                                                <?php if ($usuarioSessao->nivel == 3) : ?>
                                                    <form method="post" action="/sistema/controller/leads.controller.php" id="formDel" data-form="form-<?= $lead->id ?>">
                                                        <input type="hidden" name="id" value="<?= $lead->id ?>">
                                                        <input type="hidden" name="acao" value="deletar">
                                                        <button type="button" class="excluir" onclick="confirmDel('<?= $lead->nome ?>', 'lead', 'form-<?= $lead->id ?>')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>
        </div>
    </div>
</body>

</html>