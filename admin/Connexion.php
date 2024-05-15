<?php
session_start(); // Démarrez la session

require dirname(__DIR__). '/utilities/Header.php';
require dirname(__DIR__) . '/config/Config.php';
require dirname(__DIR__) . '/function/Database.fn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le formulaire a été soumis
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        // Sécuriser les données saisies par l'utilisateur
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $mdp = htmlspecialchars($_POST['mdp'], ENT_QUOTES, 'UTF-8');

        // Récupérer l'administrateur depuis la base de données
        $pdo = getPDOlink($config);
        $stmt = $pdo->prepare("SELECT * FROM user WHERE mail = :mail");
        $stmt->execute(['mail' => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($mdp, $admin['mdp'])) {
            // Authentification réussie, définissez une variable de session pour l'admin
            $_SESSION['admin'] = $admin;

            // Rediriger vers le tableau de bord
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "E-mail ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez entrer votre E-mail et votre mot de passe.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">


<body>
    <h2>Connexion Administrateur</h2>
    <?php if(isset($error_message)) echo "<p>$error_message</p>"; ?>
    <form method="POST" class="d-flex justify-content-center mt-5 pt-3 mb-5">
        <div class="card text-center mt-2 mb-2" style="width: 26rem;">
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
</body>
<?php require dirname(__DIR__) . '/utilities/footer.php'; ?>

</html>