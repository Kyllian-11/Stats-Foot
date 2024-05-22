<?php 
require_once dirname(__DIR__) . '/utilities/Header.php'; 
require_once dirname(__DIR__) . '/config/Config.php';
require_once dirname(__DIR__) . '/function/Database.fn.php';
require_once dirname(__DIR__) . '/function/Joueurs.fn.php';
require_once dirname(__DIR__) . '/crud/Delete.php';

$db = getPDOlink($config);
$joueurs = findAllJoueur($db);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <?php if(isconnected()){ ?>
    <h1 class='text-center'>DASHBOARD</h1>
    <div class="d-flex justify-content-evenly">
        <a href="/crud/Create.php?q=joueurs" class="btn btn-success">Ajouter un joueur</a>
        <a href="/crud/Create.php?q=equipe" class="btn btn-success">Ajouter une equipe</a>
        <a href="/crud/Create.php?q=nation" class="btn btn-success">Ajouter une nation</a>
    </div>
    <table class="table table-dark table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Prenom</th>
                <th scope="col">Nom</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($joueurs AS $joueur) { ?>
            <tr>
                <th scope="row"><?= $joueur['id']?></th>
                <td><?= $joueur['prenom']?></td>
                <td><?= $joueur['nom']?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="/crud/Update.php?id=<?= $joueur['id'] ?>"
                            class="btn btn-warning d-flex justify-content-center">Modifier</a>
                        <form action="/crud/Delete.php" method="post">
                            <input type="hidden" name="joueur_id" value="<?= $joueur['id'] ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
    <p class="fs-1 text-center my-5">Vous n'avez pas l'autorisation pour acceder a cette page </p>
    <?php } ?>
</body>

</html>

<?php require_once dirname(__DIR__) . '/utilities/footer.php'; ?>