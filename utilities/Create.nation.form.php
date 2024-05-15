<?php
$equipes = findAllEquipe($db);
$nations = findAllNation($db);
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
                <label for="nom"> Nom de la nation </label>
                <input type="text" name="nom">
            </div>
            <div class="div">
                <label for="pathimg"> Chemin de l'image </label>
                <input type="file" name="pathimg" class="border">
            </div>
            <button type="submit" class="my-3" name="ajouter">Ajouter cette nation</button>


        </div>
</form>
</div>