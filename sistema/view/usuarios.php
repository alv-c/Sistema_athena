<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/usuarios.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'usuarios';
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
                                        <th scope="col">Nome</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Status</th>
                                        <?php if ($usuarioSessao->nivel == 3) : ?>
                                            <th scope="col">Operações</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arrayUsuarios as $key => $usuario) : ?>
                                        <?php
                                        if ($usuarioSessao->nivel == 2 && ($usuario->nivel == 2 || $usuario->nivel == 3)) continue;
                                        if ($usuarioSessao->nivel == 2) {
                                            if ($usuario->gerente != $usuarioSessao->id) continue;
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
                                                <form method="post" action="/sistema/view/usuariosEdit.php">
                                                    <input type="hidden" name="editId" value="<?= $usuario->id ?>">
                                                    <button type="submit" class="btn btn-success"><?= $usuarioService->retornarNivel($usuario->nivel)[0]->nome; ?></button>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="post" action="./usuariosEdit.php">
                                                    <input type="hidden" name="editId" value="<?= $usuario->id ?>">
                                                    <button type="submit" class="btn btn-success d-flex flex-nowrap justify-content-center align-items-center">
                                                        <div class="circle-stts" style="background: <?= $usuario->status == 1 ? '#228B22' : '#B22222'; ?>;"></div>
                                                        <span class="d-block pl-2"><?= $usuario->status ? 'Ativo' : 'Inativo'; ?></span>
                                                    </button>
                                                </form>
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