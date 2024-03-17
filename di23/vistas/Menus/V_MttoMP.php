<?php


    


?>
<script src="js/Menus.js"></script>
<div id="bloqueTxtMttoMenu" name="bloqueTxtMttoMenu">
    <h2 id="titulomtto">
        Mtto de Menús y Permisos.
    </h2>
    
</div>
<form id="formBusquedaMenus" name="formBusquedaMenus">
        <button type="button" class="btn btn-success" name="btnBuscarMenus" id="btnBuscarMenus"
            onclick="buscarMenus()">Buscar</button>
        <!-- <button class="btn btn-primary" type="button" name="btnCrearMenus" id="btnCrearMenus"
            onclick="mostrarCamposCreateMenu()">Nuevo Menú</button> -->
    </form>

<div id="bloqueFormMttoMenu">

    <form id="formularioCrearMenuF" name="formularioCrearMenuF">
        <div id="camposCrearMenu" name="formularioCrearMenu" style="display: none;">
            <h2  id="txtInsertar">Inserta un nuevo menú</h2>
            <!-- Contenedor para mensajes de error sobre los campos -->
            <div id="errores" class="error-container">
                <div id="errorNombreMenu" class="error"></div>
                <div id="errorIdPadre" class="error"></div>
                <div id="errorAccion" class="error"></div>
                <div id="errorOrden" class="error"></div>
            </div>

            <!-- Campos del formulario -->

            <!-- Campo Nombre del Menú -->
            <label for="titulo">Titulo del Menú:</label>
            <div id="nombreMenuError" class="error-field"></div>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo del Menú" require><br>

            <!-- Campo ID del Padre -->
            <label for="id_menu_padre">ID del Padre:</label>
            <div id="idPadreError" class="error-field"></div>
            <input type="text" id="id_menu_padre" name="id_menu_padre" placeholder="ID del Padre"><br>

            <!-- Campo Acción -->
            <label for="accion">Acción:</label>
            <div id="accionError" class="error-field"></div>
            <input type="text" id="accion" name="accion" placeholder="Acción"><br>

            <button type="button" id="btnInsertar" name="btnInsertar"  class="btn btn-success" onclick="isertMenu();">Insertar
                Menú</button>
        </div>
    </form>
    

</div>
<div id="bloqueMttoMenu">

</div>
