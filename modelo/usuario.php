<?php

require_once "./../Config/conexion.php";

class Usuario{

    private $db;

    public function __construct(){
        $this->db = Database::connect();

    }

    public function obtenerUsuario($email){ //Función de consultar email en la Base de Datos.

        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $consul = $this->db->prepare($sql);
        $consul->execute([":email" => $email]);

        return $consul->fetch();
    }
    

    public function login($email, $pass){
        $usuario = $this->obtenerUsuario($email);
        if($usuario && password_verify($pass, $usuario['contraseña'])){
            return $usuario;
        }

        return false;

    }

    public function listarUsuario(){

        $stmt = $this->db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll();
        
    }

    public function crearUsuarios($nombre, $email, $telefono, $rol, $pass){

        //Hashear Contraseña.
        $passHash = password_hash($pass, PASSWORD_BCRYPT);

        //SQL con Placeholders.
        $sql = "INSERT INTO usuarios (nombre, email, telefono, rol, contraseña) VALUES (:nombre, :email, :telefono, :rol, :pass)";

        //Preparar la Consulta.
        $consul = $this->db->prepare($sql);

        //Ejecutar Consulta con los Parámetros Correctos.

        return $consul->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':telefono' => $telefono,
            ':rol' => $rol,
            ':pass' => $passHash
        ]);

    }
}

?>