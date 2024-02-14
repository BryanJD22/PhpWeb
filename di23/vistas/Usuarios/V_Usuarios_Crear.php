
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body id="body_formulario">

<div class="container mt-5" >


    <form id="formulario_crear" method="post" >

        <div class="form-group">
            <label for="nombreEdt">Nombre:</label>
            <input type="text" class="form-control" name="nombreEdt" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="apellido1Edt">Apellido 1:</label>
                <input type="text" class="form-control" name="apellido1Edt" required>
            </div>

            <div class="form-group col-md-6">
                <label for="apellido2Edt">Apellido 2:</label>
                <input type="text" class="form-control" name="apellido2Edt" required>
            </div>
        </div>

        <div class="form-group">
            <label for="usuarioEdt">Usuario:</label>
            <input type="text" class="form-control" name="usuarioEdt" required>
        </div>

        <div class="form-group">
            <label for="sexoEdt">Sexo:</label>
            <select class="form-control" name="sexoEdt" required>
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
            </select>
        </div>

        <div class="form-group">
            <label for="emailEdt">Email:</label>
            <input type="email" class="form-control" name="emailEdt" required>
        </div>

        <!--<div class="form-group">
            <label for="contrasenaEdt">Contraseña:</label>
            <input type="password" class="form-control" name="contrasenaEdt" require>
        </div>-->

        <div class="form-group">
            <label for="telefonoEdt">Teléfono:</label>
            <input type="tel" class="form-control" name="telefonoEdt" required>
        </div>

        <div class="form-group">
            <label for="actividadEdt">Actividad:</label>
            <select class="form-control" name="actividadEdt" required>
                <option value="S">Activo</option>
                <option value="N">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary" id="boton_agregar" name="registro" type="button" onclick="agregarUsuario()">Añadir Usuario</button>
    </form>
</div>

<!-- Incluye la biblioteca de Bootstrap y jQuery al final del body para un rendimiento óptimo -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/Usuarios.js"></script>
</body>
</html>
