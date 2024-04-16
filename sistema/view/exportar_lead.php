<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'exportar_lead';

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

    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- ESTILO -->
    <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

    <!-- JS -->
    <script>
        var pagina = '<?= $pagina ?>';
    </script>
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
                <?php if (!empty($filtro)) : ?>
                    <a href="./exportar_lead.php" class="btn btn-dark btn-sm text-white">Limpar filtro</a>
                <?php endif; ?>

                <div class="filtro-lead" style="margin-top: 50px; border: 2px solid red;">
                    <form method="post" action="./exportar_lead.php">

                        <label for="nome" class="d-block pt-2">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-filtro" placeholder="Nome" value="<?= isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">

                        <label for="telefone" class="d-block pt-2">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="form-filtro" placeholder="Telefone" value="<?= isset($_POST['telefone']) ? $_POST['telefone'] : ''; ?>">

                        <label for="telefone2" class="d-block pt-2">Telefone 2:</label>
                        <input type="text" name="telefone2" id="telefone2" class="form-filtro" placeholder="Telefone 2" value="<?= isset($_POST['telefone2']) ? $_POST['telefone2'] : ''; ?>">

                        <label for="email" class="d-block pt-2">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-filtro" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">

                        <label for="profissao" class="d-block pt-2">Profissão:</label>
                        <input type="text" name="profissao" id="profissao" class="form-filtro" placeholder="Profissão" value="<?= isset($_POST['profissao']) ? $_POST['profissao'] : ''; ?>">

                        <label for="id_usuario_consultor" class="d-block pt-2">Consultor:</label>
                        <select name="id_usuario_consultor" id="id_usuario_consultor">
                            <option hidden value="0">Selecione o consultor</option>
                            <?php foreach ($leadService->retornarConsultores($usuarioSessao->id, $usuarioSessao->nivel) as $consultor) : ?>
                                <option value="<?= $consultor->id ?>" <?= isset($_POST['id_usuario_consultor']) && $consultor->id == $_POST['id_usuario_consultor'] ? 'selected' : ''; ?>><?= $consultor->nome ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="data_ini" class="d-block pt-2">Data início:</label>
                        <input type="date" name="data_ini" id="data_ini" class="form-filtro" value="<?= isset($_POST['data_ini']) ? $_POST['data_ini'] : $data_dia_ant ?>">

                        <label for="data_fim" class="d-block pt-2">Data fim:</label>
                        <input type="date" name="data_fim" id="data_fim" class="form-filtro" value="<?= isset($_POST['data_fim']) ? $_POST['data_fim'] : date('Y-m-d') ?>">

                        <label for="midia" class="d-block pt-2">Mídia:</label>
                        <select name="midia" id="midia">
                            <option hidden value="0">Selecione a mídia</option>
                            <?php foreach ($leadService->retornarMidias() as $midia) : ?>
                                <option value="<?= $midia->id ?>" <?= isset($_POST['midia']) && $midia->id == $_POST['midia'] ? 'selected' : ''; ?>><?= $midia->nome ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="status" class="d-block pt-2">Status:</label>
                        <select name="status" id="status">
                            <option value="0" hidden>Selecione o status</option>
                            <?php foreach ($leadService->retornarStatus() as $status) : ?>
                                <option value="<?= $status->id ?>" <?= isset($_POST['status']) && $status->id == $_POST['status'] ? 'selected' : ''; ?>><?= $status->status ?></option>
                            <?php endforeach; ?>
                        </select>


                        <!-- <input type="hidden" name="id" value="<?= $lead->id ?>"> -->
                        <input type="hidden" name="acao" value="filtrarLead">
                        <div class="pt-3">
                            <button type="submit">
                                filtrar
                            </button>
                        </div>
                    </form>
                </div>




            </div>

            <!-- SESSÕES -->
            <section class="sessao-tabela pt-4">
                <div class="contain">
                    <div class="contain-btn-exp">
                        <button type="button" onclick="exportToExcel('tabela-export')">EXPORTAR</button>
                    </div>

                    <div class="table-responsive">
                        <div id="tabela-export">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Telefone 2</th>
                                        <th scope="col">Mídia</th>
                                        <th scope="col">Profissão</th>
                                        <th scope="col">Corretor</th>
                                        <th scope="col">Status</th>
                                        <!-- <th scope="col">Operações</th> -->
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
                                                    <button class="d-block text-left" type="submit"><?= $lead->telefone ?></button>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="post" action="/sistema/view/edit.php">
                                                    <input type="hidden" name="editId" value="<?= $lead->id ?>">
                                                    <button class="d-block text-left" type="submit"><?= $lead->telefone2 ?></button>
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
                                        </tr>
                                    <?php } ?>
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