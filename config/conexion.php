<?php

//Definir clase.

class Database{

//Definir atributos.

private static $host = "localhost";
private static $dbname = "restaurante";
private static $username = "root";
private static $password = "";
private static $charset = "utf8mb4";
private static $pdo = null;

private function __construct(){

}

public static function connect(){


    if(self::$pdo === null){

        try{

            $dn = "mysql:host=". self::$host . ";dbname=" . self::$dbname . ";charset=" . self::$charset;
            self::$pdo = new PDO($dn, self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die("Error de Conexión".$e->getMessage());
            
        }
    }

    return self::$pdo;

    }

}

?>