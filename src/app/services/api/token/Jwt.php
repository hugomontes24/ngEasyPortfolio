<?php

class Jwt
{

    /**
     * Génération de token
     * génération de $payload['iat'] (Timestamp) initialisation du token
     * génération de $payload['exp'] (Timestamp) durée de validité du token
     * 
     * 
     * @param array $header (algorithme et typ)
     * @param array $payload (id, role, etc)
     * @param string $secret (clé secrete)
     * @param integer $validity (durée en secondes)
     * @return string ( le token )
     */
    public static function generateToken(
                    array $header, 
                    array $payload, 
                    string $secret,
                    int $validity = 7200
            ): string
    {
        
        if($validity > 0){
            $now = new DateTime();
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $payload['iat'] + $validity;
        }

        // on encode en base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // on "nettoie les valeurs encodées.
        // on retire les + , / et =
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // on génère la signature
        $secret = base64_encode($secret);
        $secret = str_replace(['+', '/', '='], ['-', '_', ''], $secret);

        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $secret, true);
        $base64Signature = base64_encode($signature);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        // on crée le token
        $jwt = $base64Header . '.' . $base64Payload . '.' . $signature;

        return $jwt;
    }

    /**
     * Vérifier l'authenticité du token
     *
     * @param string $token
     * @param string $secret
     * @return boolean
     */
    public static function check(string $token, string $secret): bool
    {
        //On récupère des tableaux
        $header = Jwt::getHeader($token);
        $payload = Jwt::getPayload($token);

        //on génère un token de vérification
        $verifToken = Jwt::generate($header, $payload, $secret, 0);

        return $token === $verifToken;
    }

    /**
     * Récuperer le header du token dans un tableau
     *
     * @param string $token
     * @return array
     */
    public static function getHeader(string $token):array
    {
        $array = explode('.', $token);
        // le drapeau true me fair recuperer un tableau
        $header = [];
        $header= json_decode(base64_decode($array[0]), true);

       return $header; 
    }

    public static function getPayload(string $token): array
    {
        $array = explode('.', $token);
        // le drapeau true me fair recuperer un tableau
        $payload = [];
        $payload= json_decode(base64_decode($array[1]), true);

       return $payload; 
    }

    public static function isExpired(string $token): bool
    {
        $payload = Jwt::getPayload($token);

        $now = new DateTime();
        return $payload['exp'] < $now->getTimestamp();
    }


    public static function isValid(string $token): bool
    {
        return preg_match(
            "/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/",
            $token
        ) === 1;
    }

}
