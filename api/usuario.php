<?php
include("conexion.php");

class usuario{ 
    public int $id_usuario;
    public string $nombre;
    public string $apellido;
    public string $correo_electronico;
    public string $password;
    public datetime $fecha_de_nacimiento;   
}

function ConsultarUsuario($id_usuario){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT * FROM usuarios where id_usuario = " . $id_usuario; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    return json_encode($row);
}

function AgregarUsuario($nombre, $apellido, $genero, $correo_electronico){
    //$u = new usuario();

    $con= conectar();
    $nombre= 
    $apellido=
    $genero=
    $correo_electronico=
    $sql = "INSERT INTO usuarios (nombre, apellido, genero, correo_electronico,) VALUES ('John', 'Doe', 'masculino','aaa@email.com')";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    return json_encode($row);
}



print(ConsultarUsuario(1));
print(AgregarUsuario());

?>

