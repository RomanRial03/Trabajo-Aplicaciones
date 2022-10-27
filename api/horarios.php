<?php
include("conexion.php");
function ConsultarHorariosDisponibles($dias){
    $con= conectar();
    $sql = "SELECT * FROM disponibilidad WHERE dia= ".$dias; 
    $result = $con->query($sql);
    $resultado = [];

    while ($row = $result->fetch_assoc()) { 
        array_push($resultado, $row); 
    } 
    return json_encode($resultado);

}
function ExisteDisponibilidad($dias,$hora_real){
    $con= conectar();
    $fecha =  '2000-01-05 ' . $hora_real;
    $sql = "SELECT COUNT(dia) existe from disponibilidad where dia = '$dias' and hora_real =  '$fecha'";     
    $result = $con->query($sql);       
    $row = $result->fetch_assoc();    
    if ( $row["existe"] > 0){
        return true;
    }else
    {
        return false;
    }  
}
function ExisteDia($dias){
    $con= conectar();
    $sql = "SELECT COUNT(dia) existe from disponibilidad where dia = '$dias'";     
    $result = $con->query($sql);       
    $row = $result->fetch_assoc();    
    if ( $row["existe"] > 0){
        return true;
    }else
    {
        return false;
    }  

}
function AgregarHorario($dias,$hora_real){
    $con= conectar();
    $fecha =  '2000-01-03 ' . $hora_real;
    if(!ExisteDisponibilidad($dias,$hora_real)){
        $sql = "INSERT INTO disponibilidad (dia, hora_real) VALUES ('$dias', '$fecha')";        
        $result = $con->query($sql);    
        if ($result == 1){
            return "ok";
        }else{
            return "Error, no se pudo agregar el horario";
        };
    }else{
        return "Disponibilidad ya guardada";
    }     
}
function EliminarHorario($dias, $hora_real){
    $con= conectar();
    $fecha =  '2000-01-05 ' . $hora_real;
    if (!ExisteDisponibilidad($dias,$hora_real)){
        return "Error, no existe el horario";
    }
    $sql = "DELETE FROM disponibilidad WHERE dia = '$dias' and hora_real = '$fecha'";
    $result = $con->query($sql);    
    if ($result == 1){
        return "ok";
    }else{
        return "Error, no se pudo eliminar el horario";
    } 
}
function EliminarDia($dias){
    $con= conectar();
    if (!ExisteDia($dias)){
        return "Error, no existe el horario";
    }
    $sql = "DELETE FROM disponibilidad WHERE dia = '$dias'";
    $result = $con->query($sql);    
    if ($result == 1){
        return "ok";
    }else{
        return "Error, no se pudo eliminar el horario";
    } 
}



$accion = $_POST["accion"];
switch($accion){
    case "consultarHorarios":
        $dias= $_POST["dias"];
        print(ConsultarHorariosDisponibles($dias));
        break;
    case "AgregarHorario":
        $dias= $_POST["dias"];
        $hora_real= $_POST["hora_real"];
        print(AgregarHorario($dias,$hora_real));
        break;
    case "existe";
        $dias= $_POST["dias"];
        $hora_real= $_POST["hora_real"];
        print(ExisteDisponibilidad($dias,$hora_real));
        break;
    case "ExisteDia":
        $dias=$_POST["dias"];
        print(ExisteDia($dias));
        break;
    case "eliminarHorario";
        $dias= $_POST["dias"];
        $hora_real= $_POST["hora_real"];
        print(EliminarHorario($dias, $hora_real));
        break;
    case "EliminarDia";
        $dias= $_POST["dias"];
        print(EliminarDia($dias));
        break;
    
    



}
?>