<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Atena</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Menu Atena</p>
        <!-- <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul>
        </li> -->
        <li>
            <a href="/sistema/index.php">Painel</a>
        </li>
        <?php if ($usuarioSessao->nivel >= 2) : ?>
            <li>
                <a href="/sistema/view/usuarios.php">Usuários</a>
            </li>
            <li>
                <a href="/sistema/view/gerente.php">Gerente</a>
            </li>
            <!-- <li>
                <a href="#">Página</a>
            </li> -->
        <?php endif; ?>
        <li>
            <a href="/sistema/view/exportar_lead.php">Exportar Lead</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a class="download" onclick="document.getElementById('form-sair').submit()">Sair</a>
            <form method="post" action="/sistema/controller/login.controller.php" id="form-sair" style="display: none !important;">
                <input type="hidden" name="endSession" value="true">
            </form>
        </li>
        <!-- <li>
            <a href="" class="article">Back to article</a>
        </li> -->
    </ul>
</nav>