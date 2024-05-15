<?php
$equipes = findAllEquipe($db);
$nations = findAllNation($db);
$competitions = findAllCompetition($db);
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitez les données du formulaire ici

    // Rediriger vers une autre page
    header("Location: /admin/dashboard.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
?>
<form method="POST" class="d-flex justify-content-center mt-5 pt-3 mb-5">
    <div class="card text-center" style="width: 26rem;">
        <div class="w-50 m-auto text-center">

            <div class="">
                <label for="nom"> Nom du Joueur </label>
                <input type="text" name="nom">
            </div>
            <div class="">
                <label for="prenom">Prenom du joueur</label>
                <input type="text" name="prenom">
            </div>
            <div class="">
                <label for="age">Age du joueur</label>
                <input type="text" name="age">
            </div>
            <div class="">
                <label for="valeur">Valeur du joueur</label>
                <input type="text" name="valeur">
            </div>
            <div class="">
                <label for="but">Nombre de but du joueur</label>
                <input type="text" name="but">
            </div>
            <div class="">
                <label for="passe">Nombre de passe du joueur</label>
                <input type="text" name="passe">
            </div>
            <div class="">
                <label for="match">Nombre de match du joueur</label>
                <input type="text" name="match">
            </div>
            <div class="">
                <label for="equipe">Equipe du joueur</label>
                <select name="equipe" class="form-select" aria-label="default select example">
                    <?php foreach ($equipes as $equipe): ?>
                    <option value="<?= $equipe['id'] ?>"><?= $equipe['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="">
                <label for="nation">Nation du joueur</label>
                <select name="nation" class="form-select" aria-label="default select example">
                    <?php foreach ($nations as $nation): ?>
                    <option value="<?= $nation['id'] ?>"><?= $nation['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- À l'intérieur de votre formulaire -->
            <div class="form-group">
                <label for="competitions">Compétitions du joueur (sélectionnez deux au maximum)</label><br>
                <?php foreach ($competitions as $competition): ?>
                <input type="checkbox" class="competition-checkbox" name="competitions[]"
                    value="<?= $competition['id'] ?>">
                <label><?= $competition['nom'] ?></label><br>
                <?php endforeach; ?>
            </div>

            <div class="div">
                <label for="pathimg"> Chemin de l'image </label>
                <input type="file" name="pathimg" class="border">
            </div>
            <button type="submit" class="my-3" name="ajouter">Ajouter ce joueur</button>
        </div>
    </div>
</form>