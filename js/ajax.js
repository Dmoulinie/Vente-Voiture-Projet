function addMarqueDB() {
    let marqueVoiture = document.getElementById("marqueAdd").value;
    $.ajax({
        type: "POST",
        url: '../admin-panel/ajax/request_addMarque.php', 
        data: {action: 'addMarque', marque:marqueVoiture},

        success: function(data){
            console.log(data);
            let response = document.getElementById("response");
            switch (data) {
                case "success":
                    response.innerHTML = "La marque a bien été ajoutée !"; // On change le texte
                    response.style.display = "block"; // On affiche le texte
                    if (response.classList.contains("text-danger")) { //Couleur du texte si réussite
                        response.classList.remove("text-danger"); 
                        response.classList.add("text-success")
                    }
                    // Ajout du choix dans option sans reload la page
                    var x = document.getElementById("marqueChoix");
                    var option = document.createElement("option");
                    option.value = marqueVoiture;
                    option.text = marqueVoiture;
                    x.add(option);
                    break;

                case "existe":
                    response.innerHTML = "La marque éxiste déja !"; // On change le texte
                    response.style.display = "block"; // On affiche le texte
                    if (response.classList.contains("text-success")) { response.classList.remove("text-success"); response.classList.add("text-danger")}

                    break;

                default:
                    response.innerHTML = "";
                    response.style.display = "none";
                    break;
            }
        }, error: function(xhr, status, error){
            console.error(xhr);
        }
    });
}


