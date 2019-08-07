<?php
require('../vendor/autoload.php');

use Controllers\TokensController;

$method = $_SERVER["REQUEST_METHOD"];

if($method != "GET"){
    header("Metodo HTTP incorrecto", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "petición HTTP incorrecta"
    ]);
    return;
}

$tokenController = new TokensController();

if(!isset($_GET["token"])){
    header("Faltan datos", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "no se encuentra el token"
    ]);
    return;
}

$token = $_GET["token"];

if(!$tokenController->verificarTokenVerificadorCuenta($token)){

    return;
}


