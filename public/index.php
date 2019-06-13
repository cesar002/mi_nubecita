<?php
require('../vendor/autoload.php');

use Services\InitFileData;

$datos = InitFileData::getIniFileData();
echo($datos['db_name']);