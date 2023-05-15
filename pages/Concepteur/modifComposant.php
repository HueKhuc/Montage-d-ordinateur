<?php
// Récupération de données de la table Composant
if (isset($_GET['idComposant']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    $idComposant = $_GET['idComposant'];

    if (isset($_POST['modifier'])) {
        echo '<div class="alert alert-success my-5" role="alert">Done</div>';
// L'insertion de données dans la table Composant
        $sqlUpdateComposant = '
            UPDATE composant
            SET nom = :nom,
                marque = :marque,
                prix = :prix,
                quantite = :quantite,
                estPortable = :estPortable
            WHERE idComposant = :idComposant';
        $pdoStatement = $db->prepare($sqlUpdateComposant);

        $pdoStatement->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':marque', $_POST['marque'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':quantite', $_POST['quantite'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':estPortable', $_POST['estPortable'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idComposant', $idComposant, PDO::PARAM_INT);

        $pdoStatement->execute();

//L'insertion de données dans les tables enfants
        $categorie = $_POST['categorie'];
        if ($categorie == 'Alimentation') {
            $sql = 'UPDATE alimentation
                    SET puissance = :puissance
                    WHERE idComposant = :idComposant ';
            $params = [
                ':idComposant' => $idComposant,
                ':puissance' => $_POST['puissance'],

            ];
        } elseif ($categorie == 'Carte Mere') {
            $sql = 'UPDATE carte_mere
                    SET socket = :socket,
                        format = :format
                    WHERE idComposant = :idComposant ';
            $params = [
                ':idComposant' => $idComposant,
                ':socket' => $_POST['socket'],
                ':format' => $_POST['format'],

            ];
        } elseif ($categorie == 'Disque dur') {
            $sql = 'UPDATE disque_dur
                    SET ssd = :ssd,
                        capaciteDisque = :capacite
                    WHERE idComposant = :idComposant';
            $params = [
                ':idComposant' => $idComposant,
                ':estSsd' => $_POST['estSsd'],
                ':capaciteDisqueDur' => $_POST['capaciteDisqueDur'],

            ];
        } elseif ($categorie == 'Memoire vive') {
            $sql = 'UPDATE memoire_vive
                    SET capaciteMemoireVive = :capaciteMemoireVive,
                        nbBarrettes = :nbBarrettes,
                        type = :type
                    WHERE idComposant = :idComposant ';
            $params = [
                ':idComposant' => $idComposant,
                ':capaciteMemoireVive' => $_POST['capacite'],
                ':nbBarrettes' => $_POST['nbBarrettes'],
                ':type' => $_POST['type'],
            ];
        } elseif ($categorie == 'Carte Graphique') {
            $sql = 'UPDATE carte_graphique
                    SET chipset = :chipset,
                        memoire = :memoire
                    WHERE idComposant = :idComposant ';
            $params = [
                ':idComposant' => $idComposant,
                ':chipset' => $_POST['chipset'],
                ':memoire' => $_POST['memoire'],

            ];
        } elseif ($categorie == 'Clavier') {
            $sql = 'UPDATE clavier
                    SET clavierSansFil = :clavierSansFil,
                        paveNumerique = :paveNumerique,
                        typeTouche = :typeTouche
                    WHERE idComposant = :idComposant';
            $params = [
                ':idComposant' => $idComposant,
                ':clavierSansFil' => $_POST['sansFil'],
                ':paveNumerique' => $_POST['avecPave'],
                ':typeTouche' => $_POST['typeTouche'],
            ];
        } elseif ($categorie == 'Ecran') {
            $sql = 'UPDATE ecran
                    SET taille = :taille,
                    WHERE idComposant = :idComposant';
            $params = [
                ':idComposant' => $idComposant,
                ':taille' => $_POST['taille'],
            ];
        } elseif ($categorie == 'Souris') {
            $sql = 'UPDATE souris
                    SET sourisSansFil = :sourisSansFil,
                        nbTouches = :nbTouches,
                    WHERE idComposant = :idComposant';
            $params = [
                ':idComposant' => $idComposant,
                ':sourisSansFil' => $_POST['sourisSansFil'],
                ':nbTouches' => $_POST['nbTouches'],
            ];
        } elseif ($categorie == 'Processeur') {
            $sql = 'UPDATE processeur
                    SET frequence = :frequence,
                        nbCoeurs = :nbCoeurs,
                        chipsetCompatible = :chipsetCompatible
                    WHERE idComposant = :idComposant';
            $params = [
                ':idComposant' => $idComposant,
                ':frequence' => $_POST['frequence'],
                ':nbCoeurs' => $_POST['nbCoeurs'],
                ':chipsetCompatible' => $_POST['chipsetCompatible'],
            ];
        }
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
    }

// Récupération de données
    $sqlSelect = $db->prepare("SELECT 
    composant.*,
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
    LEFT JOIN alimentation ON composant.idComposant = alimentation.idComposant
    LEFT JOIN carte_graphique ON composant.idComposant = carte_graphique.idComposant
    LEFT JOIN carte_mere ON composant.idComposant = carte_mere.idComposant
    LEFT JOIN clavier ON composant.idComposant = clavier.idComposant
    LEFT JOIN disque_dur ON composant.idComposant = disque_dur.idComposant
    LEFT JOIN ecran ON composant.idComposant = ecran.idComposant
    LEFT JOIN memoire_vive ON composant.idComposant = memoire_vive.idComposant
    LEFT JOIN processeur ON composant.idComposant = processeur.idComposant
    LEFT JOIN souris ON composant.idComposant = souris.idComposant
    WHERE composant.idComposant = :idComposant");
    $sqlSelect->bindValue(':idComposant', $idComposant, PDO::PARAM_INT);
    $sqlSelect->execute();
    $res = $sqlSelect->fetchAll();

    // $results = [];
    foreach ($res as $caracTab) {
        // $categorie = str_replace(' ', '', $caracTab['categorie']);
        $categorie = $caracTab['categorie'];
        // $caracObj = new $categorie($caracTab);
        // $results[] = $caracObj;
        // var_dump($caracTab['clavierSansFil']);
        echo '
        <div class="container">
            <h4 class="text-center m-5">Formulaire de modification du composant</h4>
            <form class="d-flex flex-column gap-3" method="POST" action="">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value = "' . $caracTab['nom'] . '">
                </div>
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" class="form-control" id="marque" name="marque" value = "' . $caracTab['marque'] . '">
                </div>
                <div class="form-group">
                    <input hidden type="text" class="form-control" id="categorie" name="categorie" value = "' . $caracTab['categorie'] . '">
                </div>
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" step="0.01" min = 0 class="form-control" id="prix" name="prix" value = "' . $caracTab['prix'] . '">
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" min = 0 class="form-control" id="quantite" name="quantite" value = "' . $caracTab['quantite'] . '">
                </div>
                <div class="form-group">
                    <label for="estPortable">Compatible</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="portable" name="estPortable" value="1" ';
        if ($caracTab['estPortable'] == 1) {
            echo 'checked';
        }
        echo '>Compatible avec ordinateur portable
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="tour" name="estPortable" value="0"  ';
        if ($caracTab['estPortable'] == 0) {
            echo 'checked';
        }
        echo '>Compatible avec ordinateur fixe
                    </div>
                </div>';
// Chaque type de pièces a des caractéristiques spécifiques
        if ($categorie == "Alimentation") {
            echo '
                            <div class="form-group">
                                <label for="puissance">Puissance (en W)</label>
                                <input type="number" min=0 class="form-control" name="puissance" value = "';
            echo $caracTab['puissance'];
            echo '">
                            </div>';
        } elseif ($categorie == "Carte Graphique") {
            echo '
                            <div class="form-group">
                                <label for="chipset">Chipset</label>
                                <input type="text" class="form-control" name="chipset" value = "';
            echo $caracTab['chipset'];
            echo '">
                            </div>
                            <div class="form-group">
                                <label for="memoire">Mémoire (en Go)</label>
                                <input type="number" class="form-control" name="memoire" value = "';
            echo $caracTab['memoire'];
            echo '">
                            </div>';
        } elseif ($categorie == "Carte Mere") {
            echo '
                            <div class="form-group">
                                <label for="socket">Socket / chipset</label>
                                <input type="text" class="form-control" name="socket" value = "';
            echo $caracTab['socket'];
            echo '">
                            </div>
                            <div class="form-group">
                                <label for="format">Format (ATX, micro-ATX, etc.)</label>
                                <input type="text" class="form-control" name="format" value = "';
            echo $caracTab['format'];
            echo '">
                            </div>';
        } elseif ($categorie == "Processeur") {
            echo '
                            <div class="form-group">
                                <label for="frequence">Fréquence CPU (en GHz)</label>
                                <input type="number" step="0.01" min = 0 class="form-control" name="frequence" value = "';
            echo $caracTab['frequence'];
            echo '">
                            </div>
                            <div class="form-group">
                                <label for="nbCoeurs">Nombre de cœurs</label>
                                <input type="number" class="form-control" name="nbCoeurs" value = "';
            echo $caracTab['nbCoeurs'];
            echo '">
                            </div>
                            <div class="form-group">
                                <label for="chipsetCompatible">Chipsets compatibles</label>
                                <input type="text" class="form-control" name="chipsetCompatible" value = "';
            echo $caracTab['chipsetCompatible'];
            echo '">
                            </div>';
        } elseif ($categorie == "Memoire vive") {
            echo '
                        <div class="form-group">
                            <label for="capacite">Capacité (en Go)</label>
                            <input type="number" class="form-control" name="capaciteMemoireVive" value = "';
            echo $caracTab['capacite'];
            echo '">
                        </div>
                        <div class="form-group">
                            <label for="nbBarrettes">Nombre de barrettes</label>
                            <input type="number" class="form-control" name="nbBarrettes" value = "';
            echo $caracTab['nbBarrettes'];
            echo '">
                        </div>
                        <div class="form-group">
                            <label for="type">Type + Fréquence + norme mémoire (exemple : DDR4 3200 MHz PC4-25600)</label>
                            <input type="text" class="form-control" name="type" value = "';
            echo $caracTab['type'];
            echo '">
                        </div>';
        } elseif ($categorie == "Clavier") {
            echo '
                            <div class="form-group">
                                <label for="filClavier">Avec ou sans fil</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="avecFil" name="clavierSansFil" value = "0" ';
            if ($caracTab['clavierSansFil'] == 0) {
                echo 'checked';
            }
            echo '> Avec fil
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="clavierSansFil" name="clavierSansFil" value = "1"';
            if ($caracTab['clavierSansFil'] == 1) {
                echo 'checked';
            }
            echo '> Sans fil
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="barrette">Avec ou sans pavé numérique</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="avecPave" name="avecPave" ';
            if ($caracTab['paveNumerique'] == 1) {
                echo 'checked';
            }
            echo ' >Avec pavé
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sansPave" name="avecPave" ';
            if ($caracTab['paveNumerique'] == 0) {
                echo 'checked';
            }
            echo ' >Sans pavé
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="typeTouche">Type de touches</label>
                                <input type="text" class="form-control" name="typeTouche" value = "';
            echo $caracTab['typeTouche'];
            echo '" >
                            </div>
                            ';
        } elseif ($categorie == "Souris") {
            echo '
                        <div class="form-group">
                            <label for="filSouris">Avec ou sans fil</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="avecFilSouris" name="sourisSansFil" value = "0" ';
            if ($caracTab['sourisSansFil'] == 0) {
                echo 'checked';
            }
            echo ' >Avec fil
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="sourisSansFil" name="sourisSansFil" value = "1" ';
            if ($caracTab['sourisSansFil'] == 1) {
                echo 'checked';
            }
            echo '>Sans fil
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nbTouches">Nombre de touches</label>
                            <input type="number" class="form-control" name="nbTouches"  value = "';
            echo $caracTab['nbTouches'];
            echo '">
                        </div>
                        ';
        } elseif ($categorie == "Ecran") {
            echo '
                        <div class="form-group">
                            <label for="taille">Taille de la diagonale</label>
                            <input type="number" class="form-control" name="taille" value = "';
            echo $caracTab['taille'];
            echo '" >
                        </div>
                        ';
        } elseif ($categorie == "Disque dur") {
            echo '
                        <div class="form-group">
                            <label for="typeDisque">Type</label>
                            <div class="form-check">
                                <label class="form-check-label" for="ssd">SSD</label>
                                <input type="radio" class="form-check-input" id="ssd" name="estSsd" value = "1" ';
            if ($caracTab['ssd'] == 1) {
                echo 'checked';
            }
            echo '>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="disqueDur">Disque dur</label>
                                <input type="radio" class="form-check-input" id="disqueDur" name="estSsd" value = "0" ';
            if ($caracTab['estSsd'] == 0) {
                echo 'checked';
            }
            echo ' >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capaciteDisqueDur">Capacité (en Go)</label>
                            <input type="number" class="form-control" name="capaciteDisque" value = "';
            echo $caracTab['capaciteDisque'];
            echo '" >
                        </div>
                        ';
        }
        echo '
                <button type="submit" class="btn btn-primary my-3" name = "modifier" href="?page=concepteur/modifComposant">Envoyer</button>
            </form>
</div>
        ';

    }
}
?>