<?php
require dirname(__DIR__) . ('/utilities/Header.php'); 
require_once  dirname(__DIR__) . ('/config/Config.php');
require_once  dirname(__DIR__) . ('/function/Database.fn.php');
$db = getPDOlink($config);
require dirname(__DIR__). ('/function/Joueurs.fn.php'); 
$id = $_GET['id'];
$joueurs = findJoueurById($db, $id);
$competitions = findAllCompetition($db);

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

    $sql = "UPDATE `joueurs` SET `nom` = '$nom',`prenom` = '$prenom', `age` = '$age', `pathimg` = '$pathimg', `valeur` = '$valeur', `but` = '$but', `passe` = '$passe', `nbre_match` = '$match', `equipeID` = '$equipe', `nationID` = '$nation' WHERE id = $id";

    $db->query($sql);

    header("Location: /admin/dashboard.php");
    exit();
}





require_once dirname(__DIR__) . '/utilities/joueurs.form.php';