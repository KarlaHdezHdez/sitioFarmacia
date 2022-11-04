<?php
//Crear conexión
//$conexion = mysqli_connect("localhost", "root", "","micrositio");

$usuario = "root";
$pass = "";
$bd = "micrositio";
$servidor="localhost";

try{
	$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $bd, $usuario, $pass);
}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}

/*
if ($conexion) {
	echo "Conectado existosamente con la base de datos";
}else{
	echo "No se ha podido conectar a la base de datos";
}
*/
?>
