<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardins Condomínios Horizontais</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <!-- ROBOTO GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- PROTOSWIPE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/default-skin/default-skin.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js"></script>

    <!-- FONT AWEASOME -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS ANIMATE CARROSSEL -->
    <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet">

    <!-- SLICK CSS -->
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/slick-theme.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img id="logomarca" class="d-block mx-auto img-fluid" src="img\logo-jardins.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
                aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação" style="outline: none; cursor: pointer;">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirect('banner')">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirect('slides')">Empreendimentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirect('distancias')">Distâncias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirect('footer')">Mapa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="banner" id="banner">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-lg-7 col-md-6 col-sm-12 no-margin-padding col-left">
                    <article>
                        <h1 class="titulo">Você Sonha, a Gente Realiza</h1>
                        <h2 class="subtitulo">
                            <strong>Um mundo de possibilidades!</strong><br>
                            A TCM Imóveis oferece a você propriedades exclusivas em condomínios de alto 
                            padrão no eixo Goiânia - Anápolis - Brasília.
                            Conheça os melhores empreendimentos para investimento imobiliario, 100% 
                            regularizados e  renomados. Agende seu horário para  viver experiências de 
                            vida com a sua família enquanto te apresentamos possibilidades de oportunidades.<br>
                            Sua conquista se realiza aqui.
                        </h2>
                    </article>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 no-margin-padding col-right">
                    <fieldset>
                        <div class="contain-title">
                            <h4>
                                Faça <span>seu cadastro</span> para saber mais!
                            </h4>
                        </div>
                        <form method="post" action="./controller/leads.controller.php">
                            <input type="text" name="nome" id="nome" placeholder="nome" required>
                            <input type="text" name="telefone" id="telefone" placeholder="WhatsApp" required>
                            <input type="email" name="email" id="email" placeholder="email" required>
                            <input type="hidden" name="acao" value="inserir">
                            <button type="submit" class="btn-submit">Enviar</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>

    <section class="slides" id="slides">
        <div class="container">
            <h2 class="title">
                Empreendimentos de sucesso
            </h2>
            <h3 class="subtitle">
                A TCM Imóveis aprensenta a você os melhores lançamentos de condomínios verticais na rota Goiânia - Brasília.
            </h3>

            <div class="row no-margin-padding contain-cards">
                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/Fazenda_Canoa/02.png" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Fazenda Canoa.</h3>
                            <p class="card-text">
                                Condomínio de alto nível, as margens do Lago Corumbá 4, com praia privativa 
                                de 2.000m de extenção. Lotes a partir de 700m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-1')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/Escarpas_Eco_Parque/01.jpg" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Escarpas Eco Parque.</h3>
                            <p class="card-text">
                                Condomínio perfeito para segunda moradia, no lago Corumbá 4. A natureza no seu quintal 
                                como você sempre sonhou. Lotes a partir de 500m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-2')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/Jardins_Genebra/01.png" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Jardins Genebra.</h3>
                            <p class="card-text">
                                Condomínio 100% regularizado na região entre lagos de Brasília.
                                Segurança armada 24Horas. Lotes a partir de 648m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-3')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding gallery">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/Santere/01.png" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Aldeia Santerê.</h3>
                            <p class="card-text">
                                Um condomínio aldeia à 19 minutos de Goiânia. Com mais de trinta itens de lazer para 
                                sua família. Lotes a partir de 600m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-4')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/FGR_Jardins_Miami/06.png" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Novo Jardins - Ap. Gyn.</h3>
                            <p class="card-text">
                                Futuro lançamento FGR com acesso pelo forum Aparecida de Goiânia, 
                                próximo a GO-040. Casas ou lotes a partir de 250m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-5')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 coluna no-margin-padding">
                    <div class="card" style="width: 18rem;">
                        <div class="contain-img-card">
                            <figure class="figura">
                                <img class="card-img-top" src="./img/empreendimentos/Parqville_Pinheiros/01.png" alt="Card image cap">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h3 class="titulo">Condomínio Parqville Figueira.</h3>
                            <p class="card-text">
                                O condomínio possui uma área verde por habitante de 
                                12m²/Hab. Localizado na avenida São Paulo, oferece 
                                lotes a partir de 360m².
                            </p>
                            <div class="pt-1">
                                <button type="button" class="btn btn-block btn-sm btn-dark" onclick="redirect('carrossel-6')">Mais informações</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-1" id="carrossel-1">
        <div id="carrossel_1" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/Fazenda_Canoa/01.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Fazenda Canoa</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Esculpida no topo do planalto central e às margens do Lago Corumbá IV, <br> o Condomínio Reserva Fazenda
                                        Canoa é um verdadeiro oásis em meio a natureza.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Fazenda_Canoa/02.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Natureza e arquitetura em harmonia</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        O Fazenda Canoa é um conceito único e exclusivo. Somente nele a sua caso do lago fará parte de um
                                        verdadeiro complexo de lazer e conforto em meio a natureza.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Fazenda_Canoa/04.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Para viver bem</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Viver ao lado do mar de goiás, em sintonia com a natureza. O local perfeito para viver conforto, aventura, lazer e exercícios ao ar livre.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carrossel_1" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_1" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais" id="diferenciais">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-helicopter fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Heliponto</h2>
                        <p class="desc">
                            Aqui você possui diversas vantagens de um heliponto regularizado para acessibilidade rápida.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-ship fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Piers</h2>
                        <p class="desc">
                            2 Piers para embarcações pequenas, médias e grandes; com serviço de marina para o seu 
                            conforto.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-cocktail fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Beach Club</h2>
                        <p class="desc">
                            2 lounges, bar, piscina com borda infinita, sauna e sunken-garden...
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-dharmachakra fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Guarda-barcos</h2>
                        <p class="desc">
                            Segurança para sua embarcação para guardar, colocar e tirar da água.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-2" id="carrossel-2">
        <div id="carrossel_2" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/Escarpas_Eco_Parque/01.jpg') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Escarpas Eco Parque</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Vivendo o lazer em uma moradia com clube completo às margens do lago 
                                        Corumbá IV, onde o rústico e o sofisticado encontram o equilíbrio perfeito.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Escarpas_Eco_Parque/02.jpg') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Adrenalina, diversão e conforto</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Um conceito inédito de condomínio com lazer e aventura no Centro-Oeste, 
                                        para os mais diversos gostos e idades.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Escarpas_Eco_Parque/03.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Terra, água e ar</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        O Escarpas Eco Parque tem a natureza que inspira as melhores sensações. Novas 
                                        experiências para vivenciar, curtir e compartilhar.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carrossel_2" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_2" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais diferenciais_2" id="diferenciais_2">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-tree fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Condomínio ecológico</h2>
                        <p class="desc">
                            Bem vindo a um conceito inédito de condomínio com lazer e aventura no Centro-Oeste.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-swimmer fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Clube</h2>
                        <p class="desc">
                            Um clube completo às margens de uma praia equipada do lago Corumbá IV.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-lock fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Marina</h2>
                        <p class="desc">
                            Infraestrutura, serviço e segurança. Sua única preocupação é 
                            aproveitar ao máximo a beleza do lago.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-hiking fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Ecoaventura</h2>
                        <p class="desc">
                            Com tiroleza, quadras de areia, trilhas e tudo que te inspira as melhores sensações.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-3" id="carrossel-3">
        <div id="carrossel_3" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/Jardins_Genebra/01.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Jardins Genebra</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        O Jardins Genebra conta com lotes de 648 a 1314M², localizado entre os Lagos Sul e 
                                        Norte de Brasília com acesso pela DF-250 e acesso pela DF-456.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Jardins_Genebra/02.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">O Jeito Jardins de Viver em Brasília</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Sinônimo de qualidade nos mais de 37 condomínios já lançados pelo Brasil. 
                                        Agora a FGR chega em Brasília.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Jardins_Genebra/03.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">O melhor novo acesso da cidade</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Apenas 13km da ponte JK, o empreendimento se encontra em uma região de vale, com uma paisagem 
                                        incrível, e a melhor infraestrutura de um condomínio em Brasília.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carrossel_3" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_3" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais diferenciais_3" id="diferenciais_3">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-dumbbell fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Academia</h2>
                        <p class="desc">
                            Academia ampla, com banheiro, copa e varanda para exercícios ao ar livre e playground integrado.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-lock fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Segurança armada</h2>
                        <p class="desc">
                            Segurança armada, com monitoramento CFTV 360° e ronda 24 horas para paz e tranquilidade da sua familia.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-table-tennis fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Quadras de tênis</h2>
                        <p class="desc">
                            2 quadras de Tênis em saibro com iluminação voltadas para o norte, para evitar que o sol 
                            prejudique quem está jogando.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-futbol fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Campo de futebol</h2>
                        <p class="desc">
                            Com grama sintética.
                            Campo em tamanho real e campo menor para crianças e adolescentes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-4" id="carrossel-4">
        <div id="carrossel_4" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/Santere/01.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Aldeia Santerê</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Acorde com a cantoria de passarinhos. Colha frutas da estação com seus filhos, 
                                        sinta o cheiro e a vibração da natureza, tudo isso dentro do seu quintal.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Santere/02.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">A natureza dentro do seu quintal</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Uma reserva ambiental, com mais de 580,000m², portaria com segurança 24 horas e 
                                        bosques com 15m de largura nos fundos dos terrenos.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Santere/04.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">30 itens de lazer para você e sua família</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Piscina coberta e aquecida com raia de 25m², academia, salão de festas, 
                                        duas quadras de areia, pista de skate, campo society, ciclovia e muita mais.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <a class="carousel-control-prev" href="#carrossel_4" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_4" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais diferenciais_4" id="diferenciais_4">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-seedling fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Horta</h2>
                        <p class="desc">
                            Folhagens de hortaliças frescas, pomar no fundo do seu quintal 
                            repleto de árvores frutíferas.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-cloud-sun-rain fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Swales</h2>
                        <p class="desc">
                            Maior privacidade com seu vizinho de fundo. E terreno com curvas de nível 
                            para escoamento de água da chuva de forma natural.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-tree fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Parque</h2>
                        <p class="desc">
                            Uma reserva natural permanente de 580,000m², com um parque aberto ao público
                            no local.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-swimmer fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Club</h2>
                        <p class="desc">
                            Maior área de lazer integrada já lançada na região, com 19,000m² e 30 itens, unindo 
                            moradia e lazer. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-5" id="carrossel-5">
        <div id="carrossel_5" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/FGR_Jardins_Miami/01.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Novo Jardins - Ap. Gyn</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Perto de tudo, em uma localização privilegiada em Aparecida de Goiânia.
                                        Cercado de várias conveniências e entretenimento.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/FGR_Jardins_Miami/02.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">O lugar perfeito para sua família</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        O novo jardins proporciona para sua família, uma vida de comodidade,
                                        bem estar e felicidade. Com espaços pensados para promover conveniência e 
                                        integração dos moradores.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/FGR_Jardins_Miami/03.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">O melhor lugar para morar ou investir</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Segurança, tranquilidade, aconchego e bem-estar farão parte 
                                        do seu dia a dia. Financiamento fácil em até 480 mêses.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carrossel_5" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_5" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais diferenciais_5" id="diferenciais_5">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-house-damage fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Casas</h2>
                        <p class="desc">
                            Lotes a partir de 250m² e/ou residências a partir de 110m².
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-table-tennis fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">lazer</h2>
                        <p class="desc">
                            Piscina + Quiosque, quadra society, academia, pomar e horta, espaço kids 
                            e para mercadinho, e muito mais.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-lock fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Segurança</h2>
                        <p class="desc">
                            Portaria social e de serviço, com verdadeiro significado de qualidade de vida.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-map-marker-alt fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Localização</h2>
                        <p class="desc">
                            Próximo a shoppings, apenas 5 minutos do jardins Veneza, com acesso fácil a várias 
                            saídas da cidade.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-6" id="carrossel-6">
        <div id="carrossel_6" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background: url('img/empreendimentos/Parqville_Pinheiros/01.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Parqville Figueira</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Um cenário perfeito para viver momentos inesquecíveis com sua família.
                                        Acessibilidade, conforto e segurança criam uma experiência inagualável.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Parqville_Pinheiros/02.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Seu Novo Estilo de Vida</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Um estilo de vida único, onde natureza exuberante, acessibilidade, 
                                        conforto e segurança se unem para criar uma experiência inigualável.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background: url('img/empreendimentos/Parqville_Pinheiros/03.png') no-repeat center center !important; background-size: cover !important;">
                    <div class="mask flex-center">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4 class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">Urbanismo, Arquitetura e Paisagismo de Alto Nível.</h4>
                                    <p class="pl-5" style="background: rgba(192, 192, 192, .7); padding: 5px; border-radius: 3px;">
                                        Integrando a criação e desenvolvimento, para qualidade de vida e 
                                        espaços sofisticados de lazer, com paisagismo exclusivo.
                                    </p>
                                    <a href="#" class="ml-5" onclick="redirect('banner')">MAIS INFORMAÇÕES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carrossel_6" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carrossel_6" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
        </div>
    </section>

    <section class="diferenciais diferenciais_6" id="diferenciais_6">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-1 order-md-1">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-thumbtack fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Lotes amplos</h2>
                        <p class="desc">
                            Aproveite Lotes Residênciais e Comerciais com frente para a 
                            BR-153 disponíveis para venda.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-2 order-md-2">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-map-marker-alt fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">A melhor localização</h2>
                        <p class="desc">
                            Apenas 10 minutos do shopping Flamboyant, e 15 minutos do Parque Vaca Brava ou Areião.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-3 order-md-4">
                    <div class="card-diferencial bg-gray">
                        <div class="contain-ico">
                            <i class="fas fa-table-tennis fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Lazer completo</h2>
                        <p class="desc">
                            Quadras de tênis, capela ecumênica, campo de futebol, academia, piscina e muito mais.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-margin-padding order-sm-4 order-md-3">
                    <div class="card-diferencial">
                        <div class="contain-ico">
                            <i class="fas fa-tree fa-2x" style="color: #03d7ab;"></i>
                        </div>
                        <h2 class="title">Agrofloresta</h2>
                        <p class="desc">
                            Um sistema de reúne culturas, e integra o plantio de alimentos, que é sustentável 
                            para a qualidade de vida da sua família.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="distancias" id="distancias">
        <div class="container">
            <h2 class="title">
                Distâncias para chegar ao melhor lugar para viver com segurança e conforto.
            </h2>
            <div class="row no-margin-padding">
                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">PONTE JK</span>
                            <span class="desc">17.5Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">ERMIDA DOM BOSCO</span>
                            <span class="desc">13Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">Aeroporto</span>
                            <span class="desc">13Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">PONTE JK Novo acesso DF-456</span>
                            <span class="desc">13Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">SHOPPING IGUATEMI</span>
                            <span class="desc">17.4Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">ESPLANADA DOS MINISTÉRIOS</span>
                            <span class="desc">23Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">Pontão do lago sul</span>
                            <span class="desc">25Km</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 no-margin-padding">
                    <div class="cartao">
                        <div class="contain-ico">
                            <i class="label fas fa-location-arrow fa-1x" style="color: #fff;"></i>
                        </div>
                        <div class="contain-span">
                            <span class="titulo">CCBB</span>
                            <span class="desc">21Km</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carrossel-parceiros" id="carrossel-parceiros">
        <div class="container">
            <h2 class="title">
                Parceiros
            </h2>
            <div class="slider slider-nav">
                <div>
                    <img src="./img/parceiros/exemplo.png" alt="parceiro">
                </div>
                <div>
                    <img src="./img/parceiros/exemplo.png" alt="parceiro">
                </div>
                <div>
                    <img src="./img/parceiros/exemplo.png" alt="parceiro">
                </div>
                <div>
                    <img src="./img/parceiros/exemplo.png" alt="parceiro">
                </div>
                <div>
                    <img src="./img/parceiros/exemplo.png" alt="parceiro">
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="row no-margin-padding">
                <div class="col-md-4 no-margin-padding col-left">
                    <div class="contain-endereco">
                        <span class="titulo">Endereço:</span>
                        <span class="endereco">
                            Avenida Dona Maria Cardoso Qd. 84 Lt. 01 ao 05 - 
                            Galeria Cristal Center, sala 04/05 - Vila Sao Tomaz, 
                            Aparecida de Goiânia - GO, 74905-100
                        </span>
                        <a href="#" class="localizacao">Mapa <i class="fas fa-map-marker-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-4 no-margin-padding col-center">
                    <div class="contain-redes-sociais">
                        <a href="https://www.instagram.com/vendasfettine/" class="rede-social instagram" target="_blank">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="https://www.facebook.com/FernandoFettineCorretor/" class="rede-social facebook" target="_blank">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="https://api.whatsapp.com/message/YEMLKWGFHTW2C1?autoload=1&app_absent=0" class="rede-social wpp" target="_blank">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 no-margin-padding col-right">
                    <div class="contain-contatos">
                        <span class="titulo">Contatos:</span>
                        <!-- <span class="fixo">(62) 3284-8027</span> -->
                        <span class="wpp">(62)9.9167-5882</span>
                        <!-- <span class="email">exemplo@gmail.com</span> -->
                    </div>
                </div>
            </div>
            <div class="developer">
                <span class="dev">Developed by Álvaro Carvalho</span>
            </div>
        </div>
        <!-- PRELOADER PHOTOSWIPE -->
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <!-- Background of PhotoSwipe. 
                    It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>
            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">
                <!-- Container that holds slides. 
                            PhotoSwipe keeps only 3 of them in the DOM to save memory.
                            Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <!--  Controls are self-explanatory. Order can be changed. -->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center text-center"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal obrigado -->
        <div class="modal fade" id="modal_obrigado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="TituloModalCentralizado">Cadastro realizado com sucesso!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="outline: none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body pb-4">
                        <span style="font-size: 13px;">Clique no botão abaixo para ser redirecionado(a) para o whatsapp.</span>
                        <div class="contain-btn pt-3">
                            <a href="https://api.whatsapp.com/message/YEMLKWGFHTW2C1?autoload=1&app_absent=0" class="btn btn-success btn-sm btn-block">Whatsapp &nbsp;<i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="./js/script.js"></script>
        <script src="./js/slick.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function () { 
                $("#telefone").mask('(00)00000-0000');

                <?php if(isset($_GET['send'])) : ?>
                    $('#modal_obrigado').modal('show')
                <?php endif; ?>
            });
            // slick
            $('.slider-nav').slick({
                autoplay: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                speed: 300,
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                infinite: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Carrossels
            $('#carrossel_1').carousel({
                interval: 3000,
            })

            $('#carrossel_2').carousel({
                interval: 3000,
            })

            $('#carrossel_3').carousel({
                interval: 3000,
            })

            $('#carrossel_4').carousel({
                interval: 3000,
            })

            $('#carrossel_5').carousel({
                interval: 3000,
            })

            $('#carrossel_6').carousel({
                interval: 3000,
            })

            // scroll suave
            const menuItems = document.querySelectorAll('.menu a[href^="#"]');
            function getScrollTopByHref(element) {
                const id = element.getAttribute('href');
                return document.querySelector(id).offsetTop;
            }

            function scrollToPosition(to) {
                // Caso queira o nativo apenas
                    // window.scroll({
                    // top: to,
                    // behavior: "smooth",
                    // })
                smoothScrollTo(0, to);
            }

            function scrollToIdOnClick(event) {
                event.preventDefault();
                const to = getScrollTopByHref(event.currentTarget)- 80;
                scrollToPosition(to);
            }

            menuItems.forEach(item => {
                item.addEventListener('click', scrollToIdOnClick);
            });

            // Caso deseje suporte a browsers antigos / que não suportam scroll smooth nativo
            /**
            * Smooth scroll animation
            * @param {int} endX: destination x coordinate
            * @param {int) endY: destination y coordinate
            * @param {int} duration: animation duration in ms
            */
            function smoothScrollTo(endX, endY, duration) {
                const startX = window.scrollX || window.pageXOffset;
                const startY = window.scrollY || window.pageYOffset;
                const distanceX = endX - startX;
                const distanceY = endY - startY;
                const startTime = new Date().getTime();

                duration = typeof duration !== 'undefined' ? duration : 400;

                // Easing function
                const easeInOutQuart = (time, from, distance, duration) => {
                    if ((time /= duration / 2) < 1) return distance / 2 * time * time * time * time + from;
                    return -distance / 2 * ((time -= 2) * time * time * time - 2) + from;
                };

                const timer = setInterval(() => {
                    const time = new Date().getTime() - startTime;
                    const newX = easeInOutQuart(time, startX, distanceX, duration);
                    const newY = easeInOutQuart(time, startY, distanceY, duration);
                    if (time >= duration) {
                    clearInterval(timer);
                    }
                    window.scroll(newX, newY);
                }, 1000 / 60); // 60 fps
            };

            let redirect = (link) => {
                $("html, body").animate({
                    scrollTop: $(`#${link}`).offset().top - 100
                }, 600, function() {});
            }

            // PHOTOSWIPE
            // 'use strict';
            // (function ($) {
            //     // Init empty gallery array
            //     let galleryArray = [];

            //     // Loop over gallery items and push it to the array
            //     $('.figura').each(function () {
            //         var $link = $(this).find('a'),
            //             item = {
            //                 src: $link.attr('href'),
            //                 w: $link.data('width'),
            //                 h: $link.data('height'),
            //                 title: $link.attr('title')
            //             };
            //         galleryArray.push(item);
            //     });

            //     // Define click event on gallery item
            //     $('.open-galley').click(function (event) {
            //         // Prevent location change
            //         event.preventDefault();

            //         // Define object and gallery options
            //         var $pswp = $('.pswp')[0],
            //             options = {
            //                 index: $(this).attr("data-index"),
            //                 bgOpacity: 0.85,
            //                 showHideOpacity: true
            //             };

            //         // Initialize PhotoSwipe
            //         var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, galleryArray, options);
            //         gallery.init();
            //     });

            // }(jQuery));
        </script>

        <!-- BOTÃO WHATSAPP -->
        <!-- START Widget WhastApp hospedagemwordpresspro -->
        <a href="https://api.whatsapp.com/send?phone=5562991675882&text=" class="bt-whatsApp" target="_blank" style="right:25px; position:fixed;width:60px;height:60px;bottom:40px;z-index:100;">
        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iNTEycHgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB3aWR0aD0iNTEycHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnIGlkPSJ3aGF0c2FwcF94MkNfX21lZGlhX3gyQ19fbG9nb194MkNfX3NvY2lhbCI+PGc+PHBhdGggZD0iTTQ0Mi43NjYsMTE2LjIwNUwyODEuNzE3LDIzLjIxMmMtOC4wNzYtNC42NTktMTcuMDY0LTcuMDQ2LTI2LjA4NS03LjIwN2wwLDAgICAgYy0wLjAxNSwwLTAuMDIxLDAtMC4wMzMsMGMtMC4wMTEsMC0wLjAyNSwwLTAuMDM2LDBsMCwwYy05LjAxOCwwLjE2MS0xOC4wMDYsMi41NDgtMjYuMDg5LDcuMjA3bC0xNjEuMDUsOTIuOTg1ICAgIGMtMTYuNzI0LDkuNjU5LTI3LjAzLDI3LjQ5Ny0yNy4wMyw0Ni44MTd2MTg1Ljk1NmMwLDE5LjMyLDEwLjMwNiwzNy4xNzIsMjcuMDMsNDYuODE4bDE2MS4wNSw5Mi45OTIgICAgYzguMDgzLDQuNjU4LDE3LjA2NCw3LjA0NSwyNi4wODksNy4yMDd2MC4wMDZjMC4wMTEsMCwwLjAyNS0wLjAwNiwwLjAzNi0wLjAwNmMwLjAxMiwwLDAuMDE5LDAuMDA2LDAuMDMzLDAuMDA2di0wLjAwNiAgICBjOS4wMTMtMC4xNjIsMTguMDA5LTIuNTQxLDI2LjA4NS03LjIwN2wxNjEuMDQ5LTkyLjk4NmMxNi43MjktOS42NTIsMjcuMDM5LTI3LjQ5NiwyNy4wMzktNDYuODE2VjE2My4wMjIgICAgQzQ2OS44MDUsMTQzLjcwMyw0NTkuNDk0LDEyNS44NSw0NDIuNzY2LDExNi4yMDV6IiBzdHlsZT0iZmlsbDojMUE5RjQ5OyIvPjxwYXRoIGQ9Ik0zODYuNzc3LDI0OS4yODNjLTEuNjIxLTYzLjc2NS01NC4xNy0xMTQuOTcxLTExOC44MTYtMTE0Ljk3MSAgICBjLTYzLjkxMiwwLTExNi4wMDcsNTAuMDE2LTExOC43NSwxMTIuNzUxYy0wLjA4LDEuNzMtMC4xMzUsMy40NjEtMC4xMzUsNS4yMDZjMCwyMi4yOTIsNi4yMjEsNDMuMTI5LDE3LjA0OSw2MC45MDNsLTIxLjQzLDYzLjMxOCAgICBsNjUuODAxLTIwLjkyNmMxNy4wNSw5LjM0NiwzNi42MTQsMTQuNjg5LDU3LjQ2NCwxNC42ODljNjUuNjU0LDAsMTE4Ljg3NS01Mi44MjYsMTE4Ljg3NS0xMTcuOTg1ICAgIEMzODYuODM2LDI1MS4yNjEsMzg2LjgwMSwyNTAuMjc2LDM4Ni43NzcsMjQ5LjI4M3ogTTI2Ny45NjEsMzUxLjQ0NWMtMjAuMjkyLDAtMzkuMTg1LTYuMDQ1LTU0Ljk4Mi0xNi40MmwtMzguNDI0LDEyLjIyMyAgICBsMTIuNS0zNi44MzZjLTExLjk3MS0xNi4zNTUtMTkuMDMxLTM2LjQ2NS0xOS4wMzEtNTguMTQzYzAtMy4yNDksMC4xNzItNi40NDcsMC40NzUtOS42MTYgICAgYzQuODgxLTUwLjE5OCw0Ny42MDUtODkuNTc1LDk5LjQ2Mi04OS41NzVjNTIuNDgyLDAsOTUuNjI3LDQwLjM2Myw5OS42MTMsOTEuNDNjMC4xOTcsMi41NTYsMC4zNDQsNS4xNTUsMC4zNDQsNy43NDcgICAgQzM2Ny45MTgsMzA2Ljk1MSwzMjMuMDcyLDM1MS40NDUsMjY3Ljk2MSwzNTEuNDQ1eiIgc3R5bGU9ImZpbGw6I0ZGRkZGRjsiLz48cGF0aCBkPSJNMzE4Ljk5OCwyNzYuMDcyYy0yLjkzNi0xLjQ1My0xNy4yNzUtOC40NTUtMTkuOTI2LTkuNDA0ICAgIGMtMi42OC0wLjk2NS00LjYwNy0xLjQ1My02LjU1NywxLjQ1M2MtMS45NDksMi44ODMtNy41NDMsOS4zODktOS4yMzYsMTEuMzE2Yy0xLjcwOSwxLjkyMi0zLjQxLDIuMTctNi4zMDksMC43MjMgICAgYy0yLjkzNi0xLjQyNC0xMi4zMTEtNC40OTYtMjMuNDQyLTE0LjM0OGMtOC42ODItNy42NTgtMTQuNTA5LTE3LjEyOC0xNi4yMTctMjAuMDM1Yy0xLjcwMS0yLjg2OS0wLjE2NC00LjQzMiwxLjI4OC01Ljg4NSAgICBjMS4zMTEtMS4yODUsMi45MzItMy4zODEsNC4zNTMtNS4wNTNjMC40NDgtMC41MDQsMC43ODEtMC45NDksMS4wODgtMS4zOTVjMC42OTctMS4wNTksMS4xNzItMi4wNjYsMS44NC0zLjQzMiAgICBjMC45NzktMS45MjgsMC41MDQtMy42MTQtMC4yMjMtNS4wNzVjLTAuNzMtMS40MjQtNi41ODMtMTUuNjc2LTkuMDExLTIxLjQ1OWMtMi40MzEtNS43OTctMzAuMTExLDguNDM0LTMwLjExMSwyMi42NDkgICAgYzAsMy4zNjYsMC42MDksNi43MDMsMS41MDgsOS44NTdjMi45NTMsMTAuMjIyLDkuMjkxLDE4LjU4MiwxMC40MDEsMjAuMDc5YzEuNDU2LDEuOTEzLDIwLjE1NSwzMi4wNjEsNDkuNzkzLDQzLjY0MSAgICBjMjkuNjI5LDExLjU4LDI5LjYyOSw3LjczMiwzNC45NTksNy4yMjljNS4zMy0wLjQ3NSwyMi4xMDktMjYuMjg1LDIxLjM3OS0yNy40OThDMzIzLjgyNCwyNzguMjMyLDMyMS44OTYsMjc3LjUxLDMxOC45OTgsMjc2LjA3MiAgICB6IiBpZD0iWE1MSURfODhfIiBzdHlsZT0iZmlsbDojRkZGRkZGOyIvPjwvZz48L2c+PGcgaWQ9IkxheWVyXzEiLz48L3N2Zz4=" alt="" width="60px">
        </a>
        <span id="alertWapp" style="right:30px; visibility: hidden; position:fixed;	width:17px;	height:17px;bottom:90px; background:red;z-index:101; font-size:11px;color:#fff;text-align:center;border-radius: 50px; font-weight:bold;line-height: normal; "> 1 </span>
        <div id="msg1" style="right: 90px; visibility: hidden; background: #fff;color: #000;position: fixed;width: 100px;bottom: 55px;font-size: 12px;line-height: 13px;padding: 3px; border-radius: 10px; border:1px solid #e2e2e2; box-shadow: 2px 2px 3px #999;z-index:100; ">Entre em contato!</div>
        <script type="text/javascript">function showIt2() {document.getElementById("msg1").style.visibility = "visible";}    setTimeout("showIt2()", 5000); function hiddenIt() {document.getElementById("msg1").style.visibility = "hidden";}setTimeout("hiddenIt()", 15000); function showIt3() {document.getElementById("msg1").style.visibility = "visible";} setTimeout("showIt3()", 25000);  msg1.onclick = function() {document.getElementById('msg1').style.visibility = "hidden"; };function alertW() { document.getElementById("alertWapp").style.visibility = "visible";	} setTimeout("alertW()", 15000); </script>
        <!-- END Widget WhastApp -->

        <!-- STYLE CARROSSELS -->
        <style>
            #carrossel_1 .carousel-item .mask, 
            #carrossel_2 .carousel-item .mask, 
            #carrossel_3 .carousel-item .mask,
            #carrossel_4 .carousel-item .mask,
            #carrossel_5 .carousel-item .mask,
            #carrossel_6 .carousel-item .mask {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                background-attachment: fixed;
            }

            #carrossel_1 h4, 
            #carrossel_2 h4, 
            #carrossel_3 h4,
            #carrossel_4 h4,
            #carrossel_5 h4,
            #carrossel_6 h4 {
                font-size: 50px;
                margin-bottom: 15px;
                color: #1c1c1c;
                line-height: 100%;
                letter-spacing: 0.5px;
                font-weight: 600;
            }

            @media (max-width: 575.9px) {
                #carrossel_1 h4, 
                #carrossel_2 h4, 
                #carrossel_3 h4,
                #carrossel_4 h4,
                #carrossel_5 h4,
                #carrossel_6 h4 {
                    font-size: 35px;
                }
            }

            @media (min-width: 576px) {
                #carrossel_1 h4, 
                #carrossel_2 h4, 
                #carrossel_3 h4,
                #carrossel_4 h4,
                #carrossel_5 h4,
                #carrossel_6 h4 {
                    font-size: 45px;
                }
            }

            @media (min-width: 992px) {
                #carrossel_1 h4, 
                #carrossel_2 h4, 
                #carrossel_3 h4,
                #carrossel_4 h4,
                #carrossel_5 h4,
                #carrossel_6 h4 {
                    font-size: 50px;
                }
            }

            #carrossel_1 p, 
            #carrossel_2 p, 
            #carrossel_3 p,
            #carrossel_4 p,
            #carrossel_5 p,
            #carrossel_6 p {
                font-size: 18px;
                margin-bottom: 15px;
                color: #1c1c1c;
            }

            @media (max-width: 575.9px) {
                #carrossel_1 p, 
                #carrossel_2 p, 
                #carrossel_3 p,
                #carrossel_4 p,
                #carrossel_5 p,
                #carrossel_6 p {
                    font-size: 14px;
                }
            }

            @media (min-width: 576px) {
                #carrossel_1 p, 
                #carrossel_2 p, 
                #carrossel_3 p,
                #carrossel_4 p,
                #carrossel_5 p,
                #carrossel_6 p {
                    font-size: 16px;
                }
            }

            @media (min-width: 992px) {
                #carrossel_1 p, 
                #carrossel_2 p, 
                #carrossel_3 p,
                #carrossel_4 p,
                #carrossel_5 p,
                #carrossel_6 p {
                    font-size: 18px;
                }
            }

            #carrossel_1 .carousel-item a, 
            #carrossel_2 .carousel-item a, 
            #carrossel_3 .carousel-item a,
            #carrossel_4 .carousel-item a,
            #carrossel_5 .carousel-item a,
            #carrossel_6 .carousel-item a {
                background: #03d7ab;
                font-size: 14px;
                color: #FFF;
                padding: 13px 32px;
                display: inline-block;
            }

            #carrossel_1 .carousel-item a:hover, 
            #carrossel_2 .carousel-item a:hover, 
            #carrossel_3 .carousel-item a:hover,
            #carrossel_4 .carousel-item a:hover,
            #carrossel_5 .carousel-item a:hover,
            #carrossel_6 .carousel-item a:hover {
                background: #1c1c1c;
                text-decoration: none;
            }

            #carrossel_1 .carousel-item h4, 
            #carrossel_2 .carousel-item h4, 
            #carrossel_3 .carousel-item h4,
            #carrossel_4 .carousel-item h4,
            #carrossel_5 .carousel-item h4,
            #carrossel_6 .carousel-item h4 {
                -webkit-animation-name: fadeInLeft;
                animation-name: fadeInLeft;
            }

            #carrossel_1 .carousel-item p, 
            #carrossel_2 .carousel-item p, 
            #carrossel_3 .carousel-item p,
            #carrossel_4 .carousel-item p,
            #carrossel_5 .carousel-item p,
            #carrossel_6 .carousel-item p {
                -webkit-animation-name: slideInRight;
                animation-name: slideInRight;
            }

            #carrossel_1 .carousel-item a, 
            #carrossel_2 .carousel-item a, 
            #carrossel_3 .carousel-item a,
            #carrossel_4 .carousel-item a,
            #carrossel_5 .carousel-item a,
            #carrossel_6 .carousel-item a {
                -webkit-animation-name: fadeInUp;
                animation-name: fadeInUp;
            }

            #carrossel_1 .carousel-item .mask img, 
            #carrossel_2 .carousel-item .mask img, 
            #carrossel_3 .carousel-item .mask img,
            #carrossel_4 .carousel-item .mask img,
            #carrossel_5 .carousel-item .mask img,
            #carrossel_6 .carousel-item .mask img {
                -webkit-animation-name: slideInRight;
                animation-name: slideInRight;
                display: block;
                height: auto;
                max-width: 100%;
            }

            #carrossel_1 h4,
            #carrossel_1 p,
            #carrossel_1 a,
            #carrossel_1 .carousel-item .mask img,
            #carrossel_2 h4,
            #carrossel_2 p,
            #carrossel_2 a,
            #carrossel_2 .carousel-item .mask img,
            #carrossel_3 h4,
            #carrossel_3 p,
            #carrossel_3 a,
            #carrossel_3 .carousel-item .mask img,
            #carrossel_4 h4,
            #carrossel_4 p,
            #carrossel_4 a,
            #carrossel_4 .carousel-item .mask img,
            #carrossel_5 h4,
            #carrossel_5 p,
            #carrossel_5 a,
            #carrossel_5 .carousel-item .mask img,
            #carrossel_6 h4,
            #carrossel_6 p,
            #carrossel_6 a,
            #carrossel_6 .carousel-item .mask img
             {
                -webkit-animation-duration: 1s;
                animation-duration: 1.2s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }

            #carrossel_1 .container, 
            #carrossel_2 .container, 
            #carrossel_3 .container,
            #carrossel_4 .container,
            #carrossel_5 .container,
            #carrossel_6 .container {
                max-width: 1430px;
            }

            #carrossel_1 .carousel-item, 
            #carrossel_2 .carousel-item, 
            #carrossel_3 .carousel-item,
            #carrossel_4 .carousel-item,
            #carrossel_5 .carousel-item,
            #carrossel_6 .carousel-item {
                height: 100%;
                min-height: 550px;
            }

            #carrossel_1, 
            #carrossel_2, 
            #carrossel_3,
            #carrossel_4,
            #carrossel_5,
            #carrossel_6 {
                position: relative;
                z-index: 1;
                background: #1c1c1c;
                background-size: cover;
            }

            .carousel-control-next,
            .carousel-control-prev {
                height: 40px;
                width: 40px;
                padding: 12px;
                top: 50%;
                bottom: auto;
                transform: translateY(-50%);
                background-color: #03d7ab;
            }


            .carousel-item {
                position: relative;
                display: none;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                width: 100%;
                transition: -webkit-transform .6s ease;
                transition: transform .6s ease;
                transition: transform .6s ease, -webkit-transform .6s ease;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-perspective: 1000px;
                perspective: 1000px;
            }

            .carousel-fade .carousel-item {
                opacity: 0;
                -webkit-transition-duration: .6s;
                transition-duration: .6s;
                -webkit-transition-property: opacity;
                transition-property: opacity
            }

            .carousel-fade .carousel-item-next.carousel-item-left,
            .carousel-fade .carousel-item-prev.carousel-item-right,
            .carousel-fade .carousel-item.active {
                opacity: 1
            }

            .carousel-fade .carousel-item-left.active,
            .carousel-fade .carousel-item-right.active {
                opacity: 0
            }

            .carousel-fade .carousel-item-left.active,
            .carousel-fade .carousel-item-next,
            .carousel-fade .carousel-item-prev,
            .carousel-fade .carousel-item-prev.active,
            .carousel-fade .carousel-item.active {
                -webkit-transform: translateX(0);
                -ms-transform: translateX(0);
                transform: translateX(0)
            }

            @supports (transform-style:preserve-3d) {

                .carousel-fade .carousel-item-left.active,
                .carousel-fade .carousel-item-next,
                .carousel-fade .carousel-item-prev,
                .carousel-fade .carousel-item-prev.active,
                .carousel-fade .carousel-item.active {
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0)
                }
            }

            .carousel-fade .carousel-item-left.active,
            .carousel-fade .carousel-item-next,
            .carousel-fade .carousel-item-prev,
            .carousel-fade .carousel-item-prev.active,
            .carousel-fade .carousel-item.active {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }



            @-webkit-keyframes fadeInLeft {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(-100%, 0, 0);
                    transform: translate3d(-100%, 0, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(-100%, 0, 0);
                    transform: translate3d(-100%, 0, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            .fadeInLeft {
                -webkit-animation-name: fadeInLeft;
                animation-name: fadeInLeft;
            }

            @-webkit-keyframes fadeInUp {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(0, 100%, 0);
                    transform: translate3d(0, 100%, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(0, 100%, 0);
                    transform: translate3d(0, 100%, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            .fadeInUp {
                -webkit-animation-name: fadeInUp;
                animation-name: fadeInUp;
            }

            @-webkit-keyframes slideInRight {
                from {
                    -webkit-transform: translate3d(100%, 0, 0);
                    transform: translate3d(100%, 0, 0);
                    visibility: visible;
                }

                to {
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            @keyframes slideInRight {
                from {
                    -webkit-transform: translate3d(100%, 0, 0);
                    transform: translate3d(100%, 0, 0);
                    visibility: visible;
                }

                to {
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
            }

            .slideInRight {
                -webkit-animation-name: slideInRight;
                animation-name: slideInRight;
            }
        </style>
    </footer>
</body>

</html>