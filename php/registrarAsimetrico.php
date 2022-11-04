<?php
include_once "conexion.php";

if(!isset($_POST["nombre"]) || !isset($_POST["direccion"]) || !isset($_POST["email"]) || !isset($_POST["pass"])){
    exit();
}else{

	$key = "";
    $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $max = strlen($pattern)-1;
    for($i = 0; $i < 5; $i++){
        $key .= substr($pattern, mt_rand(0,$max), 1);
    }

	$iv = base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')));
	

    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
	$email=$_POST['email'];
	$pass=$_POST['pass']; 
    $metodo = "asimetrico";

    $encrypyted=openssl_encrypt($pass, 'aes-256-cbc', $key, false, $iv);
    $passEncriptado = base64_encode($encrypyted.'::'.$iv);

    $encrypyted2=openssl_encrypt($direccion, 'aes-256-cbc', $key, false, $iv);
    $direccEncriptado = base64_encode($encrypyted2.'::'.$iv);

    $sentencia = $base_de_datos->prepare("INSERT INTO usuarios(nombre, direccion, email, pass, _key, iv, metodo) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $direccEncriptado, $email, $passEncriptado, $key, $iv, $metodo]); 

    if($resultado === TRUE){
        header("Location: ../asimetrico.php");
        die();
    }else echo "Algo salió mal. Por favor verifica que la tabla exista";

};
?>
