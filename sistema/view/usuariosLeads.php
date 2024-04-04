<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/gerente.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
if (!empty($_GET['idUser'])) :
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
        <script src="/sistema/js/script.js"></script>

        <!-- FONT AWEASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Gerente | Sistema Athena</title>
    </head>

    <body>
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
        <div class="wrapper">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
            <div id="content">
                <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>

                <!-- FILTROS -->
                <div class="filtros pb-2" id="filtros">
                    <button class="btn-filter btn btn-dark btn-sm" onclick="openFilters()">Filtros</button>
                    <form method="post" action="usuariosLeads.php?idUser=<?= $_GET['idUser'] ?>">
                        <input type="hidden" name="acao" value="filtrar">
                        <div class="contain-filters mt-4 p-3 bg-white" id="contain-filters">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="nome" class="pt-2">Pesquisa por nome:</label>
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Pesquisar nome" value="<?= isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="telefone" class="pt-2">Pesquisa por telefone:</label>
                                        <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Pesquisar telefone" value="<?= isset($_POST['telefone']) ? $_POST['telefone'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="email" class="pt-2">Pesquisa por email:</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Pesquisar email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="status" class="pt-2">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected>Selecione o status</option>
                                            <?php foreach ($gerenteService->retornarStatus() as $status) : ?>
                                                <option value="<?= $status->id ?>" <?= !empty($_POST['status']) && $_POST['status'] == $status->id ? 'selected' : ''; ?>><?= $status->status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="sub-item">
                                                    <label for="filter_data_de" class="pt-2">Data de:</label>
                                                    <input type="date" name="filter_data_de" id="filter_data_de" class="form-control" value="<?= isset($_POST['filter_data_de']) ? $_POST['filter_data_de'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="sub-item">
                                                    <label for="filter_data_ate" class="pt-2">Data até:</label>
                                                    <input type="date" name="filter_data_ate" id="filter_data_ate" class="form-control" value="<?= isset($_POST['filter_data_ate']) ? $_POST['filter_data_ate'] : date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item pt-4">
                                <button type="submit" class="btn btn-dark btn-block btn-sm">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SESSÕES -->
                <section class="sessao-tabela mt-3">
                    <span class="h5">Lista de Leads</span>
                    <div class="contain">
                        <div id="scroll">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $arrayLeads = isset($arrayFiltro) ? $arrayFiltro : $gerenteService->recuperar($usuarioSessao->id, $_GET['idUser']); ?>
                                        <?php foreach ($arrayLeads as $leads) : ?>
                                            <?php
                                            $leads->telefone = substr_replace($leads->telefone, '(', 0, 0);
                                            $leads->telefone = substr_replace($leads->telefone, ')', 3, 0);
                                            $leads->telefone = substr_replace($leads->telefone, '-', 9, 0);
                                            ?>
                                            <tr>
                                                <th scope="row"><?= isset($leads->data) ? date('d/m/Y H:i',  strtotime($leads->data)) : ''; ?></th>
                                                <td><a class="text-primary" href="edit.php?editId=<?= $leads->id ?>"><?= $leads->nome ?></a></td>
                                                <td><a class="text-primary" href="edit.php?editId=<?= $leads->id ?>"><?= $leads->telefone ?></a></td>
                                                <td><a class="text-primary" href="edit.php?editId=<?= $leads->id ?>"><?= $leads->email ?></a></td>
                                                <td>
                                                    <a class="text-primary" href="edit.php?editId=<?= $leads->id ?>">
                                                        <div class="circle-stts" style="background: <?= $leads->cor ?>;"></div>
                                                    </a>
                                                </td>
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
<?php endif; ?>