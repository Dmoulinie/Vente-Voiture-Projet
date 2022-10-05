<?php
session_start();
if (isset($_SESSION['login'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une voiture</title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <script type="text/javascript" src="../js/ajax.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <?php
        include("../blocs/navbar.html");
    ?>

    <div style="margin-left:210px">
		<h1>Ajouter une voiture</h1>
		<?php
			if (isset($_GET['error']) && $_GET['error'] == "empty") {
				echo ("<p style='color:red'>Veuillez renseigner tous les champs ! </p>");
			} else if (isset($_GET['error']) && $_GET['error'] == "invalid") {
				echo ("<p style='color:red'>L'un des champ est faux ! </p>");
			}

		?>
		<!--  Modal Ajouter Marque -->

			
		<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" >
						<h5 class="modal-title">Ajouter une marque</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"  style="background-color:rgba(200,200,200,0.25)">
						<p style="display:none" class="text-success" id="response"></p>
						<label for="marqueAdd">Marque : </label>
						<input type="text" class="form-control" name="marqueAdd" id="marqueAdd">
					</div>
					<div class="modal-footer" style="background-color:rgba(200,200,200,0.2)" >
						<button type="button" onclick="addMarqueDB()" class="btn btn-primary">Ajouter</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				</div>
			</div>
		</div>

		


		<form action="Traitement.php" method="POST" enctype="multipart/form-data">  
			<div class="col-auto">  
				<label for="immatriculation" class="form-label">Immatriculation : </label>
				<div class="row">
					<div class="col-auto">
						<input type="text" name="immatriculation-1" style="width:auto" class="form-control" minlength="3" maxlength="3" pattern="[0-9]+" required >
					</div>
					<div class="col-auto">
						<input type="text" name="immatriculation-2" style="width:auto" class="form-control" minlength="3" maxlength="3" pattern="[0-9]+" required>
					</div>
					<div class="col-auto">
						<input type="text" name="immatriculation-3" style="width:auto"class="form-control" placeholder="NC" value="NC" pattern="NC" required readonly aria-describedby="immaHelp">
					</div>
					<small id="passwordHelpBlock" class="form-text text-muted">
						Exemple de format : 203 456 NC
					</small>
				</div>
			</div>
			<br>

			<div class="col-auto">    
				<label for="marque" class="form-label">Marque : </label>
				<select name="marque" id="marqueChoix" class="form-control">
					<option name="0">Selectionner</option>
					<?php
						include("../dbConnexion.php");
						$req = $conn->prepare("select * from marque");
						$req->execute();
						$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
						foreach ($resultat as $row) {
							echo("<option name=".$row['id'].">". $row['marque'] ."</option>");
						}
					?>
				</select>
			</div>
			<script>
				function modalMarque() {
					$('#myModal').modal("show")
					document.getElementById("response").style.display = "none"; // Réinitialisation du message de success / erreur
					document.getElementById("marqueAdd").value = ""; // Réinitialisation de l'input user
					

				}
			</script>
			<p class="ml-3 text-secondary"> Vous ne trouvez pas une marque souhaitée ? <a  onclick="modalMarque()" href="#AjouterMarque">Ajoutez-la</a> ! </p>

			<div class="col-auto">
				<label for="modele" class="form-label">Modèle : </label>
				<input type="text" name="modele" class="form-control" placeholder="Modèle (R8)">
			</div>
			<br>

			<div class="col-auto">
				<label for="dateMEC" class="form-label">Date de la première mise en circulation: </label>
				<input type="date" name="dateMEC" class="form-control">
			</div>
			<br>

			<div class="col-auto">
				<label for="prix" class="form-label">Prix : </label>
				<input type="text" name="prix" class="form-control" placeholder="Prix (CFP)">
			</div>
			<br>

			<div class="col-auto">
				<label for="dateEntreeGarage" class="form-label">Date de l'entrée au garage : </label>
				<input type="date" name="dateEntreeGarage" class="form-control">
			</div>
			<br>

			<div class="col-auto">
				<label for="nbChevaux" class="form-label">Nombre de chevaux : </label>
				<input type="text" name="nbChevaux" class="form-control" placeholder="Nombre de chevaux">
			</div>
			<br>
			<div class="col-auto">
				<label for="description" class="form-label">Description</label>
				<textarea type="text" style="height:150px" name="description"class="form-control test"></textarea>
			</div>
			<br>
			
			<div class="col-auto">
				<label for="image" class="form-label">Image : </label>
				<input type="file" id="image" name="image" accept=".jpg,.jpeg,.png">
			</div>
			<br>
			
			<div class="text-left">
				<input type="hidden" name="action" value="add">
				<input type="submit" class="btn btn-primary" value="Envoyer">
			</div>


			<!--
			<script>
				function Test() {
					document.getElementById("divBTN").style.marginRight = Math.floor(Math.random()*1000);
				}
			</script>
			-->
			
		</form>
	</div>

</body>


</html>


<?php
}
else {
	die(header("Location:admin-login.php?error=true&reason=session"));
}
?>