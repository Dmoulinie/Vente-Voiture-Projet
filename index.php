<html>
    <title>Présentation des voitures</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ms+Madi&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <body>
    <?php include("blocs/navbar.php");?>
<!--
    <style>
        .carousel {
            background-color: red;
        }

    </style>

    <div class="carousel">
        <p>test</p>
    </div>
-->



    <h1 class="text-center display-1 text-light ">Liste des voitures :</h1>
    <?php
    include("dbConnexion.php");
    $req = $conn->prepare("select * from voiture");
	$req->execute();
	// fetch all rows
	$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <style>
            body {
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-image: url('img/background.jpg');
                margin-left:270px;
            }
			
            
            .card:hover {
                transition: transform 200ms ease-in-out;
                transform: scale(1.05)
			}

            .card {
				  margin-left: 10px;
				  margin: 30px;
			}
    
            h1 {
                font-family: 'Ms Madi', cursive;
            }


            .btn:hover {
                transition: transform 100ms ease-in-out;
                transform: scale(1.05);
            }

        </style>
<!--            display:grid;
                grid-template-columns: 25% 25% 25% 25%;
				
				margin:50px;
                margin-left:125px;-->
        <div class="d-flex flex-row align-content-end flex-wrap">
            <?php
            foreach ($resultat as $row) {
                $id = $row['id'];
                $imma = $row['immatriculation'];
                $marque = $row['marque'];
                $modele = $row['modele'];
                $dateMEC = $row['dateMEC'];
                $prix = $row['prix'];
                $dateEntreeGarage = $row['dateEntreeGarage'];
                $chevaux = $row['nbChevaux'];
                $description = $row['description'];
                ?>



                <div class="card" style="width:30rem">
                    <img class="card-img-top" alt="Image non disponible."
                        <?php if (file_exists("img/$imma.jpg" )) {
                            echo('src="img/'. $imma. '.jpg"');
                        } else if (file_exists("img/$imma.png")) {
                            echo('src="img/' .$imma. '.png"');
                        } else if (file_exists("img/$imma.jpeg")) {
                            echo('src="img/' .$imma. '.jpeg"');
                        } else {
                            echo('src="img/undefined.png"');
                        }
                        ?> >
                        
                    <div class="card-body">
                        <h5 class="card-title"><?php echo($marque . " " .$modele) ?></h5>
                        <p class="card-text text-cut" id="<?php echo($id) ?>" >
                            <?php 
                                echo($description); 
                                echo("<h6 class='text-muted'> Date d'arrivé au garage :  ".$dateMEC."</h6>");
                            ?>
                        </p>
                    </div>

                    <div class="card-footer text-right">
                        <style>
                            .hidden {
                                display: none;
                            }
                        </style>
                        <script type="text/javascript">
                            function showMore(id) {
                                if (document.getElementById(id).classList.contains("text-cut")){
                                    $( "#" + id ).removeClass( "text-cut", 400, "easeOutQuint" );
                                    $("#btn" + id).html("Réduire");
                                    $("#btn" + id).removeClass("btn-primary");
                                    $( "#btn" + id ).addClass( "btn-danger",  200, "easeOutQuint" );
                                } else {
                                    $( "#" + id ).addClass( "text-cut", 400, "easeOutQuint" );
                                    $("#btn" + id).html("En Savoir Plus");
                                    $("#btn" + id).removeClass("btn-danger");
                                    $( "#btn" + id ).addClass( "btn-primary",  200, "easeOutQuint" );

                                }
                            }

                        </script>
                        <button class="btn btn-primary" id="<?php echo("btn". $id) ?>" onclick="showMore(<?php echo $id ?>)">En Savoir plus</a>    
                    </div>
                </div>
                
            <?php } ?>
        </div>
    </body>
    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright:
            <a class="text-dark">Vente-Voiture-Vitrine</a>
        </div>
        <!-- Copyright -->
    </footer>


</html>
