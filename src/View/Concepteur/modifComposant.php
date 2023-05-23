<?php
foreach ($res as $caracTab) {
    $categorie = $caracTab['categorie']; ?>

    <div class="container">
        <h2 class="text-center m-3 text-uppercase">Modifier un composant</h2>
        <form class="d-flex flex-column gap-3" method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $caracTab['nom'] ?>">
            </div>
            <div class="form-group">
                <label for="marque">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" value="<?= $caracTab['marque'] ?>">
            </div>
            <div class="form-group">
                <input hidden type="text" class="form-control" id="categorie" name="categorie"
                    value="<?= $caracTab['categorie'] ?>">
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" step="0.01" min=0 class="form-control" id="prix" name="prix"
                    value="<?= $caracTab['prix'] ?>">
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" min=0 class="form-control" id="quantite" name="quantite"
                    value="<?= $caracTab['quantite'] ?>">
            </div>
            <div class="form-group">
                <label for="estPortable">Compatible</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="portable" name="estPortable" value="1"
                            <?php if ($caracTab['estPortable'] == 1)
                                    echo 'checked'; ?>
                        > Compatible avec ordinateur portable
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="tour" name="estPortable" value="0"
                            <?php if ($caracTab['estPortable'] == 0)
                                    echo 'checked'; ?>
                            >Compatible avec ordinateur fixe
                        </div>
                    </div>
    <!-- Chaque type de pièces a des caractéristiques spécifiques -->
            <?php if ($categorie == "Alimentation") { ?>
                                    <div class="form-group">
                                        <label for="puissance">Puissance (en W)</label>
                                        <input type="number" min=0 class="form-control" name="puissance" value = "
            <?= $caracTab['puissance'] ?>">
                                    </div>
            <?php } elseif ($categorie == "Carte Graphique") { ?>
                                    <div class="form-group">
                                        <label for="chipset">Chipset</label>
                                        <input type="text" class="form-control" name="chipset" value = "
                                <?= $caracTab['chipset'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="memoire">Mémoire (en Go)</label>
                                        <input type="number" class="form-control" name="memoire" value = "
                                <?= $caracTab['memoire'] ?>">
                                    </div>
                                <?php } elseif ($categorie == "Carte Mere") { ?>
                                    <div class="form-group">
                                        <label for="socket">Socket / chipset</label>
                                        <input type="text" class="form-control" name="socket" value = "
                                <?= $caracTab['socket'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="format">Format (ATX, micro-ATX, etc.)</label>
                                        <input type="text" class="form-control" name="format" value = "
                                <?= $caracTab['format'] ?>">
                                    </div>
                                <?php } elseif ($categorie == "Processeur") { ?>
                                    <div class="form-group">
                                        <label for="frequence">Fréquence CPU (en GHz)</label>
                                        <input type="number" step="0.01" min = 0 class="form-control" name="frequence" value = "
                                <?= $caracTab['frequence'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nbCoeurs">Nombre de cœurs</label>
                                        <input type="number" class="form-control" name="nbCoeurs" value = "
                                <?= $caracTab['nbCoeurs'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="chipsetCompatible">Chipsets compatibles</label>
                                        <input type="text" class="form-control" name="chipsetCompatible" value = "
                                <?= $caracTab['chipsetCompatible'] ?>">
                                    </div>
            <?php } elseif ($categorie == "Memoire vive") { ?>
                                <div class="form-group">
                                    <label for="capacite">Capacité (en Go)</label>
                                    <input type="number" class="form-control" name="capaciteMemoireVive" value = "
                            <?= $caracTab['capacite'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nbBarrettes">Nombre de barrettes</label>
                                    <input type="number" class="form-control" name="nbBarrettes" value = "
                            <?= $caracTab['nbBarrettes'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type + Fréquence + norme mémoire (exemple : DDR4 3200 MHz PC4-25600)</label>
                                    <input type="text" class="form-control" name="type" value = "
                            <?= $caracTab['type'] ?>">
                                </div>
                            <?php } elseif ($categorie == "Clavier") { ?>
                                    <div class="form-group">
                                        <label for="filClavier">Avec ou sans fil</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="avecFil" name="clavierSansFil" value = "0" 
                                            <?php if ($caracTab['clavierSansFil'] == 0) {
                                                echo 'checked';
                                            } ?>> Avec fil
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="clavierSansFil" name="clavierSansFil" value = "1"
                                            <?php if ($caracTab['clavierSansFil'] == 1) {
                                                echo 'checked';
                                            } ?>> Sans fil
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="barrette">Avec ou sans pavé numérique</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="avecPave" name="avecPave" 
                    <?php if ($caracTab['paveNumerique'] == 1) {
                        echo 'checked';
                    } ?>>Avec pavé
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="sansPave" name="avecPave" 
                    <?php if ($caracTab['paveNumerique'] == 0) {
                        echo 'checked';
                    } ?>>Sans pavé
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="typeTouche">Type de touches</label>
                                        <input type="text" class="form-control" name="typeTouche" value = "
            <?php $caracTab['typeTouche'] ?>">
                                    </div>
            <?php } elseif ($categorie == "Souris") { ?>
                                <div class="form-group">
                                    <label for="filSouris">Avec ou sans fil</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="avecFilSouris" name="sourisSansFil" value = "0" 
                    <?php if ($caracTab['sourisSansFil'] == 0) {
                        echo 'checked';
                    } ?>>Avec fil
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="sourisSansFil" name="sourisSansFil" value = "1" 
                    <?php if ($caracTab['sourisSansFil'] == 1) {
                        echo 'checked';
                    } ?>>Sans fil
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nbTouches">Nombre de touches</label>
                                    <input type="number" class="form-control" name="nbTouches"  value = "
            <?= $caracTab['nbTouches'] ?>">
                                </div>
            <?php } elseif ($categorie == "Ecran") { ?>
                                <div class="form-group">
                                    <label for="taille">Taille de la diagonale</label>
                                    <input type="number" class="form-control" name="taille" value = "
            <?= $caracTab['taille'] ?>" >
                                </div>
            <?php } elseif ($categorie == "Disque dur") { ?>
                                <div class="form-group">
                                    <label for="typeDisque">Type</label>
                                    <div class="form-check">
                                        <label class="form-check-label" for="ssd">SSD</label>
                                        <input type="radio" class="form-check-input" id="ssd" name="estSsd" value = "1" 
                    <?php if ($caracTab['ssd'] == 1) {
                        echo 'checked';
                    } ?>>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="disqueDur">Disque dur</label>
                                        <input type="radio" class="form-check-input" id="disqueDur" name="estSsd" value = "0" 
                    <?php if ($caracTab['estSsd'] == 0) {
                        'checked';
                    } ?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="capaciteDisqueDur">Capacité (en Go)</label>
                                    <input type="number" class="form-control" name="capaciteDisque" value = "
            <?= $caracTab['capaciteDisque'] ?>" >
                                </div>
            <?php } ?>
                    <button type="submit" class="btn btn-primary my-3" name = "modifier" href="?page=concepteur/modifComposant">Envoyer</button>
                </form>
    </div>       
<?php } ?>