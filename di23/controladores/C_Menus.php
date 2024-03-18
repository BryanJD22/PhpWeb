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
        
        // public function getVistaMtto($parameters = array())
        // {
        //     $menus = $this->modelo->buscarMenu($parameters);
            
        //     Vista::render('vistas\Menus\V_MttoMP.php');
           
        // }
                
        public function getVistaMtto(){
            //$menus = $this->modelo->buscarMenu($parameters);
            
            Vista::render('vistas\Menus\V_MttoMP.php');
           
        }
        
        public function busquedaMenus($parameters = array()){
            $resultados  = $this->modelo->buscarMenuMtto($parameters);
            $menus = $resultados['menus'];
            $permisosMenu = $resultados['permisosMenu'];

            Vista::render(
                'vistas\Menus\V_Resultadosmtto.php',
                array(
                    'menus' => $menus,
                    'permisosMenu' => $permisosMenu
                )
            );
        }
        
        public function busquedaMenusPorID($parameters = array()){
            $menus = $this->modelo->buscarMenuporID($parameters);
            Vista::render(
                'vistas\Menus\V_Menus_Editar.php',
                array('menus2' => $menus)
            );
        
        }

        public function eliminarMenu($parameters = array()){
            $menus = $this->modelo->eliminarMenu($parameters);
            
            Vista::render(
                'vistas\Menus\V_ResultadosMtto.php',
                array('menus2' => $menus)
            );

        }

        public function crearMenu($parameters = array()){
            $menus = $this->modelo->crearMenu($parameters);

        }

        public function editarMenu($filtros=array()){
            $menus = $this->modelo->editarMenu($filtros);
            
            // Vista::render('vistas/Menus/V_Menus_Editar.php', array('menus2' => $menus));
            
        }

        public function buscarUsuarioRol(){
            
            $resultados = $this->modelo->buscarUsuarioRol();
            
            $usuarios = $resultados['usuarios'];
            $roles = $resultados['roles'];

            Vista::render(
                'vistas\Menus\V_MttoMP.php',
                array(
                    'usuarios' => $usuarios,
                    'roles' => $roles
                )
            );
        }



    }
?>