<?php
require_once './../init.php';

class JwtRepository 
{

    public static function getUser( string $email, PDO $pdo ): array{

        $data=[];
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
                FROM user
                WHERE u_email = :email";
    
        $result = $pdo->prepare($sql);
        $result->execute([':email'=>$email]); 
        
        $data=  $result->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
    
    
    






}

// u_firstname as firstname,
// -- u_name as name,
// -- u_email as email,
// -- u_password as password,
// -- u_date as dateInscription,
// -- u_date_connect as dateConnect,
// -- u_role as role,
// -- u_token as token,
// u_confirmed as confirmed  