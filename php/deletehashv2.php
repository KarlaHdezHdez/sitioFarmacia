<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];

include_once "conexion.php";

$sentencia = $base_de_datos->prepare("DELETE FROM usuarios WHERE idUsuario = ?;");
$resultado = $sentencia->execute([$id]);

if($resultado === TRUE){
    header("Location: ../hashv2.php");
    die();
} else{
    echo "Algo salió mal";
} 
?>