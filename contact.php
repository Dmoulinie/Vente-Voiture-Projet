<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me contacter - Garage</title>
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body style="background-color:lightgrey">

<?php include("blocs/navbar.php"); //Side Navigation ?>


<div class="container" style="margin-top:5%">
    <h2 class="text-center">Formulaire de contact</h2>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
                    <!--Form with header-->
                    <form action="admin-panel/Traitement.php" method="post">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                    <h3><i class="fa fa-envelope"></i> Contact</h3> 
                                    <?php
                                        if (isset($_GET['contact'])) {

                                            if ($_GET['contact'] == "false") {
                                                if (isset($_GET['reason'])) {
                                                    if ($_GET['reason'] == "champvide") {
                                                        echo("<h6 class='text-left' style='color:red'>Veuillez renseigner tous les champs.</h6>");
                                                    } 
                                                    if ($_GET['reason'] == "error") {
                                                        echo("<h6 class='text-left' style='color:red'>Une erreur est survenue.</h6>");
                                                    } 
                                                    if ($_GET['reason'] == "messageLong") {
                                                        echo("<h6 class='text-left' style='color:red'>Le message est trop long (256 characteres max).</h6>");
                                                    }  
                                                }
                                            } else if ($_GET['contact'] == "true" && !isset($_GET['reason'])) {
                                                echo("<h6 class='text-left ml-2' style='color:lightgreen'>Message envoyé avec succès.</h6>");

                                            }

                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                        
                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom / Prénom" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="exemple@example.com" required>
                                    </div>
                                </div>
                                <script>
                                    function updateCharRestant() {
                                        const max = 256;
                                        let valeur = document.getElementById("message").value
                                        charRestant = max - valeur.length;
                                        if (charRestant >= 0) {
                                            const elemRestant = document.getElementById("charRestant").innerHTML = charRestant + " characteres restants";
                                        }   
                                        
                                    }
                                </script>
                                <div class="form-group">
                                <small class="float-right text-secondary" id="charRestant">256 caracteres restants !</small>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        
                                        <textarea class="form-control" id="message" name="message" placeholder="Message" oninput="updateCharRestant()" maxlength="256"></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="hidden" name="contact" value="true">
                                    <input type="submit" value="Envoyer" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--Form with header-->


                </div>
	</div>
</div>
</body>
</html>