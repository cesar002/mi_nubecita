<?php
require('../vendor/autoload.php');

use Controllers\RegistroUsuarioController;

session_start();

if(!isset($_SESSION["email_usuario"])){
    header("Sesión existente", true, 503);
    echo json_encode(["status" => 3]);
    return;
}

$method = $_SERVER["REQUEST_METHOD"];

if($method == "POST"){
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $repeat_pass = $_POST["repeat_pass"];

    if(empty($email) || empty($pass)){
        header("Sin datos", true, 400);
        echo json_encode([
            "status" => 2,
            "mensaje" => "no se detetectó datos de registro"
        ]);
        return;
    }

    if($pass != $repeat_pass){
        header("Contraseñas incorrectas", true, 409);
        echo json_encode([
            "status" => 2,
            "mensaje" => "Las contraseñas son incorrectas"
        ]);
        return;
    }

    $controller = new RegistroUsuarioController();

    $result = $controller->registrarUsuario($email, $pass);

    switch($result["status"]){
        case 1:
            header("Exitoso", true, 200);
            echo json_encode([
                "status" => 1,
                "mensaje" => $result["mensaje"]
            ]);
        break;
        case 2:
            header("Datos ya existentes", true, 409);
            echo json_encode([
                "status" => 2,
                "mensaje" => $result["mensaje"]
            ]);
        break;
        case 3:
            header("Server error", true, 500);
            echo json_encode([
                "status" => 0,
                "mensake" => $result["mensaje"]
            ]);
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