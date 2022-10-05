<?php
$server = "localhost:3307";
$user = "root";
$pw = "";
$dbname = "garage";
try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname",$user,$pw);

    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo("Connexion impossible :  $e ");
}
?>