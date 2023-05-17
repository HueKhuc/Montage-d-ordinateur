<?php

if (isset($_GET['idModele']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    $id = $_GET['idModele'];
    
// Récupération de données
    $pdoStat = $db->prepare('SELECT * FROM modele WHERE idModele = :idModele');
    $pdoStat->bindValue(':idModele', $id, PDO::PARAM_INT);
    $pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
    $pdoStat->execute();
    $modele = $pdoStat->fetch();

    $sqlSelect = $db->prepare("SELECT 
    composant.*,
    montage.quantite as quantiteModele,
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
    INNER JOIN montage ON composant.idComposant = montage.idComposant
    LEFT JOIN alimentation ON composant.idComposant = alimentation.idComposant
    LEFT JOIN carte_graphique ON composant.idComposant = carte_graphique.idComposant
    LEFT JOIN carte_mere ON composant.idComposant = carte_mere.idComposant
    LEFT JOIN clavier ON composant.idComposant = clavier.idComposant
    LEFT JOIN disque_dur ON composant.idComposant = disque_dur.idComposant
    LEFT JOIN ecran ON composant.idComposant = ecran.idComposant
    LEFT JOIN memoire_vive ON composant.idComposant = memoire_vive.idComposant
    LEFT JOIN processeur ON composant.idComposant = processeur.idComposant
    LEFT JOIN souris ON composant.idComposant = souris.idComposant
    WHERE idModele = :idModele");
    $sqlSelect->bindValue(':idModele', $id, PDO::PARAM_INT);
    $sqlSelect->execute();
    $res = $sqlSelect->fetchAll();


    $results = [];
    foreach ($res as $caracTab) {
        $categorie = str_replace(' ', '', $caracTab['categorie']);
        $caracObj = new $categorie($caracTab);
        $results[] = $caracObj;
    }

    $sta = $db->prepare('SELECT * FROM composant');
    $sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
    $sta->execute();
    $composants = $sta->fetchAll();

    if (isset($_POST['modifier'])) {
        echo '<div class="alert alert-success my-5" role="alert">Done</div>';
        // Update la table 'Modele'
        $sqlUpdateMod = 'UPDATE modele
                                SET estPortable = :estPortable, quantite = :quantite, nom =:nom
                                WHERE idModele = :idModele';
        $pdoUpdateMod = $db->prepare($sqlUpdateMod);
        $pdoUpdateMod->bindValue(':idModele',$id,PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':estPortable',$_POST['estPortable'],PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':quantite',$_POST['quantiteModele'],PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':nom',$_POST['nom'],PDO::PARAM_STR);
        $pdoUpdateMod->execute();

        // Update la table 'Montage'
        $sqlDelMontage = 'DELETE FROM montage WHERE idModele = :idModele';
        $pdoDelMontage = $db->prepare($sqlDelMontage);
        $pdoDelMontage->bindValue(':idModele',$id,PDO::PARAM_INT);
        $pdoDelMontage->execute();

        foreach($results as $composant){
            $cat = str_replace(' ', '', $composant->getCategorie());
            $sqlInsertMontage = 'INSERT INTO montage (idModele, idComposant, quantite)
                                    VALUES (:idModele, :idComposant,:quantite)';
            $pdoInsertMontage = $db->prepare($sqlInsertMontage);
            $pdoInsertMontage->bindValue(':idModele',$id,PDO::PARAM_INT);
            $pdoInsertMontage->bindValue(':idComposant',$_POST[$cat],PDO::PARAM_INT);                      
            $pdoInsertMontage->bindValue(':quantite',$_POST['quantite'.$cat],PDO::PARAM_INT);  
            $pdoInsertMontage->execute();
        }}
    ?>

<div class="container">
    <h4 class="text-center m-5">Formulaire de modification du modèle</h4>
    <form class="d-flex flex-column gap-3" method="POST" action="">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $modele->getNom(); ?>">
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
                <?php
                    }
}
?>
        <button type="submit" class="btn btn-primary my-3" name="modifier" href="?page=concepteur/modifModele">
            Envoyer
        </button>
    </form>
</div>