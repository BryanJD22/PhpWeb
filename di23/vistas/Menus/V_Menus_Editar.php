<?php
    $menus = $datos['menus2'];
echo '<form id="formularioUpdatearMenu" name="formularioUpdatearMenu">';
echo '<div id="camposUpdatearMenu" style="display: block;">';
echo '<p class="" id="txtUpdatear">Updatear menú</p>';
echo '</div>';
echo '<label for="titulo">titulo del Menú:</label>';
echo '<input type="text" id="titulo" name="titulo" placeholder=' . $menus[0]['titulo'] .'><br>';
echo '<label for="id_menu_padre">ID del Padre:</label>';
echo '<input type="text" id="id_menu_padre" name="id_menu_padre" placeholder='. $menus[0]['id_menu_padre']  .'><br>';
echo '<label for="accion">Acción:</label>';
echo '<input type="text" id="accion" name="accion" placeholder="'. $menus[0]['accion']  .'"><br>';
echo '<button type="button" id="btnUpdatear" class="btn btn-primary" onclick="updateMenu('. $menus[0]['id_menu']  .');">Updatear Menú</button>';
echo '</div>';
echo '</form>';

    
?>

