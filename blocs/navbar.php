<?php
session_start();


if (isset($_SESSION['login'])) {
?>
    
<link rel="stylesheet" href="../css/navbar.css">
<div class="sidenav">
    <a href="index.php" class="btns">Accueil</a>
    <a href="/admin-panel/home.php" class="btns">Liste des voitures</a>
    <a href="/admin-panel/add-voiture.php" class="btns">Ajouter une voiture</a>
    <a href="/admin-panel/contact.php" class="btns">Contact</a>
    <a href="/admin-panel/logout.php" class="btns">Déconnexion</a>
</div>

<?php
} else {?>
    <link rel="stylesheet" href="../css/navbar.css">
    <div class="sidenav">
        <a href="index.php" class="btns">Accueil</a>
        <a href="admin-panel/admin-login.php" class="btns">Connexion</a>
        <!--<hr />-->
        <a href="contact.php">Me contacter</a>
    </div>

<?php
}
?>