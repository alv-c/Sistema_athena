<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/usuarios.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
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
                <!-- <div class="indicadorStatusCor" style="background: <?= retornarStatus($usuarioService->recuperar($id)[0]->status)['cor']; ?>;"></div> -->
                <section class="view-lead">
                    <div class="contain">
                        <fieldset>
                            <form method="post" action="/sistema/controller/usuarios.controller.php">

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="nivel">Nível</label>
                                        <select id="nivel" name="nivel" onchange="selectManager(this.value)" required>
                                            <?php foreach ($usuarioService->retornarNivel() as $nivel) : ?>
                                                <?php if ($usuarioSessao->nivel == 2 && ($nivel->id == 2 || $nivel->id == 3)) continue; ?>
                                                <option value="<?= $nivel->id ?>" <?= $usuarioService->recuperar($id)[0]->nivel == $nivel->id ? 'selected' : ''; ?>><?= $nivel->nome ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" id="nome" placeholder="Nome do lead" value="<?= $usuarioService->recuperar($id)[0]->nome ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" placeholder="exemplo@gmail.com" value="<?= $usuarioService->recuperar($id)[0]->email ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="senha">Senha</label>
                                        <input type="text" name="senha" id="senha" placeholder="Digite sua senha" value="<?= $usuarioService->recuperar($id)[0]->senha ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div>
                                            <label for="creci">Creci</label>
                                            <input type="text" name="creci" id="creci" placeholder="CRECI" value="<?= $usuarioService->recuperar($id)[0]->creci ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="status">Status</label>
                                        <select id="status" name="status">
                                            <option value="1" <?= $usuarioService->recuperar($id)[0]->status == 1 ? 'selected' : ''; ?>>
                                                Ativo
                                            </option>
                                            <option value="0" <?= $usuarioService->recuperar($id)[0]->status == 0 ? 'selected' : ''; ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="contain-input-consultor <?= $usuarioService->recuperar($id)[0]->nivel != 1 ? 'initfadeOut' : ''; ?>">
                                            <label for="gerenteConsultor">Gerente do corretor</label>
                                            <select name="gerenteConsultor" id="gerenteConsultor" required>
                                                <?php if ($usuarioSessao->nivel == 3) : ?>
                                                    <option value="0" hidden>Selecione</option>
                                                <?php endif; ?>
                                                <?php foreach ($usuarioService->recuperarGerentes() as $gerente) : ?>
                                                    <?php if ($usuarioSessao->nivel == 2 && $gerente->id != $usuarioSessao->id) continue; ?>
                                                    <option value="<?= $gerente->id ?>" <?= $usuarioService->recuperar($id)[0]->gerente == $gerente->id ? 'selected' : ''; ?>><?= $gerente->nome ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="acao" value="atualizar">
                                    <input type="hidden" name="id" value="<?= $usuarioService->recuperar($id)[0]->id ?>">
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