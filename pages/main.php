<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!--META-->
        <meta charset="utf-8">
        <meta name="Description" content="SI Pet: A smart (pet) house para o seu bixo de estimação.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#db5945">
        <!--/META-->
        <title>SI-PET A Smart house para o seu animal de estimação</title>
        <!--SCRIPTS-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
        <!--/SCRIPTS-->
        <!--STYLES-->
        <link rel="apple-touch-icon" href="../icons/paw.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel='manifest' href='../config/manifest.json'>
        <link rel="stylesheet" href="../css/style.css">
        <!--/STYLES-->
    </head>
    <body>
        <!--HEADER-->
        <header class="navbar fixed-top navbar-light">
            <button id="sidenav-toggle" class="btn btn-outline-primary d-lg-none" type="button">MENU</button>
            <a class="navbar-brand" href="#">
                <i class="fa fa-paw mr-2"></i>SI PET</a>
        </header>
        <!--/HEADER-->
        <!--MAIN-->
        <main>
            <!--SIDENAV-->
            <nav id="sidenav">
                <div id="sidenav-header">
                    <h4 id="sidenav-title">MENU</h4>
                    <button id="sidenav-dismiss" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <ul id="sidenav-list">
                    <li class="{active-home}">
                        <a href="./home">
                            <i class="fa fa-camera"></i>
                            Câmera
                        </a>
                    </li>
                    <li class="{active-alimentacao}">
                        <a href="./alimentacao">
                            <i class="fa fa-drumstick-bite"></i>
                            Alimentação
                        </a>
                    </li>
                    <li class="{active-galeria}">
                        <a href="./galeria">
                            <i class="fa fa-photo-video"></i>
                            Galeria
                        </a>
                    </li>
                    <li class="{active-ambiente}">
                        <a href="./ambiente">
                            <i class="fa fa-home"></i>
                            Ambiente
                        </a>
                    </li>
                    <li class="{active-historico}">
                        <a href="./historico">
                            <i class="fa fa-clock"></i>
                            Histórico
                        </a>
                    </li>
                    <li class="{active-pets}">
                        <a href="./pets">
                            <i class="fa fa-paw"></i>
                            Pets
                        </a>
                    </li>
                    <li class="{active-configuracoes}">
                        <a href="./configuracoes">
                            <i class="fa fa-cog"></i>
                            Configurações
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/SIDENAV-->
            <!--CONTENT-->
            <div id="content">
                {body}
            </div>
            <!--/CONTENT-->
        </main>
        <!--/MAIN-->
        <div id="sidenav-overlay"></div>
    </body>
</html>
