<!-- Footer avec onglet Accueil et onglet Connexion -->
<footer class="py-3 my-4 border-top bg-dark text-white">
  <ul class="d-flex nav align-items-center justify-content-between">
    <li class="nav-item ps-1"><a href="#" class="nav-link text-white">Accueil</a></li>
    <li class="nav-item"><a class="nav-link text-white">CLDL © 2023</a></li>    
    <?php
    if (isset($_SESSION['nom'])) { // Si connecté, onglet deconnexion s'affiche
    ?>
    <li class="nav-item pe-1"><a class="nav-link text-white" href="?page=commun/logout">Déconnexion</a></li>
    <?php
    } else { // Si non connecté, onglet connexion s'affiche
    ?>
    <li class="nav-item pe-1"><a class="nav-link text-white" href="?page=commun/login">Connexion</a></li>
    <?php
    }
    ?>
  </ul>
</footer>