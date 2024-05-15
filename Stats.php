<?php 
require __DIR__ . ('/utilities/Header.php'); 
require_once  __DIR__ . ('/config/Config.php');
require_once __DIR__ . ('/function/Database.fn.php');
$db = getPDOlink($config);
require __DIR__. ('/function/Joueurs.fn.php'); 
$nations = findAllNation($db);
$equipes = findAllEquipe($db);


// Appel des fonctions
if (isset($_POST['selection'])) {
    $joueurs = FindJoueur($db, $_POST['selection']);
    } else if (isset($_GET['nation'])) {
        $joueurs = FindJoueurByNation($db, $_GET['nation']);
        } else if (isset($_GET['equipe'])) {
            $joueurs = FindJoueurByEquipe($db, $_GET['equipe']);
            } else {
                $joueurs = findAllJoueur($db);}


?>
<!-- Formulaire de tri -->
<div class="d-flex justify-content-center">
    <div class="p-3">
        <div class="col-md-3 col-10 w-100">
            <form action="Stats.php" method="post" class="d-flex">
                <select name="selection" class="form-select" aria-label="default select example">
                    <!-- Option de tri -->
                    <option value="age ASC">Age -</option>
                    <option value="but DESC">But +</option>
                    <option value="passe DESC">Passe D +</option>
                    <option value="nom ASC">Nom A-Z</option>
                    <option value="nom DESC">Nom Z-A</option>
                    <option value="valeur DESC">Valeur +</option>
                    <option value="nbre_match DESC">Match +</option>
                    <option value="prenom ASC">Prenom A-Z</option>
                    <option value="prenom DESC">Prenom Z-A</option>
                </select>
                <button class="btn btn-primary" type="submit">Choisir</button>
            </form>
        </div>
    </div>
    <!-- 2eme Formulaire de tri par nation -->
    <div class="p-3 ">
        <div class="col-md-3 col-10 w-100">
            <form action="Stats.php" method="get" class="d-flex">
                <select name="nation" class="form-select" aria-label="default select example">
                    <!-- Option de tri -->
                    <?php foreach ($nations as $nation): ?>
                    <option value="<?= $nation['id'] ?>"><?= $nation['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary" type="submit">Choisir</button>
            </form>
        </div>
    </div>

    <!-- 3eme Formulaire de tri par club -->
    <div class="p-3 ">
        <div class="col-md-3 col-10 w-100">
            <form action="Stats.php" method="get" class="d-flex">
                <select name="equipe" class="form-select" aria-label="default select example">
                    <!-- Option de tri -->
                    <?php foreach ($equipes as $equipe): ?>
                    <option value="<?= $equipe['id'] ?>"><?= $equipe['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary" type="submit">Choisir</button>
            </form>
        </div>
    </div>
</div>


<div class="d-flex justify-content-around flex-wrap gap-3">
    <?php require __DIR__. ('/utilities/Card.php');?>
</div>
<?php require __DIR__. ('/utilities/Footer.php');?>