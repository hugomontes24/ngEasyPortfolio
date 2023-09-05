<?php
require_once "init.php";

$table = 'portfolio';

// **** à reprendre *****
if($_GET['action'] == "readAll"){

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

    if($token){

        $sql = "SELECT 
                   p_id as id,
                   p_title as title,
                    p_description as description,
                    p_name as name,
                    p_firstname as firstname,
                    p_email as email,
                    p_city as city,
                    p_description_skills as descriptionSkills,
                    u_id as u_id
                FROM portfolio
                WHERE u_id = :id
                ";
    
        $result = $pdo->prepare($sql);
        // $result->execute(); 
        $result->execute([':id'=>$_GET['id']]); 
    
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        // $data = '{"id":31,"firstname":"","name":"hugomontes","email":"lolololo"}';

        $token1 = str_replace('Bearer', '', $token );
        $data[3] = [
            "id" => 5,
            "title" => $token1,
            "description" => "",
            "name" => "",
            "firstname" => "",
            "email" => "",
            "city" => "",
            "descriptionSkills" => "",
            "u_id" => ""
        ] ;
    
        echo json_encode($data);

    }


}

// FROM". $table . "

            

    