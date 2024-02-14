<?php

require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo
{
    public $DAO;

    public function __construct()
    {
        parent::__construct(); //ejecuta constructor del padre
        $this->DAO = new DAO();
    }

    /*public function buscarUsuarios($filtros = array()){
        $d_texto='';
        $c_texto='';
        $b_texto = '';
        $usuario = '';
        $pass = '';
        extract($filtros);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario);
            $pass = addslashes($pass);
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass')";
        }else{
            if ($b_texto != '') {
                $aTexto = explode(' ', $b_texto);
                $SQL .= " AND (1=2 ";
                foreach ($aTexto as $palabra) {
                    $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
                    $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
                    $SQL .= " OR nombre LIKE '%$palabra%' ";
                }
                $SQL .= " ) ";
            }
            //  echo $c_texto;
            if ( $c_texto !='T') {
    
                $SQL .= " AND sexo = '$c_texto'";
            }
            // echo $d_texto;
            // var_dump ($filtros);
            if ($d_texto != '') {
    
                $SQL .= " AND activo = '$d_texto'";
            }
        }
        
        $id_Usuario='';
        extract($filtro);
        
        $SQL="SELECT * FROM usuarios WHERE id_Usuario=$id_Usuario";


        // echo $SQL;
        $usuarios = $this->DAO->consultar($SQL);
        return $usuarios;
    }*/

    public function paginador($SQL, $cantidad){
        $SQL2 = str_replace('*', 'COUNT(*) AS cantidadUsuarios', $SQL);
        $respuesta = $this->DAO->consultar($SQL2);
        $cantidadUsuarios = $respuesta[0]["cantidadUsuarios"];
        //echo($cantidadUsuarios);
        return ceil($cantidadUsuarios/$cantidad);
    }

    public function buscarUsuarios($filtros = array()){
        $d_texto='';
        $c_texto='';
        $b_texto = '';
        $usuario = '';
        $pass = '';
        $id_Usuario = ''; // Added to declare $id_Usuario variable
        $cantidad='';
        $pagina='0';
        $paginas='0';
        extract($filtros);
    
        $SQL = "SELECT * FROM usuarios WHERE 1=1";
    
        if ($id_Usuario != '') {
            // If an ID is provided, search for the user by ID
            $id_Usuario = intval($id_Usuario); // Ensure ID is an integer to prevent SQL injection
            $SQL .= " AND id_Usuario = $id_Usuario";
        } else {
            if ($usuario != '' && $pass != '') {
                $usuario = addslashes($usuario);
                $pass = addslashes($pass);
                $SQL .= " AND login = '$usuario' AND pass = MD5('$pass')";
            } else {
                if ($b_texto != '') {
                    $aTexto = explode(' ', $b_texto);
                    $SQL .= " AND (1=2 ";
                    foreach ($aTexto as $palabra) {
                        $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
                        $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
                        $SQL .= " OR nombre LIKE '%$palabra%' ";
                    }
                    $SQL .= " ) ";
                }
    
                if ($c_texto != 'T') {
                    $SQL .= " AND sexo = '$c_texto'";
                }
    
                if ($d_texto != '') {
                    $SQL .= " AND activo = '$d_texto'";
                }
            }
        }
        
        if($cantidad!=''){
            $paginas = $this->paginador($SQL, $cantidad, $pagina);
            $inicio = $pagina*$cantidad;
            $SQL.=" LIMIT $inicio, $cantidad";
        }

        // echo $SQL;
        $usuarios = $this->DAO->consultar($SQL);
        $usuarios[] = $paginas;
        $usuarios[] = $pagina;
        return $usuarios;
        
    }
    

    // public function buscarUsuariosMayores($filtros=array()){
    //     $c_texto='';
    //     $usuario='';
    //     $pass='';
    //     extract($filtros);

    //     $SQL = "SELECT * FROM usuarios WHERE sexo = 'H'";


    //     if ($usuario!='' && $pass!='') {
    //         $usuario = addslashes($usuario);
    //         $pass = addslashes($pass);
    //         $SQL.=" AND login = '$usuario' AND pass = MD5('$pass')";
    //     }
    //     if($c_texto!=''){
    //         $dTexto=explode(' ', $c_texto);
    //         $SQL.=" AND sexo = '$c_texto'";
    //     }
    //     // echo $SQL;
    //     $usuarios=$this->DAO->consultar($SQL);
    //     return $usuarios;
    // }

    public function crearUsuario($filtros = array()) {
        $nombreEdt='';
        $apellido1Edt='';
        $apellido2Edt='';
        $usuarioEdt='';
        $sexoEdt='';
        $emailEdt='';
        $contrasenaEdt='';
        $telefonoEdt='';
        $actividadEdt='';

        
        extract($filtros);
        echo(extract($filtros));
        // Construir la consulta SQL utilizando consultas preparadas para evitar inyecciones SQL
        $SQL = "INSERT INTO usuarios (`nombre`, `apellido_1`, `apellido_2`, `sexo`, `fecha_Alta`, `mail`, `movil`, `login`, `pass`, `activo`)
        VALUES ('$nombreEdt', '$apellido1Edt', '$apellido2Edt', '$sexoEdt', NOW(), '$emailEdt', '$telefonoEdt', '$usuarioEdt', MD5('$contrasenaEdt'), '$actividadEdt')";


        echo($SQL);
        $SQLCheckLogin = "SELECT * FROM usuarios WHERE login = '$usuarioEdt'";
        $login_antiguo = $this->DAO->consultar($SQLCheckLogin);
        $numeroLoginAntiguos = sizeof($login_antiguo);
        if($numeroLoginAntiguos==0){
            if($usuarioEdt == "" ){
                $mensaje = 'Ha de introducir al menos un nombre de usuario.';
            }else{
                $this->DAO->insertar($SQL);
                $mensaje = 'Usuario introducido correctamente';
            }
        }else{
            $mensaje = 'El nombre de usuario introducido ya existe. Introduzca de nuevo los datos.';
        }
        return $mensaje;
        //$usuarios = $this->DAO->insertar($SQL);

    }

    
    
    public function crearUsuario2($parametros =  array())
    {
        $apellido_insert = '';
        $nombre_insert = '';
        $usuario_insert = '';
        $sexo_insert = '';
        $telefono_insert = '';
        $password_insert = '';


        extract($parametros);
        $SQL = "INSERT INTO usuarios (nombre, apellido_1, apellido_2, sexo, fecha_Alta, mail,movil, login, pass, activo )";


        $nombre_insert = addslashes($nombre_insert);
        $apellido_insert = addslashes($apellido_insert);
        $usuario_insert = addslashes($usuario_insert);
        $telefono_insert = addslashes($telefono_insert);
        $sexo_insert = addslashes($sexo_insert);
        $password_insert = addslashes($password_insert);

        $SQL .= "VALUES('$nombre_insert','$apellido_insert','$apellido_insert','$sexo_insert',NOW(),'$usuario_insert@2si2023.es','$telefono_insert','$usuario_insert',MD5('$password_insert'),'S')";

        $SQLCheckLogin = "SELECT * FROM usuarios WHERE login = '$usuario_insert'";
        $login_antiguo = $this->DAO->consultar($SQLCheckLogin);
        $numeroLoginAntiguos = sizeof($login_antiguo);
        if($numeroLoginAntiguos==0){
            if($usuario_insert == "" || $password_insert==""){
                $mensaje = 'Ha de introducir al menos un nombre de usuario y una password.';
            }else{
                $this->DAO->insertar($SQL);
                $mensaje = 'Usuario introducido correctamente';
            }
        }else{
            $mensaje = 'El nombre de usuario introducido ya existe. Introduzca de nuevo los datos.';
        }
        return $mensaje;
    }



    public function obtenerUsuarioPorId($filtro=array()) {
        $id_Usuario='';
        extract($filtro);
        
        $SQL="SELECT * FROM usuarios WHERE id_Usuario=$id_Usuario";

        $usuario=$this->DAO->consultar($SQL);
        
        return $usuario;

    }

    public function editarUsuarios($filtro=array()){
        //sexo  mail  movil  login  pass
        $id_Usuario='';
        $nombre='';
        $pass='';
        $movil='';
        $mail='';
        $apellido1='';
        $apellido2='';
        $sexo='';
        $login='';
        extract($filtro);

        $SET='';

        if($nombre!=null){
            $SET.= "nombre='$nombre',";
        }
        if($apellido1!= ''){
            $SET.= "apellido_1='$apellido1',";
        }
        if($apellido2!= ''){
            $SET.= "apellido_2='$apellido2',";
        }
        if($sexo!= ''){
            $SET.= "sexo='$sexo',";
        }
        if($mail!= ''){
            $SET.= "mail='$mail',";
        }
        if($movil!= ''){
            $SET.= "movil='$movil',";
        }
        if($login!= ''){
            $SET.= "login='$login',";
        }
        if($pass!= ''){
            $SET.= "pass='$pass',";
        }

        $SET = mb_substr($SET, 0, -1);
        $SQL="UPDATE usuarios SET $SET WHERE id_Usuario=$id_Usuario";

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
