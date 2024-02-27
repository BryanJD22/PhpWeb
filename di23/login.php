<?php session_start();
$usuario = '';
$pass = '';
extract($_POST);
//var_dump($_POST);
if ($usuario == '' || $pass == '') {
    $mensa = 'Debe completar los campos';
} else {
    require_once 'controladores/C_Usuarios.php';
    $objUsuarios = new C_Usuarios();
    $datos['usuario'] = $usuario;
    $datos['pass'] = $pass;
    // $resultado=$objUsuarios->validarUsuario($datos);

    $resultado = $objUsuarios->validarUsuario(array(
        'usuario' => $usuario,
        'pass' => $pass
    ));


    if ($resultado == 'S') {
        header('Location: index.php');
    } else {
        $mensa = 'Datos incorrectos';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/minilogo.png">
    <link rel="stylesheet" href="css/LoginCSS.css">
    <title>FrutiZ - Iniciar Sesión</title>
</head>

<body>
    <div id="login-container">
        <h1>Iniciar Sesión</h1>
        <form method="post" id="login-form">
            <label for="username">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="pass" name="pass" required>
            <br><br>
            <button type="submit" id="login-button">Iniciar Sesión</button>
            <br>
            <div id="mensaje-form">
                <?php echo $mensa; ?>
            </div>
        </form>
    </div>
</body>

</html>
