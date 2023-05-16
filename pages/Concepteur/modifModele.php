<?php

if (isset($_GET['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    $id = $_GET['id'];
    
    // Récupération de données
    $pdoStat = $db->prepare('SELECT * FROM modele WHERE Id_Modele = :id');
    $pdoStat->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
    $pdoStat->execute();
    $modele = $pdoStat->fetch();

    $sqlSelect = $db->prepare("SELECT 
    composant.*,
    assembler.quantite as quantiteModele,
    alimentation.*,
    carte_graphique.*,
    carte_mere.*,
    clavier.*,
    disque_dur.*,
    ecran.*,
    memoire_vive.*,
    processeur.*,
    souris.*
    FROM composant
    INNER JOIN assembler ON composant.Id_Composant = assembler.Id_Composant
    LEFT JOIN alimentation ON composant.Id_Composant = alimentation.Id_Composant
    LEFT JOIN carte_graphique ON composant.Id_Composant = carte_graphique.Id_Composant
    LEFT JOIN carte_mere ON composant.Id_Composant = carte_mere.Id_Composant
    LEFT JOIN clavier ON composant.Id_Composant = clavier.Id_Composant
    LEFT JOIN disque_dur ON composant.Id_Composant = disque_dur.Id_Composant
    LEFT JOIN ecran ON composant.Id_Composant = ecran.Id_Composant
    LEFT JOIN memoire_vive ON composant.Id_Composant = memoire_vive.Id_Composant
    LEFT JOIN processeur ON composant.Id_Composant = processeur.Id_Composant
    LEFT JOIN souris ON composant.Id_Composant = souris.Id_Composant
    WHERE Id_Modele = :idModele");
    $sqlSelect->bindValue(':idModele', $id, PDO::PARAM_INT);
    $sqlSelect->execute();
    $res = $sqlSelect->fetchAll();


    $results = [];
    foreach ($res as $caracTab) {
        $categorie = str_replace(' ', '', $caracTab['categorie']);
        $caracObj = new $categorie($caracTab);
        $results[] = $caracObj;
        // var_dump($caracTab['nom']);
    }

    $sta = $db->prepare('SELECT categorie,nom, Id_Composant FROM composant');
    $sta->execute();
    $composants = $sta->fetchAll();

    if (isset($_POST['modifier'])) {
foreach($results as $composant){
        var_dump($_POST[str_replace(' ', '', $composant->getCategorie())]);
    }
}
    ?>

    <div class="container">
        <h4 class="text-center m-5">Formulaire de modification du modèle</h4>
        <form class="d-flex flex-column gap-3" method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $modele->getNom(); ?>">
            </div>
            <div class="form-group">
                <label for="isLaptop">Portable</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="portable" value="1"
                        <?php if ($modele->getPortable() == 1) {
                                echo 'checked';
                            }
                            ?>
                        >Oui
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="portable" value="0" 
                            <?php if ($modele->getPortable() == 0) {
                                echo 'checked';
                            }
                            ?>
                    >Non
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" min=0 class="form-control" id="quantiteModele" name="quantiteModele"
                        value="<?php echo $modele->getQuantite(); ?>">
                </div>
                    <?php foreach ($results as $composant) {
                        ?>
                            <div class=" d-flex gap-3 flex-row align-items-center">
                                <div class="form-group d-flex col-6 flex-row align-items-center gap-3">
                                    <label for="<?php echo $composant->getCategorie(); ?>" class="align-items-center col-3">
                                        <?php echo $composant->getCategorie(); ?>
                                    </label>
                                    <select class="form-select" name="<?php echo $composant->getCategorie(); ?>" 
                                    <option><?php echo $composant->getNom(); ?></option>
                                        <?php foreach ($composants as $compo) {
                                            if ($compo['categorie'] == $composant->getCategorie()) {
                                                echo '<option value="' . $compo['Id_Composant'] . '"';
                                                if ($compo['nom'] == $composant->getNom()) {
                                                    echo 'selected';
                                                }
                                                echo '>' . $compo['nom'] . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group d-flex flex-row col-2 align-items-center gap-3">
                                    <label for="quantite" class="align-items-center">Quantité</label>
                                    <input type="number" min=0 class="form-control align-items-center text-center" id="quantite" name="quantite<?php echo $composant->getCategorie(); ?>"
                                        value="<?php echo $composant->getQuantiteModele(); ?>">
                                </div>
                                <div class="form-group">
                                    <input hidden type="text" class="form-control" id="categorie" name="categorie"
                                        value="<?php echo $composant->getCategorie(); ?>">
                                </div>
                            </div>
                            <?php
                    }
}
?>
            <button type="submit" class="btn btn-primary my-3" name="modifier"
                href="?page=concepteur/modifModele">Envoyer</button>
    </form>
</div>