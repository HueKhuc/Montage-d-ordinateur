<?php
$dsn = 'mysql:dbname=montage_ordi;port=3306;host=127.0.0.1';
$user = 'root'; // Utilisateur par défaut
$motDePasse = ''; // Par défaut, pas de mot de passe sur Wamp
try {
    $db = new PDO($dsn, $user, $motDePasse, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('Connexion échouée : ' . $e->getMessage());
}
?>