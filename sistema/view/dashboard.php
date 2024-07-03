<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/controller/global.controller.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/validaSessao.php';
$pagina = 'dashboard';
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

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Dashboard | Sistema Athena</title>
</head>

<body>
    <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/modalFollowup.php' ?>
    <div class="wrapper">
        <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar-aside.php' ?>
        <div id="content">
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/navbar.php' ?>

            <!-- SESSÕES -->
            <section class="sessao-tabela">
                <span class="h5">Dashboard</span>
                <div class="contain pt-4">

                    <fieldset class="container-chart">
                        <div class="contain-chart-barra">
                            <canvas id="chart-barra"></canvas>
                        </div>

                        <div class="grid-chart">
                            <div class="item">
                                <canvas id="chart-circular-left"></canvas>
                            </div>
                            <div class="item">
                                <canvas id="chart-circular-right"></canvas>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </section>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . '/sistema/includes/footer.php'; ?>
        </div>
    </div>

    <script>
        const chartBarra = document.getElementById('chart-barra');
        new Chart(chartBarra, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'GRAFICO BARRA'
                    }
                }
            }
        });

        const circularLeft = document.getElementById('chart-circular-left');
        new Chart(circularLeft, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [10, 19, 10, 5, 2, 10],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'GRAFICO CIRCULAR ESQUERDO'
                    }
                }
            }
        });

        const circularRight = document.getElementById('chart-circular-right');
        new Chart(circularRight, {
            type: 'pie',
            data: {
                labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'purple'],
                datasets: [{
                    label: 'Dataset 1',
                    data: [10, 19, 10, 5, 2, 10],
                    backgroundColor: ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'purple'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'GRAFICO CIRCULAR DIREITO'
                    }
                }
            }
        });
    </script>
</body>

</html>




<!-- CALCULAR MÉDIA PARA GRAFICOS -->

<!-- Para calcular a média do número de registros de uma tabela MySQL baseada em uma coluna 
específica, você pode usar uma query que conte os registros agrupados pela coluna específica 
e, em seguida, calcule a média do resultado. Aqui está um exemplo genérico:

Suponha que temos uma tabela chamada dados com uma coluna chamada categoria. Queremos 
calcular a média do número de registros por cada categoria.

SELECT AVG(contagem) AS media_registros
FROM (
    SELECT COUNT(*) AS contagem
    FROM dados
    GROUP BY categoria
) AS contagens_por_categoria;

1 - SELECT COUNT(*) AS contagem: Esta parte conta o número de registros para cada valor único da 
coluna categoria.

2 - FROM dados: Aqui, dados é o nome da tabela onde estão os dados.

3 - GROUP BY categoria: Isso agrupa os resultados da contagem por cada valor único na coluna categoria.

4 - SELECT AVG(contagem) AS media_registros: Esta é a query externa que calcula a média da 
contagem de registros obtida na subquery interna.

5 - `AS contagens_por_categoria`: É um alias opcional para a subquery interna, tornando o código  -->
mais legível.