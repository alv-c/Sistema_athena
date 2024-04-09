<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
    if ((!empty($_POST['editId']) && !is_null($_POST['editId'])) || (!empty($_GET['editId']) && !is_null($_GET['editId']))) :
        $id = empty($_POST['editId']) ? $_GET['editId'] : $_POST['editId'];
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
                        <section class="view-lead pb-3">
                            <div class="contain">
                                <fieldset>
                                    <div class="content-stts pb-3">
                                        <span>
                                            <?php foreach($leadService->retornarStatus() as $status) {
                                                if($status->id == $leadService->recuperar($id)[0]->status) {
                                                    echo $status->status;
                                                    break;
                                                }
                                            } ?>
                                        </span>
                                        <div class="indicadorStatusCor" style="background: <?= $status->cor ?>;"></div>
                                    </div>
                                    <form method="post" action="/sistema/controller/leads.controller.php">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="midia">Mídia</label>
                                                <select name="midia" id="midia">
                                                    <option hidden>Selecione uma mídia</option>
                                                    <?php foreach ($leadService->retornarMidias() as $midia) : ?>
                                                        <option value="<?= $midia->id ?>" <?= $leadService->recuperar($id)[0]->id_midia == $midia->id || $usuarioSessao->nivel == 1 ? 'selected' : ''; ?>><?= $midia->nome ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="nome">Nome</label>
                                                <input type="text" name="nome" id="nome" placeholder="Nome do lead" value="<?= $leadService->recuperar($id)[0]->nome ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" name="telefone" id="telefone" placeholder="(xx) x.xxxx-xxxx" value="<?= $leadService->recuperar($id)[0]->telefone ?>" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="telefone2">Telefone 2</label>
                                                <input type="text" name="telefone2" id="telefone2" placeholder="(xx) x.xxxx-xxxx" value="<?= $leadService->recuperar($id)[0]->telefone2 ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" placeholder="exemplo@gmail.com" value="<?= $leadService->recuperar($id)[0]->email ?>" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="profissao">Profissão</label>
                                                <input type="text" name="profissao" id="profissao" placeholder="Profissão" value="<?= $leadService->recuperar($id)[0]->profissao ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="consultor">Corretor</label>
                                                <select name="consultor" id="consultor">
                                                    <option value="0" hidden>Selecione um corretor</option>
                                                    <?php foreach ($leadService->retornarConsultores($usuarioSessao->id, $usuarioSessao->nivel) as $consultor) : ?>
                                                        <option value="<?= $consultor->id ?>" <?= $leadService->recuperar($id)[0]->id_usuario_consultor == $consultor->id || $usuarioSessao->nivel == 1 ? 'selected' : ''; ?>><?= $consultor->nome ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="midia">Status</label>
                                                <select name="status" id="status">
                                                    <?php foreach($leadService->retornarStatus() as $status) : ?>
                                                        <option value="<?= $status->id ?>" <?= $valor = $leadService->recuperar($id)[0]->status == $status->id ? 'selected' : ''; ?>><?= $status->status ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="anotacao">Anotação</label>
                                                <textarea name="anotacao" id="anotacao" placeholder="Comentário"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <input type="hidden" name="acao" value="atualizar">
                                            <input type="hidden" name="id" value="<?= $leadService->recuperar($id)[0]->id ?>">
                                            <button type="submit" class="btn btn-dark btn-block btn-sm">Salvar</button>
                                        </div>
                                        <input type="hidden" name="user" value="<?= $usuarioSessao->id ?>">
                                    </form>
                                </fieldset>
                            </div>
                        </section>
                        <section class="sessao-tabela">
                            <div class="contain">
                                <div id="scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Anotação</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Usuário</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($leadService->recuperarLogsLead($id) as $itemLogArray) : ?>
                                                    <tr>
                                                        <td><?= $itemLogArray->id ?></td>
                                                        <td><?= $anotacao = empty($itemLogArray->anotacao) ? 'Mudança de status' : $itemLogArray->anotacao; ?></td>
                                                        <td><?= $itemLogArray->data ?></td>
                                                        <td style="background: <?= $itemLogArray->cor ?>; color: #fff;"><?= $itemLogArray->status ?></td>
                                                        <td><?= $itemLogArray->nomeUsuarioAnotacao ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
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