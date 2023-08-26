<?php
require_once "init.php";


// **** à reprendre *****
if($_GET['action'] == "read"){

    if($_GET['id'] == "0"){
        
        $sql = "SELECT 
                    u_id as id,
                    u_firstname as firstname,
                    u_name as name,
                    u_email as email,
                    u_password as password,
                    u_date as dateInscription,
                    u_date_connect as dateConnect,
                    u_role as role,
                    u_token as token,
                    u_confirmed as confirmed  
                FROM users";
    
        $result = $pdo->prepare($sql);
        $result->execute();
        // $data = $result->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $sql = "SELECT 
                    u_id as id,
                    u_firstname as firstname,
                    u_name as name,
                    u_email as email,
                    u_password as password,
                    u_date as dateInscription,
                    u_date_connect as dateConnect,
                    u_role as role,
                    u_token as token,
                    u_confirmed as confirmed  
                FROM users
                WHERE u_id = :id";
    
        $result = $pdo->prepare($sql);
        $result->execute([':id'=>$_GET['id']]); 
    }
    
    $data = $result->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode($data);

}