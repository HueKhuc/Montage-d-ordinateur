<?php
    ?>

<div class="container">
<h2 class="text-center m-3 text-uppercase">Modifier un modèle</h2>
    <form class="d-flex flex-column gap-3" method="POST" action="">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $modele->getNom(); ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $modele->getDescription(); ?>">
        </div>
        <div class="form-group">
            <label for="estPortable">Portable</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estPortable" value="1"
                    <?php if ($modele->getEstPortable() == 1) {
                            echo 'checked';
                        }
                    ?>
                    >Oui
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estPortable" value="0" 
                    <?php if ($modele->getEstPortable() == 0) {
                        echo 'checked';
                        }
                    ?>
                    >Non
                </div>
            </div>
            <div class="form-group">
                <label for="quantiteModele">Quantité</label>
                <input type="number" min=0 class="form-control" id="quantiteModele" name="quantiteModele"
                    value="<?php echo $modele->getQuantite(); ?>">
            </div>
                <?php foreach ($results as $composant) {
                    $cat = str_replace(' ', '', $composant->getCategorie());
                ?>
            <div class=" d-flex gap-3 flex-row align-items-center">
                <div class="form-group d-flex col-6 flex-row align-items-center gap-3">
                    <label for="<?php echo $cat; ?>" class="align-items-center col-3">
                        <?php echo $composant->getCategorie(); ?>
                    </label>
                    <select class="form-select" name="<?php echo $cat; ?>">
                        <?php foreach ($composants as $compo) {
                                if ($compo->getCategorie() == $composant->getCategorie()) {
                                    echo '<option value="' . $compo->getIdComposant() . '"';
                                    if ($compo->getIdComposant() == $composant->getIdComposant()) {
                                        echo 'selected';
                                    }
                                    echo '>' . $compo->getNom() . '</option>';
                                }
                            } ?>
                    </select>
                    </div>
                    <div class="form-group d-flex flex-row col-2 align-items-center gap-3">
                        <label for="quantite" class="align-items-center">Quantité</label>
                        <input type="number" min=0 class="form-control align-items-center text-center" id="quantite" name="quantite<?php echo $cat; ?>"
                                value="<?php echo $composant->getQuantiteModele(); ?>">
                    </div>
                    <div class="form-group">
                        <input hidden type="text" class="form-control" id="categorie" name="categorie"
                                value="<?php echo $composant->getCategorie(); ?>">
                    </div>
                </div>
                <?php } ?>
        <button type="submit" class="btn btn-primary my-3" name="modifier" href="?page=concepteur/modifModele">
            Envoyer
        </button>
    </form>
</div>