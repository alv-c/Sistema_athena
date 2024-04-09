<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/usuarios.controller.php';
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

        <!-- JS -->
        <script src="/sistema/js/script.js"></script>

        <!-- FONT AWEASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Usuários | Sistema Athena</title>
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
                    <?php if ($usuarioSessao->nivel >= 2) : ?>
                    <a href="novoUsuario.php" class="btn btn-dark btn-sm text-white">Adicionar novo usuário</a>
                    <?php endif; ?>
                    <button class="btn-filter btn btn-dark btn-sm" onclick="openFilters()">Filtros</button>
                    <form method="post" action="usuarios.php">
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
                                        <label for="email" class="pt-2">Pesquisa por email:</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Pesquisar email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="nivel" class="pt-2">Pesquisa por nivel:</label>
                                        <select name="nivel" id="nivel" class="form-control">
                                            <option hidden>Selecione o nível</option>
                                        <?php foreach($usuarioService->retornarNivel() as $nivel) : ?>
                                            <option value="<?= $nivel->id ?>" <?= !empty($_POST['nivel']) && $nivel->id == $_POST['nivel'] ? 'selected' : ''; ?>><?= $nivel->nome ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="gerente" class="pt-2">Pesquisa por gerente:</label>
                                        <select name="gerente" id="gerente" class="form-control">
                                            <option value="0" hidden>Selecione o gerente</option>
                                            <?php foreach($usuarioService->recuperarGerentes() as $gerente) : ?>
                                                <option value="<?= $gerente->id; ?>" <?= !empty($_POST['gerente']) && $_POST['gerente'] == $gerente->id ? 'selected' : ''; ?>><?= $gerente->nome; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="item">
                                        <label for="status" class="pt-2">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0" hidden>Selecione o status</option>
                                            <option value="1" <?= !empty($_POST['status']) && $_POST['status'] == '1' ? 'selected' : ''; ?>>Ativo</option>
                                            <option value="0" <?= !empty($_POST['status']) && $_POST['status'] == 'false' ? 'selected' : ''; ?>>Inativo</option>
                                        </select>
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
                <section class="sessao-tabela">
                    <div class="contain">
                        <div id="scroll">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Status</th>
                                            <?php if ($usuarioSessao->nivel == 3) : ?>
                                            <th scope="col">Operações</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($arrayUsuarios as $key => $usuario) : ?>
                                        <?php
                                        if ($usuarioSessao->nivel == 2 && ($usuario->nivel == 2 || $usuario->nivel == 3)) continue;
                                        if ($usuarioSessao->nivel == 2) {
                                            if($usuario->gerente != $usuarioSessao->id) continue;
                                        }
                                        ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td>
                                                    <form method="post" action="/sistema/view/usuariosEdit.php">
                                                        <input type="hidden" name="editId" value="<?= $usuario->id ?>">
                                                        <button type="submit" class="btn btn-success"><?= $usuario->nome ?></button>
                                                    </form>
                                                </td>

                                                <td>
                                                    <!-- <form method="post" action="./usuariosEdit.php">
                                                        <input type="hidden" name="editId" value="<?= $usuario->id ?>">
                                                        <button type="submit" class="btn btn-success"> -->
                                                            <div class="circle-stts" style="background: <?= $usuario->status == 1 ? '#228B22' : '#B22222'; ?>;"></div>
                                                        <!-- </button>
                                                    </form> -->
                                                </td>

                                                <?php if ($usuarioSessao->nivel == 3) : ?>
                                                <td>
                                                    <form method="post" action="/sistema/controller/usuarios.controller.php" id="formDel" data-form="form-<?= $usuario->id ?>">
                                                        <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                                        <input type="hidden" name="acao" value="deletar">
                                                        <button type="button" class="excluir btn btn-danger" onclick="confirmDel('<?= $usuario->nome ?>', 'usuário', 'form-<?= $usuario->id ?>')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
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