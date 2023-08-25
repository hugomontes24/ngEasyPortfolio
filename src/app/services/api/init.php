<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$pdo = new PDO(
        'mysql:host=localhost;dbname=portfolio_project', 
        'root', 
        '',
    array(
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING, 
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
    )
);
