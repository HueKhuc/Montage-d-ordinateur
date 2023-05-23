<?php
use Model\Composant;


// Formulaire d'ajout composant
if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
    echo '
<div class="container">
    <h2 class="text-center m-3 text-uppercase">Ajouter un nouveau composant</h2>
    <form class="d-flex flex-row gap-3 align-items-end mb-3" method="POST">
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select class="form-control" id="categorie" name="categorie"> 
';
foreach (Composant::CATEGORIES as $key => $categorie) {
    echo '<option value = "' . $categorie . '"';
    if (isset($_POST['categorie']) && $_POST['categorie'] == $categorie) {
        echo ' selected';
    }
        echo '>' . $categorie . '</option>';
}
echo '   
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Choisir</button>
    </form>';
    if (isset($_POST['categorie'])) {
        echo '
        <form class="d-flex flex-column gap-3" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="marque">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" step="0.01" min = 0 class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="quantite">Quantite</label>
                <input type="number" min = 0 class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="form-group">
                <label for="estPortable">Compatible</label>
                <div class="form-check">
                    <label class="form-check-label" for="estPortable">Compatible avec ordinateur portable</label>
                    <input type="radio" class="form-check-input" id="estPortable" name="estPortable" value="on" required>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="tour">Compatible avec ordinateur fixe</label>
                    <input type="radio" class="form-check-input" id="tour" name="estPortable" value="off" required>
                </div>
            </div>';          
        
// Chaque type de composant a des caractéristiques spécifiques
        if ($_POST['categorie'] == "Alimentation") {
            echo '
                    <div class="form-group">
                        <label for="puissance">Puissance (en W)</label>
                        <input type="number" min=0 class="form-control" name="puissance" required>
                    </div>';
        } elseif ($_POST['categorie'] == "Carte Graphique") {
            echo '
                    <div class="form-group">
                        <label for="chipset">Chipset</label>
                        <input type="text" class="form-control" name="chipset" required>
                    </div>
                    <div class="form-group">
                        <label for="memoire">Mémoire (en Go)</label>
                        <input type="number" class="form-control" name="memoire" required>
                    </div>';
        } elseif ($_POST['categorie'] == "Carte Mere") {
            echo '
                    <div class="form-group">
                        <label for="socket">Socket / chipset</label>
                        <input type="text" class="form-control" name="socket" required>
                    </div>
                    <div class="form-group">
                        <label for="format">Format (ATX, micro-ATX, etc.)</label>
                        <input type="text" class="form-control" name="format" required>
                    </div>';
        } elseif ($_POST['categorie'] == "Processeur") {
            echo '
                    <div class="form-group">
                        <label for="frequence">Fréquence CPU (en GHz)</label>
                        <input type="number" step="0.01" min = 0 class="form-control" name="frequence" required>
                    </div>
                    <div class="form-group">
                        <label for="nbcoeurs">Nombre de cœurs</label>
                        <input type="number" class="form-control" name="nbCoeurs" required>
                    </div>
                    <div class="form-group">
                        <label for="chipsetCompatible">Chipsets compatibles</label>
                        <input type="text" class="form-control" name="chipsetCompatible" required>
                    </div>';
        } elseif ($_POST['categorie'] == "Memoire vive") {
            echo '
                <div class="form-group">
                    <label for="capacite">Capacité (en Go)</label>
                    <input type="number" class="form-control" name="capaciteMemoireVive" required>
                </div>
                <div class="form-group">
                    <label for="nbBarrettes">Nombre de barrettes</label>
                    <input type="number" class="form-control" name="nbBarrettes" required>
                </div>
                <div class="form-group">
                    <label for="type">Type + Fréquence + norme mémoire (exemple : DDR4 3200 MHz PC4-25600)</label>
                    <input type="text" class="form-control" name="type" required>
                </div>';
        } elseif ($_POST['categorie'] == "Clavier") {
            echo '
                <div class="form-group">
                    <label for="capacite">Avec ou sans fil</label>
                    <div class="form-check">
                        <label class="form-check-label" for="avecFil">Avec fil</label>
                        <input type="radio" class="form-check-input" id="portable" name="avecFil" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="sansFil">Sans fil</label>
                        <input type="radio" class="form-check-input" id="tour" name="sansFil" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="barrette">Avec ou sans pavé numérique</label>
                    <div class="form-check">
                        <label class="form-check-label" for="avecPave">Avec pavé</label>
                        <input type="radio" class="form-check-input" id="portable" name="avecPave" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="sansPave">Sans pavé</label>
                        <input type="radio" class="form-check-input" id="tour" name="sansPave" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="typeTouche">Type de touches</label>
                    <input type="text" class="form-control" name="typeTouche" required>
                </div>
                ';
        } elseif ($_POST['categorie'] == "Souris") {
            echo '
                <div class="form-group">
                    <label for="filSouris">Avec ou sans fil</label>
                    <div class="form-check">
                        <label class="form-check-label" for="avecFilSouris">Avec fil</label>
                        <input type="radio" class="form-check-input" id="portable" name="avecFilSouris" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="sourisSansFil">Sans fil</label>
                        <input type="radio" class="form-check-input" id="tour" name="sourisSansFil" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nbTouches">Nombre de touches</label>
                    <input type="number" class="form-control" name="nbTouches" required>
                </div>
                ';
        } elseif ($_POST['categorie'] == "Ecran") {
            echo '
                <div class="form-group">
                    <label for="taille">Taille de la diagonale</label>
                    <input type="number" class="form-control" name="taille" required>
                </div>
                ';
        } elseif ($_POST['categorie'] == "Disque dur") {
            echo '
                <div class="form-group">
                    <label for="typeDisque">Type</label>
                    <div class="form-check">
                        <label class="form-check-label" for="SSD">SSD</label>
                        <input type="radio" class="form-check-input" id="estPortable" name="SSD" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="disqueDur">Disque dur</label>
                        <input type="radio" class="form-check-input" id="tour" name="disqueDur" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="capaciteDisqueDur">Capacité (en Go)</label>
                    <input type="number" class="form-control" name="capaciteDisqueDur" required>
                </div>
                ';
        }
        echo '<input type="hidden" value="' . $_POST['categorie'] . '" name="categorie">
                <button type="submit" class="btn btn-primary my-3" name ="composant">Créer</button>
        </form>';        
    }
echo '</div>';
}
?>