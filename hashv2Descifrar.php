<?php

include_once "./php/conexion.php";

if(!isset($_GET["id"])) exit();
$id = $_GET["id"];

$sentencia = $base_de_datos->prepare("SELECT * FROM usuarios WHERE idUsuario = ?;");
$sentencia->execute([$id]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia2 = $base_de_datos->prepare("SELECT pass FROM usuarios WHERE idUsuario = ?;");
$sentencia2->execute([$id]);
$usuario2 = $sentencia2->fetch(PDO::FETCH_OBJ);
$r = $usuario2->pass;

$sentencia3 = $base_de_datos->prepare("SELECT _key FROM usuarios WHERE idUsuario = ?;");
$sentencia3->execute([$id]);
$usuario3 = $sentencia3->fetch(PDO::FETCH_OBJ);
$r2 = $usuario3->_key;

$sentencia4 = $base_de_datos->prepare("SELECT iv FROM usuarios WHERE idUsuario = ?;");
$sentencia4->execute([$id]);
$usuario4 = $sentencia4->fetch(PDO::FETCH_OBJ);
$r3 = $usuario4->iv;

$sentencia5 = $base_de_datos->prepare("SELECT direccion FROM usuarios WHERE idUsuario = ?;");
$sentencia5->execute([$id]);
$usuario5 = $sentencia5->fetch(PDO::FETCH_OBJ);
$r4 = $usuario4->iv;

$key = hash('sha256', $r2);
$i = substr(hash('sha256', $r3), 0, 16);
$pswd = openssl_decrypt(base64_decode($r), 'aes-256-cbc', $key, 0, $i);
$direc = openssl_decrypt(base64_decode($r4), 'aes-256-cbc', $key, 0, $i);



if($usuario === FALSE){
	#No existe
	echo "¡No existe alguna persona con ese ID!";
    
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash V2</title>

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<?php 
        include ('header.php');
    ?>
        
    <div class="container"><br>        
        <!--Titulo-->
        <div class="row g-3">
                <div class="col-sm-10">
                    <div class="card-header">
                        <h3><strong> Cifrado Hashv2 </strong> </h3>
                    </div>
                </div>
        </div>
        <br>

        <!--FORMULARIO-->
        <div class="card" style="background-color: #fff; border-color:#D7D4D4;">
            <form action="./php/actualizarHashv2.php" method="Post">
                <div class="card-body">
                <input type="text" name="id_USER" value="<?php echo $usuario->idUsuario ?>" hidden>
                    <div class="container-md">
                        <label for="nombre" class="form-label">Nombre completo: </label>
                        <input type="text" class="form-control" id="nombre" value="<?php echo $usuario->nombre ?>" required placeholder="Ingrese el nombre completo" name="nombre">
                    </div>
                    <div class="container-md">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" class="form-control" id="direccion"  value="<?php echo $direc ?>" required placeholder="Ingrese la dirección" name="direccion">
                    </div>
                    <div class="container-md">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" id="email" value="<?php echo $usuario->email ?>" required placeholder="Ingrese el email" name="email">
                    </div>
                    <div class="container-md">
                        <label for="pass" class="form-label">Contraseña: </label>
                        <input type="text" class="form-control" id="pass" value="<?php echo $pswd ?>" required placeholder="Ingrese la contraseña" name="pass">
                    </div>
                    
                    <br> 
                    <input type="submit" value="Guardar" class="btn btn-success">
                    <input type="reset" value="Limpiar" class="btn btn-danger">
                </div>
            </form>
        </div>
    
    </div>
    
</body>
</html>