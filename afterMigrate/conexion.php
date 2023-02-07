<?php
    function conectarse()
    {
        $servidor="localhost";
        $usuario="root";
        $password="";
        $bd="system";

        $conectar = new mysqli($servidor,$usuario,$password,$bd);
        mysqli_set_charset($conectar,"utf8");
        return $conectar;
    }

    $conexion = conectarse();
?>