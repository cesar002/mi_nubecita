<?php
require('../vendor/autoload.php');

use Controllers\RegistroUsuarioController;

$method = $_SERVER["REQUEST_METHOD"];

if($method == "POST"){
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $repeat_pass = $_POST["repeat_pass"];

    if(empty($email) || empty($pass)){
        //redirigir y enviar mensaje de error de que los datos estan incompletos
    }

    if($pass != $repeat_pass){
        //redirigir y enviar mensaje de que las contraseñas estan incorrectas
    }

    $controller = new RegistroUsuarioController();

    $result = $controller->registrarUsuario($email, $pass);

    switch($result["status"]){
        case 1:
        //redirigir a pagina de correcto
        break;
        case 2:
        //contraseña existente
        break;
        default:
    }
}else{
    //redirigir a error 404
}