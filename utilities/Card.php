<!-- CARD -->  
<?php foreach ($joueurs as $row) { ?>  
<div class="card border border-dark  mb-3 " style="width: 18rem;">
  <img src="<?= $row['pathimg']?>" class="card-img-top" style="height: 410px;">
  <div class="card-body">
    <h5 class="card-title text-center fs-3"><?= $row['prenom']?></h5>
    <h5 class="card-title text-center fs-2 text-uppercase fw-bold"><?= $row['nom']?></h5>
    <a href="/joueurs.php?id=<?= $row['id'] ?>" class="btn btn-primary d-flex justify-content-center">Voir les Stats</a>
  </div>
</div>
<?php } ?>




