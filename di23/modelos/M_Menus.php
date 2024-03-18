<?php

require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Menus extends Modelo
{
    public $DAO;

    public function __construct()
    {
        parent::__construct(); //ejecuta constructor del padre
        $this->DAO = new DAO();
    }

    public function buscarmenus(){
        $SQL = "SELECT * FROM menus";
        // echo $SQL;
        $menus = $this->DAO->consultar($SQL);

        return $menus;
    }

    public function buscarPermisos($nombre_usuario){
        $SQL = "SELECT PE.id_permiso, pe.nombre  FROM permisosusuarios pu 
        INNER JOIN permisos pe ON pu.id_permiso = pe.id_permiso 
        INNER JOIN usuarios us ON pu.id_usuario = us.id_Usuario 
        WHERE us.login = '$nombre_usuario';";
        $permisos = $this->DAO->consultar($SQL);
        return $permisos;
        
    }
    
    public function buscarMenuMtto()
    {
      $SQL = "SELECT * FROM menus WHERE 1=1 ORDER BY id_menu_padre ASC, posicion ASC";

      $sqlPermisos = "SELECT P.id_Permiso, P.nombre, P.id_menu FROM permisos P INNER JOIN menus M ON P.id_menu = m.id_menu;";

      $permisosMenu = $this->DAO->consultar($sqlPermisos);

      $menus = $this->DAO->consultar($SQL);

      foreach ($menus as $menu) {
        if ($menu['id_menu_padre'] == 0) {
          $menuBueno[$menu['id_menu']] = $menu;
        } else {
          $menuBueno[$menu['id_menu_padre']]['hijos'][] = $menu;
        }
      }

      $resultados = array(
        'menus' => $menuBueno,
        'permisosMenu' => $permisosMenu
    );
      return $resultados;
    }
    public function buscarMenuporID($parameters = array())
    {
      $id_menu = "";
      extract($parameters);
      $SQL = "SELECT * FROM menus WHERE id_menu = $id_menu";
      $menus = $this->DAO->consultar($SQL);
      return $menus;
    }
    

    public function eliminarMenu($parameters = array()){
      $id_menu = "";
      extract($parameters);
      $SQL = "DELETE FROM menus WHERE ID_MENU = '$id_menu';";
      $menus = $this->DAO->borrar($SQL);
      return $menus;
  
    }
    

    public function crearMenu($parameters = array()){
      $id_menu = "";
      $titulo = "";
      $id_menu_padre = "";
      $accion = "";
      $orden = "";
    
      extract($parameters);
      echo $titulo . " - " . $id_menu_padre . " - " . $accion;

    // Verificar si el id_menu está presente
    if (!empty($id_menu)) {
 
      // Realizar alguna acción si el id_menu está presente
      $sqlPosicion2 = "SELECT posicion AS posicion FROM menus where id_menu = $id_menu;";
      $result = $this->DAO->consultar($sqlPosicion2);
      if (!empty($result)) {
        // Obtener el valor de la última posición
        $ultima_posicion = $result[0]['posicion'];
    
        // Incrementar el valor de la última posición
        $orden = $ultima_posicion + 1;

      } else {
        // Si la consulta no devuelve resultados, establecer el orden como 1
        $orden = 1;
      }
      $SQL = "INSERT INTO `menus`(`posicion`, `titulo`, `accion`) VALUES ($orden, '$titulo', '$accion');";
      $this->DAO->insertar($SQL);
      $sqlActualizarOrden = "UPDATE menus SET posicion = posicion + 1 WHERE posicion >= '$orden'";
      $this->DAO->actualizar($sqlActualizarOrden);

    } else {
        // Realizar otra acción si el id_menu no está presente
        $sqlPosicion = "SELECT MAX(posicion) AS ultima_posicion FROM menus where id_menu_padre = $id_menu_padre;";
        $result = $this->DAO->consultar($sqlPosicion);
      
        // Verificar si la consulta devolvió resultados
        if (!empty($result)) {
          // Obtener el valor de la última posición
          $ultima_posicion = $result[0]['ultima_posicion'];
      
          // Incrementar el valor de la última posición
          $orden = $ultima_posicion + 1;
        } else {
          // Si la consulta no devuelve resultados, establecer el orden como 1
          $orden = 1;
        }
        $SQL = "INSERT INTO `menus`(`posicion`, `titulo`, `id_menu_padre`, `accion`) VALUES ($orden, '$titulo', $id_menu_padre, '$accion');";
        $this->DAO->insertar($SQL);
        
    }
    

      $mensaje = "Menu creado correctamente";
      return $mensaje;

    }

    public function buscarUsuarioRol(){
        $sqlUsuarios = "SELECT id_usuario, login FROM usuarios order by id_usuario;";
        $sqlRol =  "SELECT id_rol, nombre FROM roles order by id_rol";
        $usuarios = $this->DAO->consultar($sqlUsuarios);
        $roles = $this->DAO->consultar($sqlRol);
        $resultados = array(
          'usuarios' => $usuarios,
          'roles' => $roles
      );
        return $resultados;
    }
    
  
    public function editarMenu($filtro=array()){
      //sexo  mail  movil  login  pass
      $id_menu='';
      $titulo='';
      $id_menu_padre='';
      $accion='';
      $orden='';
      extract($filtro);

      $SET='';

      if($titulo!=null){
          $SET.= "titulo='$titulo',";
      }
      if($id_menu_padre!= ''){
          $SET.= "id_menu_padre='$id_menu_padre',";
      }
      if($accion!= ''){
          $SET.= "accion='$accion',";
      }
      if($orden!= ''){
          $SET.= "orden='$orden',";
      }

      $SET = mb_substr($SET, 0, -1);
      $SQL="UPDATE menus SET $SET WHERE id_menu=$id_menu";

      echo($SQL);
      $respuesta=$this->DAO->actualizar($SQL);
      
      if($respuesta!=null){
          $insertado = 'Actualizado correctamente';
          return $insertado;
      }else{
          $insertado = 'Ha ocurrido un error al actualizar';
          return $insertado;
      }
      
  }

}
?>