<?php
// Fonction pour afficher tous les joueurs et joindre les images au joueur correspondant et leur competition 
function findAllJoueur($db) {
  $sql = "SELECT j.*, c.pathimg AS pathimg_competition 
  FROM joueurs AS j
  LEFT JOIN competition_joueurs cj ON j.id = cj.JoueursID
  LEFT JOIN competitions c ON cj.CompetitionsID = c.id
  GROUP BY j.id;";
  $requete = $db->query($sql);
  $joueurs = $requete->fetchAll();
  return $joueurs;
}

// Fonction pour afficher la page d'un seul joueur
function findJoueurById($db, $id) {
  $sql = "SELECT j.*, 
                 n.pathimg AS pathimg_nation, 
                 e.pathimg AS pathimg_equipe,
                 GROUP_CONCAT(c.pathimg) AS pathimg_competitions,
                 e.nom AS equipe_nom
          FROM joueurs AS j 
          LEFT JOIN nation n ON j.nationID = n.id
          LEFT JOIN equipe e ON j.equipeID = e.id
          LEFT JOIN competition_joueurs cj ON j.id = cj.JoueursID 
          LEFT JOIN competitions c ON cj.CompetitionsID = c.id 
          WHERE j.id = $id 
          GROUP BY j.id";
  $requete = $db->query($sql);
  $joueur = $requete->fetch();
  
  // Diviser la chaîne concaténée en un tableau
  $joueur['pathimg_competitions'] = explode(',', $joueur['pathimg_competitions']);
  
  return $joueur;
}



// Fonction pour afficher les nations 
function findAllNation($db) {
  $sql = "SELECT * FROM nation";
  $requete = $db->query($sql);
  $nations = $requete->fetchAll();
  return $nations;
}

// Fonction pour afficher les equipes
function findAllEquipe($db) {
  $sql = "SELECT * FROM equipe";
  $requete = $db->query($sql);
  $equipes = $requete->fetchAll();
  return $equipes;
}

function findAllCompetition_Joueurs($db) {
  $sql = "SELECT * FROM competition_joueurs";
  $requete = $db->query($sql);
  $competitions_joueurs = $requete->fetchAll();
  return $competitions_joueurs;
}

function findAllCompetition($db) {
  $sql = "SELECT * FROM competitions";
  $requete = $db->query($sql);
  $competitions = $requete->fetchAll();
  return $competitions;
}

function findCompetitionById($db, $id) {
  $sql = "SELECT * FROM competitions
  WHERE competitions.id = $id";
  $requete = $db->query($sql);
  $competitions = $requete->fetchAll();
  return $competitions;
}



// Fonction pour trier les joueurs par stats
function FindJoueur($db, $choice){
    if (isset($_POST['selection'])) {
        $choice = $_POST['selection'];
        $sql = "SELECT j.*, c.pathimg AS pathimg_competition 
                FROM joueurs AS j
                LEFT JOIN competition_joueurs cj ON j.id = cj.JoueursID
                LEFT JOIN competitions c ON cj.CompetitionsID = c.id
                GROUP BY j.id
                ORDER BY $choice";
        $result = $db->query($sql);
        $joueurs = $result->fetchAll();
    }
    return $joueurs;
}

// Fonction pour trier les joueurs par nation
function FindJoueurByNation($db, $choice){
  if (isset($_GET['nation'])) {
      $choice = $_GET['nation'];
      $sql = "SELECT j.*, c.pathimg AS pathimg_competition 
              FROM joueurs AS j
              LEFT JOIN competition_joueurs cj ON j.id = cj.JoueursID
              LEFT JOIN competitions c ON cj.CompetitionsID = c.id
              WHERE nationID = $choice
              GROUP BY j.id";
      $result = $db->query($sql);
      $joueurs = $result->fetchAll();
  }
  return $joueurs;
}

//  Fonction pour trier les joueurs par clubs
function FindJoueurByEquipe($db, $choice){
  if (isset($_GET['equipe'])) {
      $choice = $_GET['equipe'];
      $sql = "SELECT j.*, c.pathimg AS pathimg_competition 
              FROM joueurs AS j
              LEFT JOIN competition_joueurs cj ON j.id = cj.JoueursID
              LEFT JOIN competitions c ON cj.CompetitionsID = c.id
              WHERE equipeID = $choice
              GROUP BY j.id";
      $result = $db->query($sql);
      $joueurs = $result->fetchAll();
  }
  return $joueurs;
}


  