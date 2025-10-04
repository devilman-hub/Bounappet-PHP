<?php

require_once __DIR__ "./../config/conexion.php";
require_once __DIR__ "./../modelo/usuario.php";

class UsuarioController{

    private $modelusuario;

    private function __construct(){
        $this->modelusuario = new Usuario();
    
    }

    //Login.

    public function validarusuario(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario = $this->modelusuario->login($_POST['email'], $_POST['contraseña']);
            
            if($usuario){
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: ../vista/view/perfil.php");
            
            }else{

                header("Location: ../vista/view/login.php");
                echo "Credenciales Incorrectas, bebé.";
                
            }

        }

        else{
            header("Location: ../vista/view/login.php");
        }

    }

    public function registrar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $rol = $_POST['rol'];
            $contraseña = $_POST['contraseña'];

            $usuario = new Usuario();
            $usuario->crearUsuario($nombre, $email, $telefono, $rol, $contraseña);

            header("Location: ../vista/view/perfil.php");
        }
        
    }

    public function cerrarsesion(){

        session_start();
        session_unset();
        session_destroy();
        header("Location: ../vista/view/login.php");
        exit();

    }

    // Crear Usuario.
    public function crear() {
        $this->modelusuario->crearUsuarios($_POST['nombre'], $_POST['email'], $_POST['contrasena'], $_POST['telefono'], $_POST['rol']);
        header("Location: ../vista/view/usuarios.php");
        exit();
}

    // Actualizar Usuario.
    public function actualizar() {
        $this->modelusuario->actualizarUsuario($_POST['id_usuario'], $_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['rol']);
        header("Location: ../vista/view/usuarios.php");
        exit();
    }

     // Eliminar Usuario.
    public function eliminar() {
        $this->modelusuario->eliminarUsuario($_POST['id_usuario']);
        header("Location: ../vista/view/usuarios.php");
        exit();
    
    }


}


$objeto = new UsuarioController();
$objeto->validarusuario();

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'login': $objeto->validarusuario(); break;
        case 'crear': $objeto->crear(); break;
        case 'actualizar': $objeto->actualizar(); break;
        case 'eliminar': $objeto->eliminar(); break;
        case 'cerrar': $objeto->cerrarsesion(); break;
    }
}

?>