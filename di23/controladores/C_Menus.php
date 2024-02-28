<?php

    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Menus.php';

    class C_Menus extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Menus();

        }

        public function getMenus(){ 
            $menus=$this->modelo->buscarmenus();

            Vista::render('vistas/Menus/V_Menus.php', 
                            array('menus' => $menus));
        }

        public function getpermisos($nombre_usuario){ 
            $permisos=$this->modelo->buscarPermisos($nombre_usuario);

            Vista::render('vistas/Menus/V_Menus.php', 
                            array('permisos' => $permisos));
        }


    }
?>