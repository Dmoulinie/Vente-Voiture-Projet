<?php
include("../dbConnexion.php"); #Connexion a la base de données
session_start();
if (isset($_SESSION['login'])) { # On regarde si l'utilisateur est connecté
	
?>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <script src="../js/dashboard.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="overflow-x:hidden">

<script type="text/javascript">
	function confirmDelete(id2) {  // Confirmation  de la suppréssion (Alerte Yes/No)
		if (confirm("Voulez vous vraiment supprimer le message ?"))
			Lien = 'Traitement.php?action=deleteContact&id=';
			location.href=Lien.concat(id2);
	}
	
</script>

<?php
include("../blocs/navbar.html"); //Side Navigation
?>



<?php
try {
        $req = $conn->prepare("select * from contact");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
<div style="margin-left:200px"> <!-- Tableau de présentation des voitures -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom / Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($resultat as $row) {  
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $message = $row['message'];
                    $messageFix = wordwrap($message, 100, "\n", true);
                    echo("<tr>
                        <th scope='row'>$id</th>
                        <td>$name</td>
                        <td>$email</td>
                        <td>$messageFix</td>");    
						
						echo '<td><a href="#" onclick="confirmDelete('.$id.')">Supprimer</td>'; #Bouton pour supprimer la voiture
						echo '</tr>';
                
                    
                }
            ?>
            </tbody>
        </table>
        </div>
        <?php

      

    
} catch (Exception $e) {
    echo($e->getMessage());
}
?>

</body>

</html>

<?php
}
else {
	die(header("Location:admin-login.php?error=true&reason=session"));
}
?>

