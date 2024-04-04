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

        <!-- ESTILO -->
        <link rel="stylesheet" type="text/css" href="/sistema/css/style.css">

        <!-- SCRIPT -->
        <script src="/sistema/js/script.js"></script>

        <!-- FONT AWEASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Inserir Lead | Sistema Athena</title>
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
                            <form method="post" action="novoLead.php">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="midia">Mídia</label>
                                        <select name="midia" id="midia" required>
                                            <?php foreach($leadService->retornarMidias() as $midia) : ?>
                                                <option value="<?= $midia->id ?>"><?= $midia->nome ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" id="nome" placeholder="Nome do lead" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="telefone">Telefone</label>
                                        <input type="text" name="telefone" id="telefone" placeholder="(00)00000-0000" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="telefone2">Telefone 2</label>
                                        <input type="text" name="telefone2" id="telefone2" placeholder="(00)00000-0000">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="exemplo@gmail.com" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="profissao">Profissão</label>
                                        <input type="text" name="profissao" id="profissao" placeholder="Profissão">
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($usuarioSessao->nivel > 1) { ?>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="id_usuario_consultor">Corretor</label>
                                        <select name="id_usuario_consultor" id="id_usuario_consultor" required>
                                            <?php foreach($leadService->retornarConsultores(null, 0) as $consultor) : ?>
                                                <option value="<?= $consultor->id ?>"><?= $consultor->nome ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php } else if ($usuarioSessao->nivel == 1) { ?>
                                        <input type="hidden" name="id_usuario_consultor" value="<?= $usuarioSessao->id ?>">
                                    <?php } ?>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" required>
                                            <?php foreach($leadService->retornarStatus() as $status) : ?>
                                                <option value="<?= $status->id ?>"><?= $status->status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="acao" value="inserir_lead_manual">
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