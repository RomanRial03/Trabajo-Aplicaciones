<?php 
include("conexion.php");
function HorarioOcupado($fechayhora,$id_usuario){
    
}

//entidad referencial foren key
$accion = $_POST["accion"];
switch($accion){
    case "OcuparHorario":
        $fechayhora=$_POST["fechayhora"];
        $id_usuario=$_POST["id_usuario"];
        print(HorarioOcupado($fechayhora,$id_usuario));
        break;
    case "DesocuparHorario":
        //
        break;
}