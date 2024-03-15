<?php

?>


<?php
    //Obtenemos los datos del menú.
    $filasMenu=$datos['menus'];
    
    //Creamos el array padre que
    $padres = array();
    foreach ($filasMenu as $fila) {
        if ($fila['id_menu_padre'] === NULL || $fila['id_menu_padre'] === '') {
            $padres[$fila['id_menu']] = $fila;
        } else {
            $padreId = $fila['id_menu_padre'];
            if (!isset($padres[$padreId])) {
                $padres[$padreId] = array(
                    'titulo' => '',
                    'hijos' => array()
                );
            }
            if (!isset($padres[$padreId]['hijos'])) {
                $padres[$padreId]['hijos'] = array();
            }
            $padres[$padreId]['hijos'][] = $fila;
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
