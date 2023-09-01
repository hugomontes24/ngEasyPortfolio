<?php

require_once 'Jwt.php';
require_once './../api/init.php';

// header('Acces-Control-Allow-Origin: *');
// header('Content-Type: application/json');

// on interdit toute méhtode autre que post

// if($_SERVER['REQUEST_METHOD']!== 'POST'){
//     http_response_code(405);
//     echo json_encode(['message'=> 'Méthode non autorisé']);

//     exit;
// } 

// on vérifie si on reçoit un token
if (isset($_SERVER['Authorization'])) {
    $token = trim($_SERVER['Authorization']);

}elseif(isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $token = trim($_SERVER['HTTP_AUTHORIZATION']);
}elseif(function_exists('apache_request_headers')){
    $requestHeaders = apache_request_headers();
    if(isset($requestHeaders['Authorization'])){
        $token = trim($requestHeaders['Authorization']);
    }

}

if(!isset($token) || !preg_match('/Bearer\s(\S+)', $token, $matches) ){

    http_response_code(400);
    echo json_encode(['message'=>'Token introuvable']);
    exit;
}

//on extrait le token
$token = str_replace('Bearer ', '', $token );

// on verifie la validite
if(!Jwt::isValid($token)){
    http_response_code(400);
    echo json_encode(['message'=>'Token invalide']);
    exit;
}

// on verifie la signature
if(!Jwt::check($token, SECRET)){
    http_response_code(403);
    echo json_encode(['message'=>'Le Token est invalide']);
    exit;
}

// on verifie l'expiration
if(Jwt::isExpired($token)){
    http_response_code(403);
    echo json_encode(['message'=>'Le Token a expiré']);
    exit;
}

echo json_encode(Jwt::getPayload($token));


