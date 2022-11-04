<?php
include_once "conexion.php";

if(!isset($_POST["id_USER"]) || !isset($_POST["nombre"]) || !isset($_POST["direccion"]) || !isset($_POST["email"]) || !isset($_POST["pass"])){
    exit();
}else{
    $id_USER = $_POST["id_USER"];
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
	$email=$_POST['email'];
	$pass=$_POST['pass']; 
    $metodo = "cifradoPropio";
 
    $options = [
        'cost' => 12,
    ];

    $pswd = password_hash($pass, PASSWORD_BCRYPT, $options);
    $direc = password_hash($direccion, PASSWORD_BCRYPT, $options);
    
    $sentencia = $base_de_datos->prepare("UPDATE usuarios SET nombre = ?, direccion = ?, email = ?, pass = ?, _key = ?, iv = ?, metodo = ? WHERE idUsuario = ?;");
    $resultado = $sentencia->execute([$nombre, $direc, $email, $pswd, "", "", $metodo, $id_USER]); 

    if($resultado === TRUE){
        header("Location: ../cifradoPropio.php");
        die();
    }else echo "Algo salió mal. Por favor verifica que la tabla exista";

};
?>