<?php
require_once dirname(__DIR__) . '/config/Config.php';
require_once dirname(__DIR__) . '/function/Database.fn.php';

$db = getPDOlink($config);

if (isset($_POST['joueur_id'])) {
    $id = $_POST['joueur_id'];

    // Préparation de la requête pour supprimer le joueur
    $sql = "DELETE FROM `joueurs` WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    // Préparation de la requête pour supprimer les entrées correspondantes dans la table competition_joueurs
    $sql2 = "DELETE FROM `competition_joueurs` WHERE joueursID = ?";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute([$id]);

    // Redirection vers une autre page
    header("Location: /admin/dashboard.php");
    exit(); 
}