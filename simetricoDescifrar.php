
<?php
include_once "./php/conexion.php";


if(!isset($_GET["id"])) exit();
$id = $_GET["id"];

$sentencia = $base_de_datos->prepare("SELECT * FROM usuarios WHERE idUsuario = ?;");
$sentencia->execute([$id]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);

if($usuario === FALSE){
	#No existe
	echo "¡No existe alguna persona con ese ID!";
	exit();
}

$password = $usuario->pass;
$_key = $usuario->_key;
$iv = $usuario->iv;

$encrypted_data = base64_decode($password);
$passDesencriptado = openssl_decrypt($password, 'aes-256-cbc', $_key, 0, $iv);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado Simétrico</title>

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
                        <h3><strong> Cifrado simétrico </strong> </h3>
                    </div>
                </div>
        </div>
        <br>

        <!--FORMULARIO-->
        <div class="card" style="background-color: #fff; border-color:#D7D4D4;">
            <form action="./php/actualizarSimetrico.php" method="Post">
                <div class="card-body">
                    <div class="container-md">
                        <label for="nombre" class="form-label">Nombre completo: </label>
                        <input type="text" class="form-control" id="nombre" value="<?php echo $usuario->nombre ?>" required placeholder="Ingrese el nombre completo" name="nombre">
                    </div>
                    <div class="container-md">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" class="form-control" id="direccion" value="<?php echo $usuario->direccion ?>" required placeholder="Ingrese la dirección" name="direccion">
                    </div>
                    <div class="container-md">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" id="email" value="<?php echo $usuario->email ?>" required placeholder="Ingrese el email" name="email">
                    </div>
                    <div class="container-md">
                        <label for="pass" class="form-label">Contraseña: </label>
                        <input type="text" class="form-control" id="pass" value="<?php echo $passDesencriptado ?>" required placeholder="Ingrese la contraseña" name="pass">
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