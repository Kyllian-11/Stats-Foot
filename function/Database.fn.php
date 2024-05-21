<?php

function getPDOlink($config) {
     // DSN de connexion :
  $dsn = 'mysql:dbname=' . $config['dbname'] . ';host=' . $config['dbhost'] . ';port=' . $config['dbport'];

  // On tenter de se connecter à la base de données :
  try {

    // On instancie l'objet PDO :
    $db = new PDO($dsn, $config['dbuser'], $config['dbpass']);

    // On envoi nos requetes en utf8 :
    $db->exec("SET NAMES utf8");

    // On definit le mode de fetch par defaut :
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $db;
  } catch (PDOException $e) {
    exit('BDD Erreur de connexion : ' . $e->getMessage());
  }
}

function hashExistingData($db) {
  try {
      // Récupérer les enregistrements à partir de la base de données
      $query = $db->query("SELECT * FROM user");
      $users = $query->fetchAll();

      // Parcourir les utilisateurs et hasher les mots de passe et les adresses e-mail
      foreach ($users as $user) {
          $hashedPassword = password_hash($user['mdp'], PASSWORD_DEFAULT);

          // Mettre à jour les enregistrements dans la base de données avec les valeurs hachées
          $stmt = $db->prepare("UPDATE user SET mdp = :mdp WHERE id = :id");
          $stmt->execute(['mdp' => $hashedPassword,'id' => $user['id']]);
      }

      echo "Les mots de passe ont été hachés avec succès.";
  } catch (PDOException $e) {
      echo "Erreur lors du hachage des données existantes : " . $e->getMessage();
  }
}

// Appel de la fonction pour hasher les données existantes
// $db = getPDOlink($config);
// hashExistingData($db);