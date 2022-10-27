<?php
include("conexion.php");
function ConsultarHorariosDisponibles($dias){
    $con= conectar();
    $sql = "SELECT * FROM disponibilidad WHERE dia= ".$dias; 
    $result = $con->query($sql);
    $row = $result->fetch_assoc();    
    return json_encode($row);

}
function AgregarHorario($dias,$hora_real){
    $con= conectar();
    $sql = "INSERT INTO disponibilidad (dias, hora_real) VALUES ('$dias', '2000-01-03' + $hora_real)";
     //ejecutar para insertar
     $result = $con->query($sql);    
     if ($result == 1){
         return "ok";
     }else{
         return "Error, no se pudo agregar el horario";
     }  
}


$accion = $_POST["accion"];
switch($accion){
    case "consultarHorarios":
        $dias= $_POST["dias"];
        print(ConsultarHorariosDisponibles($dias));
        break;
    case "AgregarHorarios":
        $dias= $_POST["dias"];
        $hora_real= $_POST["hora_real"];
        print(AgregarHorario($dias,$hora_real));
        break;




}
?>