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


}
?>