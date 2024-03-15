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
      $menus = $this->DAO->consultar($SQL);
      foreach ($menus as $menu) {
        if ($menu['id_menu_padre'] == 0) {
          $menuBueno[$menu['id_menu']] = $menu;
  
        } else {
          $menuBueno[$menu['id_menu_padre']]['hijos'][] = $menu;
  
        }
      }
      return $menuBueno;
    }

    public function eliminarMenu($parameters = array()){
      $id_menu = "";
      extract($parameters);
      $SQL = "DELETE FROM menus WHERE ID_MENU = '$id_menu';";
      $menus = $this->DAO->borrar($SQL);
      return $menus;
  
    }

    // public function crearMenu($parameters = array())
    // {
    //   $nombre_menu = "";
    //   $id_padre = "";
    //   $accion = "";
    //   $orden = "";
  
    //   extract($parameters);
    //   echo $nombre_menu . " - " . $id_padre . " - " . $accion . " - " . $orden;

    //   $sqlPosicion = "SELECT MAX(posicion) AS ultima_posicion FROM menus where id_menu_padre = $id_padre;"
  
    //   //condicion compruebe que no existe un menu con el mismo nombre
    //   $sqlVerificarMenu = "SELECT COUNT(*) AS total FROM Menu WHERE NOMBRE_MENU = '$nombre_menu';";
    //   $resultadoVerificarMenu = $this->DAO->consultar($sqlVerificarMenu);
    //   $filaNombre = $resultadoVerificarMenu[0]['total'];
    //   if ($filaNombre > 0) {
    //     echo "Error: Ya existe un menu con el mismo nombre.";
    //     return;
    //   }
    //   //al no ser auto increment lo hago a mano para que no de error
    //   // $SQLid_menu = "SELECT COUNT(*) AS num_menus FROM Menu";
    //   // $num_menus = $this->DAO->consultar($SQLid_menu);
    //   // $id_menu = $num_menus[0]['num_menus'];
    //   // $id_menu = $id_menu + 1;
  
    //   // //GESTIONO AL PADRE
    //   // if ($id_padre == 0) {
    //   //   $id_padre = "";
  
    //   // }
  
    //   // Incrementar el orden 
    //   $ordenIncrementado = $orden + 1;
  
    //   //comprobacion nombre
    //   if ($nombre_menu != "") {
    //     // $nombre_menu = addslashes($nombre_menu);
    //     // $id_padre = addslashes($id_padre);
    //     // $accion = addslashes($accion);
  
    //     $SQL = "INSERT INTO Menu (id_menu, nombre_menu, id_padre, accion, orden) VALUES ('$id_menu', '$nombre_menu', '$id_padre', '$accion', '$ordenIncrementado');";
    //     echo $SQL;
    //     $menus = $this->DAO->insertar($SQL);
    //     $sqlActualizarOrden = "UPDATE Menu SET ORDEN = ORDEN + 1 WHERE ORDEN >= '$ordenIncrementado'";
    //     $this->DAO->actualizar($sqlActualizarOrden);
    //     return $menus;
    //   } else {
    //     echo "Error: EL CAMPO NOMBRE";
    //   }
    // }
}
?>