<?php
require('../../vendor/autoload.php');

use Models\UserModel;
use HandleModel\CarpetaModelHandle;
use HandleModel\ArchivosModelHandle;
use Services\JWTAuth;

$headers = apache_request_headers();

if($_SERVER["REQUEST_METHOD"] != "GET"){
    header("Metodo HTTP incorrecto", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "petición HTTP incorrecta"
    ]);
    return;
}

if(!isset($_GET["nube"])){
    header("Faltan datos", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "no se encuentra la nube especificada"
    ]);
    return;
}

if(!isset($headers['AUTORIZACION_TOKEN'])){
    header("Metodo HTTP incorrecto", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "Token de sesión no encontrado",
    ]);
    return;
}

$jwtToken = $headers['AUTORIZACION_TOKEN'];

if(!JWTAuth::checkAuthToken($jwtToken)){
    header("Sesión invalida", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "Sesión invalida",
    ]);
    return;
}

$userModel = JWTAuth::getDataAuthToken($jwtToken);

if(is_null($userModel)){
    header("Sesión invalida", true, 500);
    echo json_encode([
        "status" => 0,
        "mensaje" => "Error al leer el token de sesión",
    ]);
    return;
}

$carpetas = CarpetaModelHandle::getListCarpetaModelInRoot($userModel);
$archivos = ArchivosModelHandle::getListArchivosInRoot($userModel);

header("correcto", true, 202);
echo json_encode([
    "carpetas" => $carpetas,
    "archivos" => $archivos,
]);



