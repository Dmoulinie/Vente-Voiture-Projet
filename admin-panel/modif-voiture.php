<?php
session_start();
if (isset($_SESSION['login'])) {
?>
<html>
<head>
    <title>Modifier une voiture</title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php include("../blocs/navbar.html"); //  NavBar 
    
	
	
	if (isset($_GET['id'])) {
		include("../dbConnexion.php");
		$req = $conn->prepare("SELECT * from voiture where id = :id");
		$req->bindParam(":id",$_GET['id'], PDO::PARAM_INT);
		$req->execute();
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		if (!empty($resultat)) {
		?>
		<div style="margin-left:210px">
			<form action="Traitement.php" method="POST">
				<h3> Modification de la voiture <?php echo($_GET['id'] ." ("  . $resultat['marque'] . " " .$resultat['modele'] . " )"  )    ?></h3>
				
				<div class="col-auto">  
				<label for="immatriculation" class="form-label">Immatriculation : </label>
				<div class="row">
					<div class="col-auto">
						<input type="text" name="immatriculation-1" style="width:auto" class="form-control" value="<?php echo(substr($resultat['immatriculation'],0,3)) ?>" minlength="3" maxlength="3" pattern="[0-9]+" required >
					</div>
					<div class="col-auto">
						<input type="text" name="immatriculation-2" style="width:auto" class="form-control" value="<?php echo(substr($resultat['immatriculation'],4,3)) ?>" minlength="3" maxlength="3" pattern="[0-9]+" required>
					</div>
					<div class="col-auto">
						<input type="text" name="immatriculation-3" style="width:auto"class="form-control" placeholder="NC" value="<?php echo(substr($resultat['immatriculation'],-2)) ?>" pattern="NC" required readonly aria-describedby="immaHelp">
					</div>
					<small id="passwordHelpBlock" class="form-text text-muted">
						Exemple de format : 203 456 NC
					</small>
					</div>
				</div>
				
				<div class="col-auto">
					<label for="marque">Marque : </label>
					<input type="text" name="marque" class="form-control" value="<?php echo($resultat['marque'])?>" placeholder="<?php echo($resultat['marque']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="immatriculation">Modèle : </label>
					<input type="text" name="modele" class="form-control" value="<?php echo($resultat['modele'])?>" placeholder="<?php echo($resultat['modele']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="dateMEC">Date de mise en circulation : </label>
					<input type="date" name="dateMEC" class="form-control" value="<?php echo($resultat['dateMEC'])?>" placeholder="<?php echo($resultat['dateMEC']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="immatriculation">Prix : </label>
					<input type="text" name="prix" class="form-control" value="<?php echo($resultat['prix'])?>" placeholder="<?php echo($resultat['prix']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="dateEntreeGarage">Date de l'entrée au garage : </label>
					<input type="date" name="dateEntreeGarage" class="form-control" value="<?php echo($resultat['dateEntreeGarage'])?>" placeholder="<?php echo($resultat['dateEntreeGarage']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="nbChevaux">Chevaux : </label>
					<input type="text" name="nbChevaux" class="form-control" value="<?php echo($resultat['nbChevaux'])?>" placeholder="<?php echo($resultat['nbChevaux']) ?>" required>
				</div>
				
				<div class="col-auto">
					<label for="description" class="form-label" >Description : </label>
					<input type="text" name="description" class="form-control" value="<?php echo($resultat['description'])?>" placeholder="<?php echo($resultat['description']) ?>" required>
				</div>
				<br>

				<div class="col-auto">
					<label for="image" class="form-label">Image : </label>
					<input type="file" id="images" name="images" accept=".jpg,.jpeg,.png">
				</div>
				<br>
				
				<div class="text-left">
					<input type="hidden" name="action" value="edit">
					<input type="hidden" name="idCar" value="<?php echo($resultat['id'])?>">
					<input type="submit" class="btn btn-primary" value="Envoyer">
				</div>
			</form>
			
		</div>
		<?php 
		} else {
			echo("<h1 class='text-center'> Aucune voiture trouvée avec l'id " . $_GET['id']);
		}
		?>
		
	<?php } ?>


</body>


</html>


<?php
}
else {
	die(header("Location:admin-login.php?error=true&reason=session"));
}
?>