<?php
// Fonction pour obtenir le prix TTC (arrondi)
function prixTTC($ttc) {
  return round($ttc * 1.2, 2);
}
?>