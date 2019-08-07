<?php
require('../vendor/autoload.php');
// session_start();

use Services\JWTAuth;
use Controllers\LoginController;
$login = new LoginController();

$headers = apache_request_headers();

if(!isset($headers['AUTORIZACION_TOKEN'])){
    header("Sesión existente", true, 503);
    echo json_encode(["status" => 3]);
    return;
}

$jwtToken = $headers['AUTORIZACION_TOKEN'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(!isset($_POST["email"]) || !isset($_POST["password"])){
        header("Datos inexistentes", true, 406);
        echo json_encode(["status" => 2, "mensaje" => "Falta información"]);
        return;
    }

    if(JWTAuth::checkAuthToken($jwtToken)){
        header("Sesión ya existente", true, 406);
        echo json_encode(["status" => 2, "mensaje" => "Sesión ya existente"]);
        return;
    }

    $loginDatos = $login->Logearse($_POST["email"], $_POST["password"]);

    switch($loginDatos["status"]){
        case 1:
            header("Correcto", true, 200);
            echo json_encode($loginDatos);
        break;
        case 2:
            header("Datos no encontrados", true, 409);
            echo json_encode($loginDatos);
        break;
        case 0:
            header("Error del servidor", true, 500);
            echo json_encode($loginDatos);
        break;
        default:
    }


}else{
    header("Pagina no encontrada", true, 404);
    echo json_decode([
        "status" => 0,
        "mensaje" => "no se encuentra la ruta especificada"
    ]);
}

