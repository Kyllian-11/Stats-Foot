<?php 
require __DIR__ . ('/utilities/Header.php'); 
require_once  __DIR__ . ('/config/Config.php');
require_once  __DIR__ . ('/function/Database.fn.php');
$db = getPDOlink($config);
require __DIR__. ('/function/Joueurs.fn.php'); 
$id = $_GET['id'];
$stats=findJoueurById($db, $id);
var_dump($stats)
?>

<h1 class="fs-1 text-center p-4"><?= $stats['prenom']?> <?= $stats['nom']?></h1>

<div class="card mb-0 border-0">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?= $stats['pathimg']?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
            </div>
            <ul class="list-group list-group-flush bg-primary">
                <li class="list-group-item fs-3"> CLUB
                    <img src="<?= $stats['pathimg_equipe']?>" class="img-fluid rounded-start" alt="..."
                        style="max-width: 15%;">
                    COMPETITION
                    <?php foreach ($stats['pathimg_competitions'] as $pathimg_competition): ?>
                    <img src="<?= $pathimg_competition ?>" class="img-fluid rounded-start" alt="..."
                        style="max-width: 15%;">
                    <?php endforeach; ?>
                    NATION
                    <img src="<?= $stats['pathimg_nation']?>" class="img-fluid rounded-start" alt="..."
                        style="max-width: 15%;">
                </li>
                <li class="list-group-item fs-1">
                    <img src="/assets/img/age.png" class="img-fluid rounded-start" alt="..." style="max-width: 8%;">
                    <?= $stats['age']?>
                    <img src="/assets/img/valeur.png" class="img-fluid rounded-start" alt="..." style="max-width: 8%;">
                    <?= $stats['valeur']?>M€
                    <img src="/assets/img/but.png" class="img-fluid rounded-start" alt="..." style="max-width: 8%;">
                    <?= $stats['but']?>
                    <img src="/assets/img/passe.png" class="img-fluid rounded-start" alt="..." style="max-width: 8%;">
                    <?= $stats['passe']?>
                    <img src="/assets/img/match.png" class="img-fluid rounded-start" alt="..." style="max-width: 8%;">
                    <?= $stats['nbre_match']?>
                </li>
            </ul>

        </div>
    </div>
</div>