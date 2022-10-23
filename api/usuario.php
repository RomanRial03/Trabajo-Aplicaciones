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

function ConsultarUsuarioXId($id_usuario){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT * FROM usuarios where id_usuario = " . $id_usuario; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    return json_encode($row);
}
function ConsultarUsuarioXMail($correo){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT * FROM usuarios where correo_electronico = '" . strtolower( $correo ) . "' "; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    
    return json_encode($row);
}

function ExisteMail($correo){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT count(correo_electronico) as existe FROM usuarios where correo_electronico = '" . strtolower($correo) . "'"; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    if ( $row["existe"] > 0){
        return true;
    }else
    {
        return false;
    }    
}
function ExisteUsuario($id){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT count(id_usuario) as existe FROM usuarios where id_usuario= " . $id; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    if ( $row["existe"] > 0){
        return true;
    }else
    {
        return false;
    }    
}


function AgregarUsuario($nombre, $apellido, $genero, $correo_electronico, $password){
    if ( ExisteMail($correo_electronico)){
        return "Error, mail existente";
    }
    $con= conectar();
    $correo_electronico = strtolower($correo_electronico);
    $sql = "INSERT INTO usuarios (nombre, apellido, genero, correo_electronico, password) VALUES ('$nombre', '$apellido', '$genero','$correo_electronico','$password')";
    
    //ejecutar para insertar
    $result = $con->query($sql);    
    if ($result == 1){
        return "ok";
    }else{
        return "Error, no se pudo agregar el usuario";
    }    
}

function EliminarUsuario($id){
    //$u = new usuario();

    $con= conectar();
    if (!ExisteUsuario($id)){
        return "Error, no existe el usuario";
    }

    
    $sql = "DELETE FROM usuarios WHERE id_usuario = ".$id;
    //ejecutar para insertar
    $result = $con->query($sql);    
    if ($result == 1){
        return "ok";
    }else{
        return "Error, no se pudo eliminar el usuario";
    }  
}


$accion = $_POST["accion"];
switch($accion){
    case "agregar":
        $nombre= $_POST["nombre"];
        $apellido=$_POST["apellido"];
        $genero=$_POST["genero"];
        $correo_electronico= $_POST["correo_electronico"];     
        $password=$_POST["password"];  
        print(AgregarUsuario($nombre, $apellido, $genero, $correo_electronico, $password));
        break;
    case "validar_mail":
        $correo_electronico= $_POST["correo_electronico"];     
        if(ExisteMail($correo_electronico))
            print("si");
        else      
            print("no");
        break;  
    case "eliminar":
        $id= $_POST["id"];
        print(EliminarUsuario($id));
        break;
    case "consultarXid";
        $id= $_POST["id"];
        print(ConsultarUsuarioXId($id)); 
        break;
    case "consultarXmail";
        $correo= $_POST["correo_electronico"];
        print(ConsultarUsuarioXMail($correo)); 
        break;

}


