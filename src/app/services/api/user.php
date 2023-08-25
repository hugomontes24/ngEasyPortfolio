<?php
require_once "init.php";


// **** à reprendre *****
if($_GET['action'] == "readAll"){

    $sql = "SELECT * FROM users";

    $result = $pdo->prepare($sql);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

}