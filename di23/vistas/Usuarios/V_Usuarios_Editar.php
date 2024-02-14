<?php
    //Hacemos una comprobacion para saber si el usuario ha iniciado sesion y en caso de que haya iniciado le mosntramos el siguiente mensaje

    $usuario = $datos['usuarios'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index3.css"> <!-- Crea tu propio archivo CSS para personalizar aún más los estilos -->
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header titulo-verde">
                <h3 class="mb-0">Editar Usuario</h3>
            </div>
            <div class="card-body">
                <form id="formularioEdicionUsuario">

                    <input type="hidden" name="id_Usuario" value="<?php echo $usuario[0]['id_Usuario'] ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $usuario[0]['nombre'] ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellido1">Apellido 1:</label>
                            <input type="text" class="form-control" name="apellido1" value="<?php echo $usuario[0]['apellido_1'] ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="apellido2">Apellido 2:</label>
                            <input type="text" class="form-control" name="apellido2" value="<?php echo $usuario[0]['apellido_2'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" name="sexo">
                            <option value="M" <?php echo ($usuario[0]['sexo'] === 'M') ? 'selected' : ''; ?>>Mujer</option>
                            <option value="H" <?php echo ($usuario[0]['sexo'] === 'H') ? 'selected' : ''; ?>>Hombre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mail">Mail:</label>
                        <input type="text" class="form-control" name="mail" value="<?php echo $usuario[0]['mail'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="movil">Movil:</label>
                        <input type="text" class="form-control" name="movil" value="<?php echo $usuario[0]['movil'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" class="form-control" name="login" value="<?php echo $usuario[0]['login'] ?>">
                    </div>

                    <!--<div class="form-group">
                        <label for="pass">Contraseña:</label>
                        <input type="password" class="form-control" name="pass" value="<?php echo $usuario[0]['pass'] ?>">
                    </div>-->

                    <div class="form-group">
                        <label for="activo">Activo:</label>
                        <select class="form-control" name="activo">
                            <option value="S" <?php echo ($usuario[0]['activo'] === 'S') ? 'selected' : ''; ?>>Activo</option>
                            <option value="N" <?php echo ($usuario[0]['activo'] === 'N') ? 'selected' : ''; ?>>Inactivo</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-success" onclick="guardarCambios(<?php echo $usuario[0]['id_Usuario'] ?>)">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Incluye la biblioteca de Bootstrap y jQuery al final del body para un rendimiento óptimo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/Usuarios.js"></script>
</body>

</html>
