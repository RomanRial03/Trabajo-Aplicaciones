<?php
include("conexion.php");

class usuario{ 
    public int $id_usuario;
    public string $nombre;
    public string $apellido;
    public string $email;
    public string $clave;  
}

function ConsultarUsuarios(){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT * FROM usuarios "; 
    $result = $con->query($sql);
    $resultado = [];

    while ($row = $result->fetch_assoc()) { 
        array_push($resultado, $row); 
    } 
    return json_encode($resultado);
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
    $sql = "SELECT * FROM usuarios where email = '" . strtolower( $correo ) . "' "; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    
    return json_encode($row);
}
function ExisteMail($correo){
    //$u = new usuario();

    $con= conectar();
    $sql = "SELECT count(email) as existe FROM usuarios where email = '" . strtolower($correo) . "'"; 
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
function AgregarUsuario($nombre, $apellido, $email, $clave){
    if ( ExisteMail($email)) {
        return "{'error': 'si', 'descripcion': 'mail existente'}";
    }
    $con= conectar();
    $email = strtolower($email);
    $sql = "INSERT INTO usuarios (nombre, apellido, email, clave) VALUES ('$nombre', '$apellido','$email','$clave')";
    
    //ejecutar para insertar
    $result = $con->query($sql);    
    if ($result == 1){
        return "{'error': 'no', 'descripcion': 'usuario agregado correctamente'}";
    }else{
        return "{'error': 'si', 'descripcion': 'no se pudo agregar el usuario'}";
    }    
}
function EliminarUsuario($id){

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
function ModificarUsuario($id,$nombre,$apellido,$email,$clave){
    $con= conectar();
    if (!ExisteUsuario($id)){
        echo "Error, no existe el usuario";
    }
    $sql = "UPDATE usuarios SET nombre= '$nombre', apellido='$apellido', email='$email', clave= '$clave' WHERE id_usuario='$id'";
    $result = $con->query($sql);    
    if ($result == 1){
        return "ok";
    }else{
        return "Error, no se pudo editar el usuario";
    }  
    mysqli_close($con);
}
$data = json_decode( file_get_contents('php://input'));
switch($data->accion){
    case "agregar":
        $nombre= $data->nombre;
        $apellido=$data->apellido;
        $email= $data->email;
        $clave= $data->clave;     
        $respuesta = AgregarUsuario($nombre, $apellido, $email, $clave);        
        echo $respuesta;        
        break;
    case "validar_mail":
        $email= $_POST["email"];     
        if(ExisteMail($email))
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
        $correo= $_POST["email"];
        print(ConsultarUsuarioXMail($correo)); 
        break;
    case "consultar";        
        print(ConsultarUsuarios()); 
        break;        
    case "modificar";
        $data = json_decode($_POST["data"]);
        
        $nombre= $data["nombre"];
        $apellido=$data["apellido"];
        $email= $data["email"];
        $clave= $data["clave"];     
        $id= $data["id"];
        print(ModificarUsuario($id,$nombre,$apellido,$email,$clave));
        break;
}


