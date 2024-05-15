<?php 
require __DIR__. ('/utilities/Header.php');
require __DIR__ . ('/function/Database.fn.php');?>

<body>
    <!-- Image de fond -->
    <div class="card text-bg-dark">
        <img src="/assets/img/back.jpg" class="card-img" alt="">
        <div class="card-img-overlay">
            <h5 class="card-title text-center p-5 text-dark fs-1 bg-white bg-opacity-25">TOUTES LES STATS DES PLUS
                GRANDS JOUEURS</h5>
            <p class="card-text text-center text-dark fs-2 bg-white bg-opacity-25">Retrouvez les dans l'onglet stats !
            </p>
        </div>
    </div>
    <?php require __DIR__ . ('/utilities/footer.php'); ?>
</body>