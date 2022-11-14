<?php
$server = "localhost:3306";
$user = "root";
$pw = "root";
$dbname = "garage-voiture";
try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname",$user,$pw);

    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo("Connexion impossible :  $e ");
}
?>