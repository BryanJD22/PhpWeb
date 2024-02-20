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
    

}
?>