<?php
$sta = $db->prepare('SELECT * FROM composant');
$sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sta->execute();
$results = $sta->fetchAll();
// var_dump($results);


?>
<h1 class="text-center mt-5">Création ou modification modèle</h1>


<form action="" method="post">

    <?php
    foreach (Composant::CATEGORIES as $slug => $categorie) {
        ?>
        <div class="m-3 d-flex ">
            <label for="<?= $slug; ?>"><?= $categorie; ?> : </label>

            <select name="<?= $slug; ?>" id="<?= $slug; ?>">

                <?php
                /** @var Composant $composant */
                foreach ($results as $key => $composant) {
                    if ($composant->getCategorie() == $categorie) {
                        ?>
                        <option value="<?= $composant->getId(); ?>"><?= $composant->getNom(); ?></option>

                        <?php
                    }
                }
                ?>
                <label for="quantite"></label>
                <input type="number" placeholder="Quantite">
            </select>
        </div>
    <?php
    }
    ?>
    <div class="m-3">
        <label for="modele">Modele : </label>
        <input type="text" name="modele" id="modele">
        <input type="submit" value="Envoyer">
    </div>
</form>