<?php

require_once "conexion.php";


try{
    $db = Database::connect();

    echo "Conexión Realizada.";
}

catch(PDOException $e){
    die("Error de Conexión".$e->getMessage());

}


?>