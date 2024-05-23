<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/leads.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'edit';
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

        <!-- DATATABLE -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

        <!-- ESTILO -->
        <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

        <!-- FONT AWEASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- JS -->
        <script>
            var pagina = '<?= $pagina ?>';
        </script>
        <script src="/sistema/js/script.js"></script>

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
                                    <?php foreach ($leadService->retornarStatus() as $status) {
                                        if ($status->id == $leadService->recuperar($id)[0]->status) {
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
                                        <label for="data_nascimento">Data de nascimento</label>
                                        <input type="text" class="input_filtro_data" name="data_nascimento" id="data_nascimento" placeholder="Data de nascimento" value="<?= date('d/m/Y', strtotime($leadService->recuperar($id)[0]->data_nascimento)) ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="id_usuario_consultor">Corretor</label>
                                        <select name="id_usuario_consultor" id="id_usuario_consultor">
                                            <option value="0" hidden>Selecione um corretor</option>
                                            <?php foreach ($leadService->retornarConsultores($usuarioSessao->id, $usuarioSessao->nivel) as $consultor) : ?>
                                                <option value="<?= $consultor->id ?>" <?= $leadService->recuperar($id)[0]->id_usuario_consultor == $consultor->id || $usuarioSessao->nivel == 1 ? 'selected' : ''; ?>><?= $consultor->nome ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="midia">Status</label>
                                        <select name="status" id="status">
                                            <?php foreach ($leadService->retornarStatus() as $status) : ?>
                                                <option value="<?= $status->id ?>" <?= $valor = $leadService->recuperar($id)[0]->status == $status->id ? 'selected' : ''; ?>><?= $status->status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="anotacao">Anotação</label>
                                        <textarea name="anotacao" id="anotacao" placeholder="Comentário" class="required-js" required="false"></textarea>
                                        <div class="aviso-follow" id="aviso-follow">
                                            <div class="alert alert-warning mt-3 role=" role="alert">
                                                <strong>Atenção!</strong> Esta anotação será utilizada para a criação de follow-up!
                                            </div>
                                        </div>
                                        <div id="contain-confirm-follow">
                                            <div>
                                                <label for="data_follow">Data follow-up</label>
                                                <input type="date" id="data_follow" name="data_follow" class="required-js border border-warning" value="<?= date('Y-m-d') ?>" required="false">
                                            </div>
                                            <div>
                                                <label for="hora_follow">Hora follow-up</label>
                                                <input type="text" name="hora_follow" class="required-js input_hora border border-warning" value="<?= date('H:i:s') ?>" required="false">
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="criar_follow" value="true" id="customCheck1" onchange="marcarFollowp(this)">
                                            <label class="custom-control-label label-followup" for="customCheck1">Gerar follow-up</label>
                                        </div>
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
                                        <?php foreach ($leadService->recuperarLogsLead($id) as $itemLogArray) : ?>
                                            <tr>
                                                <td><?= $itemLogArray->id ?></td>
                                                <td>
                                                    <?php if ((bool)$itemLogArray->id_follow) : ?>
                                                        <div>
                                                            <span class="badge badge-warning">Follow-up</span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?= $anotacao = empty($itemLogArray->anotacao) ? 'Mudança de status' : $itemLogArray->anotacao; ?>
                                                </td>
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


        <!-- BOTAO WHATSAPP -->
        <!-- START Widget WhastApp hospedagemwordpresspro -->
        <a href="https://api.whatsapp.com/send?phone=55<?= $leadService->recuperar($id)[0]->telefone ?>&text=" id="waurlsite" class="bt-whatsApp" target="_blank" style="right:25px; position:fixed;width:60px;height:60px;bottom:40px;z-index:100;">
            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMCAwIDI4Ljg3IDI4Ljg3IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxzdHlsZT4uY2xzLTF7ZmlsbDojMTg5ZDBlO30uY2xzLTJ7ZmlsbDojZmZmO2ZpbGwtcnVsZTpldmVub2RkO308L3N0eWxlPjwvZGVmcz48dGl0bGUvPjxnIGRhdGEtbmFtZT0iTGF5ZXIgMiIgaWQ9IkxheWVyXzIiPjxnIGRhdGEtbmFtZT0iTGF5ZXIgMSIgaWQ9IkxheWVyXzEtMiI+PHJlY3QgY2xhc3M9ImNscy0xIiBoZWlnaHQ9IjI4Ljg3IiByeD0iNi40OCIgcnk9IjYuNDgiIHdpZHRoPSIyOC44NyIvPjxwYXRoIGNsYXNzPSJjbHMtMiIgZD0iTTcuMDksMjEuODJsLjIzLS44N2MuMjQtLjg5LjQ5LTEuNzcuNzItMi42NmEuNjUuNjUsMCwwLDAsMC0uNDMsNy4zMiw3LjMyLDAsMSwxLDMuMTYsMy4wOC43My43MywwLDAsMC0uNDUsMEM4Ljc3LDIxLjM4LDcuNDksMjEuNzQsNy4wOSwyMS44MlpNOC44LDIwLjE0Yy43My0uMTksMS40LS4zNiwyLjA3LS41NGEuNi42LDAsMCwxLC41LjA3LDYsNiwwLDAsMCw0LjA1Ljc3LDYuMTIsNi4xMiwwLDEsMC02LjMxLTMuMDksMS4yOCwxLjI4LDAsMCwxLC4xNCwxLjE2QzkuMDcsMTksOSwxOS41NSw4LjgsMjAuMTRaIi8+PHBhdGggY2xhc3M9ImNscy0yIiBkPSJNMTYuMzcsMTcuODljLTEuNDMtLjA1LTMuNzEtMS4xOC01LjI3LTMuODlhMi4yLDIuMiwwLDAsMSwuMzQtMi44MSwxLDEsMCwwLDEsLjk0LS4xNGMuMDgsMCwuMTYuMTMuMi4yMi4yMS40Ny40MS45NS41OSwxLjQzLjEuMjYtLjA4LjUtLjQ1LjkyYS4zMi4zMiwwLDAsMCwwLC40Miw1LDUsMCwwLDAsMi41NCwyLjE4LjMuMywwLDAsMCwuMzktLjFjLjU4LS43MS42NC0uOTIsMS0uNzgsMS40OC43MSwxLjU5Ljc0LDEuNi45QTEuNjEsMS42MSwwLDAsMSwxNi4zNywxNy44OVoiLz48L2c+PC9nPjwvc3ZnPg==" alt="" width="60px">
        </a>
        <span id="alertWapp" style="right:30px; visibility: hidden; position:fixed;	width:17px;	height:17px;bottom:90px; background:red;z-index:101; font-size:11px;color:#fff;text-align:center;border-radius: 50px; font-weight:bold;line-height: normal; "> 1 </span>
        <div id="msg1" style="right: 90px; visibility: visible; background: #1EBC59; color: #fff; position: fixed; width: 200px; bottom: 52px; text-align: center; font-size: 13px; line-height: 31px; height: 32px; border-radius: 100px; z-index: 100; ">Falar com lead</div>
        <script type="text/javascript">
            function showIt2() {
                document.getElementById("msg1").style.visibility = "visible";
            }
            setTimeout("showIt2()", 5000);

            function hiddenIt() {
                document.getElementById("msg1").style.visibility = "hidden";
            }
            setTimeout("hiddenIt()", 15000);

            function showIt3() {
                document.getElementById("msg1").style.visibility = "visible";
            }
            setTimeout("showIt3()", 25000);
            msg1.onclick = function() {
                document.getElementById('msg1').style.visibility = "hidden";
            };

            function alertW() {
                document.getElementById("alertWapp").style.visibility = "visible";
            }
            setTimeout("alertW()", 15000);
        </script>
        <!-- END Widget WhastApp -->


    </body>

    </html>
<?php endif; ?>