<?php
require dirname(__DIR__) . ('/utilities/Header.php'); 
require_once  dirname(__DIR__) . ('/config/Config.php');
require_once  dirname(__DIR__) . ('/function/Database.fn.php');
$db = getPDOlink($config);
require dirname(__DIR__). ('/function/Joueurs.fn.php'); 
$competitions = findAllCompetition($db);

if ($_GET['q'] == 'joueurs') {
    if (isset($_POST) && !empty($_POST)) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $valeur = $_POST['valeur'];
        $but = $_POST['but'];
        $passe = $_POST['passe'];
        $match = $_POST['match'];
        $equipe = $_POST['equipe'];
        $nation = $_POST['nation'];
        $competitions = $_POST['competition'];
        $pathimg = 'assets/img/' . $_POST['pathimg'];

        // Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitez les données du formulaire ici

    // Récupérer les ID des compétitions sélectionnées
    $competitions = $_POST['competitions'];

    // S'assurer qu'il n'y a pas plus de deux compétitions sélectionnées
    if (count($competitions) > 2) {
        // Gérer l'erreur : afficher un message à l'utilisateur, rediriger, etc.
        // Par exemple :
        echo "Veuillez sélectionner au maximum deux compétitions.";
        exit(); // Arrêter l'exécution du script
    }

    // Requête pour ajouter un nouveau joueur
    $sql = "INSERT INTO `joueurs`(`nom`, `prenom`, `age`, `valeur`, `but`, `passe`, `nbre_match`, `pathimg`, `equipeID`, `nationID`) VALUES ('$nom','$prenom','$age','$valeur','$but','$passe','$match','$pathimg','$equipe','$nation')";
    $db->query($sql);

    // Récupérer l'ID du joueur nouvellement ajouté
    $joueurId = $db->lastInsertId();

    // Insérer les associations joueur-compétition dans la table competition_joueurs
    foreach ($competitions as $competitionId) {
        $sql2 = "INSERT INTO `competition_joueurs`(`joueursID`, `competitionsID`) VALUES ('$joueurId','$competitionId')";
        $db->query($sql2);
    }

    // Rediriger vers une autre page
    header("Location: /admin/dashboard.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}


        

    }
    require_once dirname(__DIR__) . '/utilities/Create.joueurs.form.php';
} elseif ($_GET['q'] == 'nation') {
    if (isset($_POST) && !empty($_POST)) {
        $nom = $_POST['nom'];
        $pathimg = 'assets/img/' . $_POST['pathimg'];
        $sql = "INSERT INTO `nation`(`nom`, `pathimg`) VALUES ('$nom','$pathimg')";
        $db->query($sql);
    }
    require_once dirname(__DIR__) . '/utilities/Create.nation.form.php';
} elseif ($_GET['q'] == 'equipe') {
    if (isset($_POST) && !empty($_POST)) {
        $nom = $_POST['nom'];
        $pathimg = 'assets/img/' . $_POST['pathimg'];
        $sql = "INSERT INTO `equipe`(`nom`, `pathimg`) VALUES ('$nom','$pathimg')";
        $db->query($sql);
    }
    require_once dirname(__DIR__) . '/utilities/Create.equipe.form.php';
}

require_once dirname(__DIR__) . '/utilities/footer.php';