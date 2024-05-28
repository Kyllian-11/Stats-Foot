<?php
session_start(); // Démarrez la session

require dirname(__DIR__) . '/utilities/Header.php';
require dirname(__DIR__) . '/config/Config.php';
require dirname(__DIR__) . '/function/Database.fn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le formulaire a été soumis
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        // Sécuriser les données saisies par l'utilisateur
        $mail = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['mdp'], ENT_QUOTES, 'UTF-8');

        // Définir les regex
        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        // Vérifier si les données saisies respectent les regex
        if (!preg_match($emailRegex, $mail)) {
            $error_message = "L'adresse e-mail n'est pas valide.";
        } elseif (!preg_match($passwordRegex, $password)) {
            $error_message = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.";
        } else {
            // Récupérer l'administrateur depuis la base de données
            $db = getPDOlink($config);
            try {
                Authentification($db, $mail, $password);
            } catch (Exception $e) {
                $error_message = $e->getMessage();
            }
        }
    } else {
        $error_message = "Veuillez entrer votre E-mail et votre mot de passe.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <!-- Assurez-vous de corriger le chemin vers votre fichier CSS -->
</head>

<body class="vh-100">
    <div class="h-75">
        <h2 class="text-center mt-2">Connexion Administrateur</h2>
        <?php if(isset($error_message)) echo "<p>$error_message</p>"; ?>
        <form method="POST" class="d-flex justify-content-center my-5 pt-3">
            <div class="card text-center" style="width: 26rem;">
                <div class="w-50 m-auto text-center mt-2 mb-2">
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control mb-3" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="div">
                        <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
                        <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" name="valider" class="btn btn-primary mt-2">Connexion</button>
                </div>
            </div>
        </form>
    </div>
</body>
<?php require dirname(__DIR__) . '/utilities/footer.php'; ?>

</html>