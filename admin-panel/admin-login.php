<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    .retour {
        color:white;
        font-size:30px;
        margin-left:15px;
    } 

</style>
<body>
    <?php # include($_SERVER['DOCUMENT_ROOT']. "/Vente-Voiture/blocs/navbar.php");?>
    <a href="../index.php" class="retour">Retour à l'accueil </a>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Connexion</h5>
                        <form method="post" action="login.php">
                            <?php

                                if (isset($_GET['error']) == "true")
                                {
                                    if ($_GET['reason'] == "champvide") {
                                        echo("<h6 style='color:red'>Veuillez renseigner tous les champs.</h6>");
                                    } elseif ($_GET['reason'] == "invalid") {
                                        echo("<h6 style='color:red'>identifiant ou mot de passe invalide.</h6>");
                                    } elseif ($_GET['reason'] == "session") {
                                        echo("<h6 style='color:red'>Veuillez vous connecter.</h6>");
                                    }
                                }
                            
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant" required maxlength="20">
                            </div>
                            <div class="form-floating mb-3">

                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"required maxlength="50">
                            </div>
                            <br>
                            <div class="d-grid text-center">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        
    ?>



</body>

</html>