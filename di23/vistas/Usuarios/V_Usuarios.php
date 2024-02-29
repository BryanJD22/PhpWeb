<?php
    echo '<div id="bloqueTxt"><a id="txtBusqueda">Busqueda de Usuarios</a></div>';
    $visualizar = 0;
    $editar = 0;
    if(isset($_SESSION['permisos'])){
        $permisos = $_SESSION['permisos'];
        foreach($permisos as $permiso){
            if($permiso['id_permiso'] == 1){
                $visualizar = 1;
            }elseif ($permiso['id_permiso'] == 2){
                $editar = 1;
            }

        }
    }


?>
<form id="formularioBuscar" name="formularioBuscar" onkeydown="return event.key != 'Enter';">
<link rel="stylesheet" href="css/index3.css">
<label for="b_texto">
    <input type="text" id="b_texto" name="b_texto" placeholder="Nombre">
</label>
<label class= "sexo"for="c_texto">Sexo
   <select  class="form-control" id="form_sexo"  name="c_texto">
   <option value="T">Todos</option>
    <option value="H">H</option>
    <option value="M">M</option>
   </select>
</label>
<label  class= "actividad"for="d_texto">Actividad
    <input type="checkbox" id="d_texto" name="d_texto" value="S" >
</label>

<label class="cantidad" for="cantidad">Cantidad:
        <select id="cantidad" name="cantidad">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
        </select>
</label>
<?php
if($visualizar== 1){
    echo '<button type="button" class="btn btn-success"  id="btnBuscar" onclick="buscarUsuarios()">Buscar</button>';
}else{
    echo '<button type="button" class="btn btn-success"  id="btnBuscar" onclick="visualizarUsuarios()">Buscar</button>';
}
?>
<!-- <button type="button" class="btn btn-success"  id="btnBuscar" onclick="visualizarUsuarios()">Buscar</button>  -->

<button type="button" class="btn btn-success" id="btnAñadir" onclick="getVistaMenuSeleccionado('Usuarios', 'getVistaAñadir')">Añadir</button>




</form>
<div id="capaResultadosBusqueda">


</div>