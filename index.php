<?php
echo $_GET["uno"];
?>
<br>
<?php
echo "hola mundo :)";
?>
<br>
<?php
$headers = apache_request_headers();
echo ($headers["AUTORIZACION_TOKEN"])
?>