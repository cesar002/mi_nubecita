<?php
use Controllers\RegistroUsuarioController;

require('../vendor/autoload.php');

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

    $controller = new Controllers\RegistroUsuarioController();

    $result = $controller->registrarUsuario($email, $pass);

    if($result["status"] = 1){

    }else{
        
    }

}else{

}