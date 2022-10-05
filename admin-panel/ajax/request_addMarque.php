<?php
if (isset($_POST['action']) && isset($_POST['marque'])) {
    include_once("../../dbConnexion.php");
    $marque = $_POST['marque'];

    if ($marque < 2) { echo "erreur"; die();} // Arrete le code si la marque est inférieur a 2 characteres

    $req = $conn->prepare("SELECT * FROM marque");
    $res = $req->execute();
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // On récupère les données 

    if ($res != 1) { echo("erreur"); die(); } // si la requete echoue marque erreur et arretter le code

    foreach ($resultat as $row) { // On boucle a travers chaque ligne de la réponse
        if (trim(strtolower($marque)) == trim(strtolower($row['marque']))) { // On vérifie si la marque n'éxiste pas déja
            echo("existe");
            die();
        }
    }


    $req = $conn->prepare("INSERT INTO `marque`(`marque`) VALUES (:marque)");
    $req->bindParam(':marque',$marque, PDO::PARAM_STR);
    $res = $req->execute();
    if ($res != 1) { echo("erreur"); die(); } // Arrete le code si la requete echoue
    
    echo("success"); // Aucun probleme n'est survenu
}



?>