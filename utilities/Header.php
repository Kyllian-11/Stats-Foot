<?php

require dirname(__DIR__) . '/function/User.fn.php';
// Definir les domain
$domain = '/';
$index_page = $domain;
$Stats_page = $domain . 'Stats.php';
$current_url = $_SERVER['SCRIPT_NAME']; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>Stats Foot</title>
</head>
<header>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="index.php">Stats FOOT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 col-12 justify-content-around">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="/index.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/Stats.php">Stats</a>
                    </li>
                    <?php if(isconnected()){ ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/admin/Deconnexion.php">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/admin/dashboard.php">Dashboard</a>
                    </li>
                    <?php }
                    else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/admin/Connexion.php">Connexion</a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
</body>

</html>