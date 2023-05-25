<?php
// Requête pour le formulaire de commentaire
if (isset($_POST['submit'])){?>
<div class="alert alert-success my-5" role="alert">Message envoyé</div><?php 
}
?>
<!-- Détails du modèle -->
<h1 class="text-center mt-5">Détails du modèle</h1>
<div class="m-3">
    <p><strong>Nom :</strong>
        <?php echo $modele->getNom(); ?>
    </p>
    <p><strong>Portable :</strong>
        <?php echo $modele->getEstPortable() ? 'Oui' : 'Non'; ?>
    </p>
    <p><strong>Quantité :</strong>
        <?php echo $modele->getQuantite(); ?>
    </p>
    <p><strong>Concepteur :</strong>
        <?php echo $util->getNom(); ?>
    </p>
    <p><strong>Description :</strong>
        <?php echo nl2br($modele->getDescription()); ?>
    </p>
</div>

<!-- Composants du modèle -->
<div class="m-3">
    <h2>Composants</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Categorie</th>
                <th>Propriétés</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $composant) { ?>
                <tr>
                    <td>
                        <?php echo $composant->getNom(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getQuantiteModele(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getCategorie(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getMore(); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



<!-- Affichage du formulaire de commentaire -->
<div class=" container">
    <form class="row g-3 mt-5" method="post" action="">
        <div class="mb-3">
            <h5>Commentaire : </h5>
            <?php foreach ($resCo as $commentaire) {
                echo '<div> le ';
                echo $commentaire->getDateMessage() . ' de ';
                echo $commentaire->getUserName();
                if (!$commentaire->getEstLu()) {
                    echo ' (Non-lu)';
                }
                echo '<p>' . $commentaire->getTexte() . '</p>';
                echo '</div>';
            } ?>
        </div>

        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" name="commentaire" id="commentaire" rows="5"></textarea>
        </div>
        <div class="col-12 justify-content-center">
            <button type="submit" name="submit" class="btn btn-dark">Envoyer</button>
        </div>
    </form>
</div>