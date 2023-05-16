<?php
$host="localhost";
$bd="uganodes_bd";
$usuario="uganodes_ganoderma";
$contrasena="U5Dp@&0.EA2!";


try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasena);  
} catch (Exception $ex) {
    echo $ex->getMessage();

}
?>