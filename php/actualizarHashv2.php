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
    $metodo = "hashv2";
 
    $keyAES = "";
    $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $max = strlen($pattern)-1;
    for($i = 0; $i < 5; $i++){
        $keyAES .= substr($pattern, mt_rand(0,$max), 1);
    }

    $inivec = "";
    $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $max = strlen($pattern)-1;
    for($i = 0; $i < 5; $i++){
        $inivec .= substr($pattern, mt_rand(0,$max), 1);
    }



    $pswd=FALSE;
    $key = hash('sha256', $keyAES);
    $i = substr(hash('sha256',$inivec),0,16);

    $pswd = openssl_encrypt($pass, 'aes-256-cbc', $key,0, $i);
    $pswd = base64_encode($pswd);

    $direcc = openssl_encrypt($direccion, 'aes-256-cbc', $key,0, $i);
    $direcc = base64_encode($direcc);
    
    $sentencia = $base_de_datos->prepare("UPDATE usuarios SET nombre = ?, direccion = ?, email = ?, pass = ?, _key = ?, iv = ?, metodo = ? WHERE idUsuario = ?;");
    $resultado = $sentencia->execute([$nombre, $direcc, $email, $pswd, "", "", $metodo, $id_USER]); 

    if($resultado === TRUE){
        header("Location: ../hashv2.php");
        die();
    }else echo "Algo salió mal. Por favor verifica que la tabla exista";

};
?>