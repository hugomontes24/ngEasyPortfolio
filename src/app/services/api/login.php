<?php
require_once "init.php";

if($_GET['action'] == 'login'){

    // todo : traiter l'auth

     // l'objet passé est transformé en un tableau [ obj => '' ]
     $data = [];
     parse_str(file_get_contents("php://input"), $data);
     $keyOut = new \stdClass;
     // l'objet est la clé du tableau
     foreach($data as $key => $value){
         $keyOut = $key;
     }
     // je le récupère et le transforme dans un bon format
     $data1 = json_decode($keyOut);


    // echo envoie le data (tableau) en format json
    echo json_encode($data1); 
}