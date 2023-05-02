<?php
if (!empty($_POST)) {
    echo '<div class="alert alert-success my-5" role="alert">Message envoyé</div>';
}
?>
<div class=" container">
    <form class="row g-3 mt-5" method="post" action="">
        <div class="mb-3">
            <h5>Commentaire : </h5>
            <p>
                <?php echo $message->getTexte(); ?>
            </p>
        </div>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre">
        </div>
        <div class="mb-3">
            <label for="commentaire" class="form-label">Réponse</label>
            <textarea class="form-control" id="commentaire" rows="5"></textarea>
        </div>
        <div class="col-12 justify-content-center">
            <button type="submit" name="submit" class="btn btn-dark">Envoyer</button>
        </div>
    </form>
</div>