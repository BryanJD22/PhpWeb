<?php

function generarHTML($menu, $permisosMenus ,$nivel = 0)
{
    $estilo = '';
    if ($nivel == 1) {
        $estilo = 'font-size: 2em; font-weight: bold; color: black;  margin-right: 10px;';
    } else {
        $estilo = 'font-size: 1.5em;  color: black;  margin-right: 10px;';
    }

    echo '<div id="divmenus" name="divmenus" style="border: 1px solid #4CAF50; background-color: #white; border-radius: 5px; padding: 10px; margin: 10px;">';
    echo '<span id= "menus" nivel= "' . $nivel . '" style="' . $estilo . '">' . str_repeat(' ', ($nivel - 1) * 4) . $menu['titulo'] . "</span>";

    echo '<div id="botonesMenu" name="botonesMenu">';
        echo '<button  class="btn btn-success" type="button" name="btnActualizarMenus" id="btnActualizarMenus" 
        style="margin: 5px;" onclick="buscarMenusporID('. $menu['id_menu'] .');toggleFormularioEditar(' . $menu['id_menu'] . ');">Actualizar Menú</button>';

        
        echo '<button class="btn btn-success" type="button" name="btnEliminarMenus" id="btnEliminarMenus" 
        style="margin: 5px;" onclick="eliminarMenu(' . $menu['id_menu'] . ')">Eliminar Menú</button>';

        echo '<br>';
        if (empty($menu['id_menu_padre'])) {
            echo '<button class="btn btn-success" type="button" name="btnCrearMenus" id="btnCrearMenus" 
                style="margin: 5px;" onclick="guardarIdMenuPadre(' . $menu['id_menu'] . '); mostrarCamposCreateMenu();">Crear Hijo</button>';
        }
        echo '<br>';

    echo '</div>';
    // Mostrar permisos relacionados al menú con checkbox
    echo '<div id="permisosMenu_' . $menu['id_menu'] . '">';
    foreach ($permisosMenus as $permiso) {
        if ($permiso['id_menu'] == $menu['id_menu']) {
            $checked = 'checked';
            echo '<label><input type="checkbox" name="permisosMenu[]" value="' . $permiso['id_Permiso'] . '" ' . $checked . '> ' . $permiso['nombre'] . '</label><br>';
        }
    }
    echo '</div>';


    echo '</div>';
    
    // guardarOrden('.$menu['id_menu'].');
    if (!empty($menu['hijos'])) {
        foreach ($menu['hijos'] as $hijo) {
            generarHTML($hijo, $permisosMenus, $nivel + 1);
        }
    }
    echo '</div>';
    echo '<div id="formularioEditar_' . $menu['id_menu'] . '" class="formularioEditar" style="display: none; margin-top: 10px;">';
    echo '</div>';
}


$menus = $datos['menus'];
$permisosMenus = $datos['permisosMenu'];




foreach ($menus as $menu) {
    generarHTML($menu, $permisosMenus, 1); 
    echo '<button class="btn btn-success" type="button" name="btnCrearPadre" id="btnCrearPadre"
            onclick="guardarIdMenu(' . $menu['id_menu'] . ');mostrarcrearPadre()";>Nuevo Padre</button>';
}




?>
