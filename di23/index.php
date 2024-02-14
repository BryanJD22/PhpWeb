<?php session_start();
    if(isset($_SESSION['usuario']) && $_SESSION['usuario']!=''){
        //esta logeado
    }else{
        //header('Location: login.php');
    }
    // https://es.cooltext.com/
?>
<!DOCTYPE html>
<html lang="es">
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyJ8EQxFmRwOOj4BAaK86b1LZz97N6UwEy" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-e8qD9NRlAqw8C2an8lNdG8kHAWFDTyZtldz9n0aPnBcA6IeKKD5bqr25b9stHEi6" crossorigin="anonymous"></script>
        <meta name="viewport" 
            content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" 
            href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
        </link>
        <link rel="icon" type="image/x-icon" href="img/minilogo.png">
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="css/index3.css">
        <title>FrutiZ</title>

    </head>
    <body>
        <section id="secEncabezadoPagina" class="container-fluid">
            <div class="row">
                <div class="divLogotipo col-lg-2 col-md-2 col-sm-10">
                    <img src="img/logoFrtiz.png">
                </div>
                <div class="divTituloApp col-lg-8 col-md-8 d-none d-md-block" id="miNombre">BRYAN DÁVILA CIANCA</div>
                <div class="divLog col-lg-2 col-md-2 col-sm-2 " id="logoLogin">
                    <?php
                        if(isset($_SESSION['usuario'])){
                            echo '<a href="logout.php" id="logOut" title="LogOut">';
                            echo $_SESSION['usuario'];
                            echo    '<img src="img/cerrar-sesion.png">';
                            echo '</a>';
                        }else{
                            echo '<a href="login.php" title="Login">';
                            echo    '<img src="img/avatar.png">';
                            echo '</a>';
                        }
                    ?>
                </div>
            </div>
        </section>
        <section id="secMenuPagina" class="container-fluid">
            

        <?php
            require_once 'controladores/C_Menus.php';
            $menu = new C_Menus();
            $menu -> getMenus();
        ?>


        </section>
        <br>

        <div id="bloqueContenido">
        <section id="secContenidoPagina" class="container-fluid"></section>
        </div>
        <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>