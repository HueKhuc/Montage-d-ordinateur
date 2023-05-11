<?php
// Récupération de données de la table Composant
if (isset($_GET['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    $id = $_GET['id'];
    if (isset($_POST['modifier'])) {
        echo '<div class="alert alert-success my-5" role="alert">Done</div>';
        //L'insertion de données dans la table Composant
        $sqlUpdateComposant = '
            UPDATE  composant
            SET nom = :nom,
                marque = :marque,
                prix = :prix,
                quantite = :quantite,
                isLaptop = :isLaptop,
                archivage = :archivage
            WHERE Id_Composant = :idComposant';
        $pdoStatement = $db->prepare($sqlUpdateComposant);
        $portable = 0;
        if ($_POST['portable'] == 'on') {
            $portable = 1;
        }
        $archivage = 0;
        $categorie = $_POST['categorie'];
        $pdoStatement->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':marque', $_POST['marque'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':quantite', $_POST['quantite'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':isLaptop', $portable, PDO::PARAM_INT);
        $pdoStatement->bindValue(':archivage', $archivage, PDO::PARAM_INT);
        $pdoStatement->bindValue(':idComposant', $id, PDO::PARAM_INT);

        $pdoStatement->execute();

        //L'insertion de données dans les tables enfants
        if ($categorie == 'Alimentation') {
            $sql = 'UPDATE alimentation
                    SET puissance = :puissance
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':puissance' => $_POST['puissance'],

            ];
        } elseif ($categorie == 'Carte Mere') {
            $sql = 'UPDATE carte_mere
                    SET socket = :socket,
                        format = :format
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':socket' => $_POST['socket'],
                ':format' => $_POST['format'],

            ];
        } elseif ($categorie == 'Disque dur') {
            $sql = 'UPDATE disque_dur
                    SET ssd = :ssd,
                        capaciteDisque = :capacite
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':ssd' => $_POST['ssd'],
                ':capacite' => $_POST['capaciteDisqueDur'],

            ];
        } elseif ($categorie == 'Memoire vive') {
            $sql = 'UPDATE memoire_vive
                    SET capacite = :capacite,
                        nbBarrettes = :nbBarrettes,
                        type = :type
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':capacite' => $_POST['capacite'],
                ':nbBarrettes' => $_POST['nbBarrettes'],
                ':type' => $_POST['type'],
            ];
        } elseif ($categorie == 'Carte Graphique') {
            $sql = 'UPDATE carte_graphique
                    SET chipset = :chipset,
                        memoire = :memoire
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':chipset' => $_POST['chipset'],
                ':memoire' => $_POST['memoire'],

            ];
        } elseif ($categorie == 'Clavier') {
            $fil = 0;
            if ($_POST['avecFil'] == 'on') {
                $fil = 1;
            }
            $pave = 0;
            if ($_POST['avecPave'] == 'on') {
                $pave = 1;
            }
            $sql = 'UPDATE clavier
                    SET sansFilClavier = :sansfil,
                        paveNumerique = :pavenumerique,
                        typetouche = :typetouche
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':sansfil' => $fil,
                ':pavenumerique' => $pave,
                ':typetouche' => $_POST['typeTouche'],
            ];
        } elseif ($categorie == 'Ecran') {
            $sql = 'UPDATE ecran
                    SET taille = :taille,
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':taille' => $_POST['taille'],
            ];
        } elseif ($categorie == 'Souris') {
            $filSouris = 0;
            if ($_POST['avecFilSouris'] == 'on') {
                $filSouris = 1;
            }
            $sql = 'UPDATE souris
                    SET sansFilSouris = :sansfil,
                        nbTouche = :nbTouche,
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':sansfil' => $filSouris,
                ':nbtouche' => $_POST['nbTouche'],
            ];
        } elseif ($categorie == 'Processeur') {
            $sql = 'UPDATE processeur
                    SET frequence = :frequence,
                        nbCoeurs = :nbcoeurs,
                        chipsetCompatible = :chipsetcompatible
                    WHERE Id_Composant = :id ';
            $params = [
                ':id' => $id,
                ':frequence' => $_POST['frequence'],
                ':nbcoeurs' => $_POST['nbcoeurs'],
                ':chipsetcompatible' => $_POST['chipsetCompatible'],
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
    LEFT JOIN alimentation ON composant.Id_Composant = alimentation.Id_Composant
    LEFT JOIN carte_graphique ON composant.Id_Composant = carte_graphique.Id_Composant
    LEFT JOIN carte_mere ON composant.Id_Composant = carte_mere.Id_Composant
    LEFT JOIN clavier ON composant.Id_Composant = clavier.Id_Composant
    LEFT JOIN disque_dur ON composant.Id_Composant = disque_dur.Id_Composant
    LEFT JOIN ecran ON composant.Id_Composant = ecran.Id_Composant
    LEFT JOIN memoire_vive ON composant.Id_Composant = memoire_vive.Id_Composant
    LEFT JOIN processeur ON composant.Id_Composant = processeur.Id_Composant
    LEFT JOIN souris ON composant.Id_Composant = souris.Id_Composant
    WHERE composant.Id_Composant = :idComposant");
    $sqlSelect->bindValue(':idComposant', $id, PDO::PARAM_INT);
    $sqlSelect->execute();
    $res = $sqlSelect->fetchAll();

    // $results = [];
    foreach ($res as $caracTab) {
        // $categorie = str_replace(' ', '', $caracTab['categorie']);
        $categorie = $caracTab['categorie'];
        // $caracObj = new $categorie($caracTab);
        // $results[] = $caracObj;

        echo '
        <div class="container">
            <h4 class="text-center m-5">Formulaire de modification de la pièce</h4>
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
                    <label for="isLaptop">Compatible</label>
                    <div class="form-check">
                        <label class="form-check-label" for="portable">Compatible avec ordinateur portable</label>
                        <input type="radio" class="form-check-input" id="portable" name="portable" value="on" ';
        if ($caracTab['isLaptop'] == 1) {
            echo 'checked';
        }
        echo '>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="tour">Compatible avec ordinateur fixe</label>
                        <input type="radio" class="form-check-input" id="tour" name="portable" value="off"  ';
        if ($caracTab['isLaptop'] == 0) {
            echo 'checked';
        }
        echo '>
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
                            <input type="number" class="form-control" name="capacite" value = "';
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
                                    <label class="form-check-label" for="avecFil">Avec fil</label>
                                    <input type="radio" class="form-check-input" id="portable" name="avecFil" ';
            if ($caracTab['sansFilClavier'] == 0) {
                echo 'checked';
            }
            echo '>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="sansFil">Sans fil</label>
                                    <input type="radio" class="form-check-input" id="tour" name="sansFil" ';
            if ($caracTab['sansFilClavier'] == 1) {
                echo 'checked';
            }
            echo '>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="barrette">Avec ou sans pavé numérique</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="avecPave">Avec pavé</label>
                                    <input type="radio" class="form-check-input" id="portable" name="avecPave" ';
            if ($caracTab['paveNumerique'] == 1) {
                echo 'checked';
            }
            echo ' >
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="sansPave">Sans pavé</label>
                                    <input type="radio" class="form-check-input" id="tour" name="sansPave" ';
            if ($caracTab['paveNumerique'] == 0) {
                echo 'checked';
            }
            echo ' >
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
                                <label class="form-check-label" for="avecFilSouris">Avec fil</label>
                                <input type="radio" class="form-check-input" id="portable" name="avecFilSouris" ';
            if ($caracTab['sansFilSouris'] == 0) {
                echo 'checked';
            }
            echo ' >
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="sansFilSouris">Sans fil</label>
                                <input type="radio" class="form-check-input" id="tour" name="sansFilSouris" ';
            if ($caracTab['sansFilSouris'] == 1) {
                echo 'checked';
            }
            echo '>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nbTouche">Nombre de touches</label>
                            <input type="number" class="form-control" name="nbTouche"  value = "';
            echo $caracTab['nbTouche'];
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
                                <input type="radio" class="form-check-input" id="portable" name="ssd"  ';
            if ($caracTab['ssd'] == 1) {
                echo 'checked';
            }
            echo '>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="disqueDur">Disque dur</label>
                                <input type="radio" class="form-check-input" id="tour" name="disqueDur" ';
            if ($caracTab['ssd'] == 0) {
                echo 'checked';
            }
            echo ' >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capaciteDisqueDur">Capacité (en Go)</label>
                            <input type="number" class="form-control" name="capaciteDisqueDur" value = "';
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