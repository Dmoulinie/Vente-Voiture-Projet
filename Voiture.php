<?php

class Voiture {

    public $immatriculation;
    public $marque;
    public $modele;
    public $dateMEC; # Date mise en circulation
    public $prix;
    public $dateEntreeGarage;
    public $nbChevaux;
    public $description;

    public function __construct($immatriculation, $marque, $modele,$dateMEC,$prix,$dateEntreeGarage,$nbChevaux,$description)
    {
        $this->immatriculation = $immatriculation;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->dateMEC = $dateMEC;
        $this->prix = $prix;
        $this->dateEntreeGarage = $dateEntreeGarage;
        $this->nbChevaux = $nbChevaux;
        $this->description = $description;


    }

    public function getMarque()
    {
        return $this->marque;
    }
}

/*
$voiture1 = new Voiture("203 546 NC","Audi","R8","2020-04-10","1 500 000","2021-02-26","206","Belle voiture !");
$voiture1_var = get_object_vars($voiture1);
foreach ($voiture1_var as $name => $value) {
    echo "$name : $value";
    echo "<br>";
}*/

?>