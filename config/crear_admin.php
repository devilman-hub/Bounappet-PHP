<?php

//Llamar la conexión.
require_once "conexion.php";


try{

    //Instanciar clase para conexión.

    $db = Database::connect();
    $email = "juliocesar@gmail.com";

    //Consultar si ese Usuario se encuentra registrado.

    $consul = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
    $consul->execute([":email" => $email]);

    //Registrar los Datos de Usuario y Contraseña.
    if(!$consul->fetch()){
        $pass = password_hash("admin123", PASSWORD_BCRYPT); //Encriptar Contraseña.

        //Insertar Nuevo Usuario con todos los valores como parámetros.

        $sql = "INSERT INTO usuarios (nombre, email, telefono, rol, contraseña) VALUES (:nombre, :email, :telefono, :rol, :clave)";
        $consult = $db->prepare($sql);
        $consult->execute([
            ":nombre" => "Admin",
            "email" => $email,
            ":telefono" => 1234567890,
            ":rol" => "Admin",
            ":clave" => $pass
        ]);

        echo "Usuario Administrador Creado con Éxito.";
    
    }else{

        echo "El Usuario Administrador ya se encuentra Registrado.";
    }

}

catch(PDOExcept $e){
    die("Error: " . $e->getMessage());

}

?>