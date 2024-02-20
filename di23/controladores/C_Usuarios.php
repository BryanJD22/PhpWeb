<?php

    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Usuarios.php';

    class C_Usuarios extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Usuarios();
        }

        public function validarUsuario($filtros){
            $valido='N';
            $usuario=$this->modelo->buscarUsuarios($filtros);
            if (!empty($usuario)) {
                $valido='S';
                $_SESSION['usuario'] = $usuario[0]['login'];
                
            }
            return $valido;
        }

        public function getVistaUsuarios(){
            Vista::render('vistas/Usuarios/V_Usuarios.php');
        }

        public function getVistaAñadir(){
            Vista::render('vistas/Usuarios/V_Usuarios_Crear.php');
        }
////////////////////////////////////////////////////////////////////////////
        public function buscarUsuarios($filtros=array()){
            $usuarios=$this->modelo->buscarUsuarios($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', 
                            array('usuarios'=>$usuarios));
        }
//////////////////////////////////////////////////////////////////////////
        public function crearUsuario($filtros = array()) {
            
            $usuarios=$this->modelo->crearUsuario($filtros);
            echo json_encode($usuarios);
            
            Vista::render('vistas/Usuarios/V_Usuarios_Crear.php', 
                            array('usuarios'=>$usuarios));

        }


        
        public function getVistaEditar() {

            Vista::render('vistas/Usuarios/V_Usuarios_Editar.php');

        }
        
        public function buscarUsuarioPorID($filtros=array()){
            $usuario = $this->modelo->buscarUsuarios($filtros);

            Vista::render('vistas/Usuarios/V_Usuarios_Editar.php', array('usuarios' => $usuario));
        }
        
        public function editarUsuarios($filtros=array()){
            $usuario = $this->modelo->editarUsuarios($filtros);
            
            Vista::render('vistas/Usuarios/V_Resultado_Editar.php', array('usuarios' => $usuario));
            
        }

    }
?>