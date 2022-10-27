<?php
    include("api/conexion.php");
    if(!empty($_POST["email"]) && !empty($_POST["password"])){
        AgregarUsuario($nombre, $apellido, $genero, $correo_electronico, $password);
        
    } 

?>