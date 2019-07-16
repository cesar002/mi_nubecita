<?php
require('../vendor/autoload.php');
session_start();

if(!isset($_SESSION["email_usuario"])){
    header("Sesión existente", true, 503);
    echo json_encode(["status" => 3]);
    return;
}

use Controllers\LoginController;
$login = new LoginController();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(!isset($_POST["email"]) || !isset($_POST["password"])){
        header("Datos inexistentes", true, 406);
        echo json_encode(["status" => 2, "mensaje" => "Falta información"]);
        return;
    }

    $loginDatos = $login->Logearse($_POST["email"], $_POST["password"]);

    switch($loginDatos["status"]){
        case 1:
            header("Correcto", true, 200);
        break;

        case 2:

        break;

        case 0:

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

