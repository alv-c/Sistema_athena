<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-dark" onclick="alterLabel()">
            <i class="fas fa-align-left"></i>
            <span id="label-navbar">Esconder</span>
        </button>
        <button type="button" class="btn btn-dark ml-2" data-toggle="modal" data-target="#modalFollowup">
            <i class="fas fa-address-card" id="ico-btn-flw"></i>
            <span id="span-btn-flw">Followup</span>

            <?php if((bool)count($conexao->criarNotifFollow())) : ?>
                <h3>NOTIFICAR</h3>
            <?php endif; ?>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <img class="img-fluid d-block mx-auto logo-barra-superior" src="/sistema/images/logo.png" style="width: 80px;">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>