<?php
$server = "localhost";
$user = "root";
$pw = "leMotDePasseDeLaBaseCestMariaDb";
$dbname = "garage-voiture";
try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname",$user,$pw);
    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo("Connexion impossible :  $e ");
}
?>
