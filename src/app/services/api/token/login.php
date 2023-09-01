<?php
require_once "./../init.php";
require_once "./JwtRepository.php";
require_once "./Jwt.php";


const SECRET = "LaVi3estBe11e!"; // TGFWaTNlc3RCZTExZSE  CLE SECRETE
const HEADER = ["typ"=> "JWT","alg"=> "HS256"];

if($_GET['action'] == 'login'){

    // l'objet passé est transformé est decodé
     $jsonDecode = json_decode(file_get_contents('php://input'));
     $email = $jsonDecode->email;
     $password = $jsonDecode->password;
   
     $user = JwtRepository::getUser($email, $pdo);

     if(!empty($user)){
        //vérifier mot de passe
        if(password_verify($password, $user['password'] ) ){

            $payload = [ 'userId' => $user["id"],
                        'name' => $user["name"],
                        'role' => $user["role"],
                        'iat' => 0,
                        'exp' => 0
                ];       

            $token = Jwt::generateToken( HEADER, $payload, SECRET);
            $user["token"] = $token;
            $user["password"]= "";
            




                
        }else{
            $user["id"] = 0;
            $user["name"] = "Mot de passe invalide";
        }



     }

    //  Jwt::$header;


    // echo envoie le data (tableau) en format json
    echo json_encode($user); 
}


// -- u_password as password,


    //  // l'objet passé est transformé en un tableau [ obj => '' ]
    //  $data = [];
    //  parse_str(file_get_contents("php://input"), $data);
    //  $keyOut = new \stdClass;
    //  // l'objet est la clé du tableau
    //  foreach($data as $key => $value){
    //      $keyOut = $key;
    //  }
    //  // je le récupère et le transforme dans un bon format
    //  $data1 = json_decode($keyOut);

    //  // data->email   data->password
    //  $email = str_replace(['_'], ['.'], $data1->email);