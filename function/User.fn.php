<?php
function isConnected(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

function Authentification($db, $mail, $password)
{
    $sql = "SELECT * FROM user WHERE mail = :mail ";
    $query = $db->prepare($sql);
    $query->bindParam(':mail', $mail);
    $query->execute();
    $user = $query->fetch();
    if (!$user || !$password) {
        die('Email ou Mot de passe incorrect');
    }
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['connecte'] = 1;
    $_SESSION['user'] = [
        "id" => $user['id'],
        "mail" => $user["mail"],
    ];
    header('Location: ../admin/dashboard.php');
    exit();
}