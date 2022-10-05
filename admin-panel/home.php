<?php
include("../dbConnexion.php"); #Connexion a la base de données
session_start();
if (isset($_SESSION['login'])) { # On regarde si l'utilisateur est connecté
	
?>
<html>
<head>
    <title>Panneau de controle</title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <script src="../js/dashboard.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<script type="text/javascript">
	function confirmDelete(id2) {  // Confirmation  de la suppréssion (Alerte Yes/No)
		if (confirm("Voulez vous vraiment supprimer la voiture ?"))
			Lien = 'Traitement.php?action=delete&id=';
			location.href=Lien.concat(id2);
	}
	
</script>

<body>
<!--   Modal  -->

<!-- J'ai pas réussi -->

<!-- Fin Modal -->



<?php
include("../blocs/navbar.html"); //Side Navigation
?>

<?php
if (isset($_GET['action'])) { # Si 'action' existe
    switch ($_GET['action']) {  # On cherche quel action est demandé
        case 'add': # 
               if (isset($_GET['success'])) {
				if ($_GET['success'] == "true") {
		?>
                <div class="success-box bg-success text-white" id="Bar"> <!-- Barre success quand voiture ajoutée -->
                    <div id="right-modal">
                        <a href="#" onclick="Hide(Bar);" class="textCroix">&times;</a>
                    </div>
                    <div id="left-modal">
                        <p>La voiture a bien été ajoutée !</p>
                    </div>
                </div>
            <?php
			   }}
            break;
        case 'delete':
			if (isset($_GET['success'])) {
				if ($_GET['success'] == "true") {
		?>
			<div class="success-box bg-info text-white" id="Bar"> <!-- Barre success quand voiture supprimée -->
				<div id="right-modal">
					<a href="#" onclick="Hide(Bar);" class="textCroix">&times;</a>
				</div>
				<div id="left-modal">
					<p>La voiture a bien été supprimée !</p>
				</div>
			</div>
		<?php
			}}
			break;
		case 'edit':
			if (isset($_GET['success'])) {
				if ($_GET['success'] == "true") {?>
				<div class="success-box bg-success text-white" id="Bar"> <!-- Barre success quand voiture ajoutée -->
                    <div id="right-modal">
                        <a href="#" onclick="Hide(Bar);" class="textCroix">&times;</a>
                    </div>
                    <div id="left-modal">
                        <p>La voiture a bien été modifiée !</p>
                    </div>
                </div>
			<?php }}
			break;
        default:
            # code...
            break;
    }
}
?>

<?php
try {
        $req = $conn->prepare("select * from voiture");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
<div style="margin-left:200px"> <!-- Tableau de présentation des voitures -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Immatriculation</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Date de mise en circulation</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date de l'entrée en garage</th>
                    <th scope="col">Chevaux</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
					<th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($resultat as $row) {  
                    $id = $row['id'];
                    $imma = str_replace('_',' ',$row['immatriculation']); // Affichage de l'immatriculation sans les "_" 
                    $marque = $row['marque'];
                    $modele = $row['modele'];
                    $dateMEC = $row['dateMEC'];
                    $prix = $row['prix'];
                    $dateEntreeGarage = $row['dateEntreeGarage'];
                    $chevaux = $row['nbChevaux'];
                    $description = $row['description'];
					$test = "Are you sure?";
                    echo("<tr>
                        <th scope='row'>$id</th>
                        <td>$imma</td>
                        <td>$marque</td>
                        <td>$modele</td>
                        <td>$dateMEC</td>
                        <td>$prix</td>
                        <td>$dateEntreeGarage</td>
                        <td>$chevaux</td>
                        <td>$description</td>");
						
						echo '<td><a href="#" onclick="confirmDelete('.$id.')">Supprimer</td>'; #Bouton pour supprimer la voiture
                        echo '<td><a href="modif-voiture.php?id='.$id.'">Modifier</td>'; #Bouton pour modifier la voiture
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

