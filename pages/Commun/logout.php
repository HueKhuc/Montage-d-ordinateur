<?php
$pageTitle = "deconnexion";

require_once "includes/header.php";
session_destroy();

header("Location:index.php?logout=success");


?>




<?php
require_once "includes/footer.php";
?>