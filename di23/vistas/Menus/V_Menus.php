<?php

    $menus = $datos['menus'];
?>


<?php
    //Obtenemos los datos del menú.
    $filasMenu=$datos['menus'];
    //Creamos el array padre que
    $padres = array();
    foreach($filasMenu as $fila){
        if($fila['id_menu_padre'] == NULL){
            array_push($padres, $fila);
        }
        if($fila['id_menu_padre'] != NULL) {
            foreach($filasMenu as $padre){
                if($padre['id_menu']==$fila['id_menu_padre']){
                    $padre['hijos'] = $fila;
                    $padres[$fila['id_menu_padre']-1]['hijos'][] = $fila;
                }
            }
        }
    }
    //Imprimimos el array para comprobar que los datos han sido añadidos correctamente.
    //foreach($padres as $padre){echo print_r($padre);echo '<br>';}

echo '<nav class="navbar navbar-expand-sm navbar-light" id="cabeceraApartados" aria-label="Fourth navbar example">';
echo '<div class="container-fluid">';
echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="navbarsExample04">';
echo '<ul class="navbar-nav me-auto mb-2 mb-md-0">';
<<<<<<<<<<<<<<  ✨ Codeium Command ⭐ >>>>>>>>>>>>>>>>
foreach ($padres as $padre) {
    // Verificar permisos para mostrar el menú CRUD
    if ($padre['titulo'] == 'CRUDs' && !tienePermiso('ver_cruds')) {
        continue; // No mostrar este menú si no tiene permiso
    }

    if (empty($padre['hijos'])) {
        echo '<li class="nav-item">';
        // Verificar permisos para botón de editar
        if ($padre['titulo'] == 'Editar' && !tienePermiso('editar')) {
            // Botón de editar no se muestra
        } else {
            echo '<a class="nav-link active" aria-current="page" href="#">' . $padre['titulo'] . '</a>';
        }
        echo '</li>';
    } else {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">' . $padre['titulo'] . '</a>';
        echo '<ul class="dropdown-menu">';
        foreach ($padre['hijos'] as $hijo) {
            // Verificar permisos individuales para editar y añadir
            if (($hijo['titulo'] == 'Editar' && !tienePermiso('editar')) ||
                ($hijo['titulo'] == 'Añadir' && !tienePermiso('crear'))) {
                // No mostrar botón si no tiene permisos
                continue;
            }
            echo '<li><a class="dropdown-item" onclick="' . $hijo['accion'] . '">';
            echo $hijo['titulo'];
            echo '</a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }
}

// Función auxiliar para verificar permisos (debe estar definida en otro lugar del código)
function tienePermiso($permiso) {
    // Aquí se debe implementar la lógica de verificación de permisos
    // Por ejemplo, consultar a la sesión del usuario, base de datos, etc.
    // Retorna true si el usuario tiene el permiso, false en caso contrario
}
<<<<<<<  2aee5951-5a74-4d67-b3cf-a3d0d3ea6474  >>>>>>>
foreach($padres as $padre){
    if(empty($padre['hijos'])){
        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">';
        echo $padre['titulo'];
        echo '</a></li>';
    } else {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">'.$padre['titulo'].'</a>';
        echo '<ul class="dropdown-menu">';
        foreach($padre['hijos'] as $hijo){
            echo '<li><a class="dropdown-item" onclick="'.$hijo['accion'].'">';
            echo $hijo['titulo'];
            echo '</a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }
}

?>
