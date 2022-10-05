<?php

if (isset($_POST['contact'])) {  // On vérifie si l'action demandé est la page contact
    if ($_POST['contact'] == "true") {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) { // S'il manque au moins une donnée
            die(header("Location:../contact.php?contact=false&reason=champvide")); // Redirect error & stop le code
        }
        if (strlen($_POST['message']) > 256) {
            die(header("Location:../contact.php?contact=false&reason=messageLong")); // Redirect error & stop le code
        }
        include("../dbConnexion.php");
        $req = $conn->prepare("INSERT INTO `contact`(`name`, `email`, `message`) VALUES (:name,:email,:message)");
        $req->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
        $req->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
        $req->bindParam(':message',$_POST['message'],PDO::PARAM_STR);
        $resultat =$req->execute();
        if ($resultat == 1) {
            die(header("Location:../contact.php?contact=true"));
        } else {
            die(header("Location:../contact.php?contact=false&reason=error"));
        }
        
        #if success :
        #die(header("Location:../index.php?contact=true))
    }
} else {

    session_start();

    if (isset($_SESSION['login'])) {

    try {

        function checkInput($input) {
            switch ($input) {  
                case $_POST['immatriculation-1'].'_'.$_POST['immatriculation-2'].'_'.$_POST['immatriculation-3'];
                    if (strlen($input) != 10) return die(header("Location:add-voiture.php?error=invalid")); // Si l'imma ne fait pas 10 caracteres (150_021_NC) : erreur ( return + die )
                    // Sinon on continue le code
                    if (!is_numeric(substr($input, 0, 3)) && !is_numeric(substr($input,4,3)) && !substr($input,-2) == "NC") { // Si l'immatriculation est incorrecte : erreur
                        return die(header("Location:add-voiture.php?error=invalid"));
                    } // Sinon on renvoi l'immatriculation correcte.
                    return($input);
                
                   
            }  
        }
        if (isset($_POST['action'])) {  

            if (!empty($_POST['immatriculation-1']) && !empty($_POST['immatriculation-2']) && !empty($_POST['immatriculation-3'])  && !empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['dateMEC']) && !empty($_POST['prix']) && !empty($_POST['dateEntreeGarage']) && !empty($_POST['nbChevaux']) && !empty($_POST['description'])) {
                
                $immatriculation = $_POST['immatriculation-1'] ."_". $_POST['immatriculation-2'] ."_". $_POST['immatriculation-3'];
                include("../dbConnexion.php");
                #die();
                switch ($_POST['action']) {
                    case 'add':

                        $req = $conn->prepare("INSERT INTO `voiture`(`immatriculation`, `marque`, `modele`, `dateMEC`, `prix`, `dateEntreeGarage`, `nbChevaux`, `description`, `dateAjout`) VALUES (:immatriculation,:marque,:modele,:dateMEC,:prix,:dateEntreeGarage,:nbChevaux,:description,:dateAjout)");
                        $req->bindParam(':immatriculation',checkInput($immatriculation), PDO::PARAM_STR);
                        $req->bindParam(':marque', $_POST['marque'], PDO::PARAM_STR);
                        $req->bindParam(':modele', $_POST['modele'], PDO::PARAM_STR);
                        $req->bindValue(':dateMEC', $_POST['dateMEC'], PDO::PARAM_STR);
                        $req->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
                        $req->bindParam(':dateEntreeGarage', $_POST['dateEntreeGarage'], PDO::PARAM_STR);
                        $req->bindParam(':nbChevaux', $_POST['nbChevaux'], PDO::PARAM_STR);
                        $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
                        $req->bindValue(':dateAjout', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                        $req->execute();
                        if (isset($_FILES['image'])) {
                            $tmpName = $_FILES['image']['tmp_name'];
                            $name = $_FILES['image']['name'];
                            $size = $_FILES['image']['size'];
                            $type = $_FILES['image']['type'];
                            $error = $_FILES['image']['error'];
                            $typeImage = explode("/",$type)[1];
                            move_uploaded_file($tmpName,$_SERVER['DOCUMENT_ROOT'] . "/Vente-Voiture/img/". $immatriculation . "." . $typeImage);
                            die(header("Location:home.php?action=add&success=true"));
                        }
                        die(header("Location:home.php?action=add&success=true"));
                    case 'edit':
                        $req = $conn->prepare("UPDATE `voiture` SET `marque`=:marque,
                                                                    `modele`=:modele,
                                                                    `immatriculation`=:immatriculation,
                                                                    `dateMEC`=:dateMEC,
                                                                    `prix`=:prix,
                                                                    `dateEntreeGarage`=:dateEntreeGarage,
                                                                    `nbChevaux`=:nbChevaux,
                                                                    `description`=:description
                                                                WHERE id = :idCar");
                        $req->bindParam(':marque', $_POST['marque'], PDO::PARAM_STR);
                        $req->bindParam(':modele', $_POST['modele'], PDO::PARAM_STR);
                        $req->bindParam(':immatriculation',$immatriculation, PDO::PARAM_STR);
                        $req->bindParam(':dateMEC', $_POST['dateMEC'], PDO::PARAM_STR);
                        $req->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
                        $req->bindParam(':dateEntreeGarage', $_POST['dateEntreeGarage'], PDO::PARAM_STR);
                        $req->bindParam(':nbChevaux', $_POST['nbChevaux'], PDO::PARAM_STR);
                        $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
                        $req->bindParam(':idCar', $_POST['idCar'], PDO::PARAM_STR);
                        /*if (isset($_FILES['image'])) {
                            $tmpName = $_FILES['images']['tmp_name'];
                            $name = $_FILES['images']['name'];
                            $size = $_FILES['images']['size'];
                            $type = $_FILES['images']['type'];
                            $error = $_FILES['images']['error'];    
                            $typeImage = explode("/",$type)[1];
                            echo($tmpName);
                            echo("<br>");
                            echo($name);
                            echo("<br>");
                            echo($size);
                            echo("<br>");
                            echo($type);
                            echo("<br>");
                            echo($error);
                            echo("<br>");
                            echo($typeImage);
                            die();
                            #move_uploaded_file($tmpName,$_SERVER['DOCUMENT_ROOT'] . "/Vente-Voiture/img/". $_POST['immatriculation'] . "." . $typeImage);
                        }
                        die();*/
                        $req->execute();
                        die(header("Location:home.php?action=edit&success=true"));
                }
            }
                
            
        } else if  (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete') {
                if (isset($_GET['id'])) {
                    include("../dbConnexion.php");
                    $req = $conn->prepare("DELETE FROM voiture WHERE id = :id");
                    $req->bindParam(':id',$_GET['id'], PDO::PARAM_STR);
                    $req->execute();
                    die(header("Location:home.php?action=delete&success=true"));
                    
                }				
            } else if ($_GET['action'] == 'deleteContact') {
                include("../dbConnexion.php");
                    $req = $conn->prepare("DELETE FROM contact WHERE id = :id");
                    $req->bindParam(':id',$_GET['id'], PDO::PARAM_STR);
                    $req->execute();
                    die(header("Location:contact.php?action=delete&success=true"));
            } else if ($_GET['action'] == 'addMarque') {
                echo("Ajouter Marque");
            } 
        } 
        die(header("Location:home.php"));
    } catch (Exception $e ){
        echo($e);
    }

    }
    else {
        die(header("Location:admin-login.php?error=true&reason=session"));	
    }

}



?>