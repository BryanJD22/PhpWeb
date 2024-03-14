<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/index3.css">
</head>

<body>
 


<?php
   
   $editar = 0;
   if(isset($_SESSION['permisos'])){
       $permisos = $_SESSION['permisos'];
       foreach($permisos as $permiso){
           if($permiso['id_permiso'] == 2){
                $editar = 1;
           }

       }
    }
    $usuarios= $datos['usuarios'];

    array_pop($usuarios);
    array_pop($usuarios);

    echo '<table id="tablaListado" class="table table-dark">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Apellido</th>';
        echo '<th>Nombre</th>';
        echo '<th>Usuario</th>';
        echo '<th>Sexo</th>';
        echo '<th>Telefono</th>';
        echo '<th>Actividad</th>';
        if ($editar == 1) {
            echo '<th>Editar</th>'; 
            echo '<th>Eliminar</th>';
        }
        
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';


        function returnGenero($fila){
            if ($fila['sexo'] == 'H') {
                return "Hombre";
             }elseif($fila['sexo'] == 'M'){
                 return"Mujer";
            }
        }

        function returnActivos($fila){
            if($fila['activo'] == 'S'){
                return "Activo";
            }elseif($fila['activo'] == 'N'){
                return"Inactivo";
            }
        }

          
      
        
    
        foreach ($usuarios as $fila) {
            echo '<tr>';
            echo '<td>' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . '</td>';
            echo '<td>' . $fila['nombre'] . '</td>';
            echo '<td>' . $fila['login'] . '</td>';
            echo '<td>' . returnGenero($fila) . '</td>';
            echo '<td>' . $fila['movil'] . '</td>';
            echo '<td>' . returnActivos($fila) . '</td>';
            if ($editar == 1) {
                echo '<td><button class="btn btn-success" onclick=getParams('. $fila['id_Usuario'].');getVistaMenuSeleccionado('.'Usuarios'.','.'getVistaEditar'.')>Editar</button></td>';
                echo '<td><button class="btn btn-success" onclick="eliminarUsuario(' . $fila['id_Usuario'] . ')">Eliminar</button></td>';
            }// }else if($editar == 0){
            //     echo '<td><button class="btn btn-success" onclick="visualizarEditar()">Editar</button></td>';
            // }
            
            echo '</tr>';
        }

        $pagina = intval(end($datos['usuarios']));
        array_pop($datos['usuarios']);
        
        $paginas = intval(end($datos['usuarios']));
        array_pop($datos['usuarios']);
 
        
        echo '<div id = "paginador" class="paginador">';
        echo '    <a onclick="buscarUsuarios(1)" href="javascript:void(0)" class="pagina">&lt;&lt;</a>';
        echo '    <a onclick="buscarUsuarios(\'anterior\', '. $paginas .')" href="javascript:void(0)" class="pagina">&lt;</a>';
        echo '    <input type="text" id="num-pagina" class="num-pagina" value="'.($pagina + 1).'">';
        echo '    <button onclick="buscarUsuarios(undefined, '. $paginas .')" class="ir-btn">Ir</button>';
        echo '    <a onclick="buscarUsuarios(\'siguiente\', '. $paginas .')" href="javascript:void(0)" class="pagina">&gt;</a>';
        echo '    <a onclick="buscarUsuarios('. $paginas .')" href="javascript:void(0)" class="pagina">&gt;&gt;</a>';
        echo '</div>';

        

        echo '</tbody>';
        echo '</table>';
    

?>

</html>