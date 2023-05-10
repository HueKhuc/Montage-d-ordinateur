<?php
// Récupération de données de la table Composant
if (isset($_GET['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM composant WHERE Id_Composant = ' . $id;
    $sth = $db->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
    $sth->execute();
    $results = $sth->fetchAll();
    foreach ($results as $composant) {
        $categorie = $composant->getCategorie();
        $nom = $composant->getNom();
        $marque = $composant->getMarque();
        $prix = $composant->getPrix();
        $quantite = $composant->getQuantite();
        $isLaptop = $composant->getIsLaptop();
        // formulaire de modification
        echo '
        <div class="container">
            <h4 class="text-center m-5">Formulaire de modification de la pièce</h4>
            <form class="d-flex flex-column gap-3" method="POST" action="">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value = "' . $nom . '">
                </div>
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" class="form-control" id="marque" name="marque" value = "' . $marque . '">
                </div>

                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" step="0.01" min = 0 class="form-control" id="prix" name="prix" value = "' . $prix . '">
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" min = 0 class="form-control" id="quantite" name="quantite" value = "' . $quantite . '">
                </div>
                <div class="form-group">
                    <label for="isLaptop">Compatible</label>
                    <div class="form-check">
                        <label class="form-check-label" for="portable">Compatible avec ordinateur portable</label>
                        <input type="radio" class="form-check-input" id="portable" name="portable" value="on" >
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="tour">Compatible avec ordinateur fixe</label>
                        <input type="radio" class="form-check-input" id="tour" name="portable" value="off" >
                    </div>
                </div>';
        // Chaque type de pièces a des caractéristiques spécifiques
        if ($categorie == "Alimentation") {
            echo '
                            <div class="form-group">
                                <label for="puissance">Puissance (en W)</label>
                                <input type="number" min=0 class="form-control" name="puissance" >
                            </div>';
        } elseif ($categorie == "Carte Graphique") {
            echo '
                            <div class="form-group">
                                <label for="chipset">Chipset</label>
                                <input type="text" class="form-control" name="chipset" >
                            </div>
                            <div class="form-group">
                                <label for="memoire">Mémoire (en Go)</label>
                                <input type="number" class="form-control" name="memoire" >
                            </div>';
        } elseif ($categorie == "Carte Mere") {
            echo '
                            <div class="form-group">
                                <label for="socket">Socket / chipset</label>
                                <input type="text" class="form-control" name="socket" >
                            </div>
                            <div class="form-group">
                                <label for="format">Format (ATX, micro-ATX, etc.)</label>
                                <input type="text" class="form-control" name="format" >
                            </div>';
        } elseif ($categorie == "Processeur") {
            echo '
                            <div class="form-group">
                                <label for="frequence">Fréquence CPU (en GHz)</label>
                                <input type="number" step="0.01" min = 0 class="form-control" name="frequence" >
                            </div>
                            <div class="form-group">
                                <label for="nbcoeurs">Nombre de cœurs</label>
                                <input type="number" class="form-control" name="nbcoeurs" >
                            </div>
                            <div class="form-group">
                                <label for="chipsetCompatible">Chipsets compatibles</label>
                                <input type="text" class="form-control" name="chipsetCompatible" >
                            </div>';
        } elseif ($categorie == "Memoire vive") {
            echo '
                        <div class="form-group">
                            <label for="capacite">Capacité (en Go)</label>
                            <input type="number" class="form-control" name="capacite" >
                        </div>
                        <div class="form-group">
                            <label for="nbBarrettes">Nombre de barrettes</label>
                            <input type="number" class="form-control" name="nbBarrettes" >
                        </div>
                        <div class="form-group">
                            <label for="type">Type + Fréquence + norme mémoire (exemple : DDR4 3200 MHz PC4-25600)</label>
                            <input type="text" class="form-control" name="type" >
                        </div>';
        } elseif ($categorie == "Clavier") {
            echo '
                            <div class="form-group">
                                <label for="capacite">Avec ou sans fil</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="avecFil">Avec fil</label>
                                    <input type="radio" class="form-check-input" id="portable" name="avecFil" >
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="sansFil">Sans fil</label>
                                    <input type="radio" class="form-check-input" id="tour" name="sansFil" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="barrette">Avec ou sans pavé numérique</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="avecPave">Avec pavé</label>
                                    <input type="radio" class="form-check-input" id="portable" name="avecPave" >
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="sansPave">Sans pavé</label>
                                    <input type="radio" class="form-check-input" id="tour" name="sansPave" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="typeTouche">Type de touches</label>
                                <input type="text" class="form-control" name="typeTouche" >
                            </div>
                            ';
        } elseif ($categorie == "Souris") {
            echo '
                        <div class="form-group">
                            <label for="filSouris">Avec ou sans fil</label>
                            <div class="form-check">
                                <label class="form-check-label" for="avecFilSouris">Avec fil</label>
                                <input type="radio" class="form-check-input" id="portable" name="avecFilSouris" >
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="sansFilSouris">Sans fil</label>
                                <input type="radio" class="form-check-input" id="tour" name="sansFilSouris" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nbTouche">Nombre de touches</label>
                            <input type="number" class="form-control" name="nbTouche" >
                        </div>
                        ';
        } elseif ($categorie == "Ecran") {
            echo '
                        <div class="form-group">
                            <label for="taille">Taille de la diagonale</label>
                            <input type="number" class="form-control" name="taille" >
                        </div>
                        ';
        } elseif ($categorie == "Disque dur") {
            echo '
                        <div class="form-group">
                            <label for="typeDisque">Type</label>
                            <div class="form-check">
                                <label class="form-check-label" for="SSD">SSD</label>
                                <input type="radio" class="form-check-input" id="portable" name="SSD" >
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="disqueDur">Disque dur</label>
                                <input type="radio" class="form-check-input" id="tour" name="disqueDur" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capaciteDisqueDur">Capacité (en Go)</label>
                            <input type="number" class="form-control" name="capaciteDisqueDur" >
                        </div>
                        ';
        }
        echo '
                <button type="submit" class="btn btn-primary my-3" name = "modifier" href="?page=concepteur/modifierComposant">Envoyer</button>
            </form>
</div>
        ';
        if (isset($_POST['modifier'])) {
            $nom = $_POST['nom'];
            $marque = $_POST['marque'];
            var_dump($nom);
            echo $nom .'<br>';
            echo $marque;
            $sqlModif = 'UPDATE composant
                            SET nom = '.$nom.'
                        WHERE Id_Composant = '.$id;
        }
    }
}
?>