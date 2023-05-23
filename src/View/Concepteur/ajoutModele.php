<?php
use Model\Composant;

if (isset($_POST['modele'])) {?>
    <div class="alert alert-success my-5" role="alert">Modèle ajouté !</div>;
<?php } ?>
<!-- Formulaire d'ajout modele -->
<div class="container">
<h2 class="text-center m-3 text-uppercase">Ajouter un nouveau modèle</h2>
<form action="" method="post">
    <?php
    foreach (Composant::CATEGORIES as $slug => $categorie) {
        ?>
        <div class="m-3 d-flex ">
            <label for="<?= $slug; ?>"><?= $categorie; ?> :</label>
            <select name="<?= $slug; ?>" id="<?= $slug; ?>">
                <?php
                /** @var Composant $composant */
                foreach ($results as $key => $composant) {
                    if ($composant->getCategorie() == $categorie) {
                        ?>
                        <option value="<?= $composant->getIdComposant(); ?>"><?= $composant->getNom(); ?></option>
                        <?php
                    }
                }
                        ?>
            </select>
            <label for="<?= $slug; ?>_quantite">
                <input type="number" name="<?= $slug; ?>_quantite" id="<?= $slug; ?>_quantite" placeholder="Quantite" value="<?php if (isset($_POST[$slug . '_quantite'])) {
                        echo $_POST[$slug . '_quantite'];
                    }
                    ?>">
                <?php if (isset($errors[$slug])) { ?>
                    <span class="error">
                        <?= $errors[$slug];
                } ?>
                </span>
            </label>
        </div>
        <?php
    }
    ?>
    <div class="m-3">
        <label for="estPortable">Portable :</label>
        <select name="estPortable" id="estPortable">
            <option value="0">Non</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="m-3">
        <label for="modele">Modele : </label>
        <input type="text" name="modele" id="modele">
    </div>
    <div class="m-3">
        <label for="description">Description : </label>
        <textarea name="description" id="description"></textarea>
        <input type="submit" value="Envoyer">
    </div>    
</form>
</div>