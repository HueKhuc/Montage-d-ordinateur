<footer class="d-flex flex-wrap justify-content-start align-items-center py-3 my-4 border-top bg-dark text-white">
  <ul class="nav col-md-4 justify-content-between">
    <li class="nav-item"><p class="nav-link px-2 text-white">CLDL © 2023</p></li>
    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Accueil</a></li>
    <?php
    if (isset($_SESSION['nom'])) {
    ?>
      <li class="nav-item text-white">
        <a class="nav-link" href="?page=commun/logout">Deconnexion</a>
      </li>
      <?php
      } else {
      ?>
    <li class="nav-item">
      <a class="nav-link text-white" href="?page=commun/login" >Connexion</a>
    </li>
    <?php
    }
    ?>
  </ul>
</footer>