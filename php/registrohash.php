<?php
include_once "conexion.php";

if(!isset($_POST["nombre"]) || !isset($_POST["direccion"]) || !isset($_POST["email"]) || !isset($_POST["pass"])){
    exit();
}else{

    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
	$email=$_POST['email'];
	$pass=$_POST['pass']; 
    $metodo = "hashv1";
 
    $pswd = sha1($password);
    $direc = sha1($direccion);
    
    $sentencia = $base_de_datos->prepare("INSERT INTO usuarios(nombre, direccion, email, pass, _key, iv, metodo) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $direc, $email, $pswd, "", "", $metodo]); 

    if($resultado === TRUE){
        header("Location: ../hashv1.php");
        die();
    }else echo "Algo salió mal. Por favor verifica que la tabla exista";

};
?>