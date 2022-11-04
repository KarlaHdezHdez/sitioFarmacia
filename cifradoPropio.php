<?php
    include_once "./php/conexion.php";
    $sentencia = $base_de_datos->query("SELECT * FROM usuarios WHERE metodo='CifradoPropio'");
    $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado Propio</title>

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <!--HEADER-->
    <?php   
        include ('header.php');
    ?>

    <div class="container"><br>

        <!--Titulo-->
        <div class="row g-3">
            <div class="col-sm-10">
                <div class="card-header">
                    <h3><strong> Cifrado Propio </strong> </h3>
                </div>
            </div>
        </div>
        <br>


        <!--FORMULARIO-->
        <div class="card" style="background-color: #fff; border-color:#D7D4D4;">
            <form action="./php/registrocifradoP.php" method="Post">
                <div class="card-body">
                    <div class="container-md">
                        <label for="nombre" class="form-label">Nombre completo: </label>
                        <input type="text" class="form-control" id="nombre" required placeholder="Ingrese el nombre completo" name="nombre">
                    </div>
                    <div class="container-md">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" class="form-control" id="direccion" required placeholder="Ingrese la dirección" name="direccion">
                    </div>
                    <div class="container-md">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" id="email" required placeholder="Ingrese el email" name="email">
                    </div>
                    <div class="container-md">
                        <label for="pass" class="form-label">Contraseña: </label>
                        <input type="password" class="form-control" id="pass" required placeholder="Ingrese la contraseña" name="pass">
                    </div>
                    
                    <br> 
                    <input type="submit" value="Guardar" class="btn btn-success">
                    <input type="reset" value="Limpiar" class="btn btn-danger">
                </div>
            </form>
        </div>


        <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Email</th>
                <th scope="col">Contraseña Encriptada con Cifrado Propio</th>
                <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario){ ?>
                <tr>
                    <td><?php echo $usuario->idUsuario ?></td>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->direccion ?></td>
                    <td><?php echo $usuario->email ?></td>
                    <td><?php echo $usuario->pass ?></td>
                    <td>                        
                        <a href="<?php echo "./php/deletePropio.php?id=".$usuario->idUsuario?>" type="button" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                            </svg> Eliminar                                                   
                        </a>   
                        <a href="<?php echo "./CifradoPDesencriptar.php?id=".$usuario->idUsuario?>" type="button" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"></path>
                            </svg> Modificar               
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>

    </div>
    
</body>
</html>